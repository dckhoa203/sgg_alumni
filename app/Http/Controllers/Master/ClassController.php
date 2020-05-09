<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MajorBranch;
use App\Models\Classes;
use App\Models\Major;
use App\Models\ClassUser;
use App\Models\User;
use App\Models\StatusUser;
use App\Models\RoleUser;
use App\Models\Education;
use DB;
use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Academy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClassController extends Controller
{
    // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một Lớp ra trang index
    public function index(Request $request)
    {
        $class = DB::select(DB::raw('
        SELECT * FROM `classes` JOIN majors on majors.major_id=classes.major_id
        '
        ));
        $major_branch = MajorBranch::all();
        // dd($class[33]->class_id);
        foreach($class as $value){
          $classuser[$value->class_code] = ClassUser::join('users', 'users.user_id', 'class_users.user_id')
        ->where([['class_users.class_user_accountability', 'cố vấn'],['class_users.class_id', $value->class_id]])
        ->get();  
        // dd($classuser[$value->class_code]);
        }
        if(!isset($classuser)){
            $classuser='';
        }
        

        return view('pages.admins.class.index', compact('class', 'major_branch', 'classuser'));
    }

    // Hàm đỗ dữ liệu của một Lớp ra trang index
    public function index_teacher(Request $request)
    {
        $covan = ClassUser::join('users', 'users.user_id', 'class_users.user_id')
        ->join('classes', 'classes.class_id', 'class_users.class_id')
        ->where([
            ['class_users.class_user_accountability', 'cố vấn'],
            ['users.user_id', Auth::user()->user_id], ])
        ->get();
        // dd($covan);
        $major_branch = MajorBranch::all();
        $classuser = ClassUser::join('users', 'users.user_id', 'class_users.user_id')
        ->where('class_users.class_user_accountability', 'cố vấn')->get();

        return view('pages.admins.class.index', compact('covan', 'major_branch', 'classuser'));
    }

    // TODO: Mỗi function chỉ thực hiện 1 nhiệm vụ. Cho người khác dễ sửa chửa code của mình.
    // Hàm chỉ thực hiện đỗ ra trang Thêm
    public function create_render(Request $request)
    {
        $nganh = Major::all();
        $khoa = Academy::all();
        $teacher = User::join('role_users', 'role_users.user_id', 'users.user_id')
        ->where('role_users.role_id', 2)->get();

        return view('pages.admins.class.create', compact('nganh', 'khoa', 'teacher'));
    }

    // Hàm chỉ thực hiện chức năng Thêm thông qua Method = POST
    public function create_submit(Request $request)
    {
        // $year_start = substr($request->class_year_begin, 0, 4);
        // $year_finish = substr($request->class_year_begin, -4);

        // $education = Education::all();
        // $congnam = floor($education[0]->education_training_time / 2);
        // $hocky = $education[0]->education_training_time % 2;
        // $year_start = $year_start + $congnam;
        // $year_finish = $year_finish + $congnam;

        // if ($hocky == 1 && $request->class_semester_begin == 1) {
        //     $class_semester_end = 2;
        // } elseif ($hocky == 1 && $request->class_semester_begin == 2) {
        //     $class_semester_end = 1;
        //     ++$year_start;
        //     ++$year_finish;
        // }

        // dd($hocky);

        // dd($request);
        $this->validate($request, [
            'class_code' => 'required',
            'class_name' => 'required',
            'class_begin' => 'required',
        ]);

        $class_end = new Carbon($request->class_begin);
        $class_end = $class_end->addYears(4)->toDateString();

        $class_id = DB::table('classes')->insertGetId(
            array(
                'major_id' => $request->major_id,
                'major_branch_id' => $request->major_branch_id,
                'class_code' => $request->class_code,
                'class_name' => $request->class_name,
                // 'class_semester_begin' => $request->class_semester_begin,
                // 'class_year_begin' => $request->class_year_begin,
                // 'class_semester_end' => $class_semester_end,
                // 'class_year_end' => $year_start.' - '.$year_finish,
                'class_begin' => $request->class_begin,
                'class_end' => $class_end,
            )
        );

        if (!empty($request->teacher)) {
            foreach ($request->teacher as $key => $value) {
                $teacher = DB::table('users')->where('username', $value)->first();
                // dd($teacher);
                if ($teacher != null) {
                    // if(!empty($value))
                    DB::table('class_users')->insert([
                        'class_id' => $class_id,
                        'user_id' => $teacher->user_id,
                        'class_user_accountability' => 'cố vấn',
                    ]);
                } else {
                    return redirect('class/create')->with('error', 'Mã giáo viên không tồn tại');
                }
            }
        }

        return redirect('class')->with('success', 'Added Successfully');
    }

    public function render_quick(Request $request)
    {
        $nganh = Major::all();
        $khoa = Academy::all();

        return view('pages.admins.class.create_quick', compact('nganh', 'khoa'));
    }

    public function submit_quick(Request $request)
    {
        // KH12Y1A1
        $this->validate($request, [
            'class_number' => 'required',
            'class_begin' => 'required',
            'class_end' => 'required',
        ]);
        $major = Major::find($request->major_id);
        $academy = Academy::find($major->academy_id);
        $year = substr($request->class_begin, 2, 2);

        if ($request->major_branch_id != 0) {//Chuyên ngành Tin học ứng dụng
            for ($i = 1; $i <= $request->class_number; ++$i) {
                Classes::insert([
                            'major_id' => $request->major_id,
                            'major_branch_id' => $request->major_branch_id,
                            'class_code' => 'KH'.$year.'Y1A'.$i,
                            'class_name' => 'Tin học ứng dụng A'.$i,
                            'class_begin' => $request->class_begin,
                            'class_end' => $request->class_end,
                        ]);
            }
        } else {
            for ($i = 1; $i <= $request->class_number; ++$i) {
                Classes::insert([
                            'major_id' => $request->major_id,
                            'major_branch_id' => $request->major_branch_id,
                            'class_code' => $academy->academy_code.$year.$major->major_code.'A'.$i,
                            'class_name' => $major->major_name.' A'.$i,
                            'class_begin' => $request->class_begin,
                            'class_end' => $request->class_end,
                        ]);
            }
        }

        return redirect('class')->with('success', 'Added Successfully');
    }

    public function show($class_id)
    {
        $class = Classes::find($class_id);
        $teacher = User::join('class_users', 'class_users.user_id', 'users.user_id')
        ->join('classes', 'classes.class_id', 'class_users.class_id')
        ->where([['classes.class_id', $class_id], ['class_users.class_user_accountability', 'cố vấn']])->get();

        $student = User::join('class_users', 'class_users.user_id', 'users.user_id')
        ->join('classes', 'classes.class_id', 'class_users.class_id')
        ->where([['classes.class_id', $class_id], ['class_users.class_user_accountability', 'sinh viên']])->get();

        return view('pages.admins.class.show', compact('teacher', 'student', 'class'));
    }

    public function edit($class_id)
    {
        $nganh = Major::all();
        $chuyennganh = MajorBranch::all();
        $teacher = User::join('role_users', 'role_users.user_id', 'users.user_id')
                ->where('role_users.role_id', 2)->get();
        $class = Classes::findOrFail($class_id);
        $class_user = ClassUser::where([['class_id', $class_id], ['class_user_accountability', 'cố vấn']])->get();
        if ($class_user->toArray() != null) {
            foreach ($class_user as $item) {
                $user = User::findOrFail($item->user_id);
                $username[] = $user->username;
            }
        } else {
            $username[] = '';
        }

        return view('pages.admins.class.edit', compact('class', 'class_id', 'nganh', 'chuyennganh', 'username', 'teacher'));
    }

    public function update(Request $request, $class_id)
    {
        // $this->validate($request, [
        //     'class_code' => 'required',
        //     'class_name' => 'required',
        //     'adviser_teacher' => 'required',
        //     'class_begin' => 'required',
        //     'class_end' => 'required',
        // ]);
        // $year_start = substr($request->class_year_begin, 0, 4);
        // $year_finish = substr($request->class_year_begin, -4);

        // $education = Education::all();
        // $congnam = floor($education[0]->education_training_time / 2);
        // $hocky = $education[0]->education_training_time % 2;
        // $year_start = $year_start + $congnam;
        // $year_finish = $year_finish + $congnam;

        // if ($hocky == 1 && $request->class_semester_begin == 1) {
        //     $class_semester_end = 2;
        // } elseif ($hocky == 1 && $request->class_semester_begin == 2) {
        //     $class_semester_end = 1;
        //     ++$year_start;
        //     ++$year_finish;
        // }

        $class_end = new Carbon($request->class_begin);
        $class_end = $class_end->addYears(4)->toDateString();

        $class = Classes::find($class_id);
        //TODO:  Nhan du lieu tu form cu
        $class->major_id = $request->major_id;
        $class->major_branch_id = $request->major_branch_id;
        $class->class_code = $request->class_code;
        $class->class_name = $request->class_name;
        $class->class_begin = $request->class_begin;
        $class->class_end = $class_end;

        // $class->class_semester_begin = $request->class_semester_begin;
        // $class->class_year_begin = $request->class_year_begin;
        // $class->class_semester_end = $class_semester_end;
        // $class->class_year_end = $year_start.' - '.$year_finish;
        $class->save();

        $teacher_old = ClassUser::join('users', 'users.user_id', 'class_users.user_id')
        ->where('class_users.class_id', $class_id)
        ->select('username', 'class_users.class_user_id')
        ->get();

        foreach ($teacher_old as $item) {
            if (is_array($request->teacher_old)) {
                foreach ($request->teacher_old as $key => $value) {
                    if ($item->username != $value) {
                        $class_user = ClassUser::findOrFail($item->class_user_id);
                        $class_user->delete();
                    }
                }
            }
        }

        if (!empty($request->teacher_new)) {
            foreach ($request->teacher_new as $key => $value) {
                $teacher = DB::table('users')->where('username', $value)->first();
                // dd($teacher);
                if ($teacher != null) {
                    // if(!empty($value))
                    DB::table('class_users')->insert([
                        'class_id' => $class_id,
                        'user_id' => $teacher->user_id,
                        'class_user_accountability' => 'cố vấn',
                    ]);
                } else {
                    return redirect('class/create')->with('error', 'Mã giáo viên không tồn tại');
                }
            }
        }

        return redirect('class')->with('success', 'Updated Successfully');
    }
    public function import(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'import_classes'  => 'required|mimes:xls,xlsx,csv'
        ]);
        $teachers = Excel::toArray(new TeacherImport(), $request->file('import_classes'));
        foreach ($teachers[0] as $teacher) {
            if($teacher['Tên Lớp']==null) {continue;}
            //nếu đã có thì bỏ qua
            $exist1 = Classes::where('class_code', $teacher['Tên Lớp'])->get();
            if (!$exist1->isEmpty()) {
                continue;
            }
            $chuyennganh=0;
            if($teacher['Tên chuyên ngành']=='Tin học Ứng dụng'){
                $chuyennganh=1;
                $nganh=5;
            }
                else{
                    $nganh=Major::where('major_code',$teacher['Mã chuyên ngành'])->first();
                        if($nganh==null){
                            $nganh=Major::insertGetId(
                                array(
                                'academy_id'=>1,
                                'major_code'=>$teacher['Mã chuyên ngành'],
                                'major_name'=>$teacher['Tên chuyên ngành'],
                                )
                        );
                    }
                    else{
                        $nganh=$nganh->major_id;
                    }
                }
                $cutbegin = date('Y-m-d', strtotime('01-08-20'.substr($teacher['Tên Lớp'], 2, 2)));
                $cutend_temp = '20'.substr($teacher['Tên Lớp'], 2, 2) + 4;
                $cutend = date('Y-m-d', strtotime('01-12-'.$cutend_temp));
                $lop=Classes::insertGetId([
                    'major_id'=>$nganh,
                    'major_branch_id'=>$chuyennganh,
                    'class_code'=>$teacher['Tên Lớp'],
                    'class_name'=>$teacher['Tên chuyên ngành'],
                    'class_begin'=>$cutbegin,
                    'class_end'=>$cutend,
                ]);
            //nếu chưa có giáo viên này thì tạo
            
            $tel=ltrim(strstr($teacher['Liên hệ'],'-'), '-');
            if($tel==''){
                $tel=$teacher['Liên hệ'];
            }
            $mail=substr( $teacher['Liên hệ'],  0, strpos($teacher['Liên hệ'],'-') );
            if($mail==''){
                $mail='@ctu.edu.vn';
            }
            $exist2 = User::where('code', $teacher['MSCB'])->get();
            if ($exist2->isEmpty()) {
                $gv = User::insertGetId(
                array(
                'username' => $teacher['MSCB'],
                'code' => $teacher['MSCB'],
                'name' => $teacher['Họ tên CB'],
                'other_email' => $mail,
                // 'password' => Hash::make($user['Mật khẩu']),
                'password' => Hash::make('admin'),
                'course' => '',
                'nation' => '',
                'tel' => $tel,
                'email' => $mail,
                'address' => '',
                'birth' => '',
                'gender' => '',
                'family_tel' => '',
                'family_address' => '',
                'status_id' => 3,
                'district_id' => 1,
                )
                );
            StatusUser::insert([
                'user_id' => $gv,
                'status_id' => 3,
                'status_users_reason' => '',
            ]);
            RoleUser::insert([
                'user_id' => $gv,
                'role_id' => 2,
            ]);
            }
            else{
                $gv=$exist2[0]->user_id;
            };
            
            ClassUser::insert([
                'user_id' => $gv,
                'class_id' =>$lop,
                'class_user_accountability' => 'cố vấn',
            ]);
            
            
            
        }

        return back()->with('success', 'Thêm danh sách Cố vấn thành công!');
    }
    public function destroy($class_id)
    {
        $data = Classes::findOrFail($class_id);
        $data->delete();
        // dd($data);
        return redirect('class')->with('success', 'Deleted Successfully!');
    }

    // DOM lấy chuyên ngành theo ngành
    public function get_major_branch($major_id)
    {
        $major_branch = MajorBranch::where('major_id', $major_id)->get();
        echo '<option value=0>Không</option>';
        foreach ($major_branch as $item) {
            echo "<option value='".$item->major_branch_id."'>".$item->major_branch_name.'</option>';
        }
    }

    public function get_major_branch_edit($major_id)
    {
        $major_branch = MajorBranch::where('major_id', $major_id)->get();
        if ($major_branch == null) {
            echo '<option value=0>Không</option>';
        } else {
            foreach ($major_branch as $item) {
                echo "<option value='".$item->major_branch_id."'>".$item->major_branch_name.'</option>';
            }
        }
    }
}
