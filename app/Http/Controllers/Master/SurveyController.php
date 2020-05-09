<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\RoleSurvey;
use Carbon\Carbon;
// Export
use Excel;
use App\Exports\SurveysExport;
// Array
use Illuminate\Support\Arr;

class SurveyController extends Controller
{
    //khoi tao
    public function __construct()
    {
        parent::__construct();
    }

    public function home(Request $request)
    {
        $surveys = Survey::get();

        return view('home', compact('surveys'));
    }

    public function index(Request $request)
    {
        $config = [
          'model' => new Survey(),
          'request' => $request,
        ];
        $this->config($config);
        $survey = $this->model->web_index($this->request);

        return view('pages.admins.survey.index', ['survey' => $survey]);
    }

    // Show page to create new survey
    public function create_render()
    {
        return view('pages.admins.survey.create');
    }

    //tạo khảo sát
    public function create_submit(Request $request)
    {
        $survey_start = substr($request->get('survey_time'), 0, 19);
        $survey_end = substr($request->get('survey_time'), 22, 19);
        if (substr($survey_start, 17, 2) == 'AM') {
            $start = (date('Y-m-d h:i:s', strtotime($survey_start)));
        } else {
            $start = (date('Y-m-d H:i:s', strtotime($survey_start)));
        }
        if (substr($survey_end, 17, 2) == 'AM') {
            $end = (date('Y-m-d h:i:s', strtotime($survey_end)));
        } else {
            $end = (date('Y-m-d H:i:s', strtotime($survey_end)));
        }

        // dd(date('h:i A ', strtotime(substr($request->get('survey_time'), 0, 19))));
        // dd((substr($request->get('survey_time'), 0, 19)));
        // dd(strtotime(substr($request->get('survey_time'), 0, 19)));
        $this->validate($request, [
            'survey_name' => 'required',
            'survey_description' => 'required',
            'survey_version' => 'required',
            //set ngày bắt đầu trước ngày kết thúc
            // 'survey_start' => 'required|date|before:survey_end',
            // 'survey_end' => 'required|date|after:survey_start',
        ]);
        $surveys = new Survey();
        $surveys->user_id = Auth::user()->user_id;
        $surveys->survey_name = $request->get('survey_name');
        $surveys->survey_description = $request->get('survey_description');
        // $surveys->survey_start = $request->survey_start;
        // $surveys->survey_end = $request->survey_end;
        $surveys->survey_start = $start;
        $surveys->survey_end = $end;
        $surveys->survey_version = $request->get('survey_version');

        $survey_id = $surveys->insertGetId([
          'user_id' => $surveys->user_id,
          'survey_name' => $surveys->survey_name,
          'survey_description' => $surveys->survey_description,
        //   'survey_start' => $surveys->survey_start,
        //   'survey_end' => $surveys->survey_end,
          'survey_start' => $start,
          'survey_end' => $end,
          'survey_version' => $surveys->survey_version,
        ]);
        RoleSurvey::insert([
            'role_id' => (int) $request->role_id,
            'survey_id' => $survey_id,
        ]);

        return redirect("/survey/{$survey_id}");
    }

    //thêm câu hỏi
    public function detail_survey(Survey $survey)
    {
        $questions = Question::where('survey_id', $survey->survey_id)->orderBy('created_at', 'asc')->get();

        return view('pages.admins.survey.detail', compact('survey', 'questions'));
    }

    ////////////////////////////////////
    //middleware của khảo sát
    public function view_survey(Survey $survey)
    {
        //xét ngày khảo sát
        $now = Carbon::now();
        if (strstr($now->diffForHumans($survey->survey_start), 'after') and strstr($now->diffForHumans($survey->survey_end), 'before')) {
            $check = Answer::where([['user_id', Auth::user()->user_id], ['survey_id', $survey->survey_id]])->get();

            if ($check->isEmpty()) {//chưa trả lời
                $questions = Question::where('survey_id', $survey->survey_id)
                ->orderBy('created_at', 'asc')
                ->get();

                return view('pages.admins.survey.view', compact('survey', 'questions'));
            } else {//đã trả lời->chỉnh sửa câu tl
                $answer = json_decode($check[0]->answer_content, true);
                $questions = Question::where('survey_id', $survey->survey_id)
                ->orderBy('created_at', 'asc')
                ->get();

                return view('pages.admins.survey.update_answer', compact('survey', 'answer', 'questions'));
            }
        } else {
            return back()->with('error', 'Chưa đến thời gian khảo sát');
        }
    }

    //hiển thị đáp án
    public function view_survey_answers(Survey $survey)
    {
        // $survey->load('answers', 'questions');
        $questions = Question::where('survey_id', $survey->survey_id)
                ->orderBy('created_at', 'asc')
                ->get();
        $answer = Answer::where('survey_id', $survey->survey_id)->get();

        $survey_arr = $survey->load('answers')->toArray();

        // Lay user
        // foreach ($survey->answers as $item) {
        //     $name = $item->users->name;
        //     $code = $item->users->code;
        //     $users[] = [
        //         'name' => $name,
        //         'code' => $code,
        //     ];
        // }
        // $coun = Question::where('survey_id', $survey->survey_id)->count();
        // $survey_json = json_encode(Arr::add($survey_arr, 'users', $users));

        // return view('pages.admins.answer.view', compact('survey', 'survey_json', 'coun', 'questions'));
        return view('pages.admins.answer.view', compact('survey', 'questions'));
    }

    //lấy thông tin khảo sát cũ
    public function edit(Survey $survey)
    {
        $survey_id = Survey::findOrFail($survey->survey_id);
        $role = RoleSurvey::where('survey_id', $survey->survey_id)->first();
        if (substr(date('H:i A', strtotime($survey->survey_start)), 0, 2) > 12) {
            $start = date('m/d/Y h:i A', strtotime($survey->survey_start));
        } else {
            $start = date('m/d/Y h:i', strtotime($survey->survey_start)).' AM';
        }
        if (substr(date('H:i A', strtotime($survey->survey_end)), 0, 2) > 12) {
            $end = date('m/d/Y h:i A', strtotime($survey->survey_end));
        } else {
            $end = date('m/d/Y h:i', strtotime($survey->survey_end)).' AM';
        }
        // dd($start);
        $survey_time = $start.' - '.$end;
        // dd($survey_time);

        return view('pages.admins.survey.edit', compact('survey', 'survey_id', 'role', 'survey_time'));
    }

    //Cập nhật thong tin khảo sát
    public function update(request $request, $survey_id)
    {
        $survey_start = substr($request->get('survey_time'), 0, 19);
        $survey_end = substr($request->get('survey_time'), 22, 19);
        if (substr($survey_start, 17, 2) == 'AM') {
            $start = (date('Y-m-d h:i:s', strtotime($survey_start)));
        } else {
            $start = (date('Y-m-d H:i:s', strtotime($survey_start)));
        }
        if (substr($survey_end, 17, 2) == 'AM') {
            $end = (date('Y-m-d h:i:s', strtotime($survey_end)));
        } else {
            $end = (date('Y-m-d H:i:s', strtotime($survey_end)));
        }
        $this->validate($request, [
            'survey_name' => 'required',
            'survey_description' => 'required',
            'survey_version' => 'required',
        ]);

        $survey = Survey::find($survey_id);
        //lấy id người tạo
        $survey->user_id = Auth::user()->user_id;
        $survey->survey_name = $request->get('survey_name');
        $survey->survey_description = $request->get('survey_description');
        $survey->survey_start = $start;
        $survey->survey_end = $end;
        $survey->survey_version = $request->get('survey_version');

        $survey->save();

        RoleSurvey::where('survey_id', $survey_id)->update([
            'role_id' => $request->role_id,
        ]);

        return redirect('survey')->with('success', 'Updated Successfully!');
    }

    //Tạo khảo sát mới
    public function add_new($survey_id)
    {
        $i = 1;

        $now = Carbon::now();
        // dd($now->addSeconds(1));
        $survey = Survey::find($survey_id);
        $question = Question::where('survey_id', $survey_id)->get();

        $survey_id_insertgetid = Survey::insertGetId(array(
            'user_id' => Auth::user()->user_id,
            'survey_name' => $survey->survey_name,
            'survey_description' => $survey->survey_description,
            'survey_start' => $survey->survey_start,
            'survey_end' => $survey->survey_end,
            'survey_version' => $survey->survey_version + 1,
        ));
        $rolesurvey_old = RoleSurvey::where('survey_id', $survey_id)->first();
        RoleSurvey::insert([
            'survey_id' => $survey_id_insertgetid,
            'role_id' => $rolesurvey_old->role_id,
        ]);
        if (!$question->isEmpty()) {
            foreach ($question as $value) {
                ++$i;
                Question::insert([
                'survey_id' => $survey_id_insertgetid,
                'question_title' => $value->question_title,
                'question_mandatory' => $value->question_mandatory,
                'question_type' => $value->question_type,
                'question_option' => $value->question_option,
                'created_at' => $now->addSeconds(1),
            ]);
            }
        }

        return redirect('survey')->with('success', 'Updated Successfully!');
    }

    public function destroy($survey_id)
    {
        $data = Survey::findOrFail($survey_id);
        $data->delete();

        return redirect('survey')->with('success', 'Deleted Successfully!');
    }

    public function export(Request $request)
    {
        $survey = $request->get('data');
        $survey = json_decode($survey, true);
        // dd($survey);

        return Excel::download(new SurveysExport($survey), 'survey.xlsx');
    }
}
