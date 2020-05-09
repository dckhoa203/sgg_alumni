<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Survey;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    //lưu câu trả lời
    public function store(Request $request, Survey $survey)
    {
        // remove the token
        $arr = $request->except('_token');
        // dd($arr);
        if (!$arr != null) {
            return 123;
        } else {
            foreach ($arr as $key => $value) {
                $Answer = new Answer();
                $Question = Question::findOrFail($key);
                //check câu hỏi bắt buộc
                if (!is_array($value)) {
                    $Value = $value[$key];
                } else {
                    $Value = json_encode($arr, true);
                }
            }

            $Answer->insert([
            'survey_id' => $survey->survey_id,
            'user_id' => Auth::user()->user_id,
            'answer_content' => $Value,
            ]);

            return back()->with('success', 'Successful Survey!');

            // return redirect('survey');
        }
    }

    public function update(Request $request, Survey $survey)
    {
        // remove the token
        $arr = $request->except('_token');
        if (count($arr) == 0) {
            return back()->with('error', 'Không thể hủy khảo sát');
        } else {
            foreach ($arr as $key => $value) {
                $Question = Question::findOrFail($key);
                //check câu hỏi bắt buộc
                if (!is_array($value)) {
                    $Value = $value[$key];
                } else {
                    $Value = json_encode($arr, true);
                }
            }
            $check = Answer::where([['survey_id', $survey->survey_id], ['user_id', Auth::user()->user_id]])->get();
            // dd($check);
            if (!$check->isEmpty()) {
                Answer::where([['survey_id', $survey->survey_id], ['user_id', Auth::user()->user_id]])->update([
            'answer_content' => $Value,
            ]);
            } else {
                return back()->with('error', 'Không tìm thấy khảo sát');
            }

            return back()->with('success', 'Cập nhật thành công');
            // return redirect('survey')->with('error', 'Không tìm thấy khảo sát');

            // return redirect('survey');
        }
    }
}
