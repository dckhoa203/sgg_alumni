<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Question;

class QuestionController extends Controller
{
    // Ham khoi tao
    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request, Survey $survey)
    {
        // dd($request);
        if (($request->question_mandatory)) {
            $question_mandatory = $request->question_mandatory;
        } else {
            $question_mandatory = null;
        }
        $arr = $request->except('_token');
        // dd($arr);
        // if($question_mandatory==null){

        // }else{}
        //duyệt request lưu dạng json
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                $Question = new Question();
                if (is_array($value)) {
                    $Option = json_encode($arr, true);
                } else {
                    $Option = '';
                }
            }
        }
        $tam = json_decode($Option, true);
        if (!empty($tam)) {
            foreach ($tam as $key => $value) {
                //xóa bớt các thành phần không cần thiết từ request
                if (!is_array($value)) {
                    unset($tam[$key]);
                }
                $v = $value;
            }
            $op = '{"option":'.json_encode($v, true).'}';
        } else {
            $op = null;
        }

        $Question->insert([
        'survey_id' => $survey->survey_id,
        'question_title' => $request->question_title,
        'question_mandatory' => $question_mandatory,
        'question_type' => $request->question_type,
        'question_option' => $op,
      ]);

        return back()->with('success', 'Successful Survey!');
    }

    public function up(Question $question)
    {
        if ($question->question_id - 1 > 1) {
            $up_before = Question::where([
                ['created_at', '<', $question->created_at],
                ['survey_id', $question->survey_id],
                ])
            ->orderBy('question_id', 'desc')
            ->get();

            if (!$up_before->isEmpty()) {
                $temp = $up_before[0]->created_at;
                $up_after = Question::where('question_id', $up_before[0]->question_id)->update([
                    // 'question_title' => $question->question_title,
                    // 'question_mandatory' => $question->question_mandatory,
                    // 'question_type' => $question->question_type,
                    // 'question_option' => $question->question_option,
                    'created_at' => $question->created_at,
                ]);
                $main_after = Question::where('question_id', $question->question_id)->update([
                    // 'question_title' => $up_ola[0]->question_title,
                    // 'question_mandatory' => $up_ola[0]->question_mandatory,
                    // 'question_type' => $up_ola[0]->question_type,
                    // 'question_option' => $up_ola[0]->question_option,
                    'created_at' => $temp,
                ]);

                return back()->with('success', 'Successful Question!');
            }

            return back();
        } else {
            return back();
        }
    }

    public function down(Question $question)
    {
        $down_before = Question::where([
            ['created_at', '>', $question->created_at],
            ['survey_id', $question->survey_id],
            ])
            ->get();

        if (!$down_before->isEmpty()) {
            $temp = $down_before[0]->created_at;
            $down_after = Question::where('question_id', $down_before[0]->question_id)->update([
                    'created_at' => $question->created_at,
                ]);
            $main_after = Question::where('question_id', $question->question_id)->update([
                    'created_at' => $temp,
                    ]);

            return back()->with('success', 'Successful Question!');
        }

        return back();
    }

    // public function up(Question $question)
    // {
    //     if ($question->question_id - 1 > 1) {
    //         $up_ola = Question::where([['question_id', '<', $question->question_id], ['survey_id', $question->survey_id]])
    //         ->orderBy('question_id', 'desc')
    //         ->get();
    //         if (!$up_ola->isEmpty()) {
    //             $up_new = Question::where('question_id', $up_ola[0]->question_id)->update([
    //                 'question_title' => $question->question_title,
    //                 'question_mandatory' => $question->question_mandatory,
    //                 'question_type' => $question->question_type,
    //                 'question_option' => $question->question_option,
    //             ]);
    //             $main_new = Question::where('question_id', $question->question_id)->update([
    //                 'question_title' => $up_ola[0]->question_title,
    //                 'question_mandatory' => $up_ola[0]->question_mandatory,
    //                 'question_type' => $up_ola[0]->question_type,
    //                 'question_option' => $up_ola[0]->question_option,
    //             ]);

    //             return back()->with('success', 'Successful Question!');
    //         }

    //         return back();
    //     } else {
    //         return back();
    //     }
    // }

    // public function down(Question $question)
    // {
    //     if ($question->question_id + 1 > 1) {
    //         $down_old = Question::where([['question_id', '>', $question->question_id], ['survey_id', $question->survey_id]])
    //         ->get();
    //         if (!$down_old->isEmpty()) {
    //             $down_new = Question::where('question_id', $down_old[0]->question_id)->update([
    //                 'question_title' => $question->question_title,
    //                 'question_mandatory' => $question->question_mandatory,
    //                 'question_type' => $question->question_type,
    //                 'question_option' => $question->question_option,
    //             ]);
    //             $main_new = Question::where('question_id', $question->question_id)->update([
    //                 'question_title' => $down_old[0]->question_title,
    //                 'question_mandatory' => $down_old[0]->question_mandatory,
    //                 'question_type' => $down_old[0]->question_type,
    //                 'question_option' => $down_old[0]->question_option,
    //             ]);

    //             return back()->with('success', 'Successful Question!');
    //         }

    //         return back();
    //     } else {
    //         return back();
    //     }
    // }

    public function edit(Question $question)
    {
        $question_id = Question::findOrFail($question->question_id);

        return view('pages.admins.question.edit', compact('question', 'question_id'));
    }

    //chưa fix lỗi json
    public function update(Request $request, $question_id)
    {
        // dd($request);
        if ($request->question_mandatory == 'on') {
            $question_mandatory = 1;
        } else {
            $question_mandatory = null;
        }
        $title = $request->question_title;
        $Option = '';
        $arr = $request->except('_token', 'question_title','question_mandatory');

        if (is_array($arr)) {
            $Question = Question::findOrFail($question_id);
            foreach ($arr as $key => $value) {
                if (!is_array($value)) {
                    $title = $value[$value];
                } else {
                    $Option = json_encode($arr, true);
                }

                $questionArray[] = $Question;
            }
        }
        //chưa làm xóa và thay đổi bắt buộc
        $Question->update([
                    'question_title' => $title,
                    'question_option' => $Option,
                    'question_mandatory' => $question_mandatory,
                ]);

        return back()->with('success', 'Updated Successfully!');
    }

    public function delete(Request $request, $question_id, $item1)
    {
        $Question = Question::where('question_id', $question_id)->get()->toArray();
        $Question2 = Question::findOrFail($question_id);
        $option = data_get($Question, '0.question_option');
        $obj = json_decode($option, true);
        foreach ($obj as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    unset($v[$item1]);
                    break;
                }
            }
            $tam = $v;
            break;
        }
        $op = '{"option":'.json_encode($tam, true).'}';
        $Question2->update([
            'question_option' => $op,
        ]);

        return back()->with('success', 'Updated Successfully!');
    }

    public function remove(Question $question)
    {
        $question_id = Question::findOrFail($question->question_id);
        $question_id->delete();
        // dd($data);
        return back();
    }
}
