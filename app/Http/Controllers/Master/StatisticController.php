<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\Major;
use App\Models\MajorBranch;
use App\Models\Classes;
use DB;
use App\Models\RegisterGraduate;
// Excel
use Excel;
use App\Exports\QuestionsExport;
use App\Exports\SurveysStatisticExport;
use App\Exports\JobStatisticExport;

class StatisticController extends Controller
{
    //khoi tao
    public function __construct()
    {
        parent::__construct();
    }

    //=========================================================================================
    // PHẦN CODE CỦA KHOA
    //=========================================================================================

    public function index(Request $request)
    {
        $config = [
            'model' => new Survey(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);

        return view('pages.admins.statistic.index', ['data' => $data]);
    }

    // ajax lấy question thông qua  đổ ra survey
    public static function get_survey($survey_id)
    {
        $question = Question::where('survey_id', $survey_id)->get();
        foreach ($question as $item) {
            if ($item->question_type == 'Radio' || ($item->question_type == 'Checkbox')) {
                echo "$item->question_type"."<option value='".$item->question_id."'>".$item->question_title.'</option>';
            }
        }
    }

    /**
     * Thống kê câu trả lời, dựa trên câu hỏi của khảo sát (form).
     *
     * @param Request
     *
     * @return array $data
     */
    public function answer_statistic(Request $request)
    {
        // Lấy id khảo sát
        $survey_id = $request->get('survey');
        // Lấy id câu hỏi của khảo sát trên
        $question_id = $request->get('question');

        // $question_name = Question::where('question_id', $question_id)->first();
        // $question_name = $question_name['question_title'];

        // Lấy tất cả câu trả lời có câu hỏi = $question_id
        $answer = Answer::where('survey_id', $survey_id)->get();
        // Lấy trường [answer_content], nội dung câu hỏi, dạng json
        $answer = $answer->pluck('answer_content');
        // lặp qua từng câu trả lời, để decode
        foreach ($answer as $item) {
            $temp = json_decode($item, true); // $temp lưu tạm giá trị decode hiện tại
            $val_temp = $temp[$question_id]; // lấy câu trả có id câu hỏi = $question_id, (array)
            // kiểm tra có phải là mảng ko
            // dd($val_temp);
            if (is_array($val_temp)) {
                // nếu < 2, thì chỉ có 1 giá trị, câu hỏi dạng radio
                // ngược lại, có nhiều hơn 1 giá trị, câu hỏi dạng checkbox
                if (count($val_temp) < 2) {
                    // gán câu trả lời vào mảng $answer
                    $answer_content[] = $val_temp[0];
                } else {
                    // Lặp qua, lấy giá trị câu trả lời gán vào mảng $answer
                    foreach ($val_temp as $key => $value) {
                        $answer_content[] = $value;
                    }
                }
            }
        }

        // chuyển về kiểu collect để sử dụng các phương thức count(đếm) và countBy(đếm theo nhóm)
        $answer_content = collect($answer_content);
        // Đếm tất cả
        $count_all = $answer_content->count();
        // Đếm gôm theo nhóm
        $count_by = $answer_content->countBy()->all();
        // Gán các dữ liệu vào $data
        foreach ($count_by  as $key => $value) {
            $ratio = round($value / $count_all, 2) * 100;   // Tính tỷ lệ (%), hàm round(..., 2) làm tròn 2 số thập phân
            $data[] = [
                'label' => $key,    // Câu trả lời (nhãn)
                'total' => $value,  // Tống số user chọn câu trả lời trên
                'ratio' => $ratio,  // Tỷ lệ (%) cho câu trả lời trên
            ];
            // lưu nhãn, dự trù
            $lable[] = $key;
        }
        // Thêm dữ liệu tổng vào cuối, $count_all(tổng số câu trả lời)
        $data[] = ['label' => 'Tổng', 'total' => $count_all, 'ratio' => 100];

        return $data;
    }

    // Export excel thống kê theo from
    public function export(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        return Excel::download(new QuestionsExport($data), 'Statictis.xlsx');
    }

    // Hàm hiển thị dữ liệu thống kê theo khảo sát (form)
    public function show(Request $request)
    {
        $data = $this->answer_statistic($request);

        $data_json = json_encode($data);

        return view('pages.admins.statistic.show', ['data' => $data, 'data_json' => $data_json]);
    }

    // Lấy tất cả dữ liệu trong bảng khảo sát
    public function show_surveys(Request $request)
    {
        $config = [
            'model' => new Survey(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);

        return view('pages.admins.statistic.show_surveys', ['data' => $data]);
    }

    // tính toán, thống kê tất cả các khảo sát
    public function statistic_questions($survey_id)
    {
        $survey = Survey::where('survey_id', $survey_id)->first();
        $survey->load('questions', 'answers');
        // dd($survey->answers);
        $questions = $survey->questions;

        $answers = $survey->answers;
        $answer_merge = [];
        foreach ($questions  as $item) {
            if ($item->question_type == 'Radio' || $item->question_type == 'Checkbox') {
                $question_radio[] = $item->toArray();
            }
            // if($item->question_type == 'Checkbox') {
            //     $question_checkbox [] = $item->toArray();
            // }
        }
        // dd($question_radio);
        foreach ($answers as $item) {
            $answer_temp = $item->toArray();
            $answer_content_decode = json_decode($answer_temp['answer_content'], true);
            $answer_content[] = $answer_content_decode;
        }

        foreach ($question_radio as $key_question => $value_question) {
            foreach ($answer_content as $key_answer => $value_answer) {
                $answer_user[$key_answer] = $value_answer[$value_question['question_id']];
            }
            // Câu hỏi dạng radio
            $question_title = $value_question['question_title'];
            $answer_merge = collect($answer_user)->collapse();
            $count_total = count($answer_user);
            $count_by = $answer_merge->countBy()->all();
            $total_ratio = 0;
            $data = [];
            foreach ($count_by  as $key => $value) {
                $ratio = round($value / $count_total, 2) * 100;   // Tính tỷ lệ (%), hàm round(..., 2) làm tròn 2 số thập phân
                $data[] = [
                    'label' => $key,    // Câu trả lời (nhãn)
                    'total' => $value,  // Tống số user chọn câu trả lời trên
                    'ratio' => $ratio,  // Tỷ lệ (%) cho câu trả lời trên
                ];
            }
            $total_ratio = (empty($count_by)) ? 0 : 100;
            // Thêm dữ liệu tổng vào cuối, $count_all(tổng số câu trả lời)
            $data[] = ['label' => 'Tổng', 'total' => $count_total, 'ratio' => $total_ratio];
            $statistic[$question_title] = $data;
        }

        // Câu hỏi dạng chech
        // foreach($question_checkbox as $key_question => $value_question) {
        //     foreach($answer_content as $key_answer => $value_answer) {
        //         $answer_user[$key_answer] = $value_answer[$value_question['question_id']];
        //     }

        //     $question_title = $value_question['question_title'];
        //     $answer_merge = collect($answer_user)->collapse();
        //     $count_total = count($answer_user);
        //     $count_by = $answer_merge->countBy()->all();

        //     $total_ratio = 0;
        //     $data = [];
        //     foreach ($count_by  as $key => $value) {
        //         $ratio = round($value / $count_total, 2) * 100;   // Tính tỷ lệ (%), hàm round(..., 2) làm tròn 2 số thập phân
        //         $data[] = [
        //             'label' => $key,    // Câu trả lời (nhãn)
        //             'total' => $value,  // Tống số user chọn câu trả lời trên
        //             'ratio' => $ratio,  // Tỷ lệ (%) cho câu trả lời trên
        //         ];
        //     }
        //     $total_ratio = (empty($count_by)) ? 0 : 100;
        //     // Thêm dữ liệu tổng vào cuối, $count_all(tổng số câu trả lời)
        //     $data[] = ['label' => 'Tổng', 'total' => $count_total, 'ratio' => $total_ratio];
        //     $statistic [$question_title] = $data;
        // }
        // dd($statistic);

        return $statistic;
    }

    // Hiển thị tất cả các thống kê của một khảo sát qua trang view
    public function show_statistic_surveys($survey_id)
    {
        $data = $this->statistic_questions($survey_id);
        $data_json = json_encode($data);

        return view('pages.admins.statistic.show_survey_statistic', compact('data', 'data_json'));
    }

    // Export tất cả các thống kê của một khảo sát qua trang view
    public function export_statistic_surveys(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);
        // dd($data);
        return Excel::download(new SurveysStatisticExport($data), 'Survey_statictis.xlsx');
    }

    //=========================================================================================
    // PHẦN CODE CỦA NGHĨA
    //=========================================================================================
    public function student()
    {
        $hienthi_course = 'all';
        $hienthi_major = 'all';
        $major = Major::all();
        $nganh = $major;
        $column = 1;
        // $request->year = 2019;

        foreach ($major as $value1) {
            // dd($value1->major_code);
            $total_student[$value1->major_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
            ->join('classes', 'classes.class_id', 'class_users.class_id')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where([['class_users.class_user_accountability', 'sinh viên'], ['majors.major_code', $value1->major_code]])
            ->whereYear('classes.class_end', '<=', now()->year)
            ->count();
            // dd($total_student[$value1->major_code]);
            // dd($value1->major_name);
            //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
            $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where('majors.major_code', $value1->major_code)
            ->get();
            // dd($register_graduate[$value1->major_code]);
            $trungbinh[$value1->major_code] = 0;
            $kha[$value1->major_code] = 0;
            $gioi[$value1->major_code] = 0;
            $xuatsac[$value1->major_code] = 0;
            $per[$value1->major_code] = 0;
            $tiletrungbinh[$value1->major_code] = 0;
            $tilekha[$value1->major_code] = 0;
            $tilegioi[$value1->major_code] = 0;
            $tilexuatsac[$value1->major_code] = 0;
            $register_graduate_pass[$value1->major_code] = count($register_graduate);
            foreach ($register_graduate as $va) {
                if ($va->register_graduate_ranked == 'Trung bình') {
                    ++$trungbinh[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Khá') {
                    ++$kha[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Giỏi') {
                    ++$gioi[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Xuất sắc') {
                    ++$xuatsac[$value1->major_code];
                }

                // dd($tilekha[$value1->major_code]);
            }
            if ($total_student[$value1->major_code] != 0) {
                $per[$value1->major_code] = round(($register_graduate_pass[$value1->major_code] / $total_student[$value1->major_code]), 4) * 100;
                if ($register_graduate_pass[$value1->major_code] != 0) {
                    $tiletrungbinh[$value1->major_code] = round(($trungbinh[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilekha[$value1->major_code] = round(($kha[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilegioi[$value1->major_code] = round(($gioi[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilexuatsac[$value1->major_code] = round(($xuatsac[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                }
            }

            // dd($register_graduate_pass[$value1->major_code]);
        }//lấy chuyên ngành
        //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
        //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
        //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
        // $nowyear = ((int) now()->year) - 1978;
        $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
        $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
            ->join('classes', 'classes.class_id', 'class_users.class_id')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where('class_users.class_user_accountability', 'sinh viên')
            ->whereYear('classes.class_end', '<=', now()->year)
            ->count();
        //sv tốt nghiệp sớm
        $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
        ->join('class_users', 'class_users.user_id', 'users.user_id')
        ->join('classes', 'classes.class_id', 'class_users.class_id')
        ->whereYear('register_graduate_date', '<', 'classes.class_end')
        ->count();
        $tong_sv = $tong_sv + $early;
        // dd($value1->major_name);
        //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
        $tong_cuusv = RegisterGraduate::count();
        $tong_trungbinh = RegisterGraduate::where('register_graduate_ranked', 'Trung bình')->count();
        $tong_kha = RegisterGraduate::where('register_graduate_ranked', 'Khá')->count();
        $tong_gioi = RegisterGraduate::where('register_graduate_ranked', 'Giỏi')->count();
        $tong_xuatsac = RegisterGraduate::where('register_graduate_ranked', 'Xuất sắc')->count();
        $tong_tiletrungbinh = 0;
        $tong_tilekha = 0;
        $tong_tilegioi = 0;
        $tong_tilexuatsac = 0;
        $tong_per = 0;
        if ($tong_sv != 0) {
            $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
            if ($tong_cuusv != 0) {
                $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
            }
        }
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();

        return view('pages.admins.statistic.student',
        compact('register_graduate_pass',
        'total_student',
        'per',
        'column',
        'course',
        'major',
        'name',
        'trungbinh',
        'kha',
        'gioi',
        'xuatsac',
        'tiletrungbinh',
        'tilekha',
        'tilegioi',
        'tilexuatsac',
        'tong_sv',
        'tong_cuusv',
        'tong_trungbinh',
        'tong_kha',
        'tong_gioi',
        'tong_xuatsac',
        'tong_tiletrungbinh',
        'tong_tilekha',
        'tong_tilegioi',
        'tong_tilexuatsac',
        'tong_per',
        'nganh',
        'hienthi_course',
        'hienthi_major',
    ));
    }

    public function course(Request $request)
    {
        $hienthi_course = $request->course;
        $hienthi_major = $request->major;
        $course = $request->course;
        if ($request->major != 'all') {
            $nganh = Major::find($request->major);
        } else {
            $nganh = 'all';
        }
        // dd($nganh);
        //K42             2016             2020
        //K45 => course = 2019 ->class_end=2023
        //K39             2013             2016
        //K41             2015             2019
        //các trường hợp

        // if ($course == 'all') {
        //     return \Redirect::route('statistic.student');
        // } else {
        //     if ($major == 'all') {
        //     } else {
        //     }
        // }
        if ($course == 'all') {
            return \Redirect::route('statistic.student');
        } else {
            //lấy năm kết thúc của khóa đó
            $temp1 = Classes::select(DB::raw('YEAR(class_end) as class_end'))->whereYear('class_begin', $course)->distinct()->first();

            $course_end = $temp1->class_end;
            //thống kê theo khóa
            if ($nganh == 'all') {
                $major = Major::all();
                $column = 1;
                // $request->year = 2019;

                foreach ($major as $value1) {
                    // dd($value1->major_code);
                    $total_student[$value1->major_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where([['class_users.class_user_accountability', 'sinh viên'],
                    ['majors.major_code', $value1->major_code], ])
                    ->whereYear('classes.class_begin', $course)
                    ->count();
                    // dd($value1->major_name);
                    //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                    $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where([['majors.major_code', $value1->major_code], ['register_graduate_year_begin', $course]])
                    ->get();

                    // dd($register_graduate[$value1->major_code]);
                    $trungbinh[$value1->major_code] = 0;
                    $kha[$value1->major_code] = 0;
                    $gioi[$value1->major_code] = 0;
                    $xuatsac[$value1->major_code] = 0;
                    $per[$value1->major_code] = 0;
                    $tiletrungbinh[$value1->major_code] = 0;
                    $tilekha[$value1->major_code] = 0;
                    $tilegioi[$value1->major_code] = 0;
                    $tilexuatsac[$value1->major_code] = 0;

                    $register_graduate_pass[$value1->major_code] = count($register_graduate);

                    foreach ($register_graduate as $va) {
                        if ($va->register_graduate_ranked == 'Trung bình') {
                            ++$trungbinh[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Khá') {
                            ++$kha[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Giỏi') {
                            ++$gioi[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Xuất sắc') {
                            ++$xuatsac[$value1->major_code];
                        }

                        // dd($tilekha[$value1->major_code]);
                    }
                    if ($total_student[$value1->major_code] != 0) {
                        $per[$value1->major_code] = round(($register_graduate_pass[$value1->major_code] / $total_student[$value1->major_code]), 4) * 100;
                        if ($register_graduate_pass[$value1->major_code] != 0) {
                            $tiletrungbinh[$value1->major_code] = round(($trungbinh[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilekha[$value1->major_code] = round(($kha[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilegioi[$value1->major_code] = round(($gioi[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilexuatsac[$value1->major_code] = round(($xuatsac[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                        }
                    }
                }

                //lấy chuyên ngành
                //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
                //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
                //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
                // $nowyear = ((int) now()->year) - 1978;
                $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
                $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->join('majors', 'majors.major_id', 'classes.major_id')
                ->where('class_users.class_user_accountability', 'sinh viên')
                ->whereYear('classes.class_begin', $course)
                ->count();
                //sv tốt nghiệp sớm
                $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
                ->join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->whereYear('register_graduate_date', '<', 'classes.class_end')
                ->whereYear('classes.class_begin', $course)
                ->count();
                $tong_sv = $tong_sv + $early;
                // dd($value1->major_name);
                //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                $tong_cuusv = RegisterGraduate::where('register_graduate_year_begin', $course)->count();
                $tong_trungbinh = RegisterGraduate::where([['register_graduate_ranked', 'Trung bình'], ['register_graduate_year_begin', $course]])->count();
                $tong_kha = RegisterGraduate::where([['register_graduate_ranked', 'Khá'], ['register_graduate_year_begin', $course]])->count();
                $tong_gioi = RegisterGraduate::where([['register_graduate_ranked', 'Giỏi'], ['register_graduate_year_begin', $course]])->count();
                $tong_xuatsac = RegisterGraduate::where([['register_graduate_ranked', 'Xuất sắc'], ['register_graduate_year_begin', $course]])->count();
                $tong_tiletrungbinh = 0;
                $tong_tilekha = 0;
                $tong_tilegioi = 0;
                $tong_tilexuatsac = 0;
                $tong_per = 0;
                if ($tong_sv != 0) {
                    $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
                    if ($tong_cuusv != 0) {
                        $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                        $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                        $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                        $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
                    }
                }
            }
            //thống kê các lớp thuộc ngành và khóa đó
            else {
                $major = Classes::join('majors', 'majors.major_id', 'classes.major_id')
                ->where('majors.major_id', $nganh->major_id)
                ->whereYear('classes.class_begin', $course)->get();
                $column = 2;

                // $request->year = 2019;
                // dd($major->isEmpty());
                if ($major->isEmpty()) {
                    $total_student = 0;
                    $register_graduate_pass = 0;
                    $per = 0;
                    $trungbinh = 0;
                    $kha = 0;
                    $gioi = 0;
                    $xuatsac = 0;

                    $tiletrungbinh = 0;
                    $tilekha = 0;
                    $tilegioi = 0;
                    $tilexuatsac = 0;
                } else {
                    foreach ($major as $value1) {
                        $total_student[$value1->class_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->where([['class_users.class_user_accountability', 'sinh viên'],
                    ['classes.class_id', $value1->class_id], ])
                    ->whereYear('classes.class_end', $course_end)
                    ->count();
                        //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                        $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
                    ->where([['classes.class_id', $value1->class_id], ['register_graduate_year_begin', $course]])
                    ->get();
                        $trungbinh[$value1->class_code] = 0;
                        $kha[$value1->class_code] = 0;
                        $gioi[$value1->class_code] = 0;
                        $xuatsac[$value1->class_code] = 0;
                        $per[$value1->class_code] = 0;
                        $tiletrungbinh[$value1->class_code] = 0;
                        $tilekha[$value1->class_code] = 0;
                        $tilegioi[$value1->class_code] = 0;
                        $tilexuatsac[$value1->class_code] = 0;

                        $register_graduate_pass[$value1->class_code] = count($register_graduate);
                        foreach ($register_graduate as $va) {
                            if ($va->register_graduate_ranked == 'Trung bình') {
                                ++$trungbinh[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Khá') {
                                ++$kha[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Giỏi') {
                                ++$gioi[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Xuất sắc') {
                                ++$xuatsac[$value1->class_code];
                            }

                            // dd($tilekha[$value1->class_code]);
                        }
                        if ($total_student[$value1->class_code] != 0) {
                            $per[$value1->class_code] = round(($register_graduate_pass[$value1->class_code] / $total_student[$value1->class_code]), 4) * 100;
                            if ($register_graduate_pass[$value1->class_code] != 0) {
                                $tiletrungbinh[$value1->class_code] = round(($trungbinh[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilekha[$value1->class_code] = round(($kha[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilegioi[$value1->class_code] = round(($gioi[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilexuatsac[$value1->class_code] = round(($xuatsac[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                            }
                        }

                        // dd($register_graduate_pass[$value1->class_code]);
                    }
                }

                //lấy chuyên ngành
                //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
                //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
                //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
                // $nowyear = ((int) now()->year) - 1978;
                $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
                $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->join('majors', 'majors.major_id', 'classes.major_id')
                ->where([['class_users.class_user_accountability', 'sinh viên'], ['majors.major_id', $nganh->major_id]])
                ->whereYear('classes.class_begin', $course)
                ->count();
                //sv tốt nghiệp sớm
                $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
                ->join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->whereYear('register_graduate_date', '<', 'classes.class_end')
                ->count();
                $tong_sv = $tong_sv + $early;
                // dd($value1->major_name);
                //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                $tong_cuusv = RegisterGraduate::where([['register_graduate_year_begin', $course], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->count();
                $tong_trungbinh = RegisterGraduate::where([['register_graduate_ranked', 'Trung bình'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_kha = RegisterGraduate::where([['register_graduate_ranked', 'Khá'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_gioi = RegisterGraduate::where([['register_graduate_ranked', 'Giỏi'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_xuatsac = RegisterGraduate::where([['register_graduate_ranked', 'Xuất sắc'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();

                // $tong_kha = RegisterGraduate::where('register_graduate_ranked', 'Khá')->whereYear('register_graduate_date', $course)->count();
                // $tong_gioi = RegisterGraduate::where('register_graduate_ranked', 'Giỏi')->whereYear('register_graduate_date', $course)->count();
                // $tong_xuatsac = RegisterGraduate::where('register_graduate_ranked', 'Xuất sắc')->whereYear('register_graduate_date', $course)->count();
                $tong_tiletrungbinh = 0;
                $tong_tilekha = 0;
                $tong_tilegioi = 0;
                $tong_tilexuatsac = 0;
                $tong_per = 0;
                if ($tong_sv != 0) {
                    $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
                    if ($tong_cuusv != 0) {
                        $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                        $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                        $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                        $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
                    }
                }
            }
        }
        $nganh = Major::all();
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();

        return view('pages.admins.statistic.student',
            compact('register_graduate_pass',
            'total_student',
            'per',
            'column',
            'course',
            'nganh',
            'major',
            'name',
            'trungbinh',
            'kha',
            'gioi',
            'xuatsac',
            'tiletrungbinh',
            'tilekha',
            'tilegioi',
            'tilexuatsac',
            'tong_sv',
            'tong_cuusv',
            'tong_trungbinh',
            'tong_kha',
            'tong_gioi',
            'tong_xuatsac',
            'tong_tiletrungbinh',
            'tong_tilekha',
            'tong_tilegioi',
            'tong_tilexuatsac',
            'tong_per',
            'hienthi_course',
            'hienthi_major',
        ));

        // return view('pages.admins.statistic.student', [
        //  'register_graduate_pass' => $register_graduate_pass,
        //  'total_student' => $total_student,
        //  'per' => $per,
        //  'column' => $column,
        //  'course' => $course,
        //  'major' => $major,
        //  'name' => $name,
        //  'trungbinh' => $trungbinh,
        //  'kha' => $kha,
        //  'gioi' => $gioi,
        //  'xuatsac' => $xuatsac,
        //  'tiletrungbinh' => $tiletrungbinh,
        //  'tilekha' => $tilekha,
        //  'tilegioi' => $tilegioi,
        //  'tilexuatsac' => $tilexuatsac,
        //  'tong_sv' => $tong_sv,
        // 'tong_cuusv' => $tong_cuusv,
        // 'tong_trungbinh' => $tong_trungbinh,
        // 'tong_kha' => $tong_kha,
        // 'tong_gioi' => $tong_gioi,
        // 'tong_xuatsac' => $tong_xuatsac,
        // 'tong_tiletrungbinh' => $tong_tiletrungbinh,
        // 'tong_tilekha' => $tong_tilekha,
        // 'tong_tilegioi' => $tong_tilegioi,
        // 'tong_tilexuatsac' => $tong_tilexuatsac,
        // 'tong_per' => $tong_per,
        //   ]);
    }

    public function graduate()
    {
        $hienthi_course = 'all';
        $hienthi_major = 'all';
        $major = Major::all();
        $nganh = $major;
        $column = 1;
        // $request->year = 2019;

        foreach ($major as $value1) {
            // dd($value1->major_code);
            $total_student[$value1->major_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
            ->join('classes', 'classes.class_id', 'class_users.class_id')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where([['class_users.class_user_accountability', 'sinh viên'], ['majors.major_code', $value1->major_code]])
            ->whereYear('classes.class_end', '<=', now()->year)
            ->count();
            // dd($value1->major_name);
            //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
            $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where('majors.major_code', $value1->major_code)
            ->get();
            // dd($register_graduate[$value1->major_code]);
            $trungbinh[$value1->major_code] = 0;
            $kha[$value1->major_code] = 0;
            $gioi[$value1->major_code] = 0;
            $xuatsac[$value1->major_code] = 0;
            $per[$value1->major_code] = 0;
            $tiletrungbinh[$value1->major_code] = 0;
            $tilekha[$value1->major_code] = 0;
            $tilegioi[$value1->major_code] = 0;
            $tilexuatsac[$value1->major_code] = 0;
            $register_graduate_pass[$value1->major_code] = count($register_graduate);
            foreach ($register_graduate as $va) {
                if ($va->register_graduate_ranked == 'Trung bình') {
                    ++$trungbinh[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Khá') {
                    ++$kha[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Giỏi') {
                    ++$gioi[$value1->major_code];
                }
                if ($va->register_graduate_ranked == 'Xuất sắc') {
                    ++$xuatsac[$value1->major_code];
                }

                // dd($tilekha[$value1->major_code]);
            }
            if ($total_student[$value1->major_code] != 0) {
                $per[$value1->major_code] = round(($register_graduate_pass[$value1->major_code] / $total_student[$value1->major_code]), 4) * 100;
                if ($register_graduate_pass[$value1->major_code] != 0) {
                    $tiletrungbinh[$value1->major_code] = round(($trungbinh[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilekha[$value1->major_code] = round(($kha[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilegioi[$value1->major_code] = round(($gioi[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                    $tilexuatsac[$value1->major_code] = round(($xuatsac[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                }
            }

            // dd($register_graduate_pass[$value1->major_code]);
        }//lấy chuyên ngành
        //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
        //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
        //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
        // $nowyear = ((int) now()->year) - 1978;
        $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
        $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
            ->join('classes', 'classes.class_id', 'class_users.class_id')
            ->join('majors', 'majors.major_id', 'classes.major_id')
            ->where('class_users.class_user_accountability', 'sinh viên')
            ->whereYear('classes.class_end', '<=', now()->year)
            ->count();
        //sv tốt nghiệp sớm
        $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
        ->join('class_users', 'class_users.user_id', 'users.user_id')
        ->join('classes', 'classes.class_id', 'class_users.class_id')
        ->whereYear('register_graduate_date', '<', 'classes.class_end')
        ->count();
        $tong_sv = $tong_sv + $early;
        // dd($value1->major_name);
        //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
        $tong_cuusv = RegisterGraduate::count();
        $tong_trungbinh = RegisterGraduate::where('register_graduate_ranked', 'Trung bình')->count();
        $tong_kha = RegisterGraduate::where('register_graduate_ranked', 'Khá')->count();
        $tong_gioi = RegisterGraduate::where('register_graduate_ranked', 'Giỏi')->count();
        $tong_xuatsac = RegisterGraduate::where('register_graduate_ranked', 'Xuất sắc')->count();
        $tong_tiletrungbinh = 0;
        $tong_tilekha = 0;
        $tong_tilegioi = 0;
        $tong_tilexuatsac = 0;
        $tong_per = 0;
        if ($tong_sv != 0) {
            $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
            if ($tong_cuusv != 0) {
                $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
            }
        }
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();

        return view('pages.admins.statistic.graduate',
        compact('register_graduate_pass',
        'total_student',
        'per',
        'column',
        'course',
        'major',
        'name',
        'trungbinh',
        'kha',
        'gioi',
        'xuatsac',
        'tiletrungbinh',
        'tilekha',
        'tilegioi',
        'tilexuatsac',
        'tong_sv',
        'tong_cuusv',
        'tong_trungbinh',
        'tong_kha',
        'tong_gioi',
        'tong_xuatsac',
        'tong_tiletrungbinh',
        'tong_tilekha',
        'tong_tilegioi',
        'tong_tilexuatsac',
        'tong_per',
        'nganh',
        'hienthi_course',
        'hienthi_major',
    ));
    }

    public function graduate_statistic(Request $request)
    {
        $hienthi_course = $request->course;
        $hienthi_major = $request->major;
        $course = $request->course;
        if ($request->major == 'all') {
            $nganh = 'all';
        } elseif ($request->major != 'detail') {
            $nganh = 'detail';
        } else {
            $nganh = Major::find($request->major);
        }
        // dd($nganh);
        //K42             2016             2020
        //K45 => course = 2019 ->class_end=2023
        //K39             2013             2016
        //K41             2015             2019
        //các trường hợp

        // if ($course == 'all') {
        //     return \Redirect::route('statistic.student');
        // } else {
        //     if ($major == 'all') {
        //     } else {
        //     }
        // }
        $nam = Classes::select(DB::raw('YEAR(class_end) as class_end'))->whereYear('class_begin', $course)->distinct()->first();
        if ($course == 'all') {
            return \Redirect::route('statistic.student');
        } else {
            //lấy năm kết thúc của khóa đó
            $temp1 = Classes::select(DB::raw('YEAR(class_end) as class_end'))->whereYear('class_begin', $course)->distinct()->first();

            $course_end = $temp1->class_end;
            //thống kê theo khóa
            if ($nganh == 'all') {
                $major = Major::all();
                $column = 1;
                // $request->year = 2019;

                foreach ($major as $value1) {
                    // dd($value1->major_code);
                    $total_student[$value1->major_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where([['class_users.class_user_accountability', 'sinh viên'],
                    ['majors.major_code', $value1->major_code], ])
                    ->whereYear('classes.class_begin', $course)
                    ->count();
                    // dd($value1->major_name);
                    //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                    $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where([['majors.major_code', $value1->major_code], ['register_graduate_year_begin', $course]])
                    ->get();

                    // dd($register_graduate[$value1->major_code]);
                    $trungbinh[$value1->major_code] = 0;
                    $kha[$value1->major_code] = 0;
                    $gioi[$value1->major_code] = 0;
                    $xuatsac[$value1->major_code] = 0;
                    $per[$value1->major_code] = 0;
                    $tiletrungbinh[$value1->major_code] = 0;
                    $tilekha[$value1->major_code] = 0;
                    $tilegioi[$value1->major_code] = 0;
                    $tilexuatsac[$value1->major_code] = 0;

                    $register_graduate_pass[$value1->major_code] = count($register_graduate);

                    foreach ($register_graduate as $va) {
                        if ($va->register_graduate_ranked == 'Trung bình') {
                            ++$trungbinh[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Khá') {
                            ++$kha[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Giỏi') {
                            ++$gioi[$value1->major_code];
                        }
                        if ($va->register_graduate_ranked == 'Xuất sắc') {
                            ++$xuatsac[$value1->major_code];
                        }

                        // dd($tilekha[$value1->major_code]);
                    }
                    if ($total_student[$value1->major_code] != 0) {
                        $per[$value1->major_code] = round(($register_graduate_pass[$value1->major_code] / $total_student[$value1->major_code]), 4) * 100;
                        if ($register_graduate_pass[$value1->major_code] != 0) {
                            $tiletrungbinh[$value1->major_code] = round(($trungbinh[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilekha[$value1->major_code] = round(($kha[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilegioi[$value1->major_code] = round(($gioi[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                            $tilexuatsac[$value1->major_code] = round(($xuatsac[$value1->major_code] / $register_graduate_pass[$value1->major_code]), 4) * 100;
                        }
                    }
                }

                //lấy chuyên ngành
                //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
                //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
                //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
                // $nowyear = ((int) now()->year) - 1978;
                $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
                $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->join('majors', 'majors.major_id', 'classes.major_id')
                ->where('class_users.class_user_accountability', 'sinh viên')
                ->whereYear('classes.class_begin', $course)
                ->count();
                //sv tốt nghiệp sớm
                $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
                ->join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->whereYear('register_graduate_date', '<', 'classes.class_end')
                ->whereYear('classes.class_begin', $course)
                ->count();
                $tong_sv = $tong_sv + $early;
                // dd($value1->major_name);
                //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                $tong_cuusv = RegisterGraduate::where('register_graduate_year_begin', $course)->count();
                $tong_trungbinh = RegisterGraduate::where([['register_graduate_ranked', 'Trung bình'], ['register_graduate_year_begin', $course]])->count();
                $tong_kha = RegisterGraduate::where([['register_graduate_ranked', 'Khá'], ['register_graduate_year_begin', $course]])->count();
                $tong_gioi = RegisterGraduate::where([['register_graduate_ranked', 'Giỏi'], ['register_graduate_year_begin', $course]])->count();
                $tong_xuatsac = RegisterGraduate::where([['register_graduate_ranked', 'Xuất sắc'], ['register_graduate_year_begin', $course]])->count();
                $tong_tiletrungbinh = 0;
                $tong_tilekha = 0;
                $tong_tilegioi = 0;
                $tong_tilexuatsac = 0;
                $tong_per = 0;
                if ($tong_sv != 0) {
                    $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
                    if ($tong_cuusv != 0) {
                        $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                        $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                        $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                        $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
                    }
                }
            }
            //thống kê các lớp thuộc ngành và khóa đó
            else {
                $major = Classes::join('majors', 'majors.major_id', 'classes.major_id')
                ->where('majors.major_id', $nganh->major_id)
                ->whereYear('classes.class_begin', $course)->get();
                $column = 2;

                // $request->year = 2019;
                // dd($major->isEmpty());
                if ($major->isEmpty()) {
                    $total_student = 0;
                    $register_graduate_pass = 0;
                    $per = 0;
                    $trungbinh = 0;
                    $kha = 0;
                    $gioi = 0;
                    $xuatsac = 0;

                    $tiletrungbinh = 0;
                    $tilekha = 0;
                    $tilegioi = 0;
                    $tilexuatsac = 0;
                } else {
                    foreach ($major as $value1) {
                        $total_student[$value1->class_code] = User::join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->where([['class_users.class_user_accountability', 'sinh viên'],
                    ['classes.class_id', $value1->class_id], ])
                    ->whereYear('classes.class_end', $course_end)
                    ->count();
                        //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                        $register_graduate = RegisterGraduate::join('classes', 'classes.class_code', 'register_graduate.register_graduate_class_code')
                    ->where([['classes.class_id', $value1->class_id], ['register_graduate_year_begin', $course]])
                    ->get();
                        $trungbinh[$value1->class_code] = 0;
                        $kha[$value1->class_code] = 0;
                        $gioi[$value1->class_code] = 0;
                        $xuatsac[$value1->class_code] = 0;
                        $per[$value1->class_code] = 0;
                        $tiletrungbinh[$value1->class_code] = 0;
                        $tilekha[$value1->class_code] = 0;
                        $tilegioi[$value1->class_code] = 0;
                        $tilexuatsac[$value1->class_code] = 0;

                        $register_graduate_pass[$value1->class_code] = count($register_graduate);
                        foreach ($register_graduate as $va) {
                            if ($va->register_graduate_ranked == 'Trung bình') {
                                ++$trungbinh[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Khá') {
                                ++$kha[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Giỏi') {
                                ++$gioi[$value1->class_code];
                            }
                            if ($va->register_graduate_ranked == 'Xuất sắc') {
                                ++$xuatsac[$value1->class_code];
                            }

                            // dd($tilekha[$value1->class_code]);
                        }
                        if ($total_student[$value1->class_code] != 0) {
                            $per[$value1->class_code] = round(($register_graduate_pass[$value1->class_code] / $total_student[$value1->class_code]), 4) * 100;
                            if ($register_graduate_pass[$value1->class_code] != 0) {
                                $tiletrungbinh[$value1->class_code] = round(($trungbinh[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilekha[$value1->class_code] = round(($kha[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilegioi[$value1->class_code] = round(($gioi[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                                $tilexuatsac[$value1->class_code] = round(($xuatsac[$value1->class_code] / $register_graduate_pass[$value1->class_code]), 4) * 100;
                            }
                        }

                        // dd($register_graduate_pass[$value1->class_code]);
                    }
                }

                //lấy chuyên ngành
                //tổng số sv = tổng số sv của các lớp có năm kết thúc trước năm hiện tại+sv tốt nghiệp sớm
                //tổng số sv tn = tổng sv tn có trong dữ liệu register_graduate
                //số sv tn sớm = sv có năm tn nhỏ hơn năm kết thúc của lớp
                // $nowyear = ((int) now()->year) - 1978;
                $name = 'THỐNG KÊ TỈ LỆ TỐT NGHIỆP CỦA SINH VIÊN KHOA CNTT&TT';
                $tong_sv = User::join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->join('majors', 'majors.major_id', 'classes.major_id')
                ->where([['class_users.class_user_accountability', 'sinh viên'], ['majors.major_id', $nganh->major_id]])
                ->whereYear('classes.class_begin', $course)
                ->count();
                //sv tốt nghiệp sớm
                $early = User::join('register_graduate', 'register_graduate.register_graduate_code', 'users.username')
                ->join('class_users', 'class_users.user_id', 'users.user_id')
                ->join('classes', 'classes.class_id', 'class_users.class_id')
                ->whereYear('register_graduate_date', '<', 'classes.class_end')
                ->count();
                $tong_sv = $tong_sv + $early;
                // dd($value1->major_name);
                //lấy sv tốt nghiệp theo ngành dựa trên mã lớp join với lớp (nếu không tồn tại lớp đó dữ liệu sẽ bị sai)
                $tong_cuusv = RegisterGraduate::where([['register_graduate_year_begin', $course], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->count();
                $tong_trungbinh = RegisterGraduate::where([['register_graduate_ranked', 'Trung bình'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_kha = RegisterGraduate::where([['register_graduate_ranked', 'Khá'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_gioi = RegisterGraduate::where([['register_graduate_ranked', 'Giỏi'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();
                $tong_xuatsac = RegisterGraduate::where([['register_graduate_ranked', 'Xuất sắc'], ['register_graduate_major_name', 'LIKE', '%'.$nganh->major_name.'%']])->where('register_graduate_year_begin', $course)->count();

                // $tong_kha = RegisterGraduate::where('register_graduate_ranked', 'Khá')->whereYear('register_graduate_date', $course)->count();
                // $tong_gioi = RegisterGraduate::where('register_graduate_ranked', 'Giỏi')->whereYear('register_graduate_date', $course)->count();
                // $tong_xuatsac = RegisterGraduate::where('register_graduate_ranked', 'Xuất sắc')->whereYear('register_graduate_date', $course)->count();
                $tong_tiletrungbinh = 0;
                $tong_tilekha = 0;
                $tong_tilegioi = 0;
                $tong_tilexuatsac = 0;
                $tong_per = 0;
                if ($tong_sv != 0) {
                    $tong_per = round(($tong_cuusv / $tong_sv), 4) * 100;
                    if ($tong_cuusv != 0) {
                        $tong_tiletrungbinh = round(($tong_trungbinh / $tong_cuusv), 4) * 100;
                        $tong_tilekha = round(($tong_kha / $tong_cuusv), 4) * 100;
                        $tong_tilegioi = round(($tong_gioi / $tong_cuusv), 4) * 100;
                        $tong_tilexuatsac = round(($tong_xuatsac / $tong_cuusv), 4) * 100;
                    }
                }
            }
        }
        $nganh = Major::all();
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();

        return view('pages.admins.statistic.student',
            compact('register_graduate_pass',
            'total_student',
            'per',
            'column',
            'course',
            'nganh',
            'major',
            'name',
            'trungbinh',
            'kha',
            'gioi',
            'xuatsac',
            'tiletrungbinh',
            'tilekha',
            'tilegioi',
            'tilexuatsac',
            'tong_sv',
            'tong_cuusv',
            'tong_trungbinh',
            'tong_kha',
            'tong_gioi',
            'tong_xuatsac',
            'tong_tiletrungbinh',
            'tong_tilekha',
            'tong_tilegioi',
            'tong_tilexuatsac',
            'tong_per',
            'hienthi_course',
            'hienthi_major',
        ));

        // return view('pages.admins.statistic.student', [
        //  'register_graduate_pass' => $register_graduate_pass,
        //  'total_student' => $total_student,
        //  'per' => $per,
        //  'column' => $column,
        //  'course' => $course,
        //  'major' => $major,
        //  'name' => $name,
        //  'trungbinh' => $trungbinh,
        //  'kha' => $kha,
        //  'gioi' => $gioi,
        //  'xuatsac' => $xuatsac,
        //  'tiletrungbinh' => $tiletrungbinh,
        //  'tilekha' => $tilekha,
        //  'tilegioi' => $tilegioi,
        //  'tilexuatsac' => $tilexuatsac,
        //  'tong_sv' => $tong_sv,
        // 'tong_cuusv' => $tong_cuusv,
        // 'tong_trungbinh' => $tong_trungbinh,
        // 'tong_kha' => $tong_kha,
        // 'tong_gioi' => $tong_gioi,
        // 'tong_xuatsac' => $tong_xuatsac,
        // 'tong_tiletrungbinh' => $tong_tiletrungbinh,
        // 'tong_tilekha' => $tong_tilekha,
        // 'tong_tilegioi' => $tong_tilegioi,
        // 'tong_tilexuatsac' => $tong_tilexuatsac,
        // 'tong_per' => $tong_per,
        //   ]);
    }

    public function job(Request $request)
    {
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();
        $hienthi_course = 'all';
        $hienthi_year = 'all';
        $check = 'year';
        $selectyear = RegisterGraduate::selectRaw('YEAR(register_graduate_date) as year')->distinct()->orderBy('year', 'desc')->get();

        $major = Major::all();
        // $request->year = 2019;
        foreach ($major as $value1) {//lấy chuyên ngành
            //đếm tổng số sv tốt nghiệp của năm... theo ngành...
            $total_graduate[$value1->major_code] = count(RegisterGraduate::where('register_graduate_major_name', 'LIKE', $value1->major_name)
            ->get());

            //đếm tổng số sv nữ tốt nghiệp của năm... theo ngành...
            $total_graduate_female[$value1->major_code] = count(RegisterGraduate::where([['register_graduate_major_name', 'LIKE', $value1->major_name], ['register_graduate_gender', 'LIKE', 'N']])
            ->get());

            $feedback[$value1->major_code] = 0; //đếm số phản hồi
            $female_feedback[$value1->major_code] = 0; //số phản hồi là nữ
            $count_dungnganhdaotao[$value1->major_code] = 0;
            $count_lienquandennganhdaotao[$value1->major_code] = 0;
            $count_khonglienquandennganhdaotao[$value1->major_code] = 0;
            $count_tieptuchoc[$value1->major_code] = 0;
            $count_chuacovieclam[$value1->major_code] = 0;
            $count_nhanuoc[$value1->major_code] = 0;
            $count_tunhan[$value1->major_code] = 0;
            $count_tutaovieclam[$value1->major_code] = 0;
            $count_coyeutonuocngoai[$value1->major_code] = 0;

            //lấy id khảo sát
            $survey_year = Survey::where('survey_name', 'LIKE', '%TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP%')->get(); //lấy id khảo sát
            foreach ($survey_year as $value2) {//duyệt khảo sát
                //lấy câu hỏi việc làm
                $tinhhinhvieclam1 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/Chị có việc làm hay chưa?%']])->first();
                // dd($tinhhinhvieclam[0]['question_id']);
                $tinhhinhvieclam2 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?%']])->first();
                //lấy câu hỏi khu vuc làm viec
                $khuvuclamviec = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/chị làm việc trong khu vực nào?%']])->first();
                //$khuvuclamviec[0]

                //lấy câu trả lời theo khảo sát của
                $answer = Answer::join('users', 'users.user_id', 'answers.user_id')
                ->join('role_users', 'role_users.user_id', 'answers.user_id')
                ->where([['survey_id', $value2->survey_id], ['role_users.role_id', 3]])->get();
                //$answer[0]

                // $feedback[$value1->major_code] = count($answer);  //đếm số phản hồi
                // dd($value1->major_code);
                foreach ($answer as $value3) {//duyệt bảng câu trả lời để lấy dữ liệu
                    //thông tin người trả lời khảo sát
                    $temp_female_feedback = User::join('answers', 'users.user_id', 'answers.user_id')->where('users.user_id', $value3->user_id)->first();
                    $temp_feedback = User::join('answers', 'users.user_id', 'answers.user_id')
                    ->join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where('users.user_id', $value3->user_id)->first();
                    // dd($temp_feedback->major_code);
                    if ($temp_feedback->major_code != $value1->major_code) {
                        continue; //chỉ lấy câu tl của người thuộc ngành đó trả lời
                    }
                    if ($temp_female_feedback->gender == 'N') {
                        ++$female_feedback[$value1->major_code]; //nếu phản hồi là nữ thì cộng 1
                    }
                    if ($temp_feedback->major_code == $value1->major_code) {
                        ++$feedback[$value1->major_code]; //đếm phản hồi của ngành
                    }

                    // dd($tinhhinhvieclam[0]);

                    ///////đếm phương án
                    $answer_dungnganhdaotao = json_decode($value3->answer_content);
                    // dd($answer_dungnganhdaotao);
                    foreach ($answer_dungnganhdaotao as $key4 => $value4) {
                        //đém câu trả lời đúng ngành đào tạo
                        // dd($tinhhinhvieclam['question_id']);
                        // dd($value4[0]);
                        // dd($tinhhinhvieclam1['question_id']);
                        if ($key4 == $tinhhinhvieclam1['question_id']) {
                            // dd(preg_match('.Có.việc.', $value4[0], $matches));
                            // dd(stripos($value4[0], '"Có việc (Tiếp tục khảo sát)"') !== false);
                            // "Có việc (Tiếp tục khảo sát)"
                            //lọc đếm đáp án về tình hình việc làm
                            // if (stripos($value4[0], 'Đúng ngành đào tạo') !== false) {
                            //     ++$count_dungnganhdaotao[$value1->major_code];
                            // } elseif (stripos($value4[0], 'Liên quan đến ngành đào tạo') !== false) {
                            //     ++$count_lienquandennganhdaotao[$value1->major_code];
                            // } elseif (stripos($value4[0], 'Không liên quan đến ngành đào tạo') !== false) {
                            //     ++$count_khonglienquandennganhdaotao[$value1->major_code];
                            // } elseif (stripos($value4[0], 'Tiếp tục học') !== false) {
                            //     ++$count_tieptuchoc[$value1->major_code];
                            // } elseif (stripos($value4[0], 'Chưa có') !== false) {
                            //     ++$count_chuacovieclam[$value1->major_code];
                            // } else {
                            //     dd('Lỗi tình hình việc làm');
                            // }
                            if (stripos($value4[0], 'Chưa - Đang học (Kết thúc khảo sát)') !== false) {
                                ++$count_tieptuchoc[$value1->major_code];
                            } elseif (stripos($value4[0], 'Chưa có (Kết thúc khảo sát)') !== false) {
                                ++$count_chuacovieclam[$value1->major_code];
                            }
                        }
                        if ($key4 == $tinhhinhvieclam2['question_id']) {
                            // dd(strpos($value4[0], 'Đúng ngành đào tạo') !== false);
                            // strcasecmp
                            // dd(strcasecmp($value4[0], 'Đúng ngành đào tạo'));/
                            // if (stripos($value4[0], 'Đúng ngành đào tạo') !== false) {
                            //     ++$count_dungnganhdaotao[$value1->major_code];
                            if (strcasecmp($value4[0], 'Đúng với ngành đào tạo') == 0) {
                                ++$count_dungnganhdaotao[$value1->major_code];
                            } elseif (stripos($value4[0], 'Không đúng với ngành đào tạo') !== false) {
                                ++$count_lienquandennganhdaotao[$value1->major_code];
                            } elseif (stripos($value4[0], 'Không liên quan đến ngành được đào tạo') !== false) {
                                ++$count_khonglienquandennganhdaotao[$value1->major_code];
                            }
                        }
                        if ($key4 == $khuvuclamviec['question_id']) {
                            if (stripos($value4[0], 'Nhà nước') !== false) {
                                ++$count_nhanuoc[$value1->major_code];
                            } elseif (stripos($value4[0], 'Tư nhân') !== false) {
                                ++$count_tunhan[$value1->major_code];
                            } elseif (stripos($value4[0], 'Tự tạo việc làm') !== false) {
                                ++$count_tutaovieclam[$value1->major_code];
                            } elseif (stripos($value4[0], 'Liên doanh nước ngoài') !== false) {
                                ++$count_coyeutonuocngoai[$value1->major_code];
                            } else {
                                dd('Lỗi khu vực việc làm');
                            }
                        }
                    }
                }
            }
            if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                $tile_vieclam_phanhoi[$value1->major_code] = round(
            ($count_dungnganhdaotao[$value1->major_code] +
            $count_lienquandennganhdaotao[$value1->major_code] +
            $count_khonglienquandennganhdaotao[$value1->major_code] +
            $count_tieptuchoc[$value1->major_code])*100 / $feedback[$value1->major_code], 2);
            } else {
                $tile_vieclam_phanhoi[$value1->major_code] = 0;
            }

            if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                $tile_vieclam_tongtn[$value1->major_code] = round(
            ($count_dungnganhdaotao[$value1->major_code] +
            $count_lienquandennganhdaotao[$value1->major_code] +
            $count_khonglienquandennganhdaotao[$value1->major_code] +
            $count_tieptuchoc[$value1->major_code])*100 / $total_graduate[$value1->major_code], 2);
            } else {
                $tile_vieclam_tongtn[$value1->major_code] = 0;
            }
        }

        $data_export = json_encode([
            'selectyear' => $selectyear,
            'major' => $major,
            'total_graduate' => $total_graduate,
            'total_graduate_female' => $total_graduate_female,
            'feedback' => $feedback,
            'female_feedback' => $female_feedback,
            'count_dungnganhdaotao' => $count_dungnganhdaotao,
            'count_lienquandennganhdaotao' => $count_lienquandennganhdaotao,
            'count_khonglienquandennganhdaotao' => $count_khonglienquandennganhdaotao,
            'count_tieptuchoc' => $count_tieptuchoc,
            'count_chuacovieclam' => $count_chuacovieclam,
            'tile_vieclam_phanhoi' => $tile_vieclam_phanhoi,
            'tile_vieclam_tongtn' => $tile_vieclam_tongtn,
            'count_nhanuoc' => $count_nhanuoc,
            'count_tunhan' => $count_tunhan,
            'count_tutaovieclam' => $count_tutaovieclam,
            'count_coyeutonuocngoai' => $count_coyeutonuocngoai,
        ]);

        return  view('pages.admins.statistic.job',
        compact(
        'course',
        'hienthi_course',
        'selectyear',
        'hienthi_year',
        'check',
        'major',
        'total_graduate',
        'total_graduate_female',
        'feedback',
        'female_feedback',
        'count_dungnganhdaotao',
        'count_lienquandennganhdaotao',
        'count_khonglienquandennganhdaotao',
        'count_tieptuchoc',
        'count_chuacovieclam',
        'tile_vieclam_phanhoi',
        'tile_vieclam_tongtn',
        'count_nhanuoc',
        'count_tunhan',
        'count_tutaovieclam',
        'count_coyeutonuocngoai',
        'data_export'));
    }

    public function cohort_all()
    { //chưa xong
        $major = Major::all();
        // $request->year = 2019;
        foreach ($major as $value1) {//lấy chuyên ngành
            //đếm tổng số sv tốt nghiệp của năm... theo ngành...
            $total_graduate[$value1->major_code] = count(RegisterGraduate::where('register_graduate_major_name', 'LIKE', $value1->major_name)
            ->get());

            //đếm tổng số sv nữ tốt nghiệp của năm... theo ngành...
            $total_graduate_female[$value1->major_code] = count(RegisterGraduate::where([['register_graduate_major_name', 'LIKE', $value1->major_name], ['register_graduate_gender', 'LIKE', 'N']])
            ->get());

            $feedback[$value1->major_code] = 0; //đếm số phản hồi
            $female_feedback[$value1->major_code] = 0; //số phản hồi là nữ
            $count_dungnganhdaotao[$value1->major_code] = 0;
            $count_lienquandennganhdaotao[$value1->major_code] = 0;
            $count_khonglienquandennganhdaotao[$value1->major_code] = 0;
            $count_tieptuchoc[$value1->major_code] = 0;
            $count_chuacovieclam[$value1->major_code] = 0;
            $count_nhanuoc[$value1->major_code] = 0;
            $count_tunhan[$value1->major_code] = 0;
            $count_tutaovieclam[$value1->major_code] = 0;
            $count_coyeutonuocngoai[$value1->major_code] = 0;

            //lấy id khảo sát
            $survey_year = Survey::where('survey_name', 'LIKE', '%TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP%')->get(); //lấy id khảo sát
            foreach ($survey_year as $value2) {//duyệt khảo sát
                //lấy câu hỏi việc làm
                $tinhhinhvieclam1 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/Chị có việc làm hay chưa?%']])->first();
                // dd($tinhhinhvieclam[0]['question_id']);
                $tinhhinhvieclam2 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?%']])->first();
                //lấy câu hỏi khu vuc làm viec
                $khuvuclamviec = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/chị làm việc trong khu vực nào?%']])->first();
                //$khuvuclamviec[0]

                //lấy câu trả lời theo khảo sát của
                $answer = Answer::join('users', 'users.user_id', 'answers.user_id')
                ->join('role_users', 'role_users.user_id', 'answers.user_id')
                ->where([['survey_id', $value2->survey_id], ['role_users.role_id', 3]])->get();
                //$answer[0]

                // $feedback[$value1->major_code] = count($answer);  //đếm số phản hồi
                // dd($value1->major_code);
                foreach ($answer as $value3) {//duyệt bảng câu trả lời để lấy dữ liệu
                    //thông tin người trả lời khảo sát
                    $temp_female_feedback = User::join('answers', 'users.user_id', 'answers.user_id')->where('users.user_id', $value3->user_id)->first();
                    $temp_feedback = User::join('answers', 'users.user_id', 'answers.user_id')
                    ->join('class_users', 'class_users.user_id', 'users.user_id')
                    ->join('classes', 'classes.class_id', 'class_users.class_id')
                    ->join('majors', 'majors.major_id', 'classes.major_id')
                    ->where('users.user_id', $value3->user_id)->first();
                    // dd($temp_feedback->major_code);
                    if ($temp_feedback->major_code != $value1->major_code) {
                        continue; //chỉ lấy câu tl của người thuộc ngành đó trả lời
                    }
                    if ($temp_female_feedback->gender == 'N') {
                        ++$female_feedback[$value1->major_code]; //nếu phản hồi là nữ thì cộng 1
                    }
                    if ($temp_feedback->major_code == $value1->major_code) {
                        ++$feedback[$value1->major_code]; //đếm phản hồi của ngành
                    }

                    // dd($tinhhinhvieclam[0]);

                    ///////đếm phương án
                    $answer_dungnganhdaotao = json_decode($value3->answer_content);
                    // dd($answer_dungnganhdaotao);
                    foreach ($answer_dungnganhdaotao as $key4 => $value4) {
                        //đém câu trả lời đúng ngành đào tạo
                        if ($key4 == $tinhhinhvieclam1['question_id']) {
                            if (stripos($value4[0], 'Chưa - Đang học (Kết thúc khảo sát)') !== false) {
                                ++$count_tieptuchoc[$value1->major_code];
                                continue;
                            } elseif (stripos($value4[0], 'Chưa có (Kết thúc khảo sát)') !== false) {
                                ++$count_chuacovieclam[$value1->major_code];
                                continue;
                            }
                            continue;
                        }
                        if ($key4 == $tinhhinhvieclam2['question_id']) {
                            if (strcasecmp($value4[0], 'Đúng với ngành đào tạo') == 0) {
                                ++$count_dungnganhdaotao[$value1->major_code];
                            } elseif (stripos($value4[0], 'Không đúng với ngành đào tạo') !== false) {
                                ++$count_lienquandennganhdaotao[$value1->major_code];
                            } elseif (stripos($value4[0], 'Không liên quan đến ngành được đào tạo') !== false) {
                                ++$count_khonglienquandennganhdaotao[$value1->major_code];
                            }
                        }
                        if ($key4 == $khuvuclamviec['question_id']) {
                            if (stripos($value4[0], 'Nhà nước') !== false) {
                                ++$count_nhanuoc[$value1->major_code];
                            } elseif (stripos($value4[0], 'Tư nhân') !== false) {
                                ++$count_tunhan[$value1->major_code];
                            } elseif (stripos($value4[0], 'Tự tạo việc làm') !== false) {
                                ++$count_tutaovieclam[$value1->major_code];
                            } elseif (stripos($value4[0], 'Liên doanh nước ngoài') !== false) {
                                ++$count_coyeutonuocngoai[$value1->major_code];
                            } else {
                                dd('Lỗi khu vực việc làm');
                            }
                        }
                    }
                }
            }
            if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                $tile_vieclam_phanhoi[$value1->major_code] = round(($count_dungnganhdaotao[$value1->major_code] +
            $count_lienquandennganhdaotao[$value1->major_code] +
            $count_khonglienquandennganhdaotao[$value1->major_code] +
            $count_tieptuchoc[$value1->major_code])*100 / $feedback[$value1->major_code], 2);
            } else {
                $tile_vieclam_phanhoi[$value1->major_code] = 0;
            }

            if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                $tile_vieclam_tongtn[$value1->major_code] = round(($count_dungnganhdaotao[$value1->major_code] +
            $count_lienquandennganhdaotao[$value1->major_code] +
            $count_khonglienquandennganhdaotao[$value1->major_code] +
            $count_tieptuchoc[$value1->major_code])*100 / $total_graduate[$value1->major_code], 2);
            } else {
                $tile_vieclam_tongtn[$value1->major_code] = 0;
            }
        }
    }

    public function cohort_statistic($cohort)
    {//thống kê ciệc làm theo năm tốt nghiệp
        //  dd($cohort);

        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();
        $hienthi_course = $cohort;
        $selectyear = RegisterGraduate::selectRaw('YEAR(register_graduate_date) as year')->distinct()->orderBy('year', 'desc')->get();
        $hienthi_year = 'all';
        $check = 'cohort';
        $major = Major::all();
        // $request->year = 2019;
            foreach ($major as $value1) {//lấy chuyên ngành
                //đếm tổng số sv tốt nghiệp của năm... theo ngành...
                $total_graduate[$value1->major_code] = count(
                    RegisterGraduate::where([
                        ['register_graduate_major_name', 'LIKE', $value1->major_name],
                        ['register_graduate_year_begin', $cohort],
                        ])
                ->get());
                // dd($total_graduate[$value1->major_code]);

                //đếm tổng số sv nữ tốt nghiệp của năm... theo ngành...
                $total_graduate_female[$value1->major_code] = count(RegisterGraduate::where([['register_graduate_major_name', 'LIKE', $value1->major_name], ['register_graduate_gender', 'LIKE', 'N']])
                ->get());

                $feedback[$value1->major_code] = 0; //đếm số phản hồi
                $female_feedback[$value1->major_code] = 0; //số phản hồi là nữ
                $count_dungnganhdaotao[$value1->major_code] = 0;
                $count_lienquandennganhdaotao[$value1->major_code] = 0;
                $count_khonglienquandennganhdaotao[$value1->major_code] = 0;
                $count_tieptuchoc[$value1->major_code] = 0;
                $count_chuacovieclam[$value1->major_code] = 0;
                $count_nhanuoc[$value1->major_code] = 0;
                $count_tunhan[$value1->major_code] = 0;
                $count_tutaovieclam[$value1->major_code] = 0;
                $count_coyeutonuocngoai[$value1->major_code] = 0;

                //lấy id khảo sát
                $survey_year = Survey::where('survey_name', 'LIKE', '%TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP%')->get(); //lấy id khảo sát
                foreach ($survey_year as $value2) {//duyệt khảo sát
                    //lấy câu hỏi việc làm
                    $tinhhinhvieclam1 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/Chị có việc làm hay chưa?%']])->first();
                    // dd($tinhhinhvieclam[0]['question_id']);
                    $tinhhinhvieclam2 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?%']])->first();
                    //lấy câu hỏi khu vuc làm viec
                    $khuvuclamviec = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/chị làm việc trong khu vực nào?%']])->first();
                    //$khuvuclamviec[0]
                    //lấy câu trả lời theo khảo sát của
                    $answer = Answer::join('users', 'users.user_id', 'answers.user_id')
                    ->join('register_graduate', 'register_graduate.register_graduate_code', 'users.code')
                    ->join('role_users', 'role_users.user_id', 'users.user_id')
                    ->where([['survey_id', $value2->survey_id], ['role_users.role_id', 3], ['register_graduate_year_begin', $cohort]])
                    ->get();
                    // dd($year);
                    // dd($answer);
                    //$answer[0]
                    // dd(!$answer->isEmpty());
                    // $feedback[$value1->major_code] = count($answer);  //đếm số phản hồi
                    // dd($value1->major_code);
                    if (!$answer->isEmpty()) {
                        foreach ($answer as $value3) {//duyệt bảng câu trả lời để lấy dữ liệu
                            //thông tin người trả lời khảo sát
                            $temp_female_feedback = User::join('answers', 'users.user_id', 'answers.user_id')->where('users.user_id', $value3->user_id)->first();
                            $temp_feedback = User::join('answers', 'users.user_id', 'answers.user_id')
                            ->join('class_users', 'class_users.user_id', 'users.user_id')
                            ->join('classes', 'classes.class_id', 'class_users.class_id')
                            ->join('majors', 'majors.major_id', 'classes.major_id')
                            ->where('users.user_id', $value3->user_id)->first();
                            // dd($temp_feedback->major_code);
                            if ($temp_feedback->major_code != $value1->major_code) {
                                continue; //chỉ lấy câu tl của người thuộc ngành đó trả lời
                            }
                            if ($temp_female_feedback->gender == 'N') {
                                ++$female_feedback[$value1->major_code]; //nếu phản hồi là nữ thì cộng 1
                            }
                            if ($temp_feedback->major_code == $value1->major_code) {
                                ++$feedback[$value1->major_code]; //đếm phản hồi của ngành
                            }

                            // dd($tinhhinhvieclam[0]);

                            ///////đếm phương án
                            $answer_dungnganhdaotao = json_decode($value3->answer_content);
                            // dd($answer_dungnganhdaotao);
                            foreach ($answer_dungnganhdaotao as $key4 => $value4) {
                                //đém câu trả lời đúng ngành đào tạo
                                if ($key4 == $tinhhinhvieclam1['question_id']) {
                                    if (stripos($value4[0], 'Chưa - Đang học (Kết thúc khảo sát)') !== false) {
                                        ++$count_tieptuchoc[$value1->major_code];
                                        continue;
                                    } elseif (stripos($value4[0], 'Chưa có (Kết thúc khảo sát)') !== false) {
                                        ++$count_chuacovieclam[$value1->major_code];
                                        continue;
                                    }
                                }
                                if ($key4 == $tinhhinhvieclam2['question_id']) {
                                    // dd(strpos($value4[0], 'Đúng ngành đào tạo') !== false);
                                    // strcasecmp
                                    // dd(strcasecmp($value4[0], 'Đúng ngành đào tạo'));/
                                    // if (stripos($value4[0], 'Đúng ngành đào tạo') !== false) {
                                    //     ++$count_dungnganhdaotao[$value1->major_code];
                                    if (strcasecmp($value4[0], 'Đúng với ngành đào tạo') == 0) {
                                        ++$count_dungnganhdaotao[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Không đúng với ngành đào tạo') !== false) {
                                        ++$count_lienquandennganhdaotao[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Không liên quan đến ngành được đào tạo') !== false) {
                                        ++$count_khonglienquandennganhdaotao[$value1->major_code];
                                    }
                                }
                                if ($key4 == $khuvuclamviec['question_id']) {
                                    if (stripos($value4[0], 'Nhà nước') !== false) {
                                        ++$count_nhanuoc[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Tư nhân') !== false) {
                                        ++$count_tunhan[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Tự tạo việc làm') !== false) {
                                        ++$count_tutaovieclam[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Liên doanh nước ngoài') !== false) {
                                        ++$count_coyeutonuocngoai[$value1->major_code];
                                    } else {
                                        dd('Lỗi khu vực việc làm');
                                    }
                                }
                            }
                        }
                    }
                }
                if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                    $tile_vieclam_phanhoi[$value1->major_code] = round(
                ($count_dungnganhdaotao[$value1->major_code] +
                $count_lienquandennganhdaotao[$value1->major_code] +
                $count_khonglienquandennganhdaotao[$value1->major_code] +
                $count_tieptuchoc[$value1->major_code])*100 / $feedback[$value1->major_code], 2);

                    $tile_vieclam_tongtn[$value1->major_code] = round(
                ($count_dungnganhdaotao[$value1->major_code] +
                $count_lienquandennganhdaotao[$value1->major_code] +
                $count_khonglienquandennganhdaotao[$value1->major_code] +
                $count_tieptuchoc[$value1->major_code])*100 / $total_graduate[$value1->major_code], 2);
                } else {
                    $tile_vieclam_phanhoi[$value1->major_code] = 0;
                    $tile_vieclam_tongtn[$value1->major_code] = 0;
                }
            }
        // dd($count_dungnganhdaotao);
        return $this->return_view($course,
    $hienthi_course,
    $selectyear,
    $hienthi_year,
    $check,
    $major,
    $total_graduate,
    $total_graduate_female,
    $feedback,
    $female_feedback,
    $count_dungnganhdaotao,
    $count_lienquandennganhdaotao,
    $count_khonglienquandennganhdaotao,
    $count_tieptuchoc,
    $count_chuacovieclam,
    $tile_vieclam_phanhoi,
    $tile_vieclam_tongtn,
    $count_nhanuoc,
    $count_tunhan,
    $count_tutaovieclam,
    $count_coyeutonuocngoai,
    );
    }

    public function year_statistic($year)
    {//thống kê ciệc làm theo năm tốt nghiệp
        //  dd($year);
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();
        $hienthi_course = 'all';
        $selectyear = RegisterGraduate::selectRaw('YEAR(register_graduate_date) as year')->distinct()->orderBy('year', 'desc')->get();
        $hienthi_year = $year;
        $check = 'year';
        $major = Major::all();
        // $request->year = 2019;
            foreach ($major as $value1) {//lấy chuyên ngành
                //đếm tổng số sv tốt nghiệp của năm... theo ngành...
                $total_graduate[$value1->major_code] = count(RegisterGraduate::where('register_graduate_major_name', 'LIKE', $value1->major_name)
                ->whereYear('register_graduate_date', $year)
                ->get());
                // dd($total_graduate[$value1->major_code]);

                //đếm tổng số sv nữ tốt nghiệp của năm... theo ngành...
                $total_graduate_female[$value1->major_code] = count(RegisterGraduate::where([['register_graduate_major_name', 'LIKE', $value1->major_name], ['register_graduate_gender', 'LIKE', 'N']])
                ->get());

                $feedback[$value1->major_code] = 0; //đếm số phản hồi
                $female_feedback[$value1->major_code] = 0; //số phản hồi là nữ
                $count_dungnganhdaotao[$value1->major_code] = 0;
                $count_lienquandennganhdaotao[$value1->major_code] = 0;
                $count_khonglienquandennganhdaotao[$value1->major_code] = 0;
                $count_tieptuchoc[$value1->major_code] = 0;
                $count_chuacovieclam[$value1->major_code] = 0;
                $count_nhanuoc[$value1->major_code] = 0;
                $count_tunhan[$value1->major_code] = 0;
                $count_tutaovieclam[$value1->major_code] = 0;
                $count_coyeutonuocngoai[$value1->major_code] = 0;

                //lấy id khảo sát
                $survey_year = Survey::where('survey_name', 'LIKE', '%TÌNH HÌNH VIỆC LÀM CỦA SINH VIÊN SAU 1 NĂM TỐT NGHIỆP%')->get(); //lấy id khảo sát
                foreach ($survey_year as $value2) {//duyệt khảo sát
                    //lấy câu hỏi việc làm
                    $tinhhinhvieclam1 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/Chị có việc làm hay chưa?%']])->first();
                    // dd($tinhhinhvieclam[0]['question_id']);
                    $tinhhinhvieclam2 = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Công việc mà Anh/Chị đang làm có đúng với ngành Anh/Chị được đào tạo hay không?%']])->first();
                    //lấy câu hỏi khu vuc làm viec
                    $khuvuclamviec = Question::where([['survey_id', $value2->survey_id], ['question_title', 'LIKE', '%Anh/chị làm việc trong khu vực nào?%']])->first();
                    //$khuvuclamviec[0]
                    //lấy câu trả lời theo khảo sát của
                    $answer = Answer::join('users', 'users.user_id', 'answers.user_id')
                    ->join('register_graduate', 'register_graduate.register_graduate_code', 'users.code')
                    ->join('role_users', 'role_users.user_id', 'users.user_id')
                    ->where([['survey_id', $value2->survey_id], ['role_users.role_id', 3]])
                    ->whereYear('register_graduate_date', $year)
                    ->get();
                    // dd($year);
                    // dd($answer);
                    //$answer[0]
                    // dd(!$answer->isEmpty());
                    // $feedback[$value1->major_code] = count($answer);  //đếm số phản hồi
                    // dd($value1->major_code);
                    if (!$answer->isEmpty()) {
                        foreach ($answer as $value3) {//duyệt bảng câu trả lời để lấy dữ liệu
                            //thông tin người trả lời khảo sát
                            $temp_female_feedback = User::join('answers', 'users.user_id', 'answers.user_id')->where('users.user_id', $value3->user_id)->first();
                            $temp_feedback = User::join('answers', 'users.user_id', 'answers.user_id')
                            ->join('class_users', 'class_users.user_id', 'users.user_id')
                            ->join('classes', 'classes.class_id', 'class_users.class_id')
                            ->join('majors', 'majors.major_id', 'classes.major_id')
                            ->where('users.user_id', $value3->user_id)->first();
                            // dd($temp_feedback->major_code);
                            if ($temp_feedback->major_code != $value1->major_code) {
                                continue; //chỉ lấy câu tl của người thuộc ngành đó trả lời
                            }
                            if ($temp_female_feedback->gender == 'N') {
                                ++$female_feedback[$value1->major_code]; //nếu phản hồi là nữ thì cộng 1
                            }
                            if ($temp_feedback->major_code == $value1->major_code) {
                                ++$feedback[$value1->major_code]; //đếm phản hồi của ngành
                            }

                            // dd($tinhhinhvieclam[0]);

                            ///////đếm phương án
                            $answer_dungnganhdaotao = json_decode($value3->answer_content);
                            // dd($answer_dungnganhdaotao);
                            foreach ($answer_dungnganhdaotao as $key4 => $value4) {
                                //đém câu trả lời đúng ngành đào tạo
                                // dd($tinhhinhvieclam['question_id']);
                                // dd($value4[0]);
                                // dd($tinhhinhvieclam1['question_id']);
                                if ($key4 == $tinhhinhvieclam1['question_id']) {
                                    // dd(preg_match('.Có.việc.', $value4[0], $matches));
                                    // dd(stripos($value4[0], '"Có việc (Tiếp tục khảo sát)"') !== false);
                                    // "Có việc (Tiếp tục khảo sát)"
                                    //lọc đếm đáp án về tình hình việc làm
                                    // if (stripos($value4[0], 'Đúng ngành đào tạo') !== false) {
                                    //     ++$count_dungnganhdaotao[$value1->major_code];
                                    // } elseif (stripos($value4[0], 'Liên quan đến ngành đào tạo') !== false) {
                                    //     ++$count_lienquandennganhdaotao[$value1->major_code];
                                    // } elseif (stripos($value4[0], 'Không liên quan đến ngành đào tạo') !== false) {
                                    //     ++$count_khonglienquandennganhdaotao[$value1->major_code];
                                    // } elseif (stripos($value4[0], 'Tiếp tục học') !== false) {
                                    //     ++$count_tieptuchoc[$value1->major_code];
                                    // } elseif (stripos($value4[0], 'Chưa có') !== false) {
                                    //     ++$count_chuacovieclam[$value1->major_code];
                                    // } else {
                                    //     dd('Lỗi tình hình việc làm');
                                    // }
                                    if (stripos($value4[0], 'Chưa - Đang học (Kết thúc khảo sát)') !== false) {
                                        ++$count_tieptuchoc[$value1->major_code];
                                        continue;
                                    } elseif (stripos($value4[0], 'Chưa có (Kết thúc khảo sát)') !== false) {
                                        ++$count_chuacovieclam[$value1->major_code];
                                        continue;
                                    }
                                }
                                if ($key4 == $tinhhinhvieclam2['question_id']) {
                                    // dd(strpos($value4[0], 'Đúng ngành đào tạo') !== false);
                                    // strcasecmp
                                    // dd(strcasecmp($value4[0], 'Đúng ngành đào tạo'));/
                                    // if (stripos($value4[0], 'Đúng ngành đào tạo') !== false) {
                                    //     ++$count_dungnganhdaotao[$value1->major_code];
                                    if (strcasecmp($value4[0], 'Đúng với ngành đào tạo') == 0) {
                                        ++$count_dungnganhdaotao[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Không đúng với ngành đào tạo') !== false) {
                                        ++$count_lienquandennganhdaotao[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Không liên quan đến ngành được đào tạo') !== false) {
                                        ++$count_khonglienquandennganhdaotao[$value1->major_code];
                                    }
                                }
                                if ($key4 == $khuvuclamviec['question_id']) {
                                    if (stripos($value4[0], 'Nhà nước') !== false) {
                                        ++$count_nhanuoc[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Tư nhân') !== false) {
                                        ++$count_tunhan[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Tự tạo việc làm') !== false) {
                                        ++$count_tutaovieclam[$value1->major_code];
                                    } elseif (stripos($value4[0], 'Liên doanh nước ngoài') !== false) {
                                        ++$count_coyeutonuocngoai[$value1->major_code];
                                    } else {
                                        dd('Lỗi khu vực việc làm');
                                    }
                                }
                            }
                        }
                    }
                }
                if ($feedback[$value1->major_code] != 0 && $total_graduate[$value1->major_code] != 0) {
                    $tile_vieclam_phanhoi[$value1->major_code] = round(
                ($count_dungnganhdaotao[$value1->major_code] +
                $count_lienquandennganhdaotao[$value1->major_code] +
                $count_khonglienquandennganhdaotao[$value1->major_code] +
                $count_tieptuchoc[$value1->major_code])*100 / $feedback[$value1->major_code], 2);

                    $tile_vieclam_tongtn[$value1->major_code] = round(
                ($count_dungnganhdaotao[$value1->major_code] +
                $count_lienquandennganhdaotao[$value1->major_code] +
                $count_khonglienquandennganhdaotao[$value1->major_code] +
                $count_tieptuchoc[$value1->major_code])*100 / $total_graduate[$value1->major_code], 2);
                } else {
                    $tile_vieclam_phanhoi[$value1->major_code] = 0;
                    $tile_vieclam_tongtn[$value1->major_code] = 0;
                }
            }
        // dd($count_dungnganhdaotao);
        return $this->return_view($course,
    $hienthi_course,
    $selectyear,
    $hienthi_year,
    $check,
    $major,
    $total_graduate,
    $total_graduate_female,
    $feedback,
    $female_feedback,
    $count_dungnganhdaotao,
    $count_lienquandennganhdaotao,
    $count_khonglienquandennganhdaotao,
    $count_tieptuchoc,
    $count_chuacovieclam,
    $tile_vieclam_phanhoi,
    $tile_vieclam_tongtn,
    $count_nhanuoc,
    $count_tunhan,
    $count_tutaovieclam,
    $count_coyeutonuocngoai,
    );
    }

    public function return_view($course,
    $hienthi_course,
    $selectyear,
    $hienthi_year,
    $check,
    $major,
    $total_graduate,
    $total_graduate_female,
    $feedback,
    $female_feedback,
    $count_dungnganhdaotao,
    $count_lienquandennganhdaotao,
    $count_khonglienquandennganhdaotao,
    $count_tieptuchoc,
    $count_chuacovieclam,
    $tile_vieclam_phanhoi,
    $tile_vieclam_tongtn,
    $count_nhanuoc,
    $count_tunhan,
    $count_tutaovieclam,
    $count_coyeutonuocngoai
    ) {
        return  view('pages.admins.statistic.job',
        compact(
        'course',
        'hienthi_course',
        'selectyear',
        'hienthi_year',
        'check',
        'major',
        'total_graduate',
        'total_graduate_female',
        'feedback',
        'female_feedback',
        'count_dungnganhdaotao',
        'count_lienquandennganhdaotao',
        'count_khonglienquandennganhdaotao',
        'count_tieptuchoc',
        'count_chuacovieclam',
        'tile_vieclam_phanhoi',
        'tile_vieclam_tongtn',
        'count_nhanuoc',
        'count_tunhan',
        'count_tutaovieclam',
        'count_coyeutonuocngoai',
        ));
    }

    public function job_statistic(Request $request)
    {
        $course = Classes::selectRaw('YEAR(class_begin) as year')->distinct()->orderBy('year', 'desc')->get();
        $selectyear = RegisterGraduate::selectRaw('YEAR(register_graduate_date) as year')->distinct()->orderBy('year', 'desc')->get();
        $check = $request->check;
        $cohort = $request->cohort;
        $year = $request->year;
        // dd($cohort);
        //thuật toán

        // if($check='cohort'){//thống kê theo khóa
        //     if($course=='all'){
        //         $this->cohort_all();
        // }
        //         else{
        //             $this->cohort_statistic();
        //         }
        //             $hienthi_course=$course;
        //             $hienthi_year='all';
        // }
        // else{//thống kê theo năm
        //     if($year=='all'){
        //     return \Redirect::route('statistic.job');
        // }
        //         else{
        //             $this->year_statistic();
        //         }
        //             $hienthi_course='all';
        //             $hienthi_year=$year;
        // }

        if ($check == 'cohort') {//thống kê theo khóa
            if ($cohort == 'all') {
                return \Redirect::route('statistic.job');
            // return $this->cohort_all($year);
            } else {
                return $this->cohort_statistic($cohort);
            }
        } else {//thống kê theo năm
            if ($year == 'all') {
                return \Redirect::route('statistic.job');
            } else {
                return $this->year_statistic($year);
            }
        }
    }
// TODO THỐNG KÊ VIỆC LÀM THỰC TẾ CỦA CSV
    public function job_profile()
    {
        
        $major = Major::all();
        // $request->year = 2019;
        foreach ($major as $value1) {//lấy chuyên ngành
            //đếm tổng số sv tốt nghiệp
            $total_graduate[$value1->major_code]=count(
                User::join('role_users','users.user_id','role_users.user_id')
                    ->join('class_users','users.user_id','class_users.user_id')
                    ->join('classes','classes.class_id','class_users.class_id')
                    ->join('majors','majors.major_id','classes.major_id')
                    ->where([['role_users.role_id',3],['major_code',$value1->major_code]])
                    ->get()
            );
            
            
            //đếm tổng số sv nữ tốt nghiệp của năm... theo ngành...
            $total_graduate_female[$value1->major_code]=count(
                User::join('role_users','users.user_id','role_users.user_id')
                    ->join('class_users','users.user_id','class_users.user_id')
                    ->join('classes','classes.class_id','class_users.class_id')
                    ->join('majors','majors.major_id','classes.major_id')
                    ->where([['role_users.role_id',3],['users.gender','N'],['major_code',$value1->major_code]])
                    ->get()
            );
            // dd($total_graduate_female[$value1->major_code]);

            $dacovieclam[$value1->major_code] = 0; //đếm số phản hồi
            $dacovieclamnu[$value1->major_code] = 0; //số phản hồi là nữ
            $count_duoi5[$value1->major_code] = 0;
            $count_5den10[$value1->major_code] = 0;
            $count_tren10[$value1->major_code] = 0;
            $tilevieclam[$value1->major_code]= 0;
            $phantram_dacovieclamnu[$value1->major_code]= 0;
            $phantram_count_duoi5[$value1->major_code]=0;
            $phantram_count_5den10[$value1->major_code]=0;
            $phantram_count_tren10[$value1->major_code]=0;

            
            $users = User::select(DB::raw('LENGTH(work_salary) as salary, work_users.user_id, gender, work_salary'))
            ->join('role_users','users.user_id','role_users.user_id')
            ->join('class_users','users.user_id','class_users.user_id')
            ->join('classes','classes.class_id','class_users.class_id')
            ->join('majors','majors.major_id','classes.major_id')
            ->join('work_users','users.user_id','work_users.user_id')
            ->join('works','works.work_id','work_users.work_id')
            ->where([
                    ['role_users.role_id',3],
                    ['class_user_accountability','sinh viên'],
                    ['major_code',$value1->major_code]
                    ])
            ->groupBy('work_users.user_id')
            ->orderBy('salary', 'desc')
            ->get();
            // ->unique('work_users.user_id');

            // dd(strlen ('Trên 10 triệu    '));
            // dd($users[6]);
            //17
            //19
            //16

            // dd(!$users->isEmpty());
            if(!$users->isEmpty()){
                $dacovieclam[$value1->major_code]=count($users);
            
            foreach ($users as $user) {
                // dump($user);
                if($user->gender=='N'){
                    ++$dacovieclamnu[$value1->major_code]  ;
                }
                if($user->work_salary=='Dưới 5 triệu'){
                    ++$count_duoi5[$value1->major_code]  ;
                }
                if($user->work_salary=='Từ 5 - 10 triệu'){
                    ++$count_5den10[$value1->major_code]  ;
                }
                if($user->work_salary=='Trên 10 triệu    '){
                    ++$count_tren10[$value1->major_code]  ;
                }
               
            } 
            // die;
            // dd($dacovieclamnu[$value1->major_code]);
        }
            if($dacovieclam[$value1->major_code]!=0){
            $phantram_dacovieclamnu[$value1->major_code]=round(
                $dacovieclamnu[$value1->major_code]*100/$total_graduate_female[$value1->major_code],2
            );

            $phantram_count_duoi5[$value1->major_code]=round(
                $count_duoi5[$value1->major_code]*100/$dacovieclam[$value1->major_code],2
            );

            $phantram_count_5den10[$value1->major_code]=round(
                $count_5den10[$value1->major_code]*100/$dacovieclam[$value1->major_code],2
            );

            $phantram_count_tren10[$value1->major_code]=round(
                $count_tren10[$value1->major_code]*100/$dacovieclam[$value1->major_code],2
            );

            if( $phantram_count_tren10[$value1->major_code] + $phantram_count_5den10[$value1->major_code] +$phantram_count_duoi5[$value1->major_code] >100){
                $phantram_count_tren10[$value1->major_code]=100-($phantram_count_duoi5[$value1->major_code]+ $phantram_count_duoi5[$value1->major_code]);
            }
            if($total_graduate[$value1->major_code]!=0){
            $tilevieclam[$value1->major_code]=round(
                $dacovieclam[$value1->major_code]*100/$total_graduate[$value1->major_code],2);
            }
        }
    }

        return  view('pages.admins.statistic.job_profile',
        compact(
        'total_graduate',
        'total_graduate_female',
        'phantram_dacovieclamnu',
        'phantram_count_duoi5',
        'phantram_count_5den10',
        'phantram_count_tren10',
        'dacovieclam',
        'dacovieclamnu',
        'count_duoi5',
        'count_5den10',
        'count_tren10',
        'major',
        'tilevieclam'
        ));
    }

    // Ajax lấy chuyên ngành theo ngành
    public function get_major_branch($major_id)
    {
        $major_branch = MajorBranch::where('major_id', $major_id)->get();
        echo "<option value='all'>Tất cả</option>";
        foreach ($major_branch as $item) {
            echo "<option value='".$item->major_branch_id."'>".$item->major_branch_name.'</option>';
        }
    }

    public function showMajor(Request $request)
    {
        if ($request->ajax()) {
            $major = Major::all();

            return response()->json($major, 200);
        }
    }

    public function get_major($course)
    {
        if ($course == 'all') {
            echo "<option value='all'>Tất cả</option>";
        } else {
            $major = Major::all();
            echo "<option value='all'>Tất cả</option>";
            foreach ($major as $item) {
                echo "<option value='".$item->major_id."'>".$item->major_name.'</option>';
            }
        }
    }

    // Ajax lấy lơp theo chuyên ngành
    public function get_class($major_id, $major_branch_id, $course)
    {
        // if ($course == 'all') {
        //     echo "<option value='all'>all</option>";
        // } else {
        if ($major_branch_id == 'all') {
            $class = Classes::where('major_id', $major_id)
        ->whereYear('class_begin', $course)
        ->get();
        } else {
            $class = Classes::Where([['major_id', $major_id], ['major_branch_id', $major_branch_id]])
        ->whereYear('class_begin', $course)
        ->get();
        }

        // dd($class);
        echo "<option value='all'>Tất cả</option>";
        foreach ($class as $item) {
            echo "<option value='".$item->class_id."'>".$item->class_code.' - '.$item->class_name.'</option>';
        }
        // }
    }

    // Job export
    public function job_export(Request $request)
    {
        $data = json_decode($request->get('data_export'), true);

        return Excel::download(new JobStatisticExport($data), 'EmploymentStatistics.xlsx');
    }


    
   
}
