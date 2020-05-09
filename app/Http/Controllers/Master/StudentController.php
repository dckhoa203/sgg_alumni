<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classes;
use App\Models\Major;
use App\Models\MajorBranch;
use App\Models\Academy;
use App\Models\Ward;
use App\Models\City;
use App\Models\District;
use App\Models\ClassUser;
use App\Models\RoleUser;
use App\Models\StatusUser;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = User::select('users.user_id', 'username', 'name', 'tel', 'email', 'class_id')
        ->join('role_users', 'role_users.user_id', 'users.user_id')
        ->join('class_users', 'users.user_id', 'class_users.user_id')
        ->where('role_users.role_id', 4)->limit(2000)->get();
        // GET CLASS_NAME
        $class_name = Classes::all();

        return view('pages.admins.students.index', compact('students', 'class_name'));
    }

    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $this->validate($request,[
            'file'  => 'required|mimes:xls,xlsx,csv'
        ]);
        // $users = Excel::import(new UsersImport(), $request->file('file'));
        $users = Excel::toArray(new UsersImport(), $request->file('file'));
        // $alumnis = Excel::toArray(new RegisterGraduateImport(), $request->file('file_graduate'));
        // dd($users[0][1]);
        // unset($users[0][0]);
        // unset($users[0][1]);
        foreach ($users[0] as $user) {
            $user['Nữ'] =  str_replace("\xc2\xa0", '', $user['Nữ']);
            // dd($user)
            // dd(substr($user['Lớp'], 2, 2));
            // dd($cut2 = '20'.substr($user['Lớp'], 2, 2) + 1);
            $exist = User::where('username', $user['Mã SV'])->get();
            if (!$exist->isEmpty()) {
                continue;
            }

            if ($user['Tình trạng'] == 'T') {
                $status_id = 1;
            } else {
                $status_id = 2;
            }
            if ($user['Nữ'] == 'N') {
                $gender = 'N';
            } else {
                $gender = '';
            }

            if ($user['Tên dân tộc'] == null) {
                $user['Tên dân tộc'] = '';
            }

            if ($user['ĐT DĐ'] == null) {
                $user['ĐT DĐ'] = '';
            }
            if ($user['Email'] == null) {
                $user['Email'] = '';
            }
            if ($user['Địa chỉ'] == null) {
                $user['Địa chỉ'] = '';
            }
            if ($user['Ngày sinh'] == null) {
                $user['Ngày sinh'] = '';
            }
            if ($user['ĐT GĐ'] == null) {
                $user['ĐT GĐ'] = '';
            }
            if ($user['Địa chỉ GD'] == null) {
                $user['Địa chỉ GD'] = '';
            }

            if ($user['Lý do'] == null) {
                $user['Lý do'] = '';
            }
            if ($user['Mã huyện'] == null) {
                $user['Mã huyện'] = '';
            }
            if ($user['Mã tỉnh'] == null) {
                $user['Mã tỉnh'] = '';
            }
            if ($user['Email'] == null) {
                $user['Email'] = $user['Họ và tên'].$user['Mã SV'].'@student.ctu.edu.vn';
            }
            $sinh = (str_replace('/', '-', str_replace("\xc2\xa0", '', $user['Ngày sinh'])));
            $ngaysinh = date('Y-m-d', strtotime($sinh));
            // $ngaysinh = date('Y-m-d', strtotime(str_replace("\xc2\xa0", '', $alumni['Ngày sinh'])));
            if ($ngaysinh == '1970-01-01') {
                // $ngay2 = new DateTime($alumni['Ngày sinh']);
                // $ngayky=date_format($ngay2, 'Y-m-d');
                // $ngaysinh=date('Y-m-d', strtotime($alumni['Ngày sinh']));
                // $ngaysinh = date_format(date_create_from_format('d/m/Y', $alumni['Ngày sinh']), 'Y-m-d');
                $ngaysinh = date_create_from_format('d/m/Y', $user['Ngày sinh']);
            }
            $cohort = ((int) substr($user['Lớp'], 2, 2)) + 26;

            $student = User::insertGetId(
                array(
                'username' => $user['Mã SV'],
                'code' => $user['Mã SV'],
                'name' => $user['Họ và tên'],
                'other_email' => $user['Email'],
                // 'password' => Hash::make($user['Mật khẩu']),
                'password' => Hash::make('admin'),
                'course' => $cohort,
                'nation' => $user['Tên dân tộc'],
                'tel' => $user['ĐT DĐ'],
                'email' => $user['Email'],
                'address' => $user['Địa chỉ'],
                'birth' => $ngaysinh,
                // 'birth' => date('Y-m-d H:i:s', strtotime($user['Ngày sinh'])),
                // 'birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user['Ngày sinh']),
                'gender' => $gender,
                'family_tel' => $user['ĐT GĐ'],
                'family_address' => $user['Địa chỉ GD'],
                'status_id' => $status_id,
                'district_id' => $user['Mã huyện'].$user['Mã tỉnh'],
                )
            );
            //tự tạo lớp nếu chưa có
            // $class = Classes::where('class_code', $user['Lớp'])->getLast()->first();
            $class = Classes::select('class_id')->where('class_code', $user['Lớp'])->get();
            if ($class->isEmpty()) {
                $major = Major::where('major_name', $user['Tên ngành'])->first();
                if ($major == null) {
                    continue;
                }
                if ($user['Tên chuyên ngành'] == 'Tin học Ứng dụng') {
                    $majorbranch = 1;
                } else {
                    $majorbranch = 0;
                }
                // $cut = '20'.substr($user['Lớp'], 2, 2);
                // $cut2 = '20'.substr($user['Lớp'], 2, 2) + 1;
                // $cut3 = '20'.substr($user['Lớp'], 2, 2) + 4;
                // $cut4 = $cut2 + 4;
                $cutbegin = date('Y-m-d', strtotime('01-08-20'.substr($user['Lớp'], 2, 2)));
                $cutend_temp = '20'.substr($user['Lớp'], 2, 2) + 4;
                $cutend = date('Y-m-d', strtotime('01-12-'.$cutend_temp));
                $class_id = Classes::insertGetId(array(
                    'class_code' => $user['Lớp'],
                    'class_name' => $user['Tên ngành'],
                    // 'class_semester_begin' => 1,
                    // 'class_year_begin' => $cut.' - '.$cut2,
                    // 'class_year_end' => $cut3.' - '.$cut4,
                    // 'class_semester_end' => 2,
                    'major_id' => $major->major_id,
                    'major_branch_id' => $majorbranch,
                    'class_begin' => $cutbegin,
                    'class_end' => $cutend,
                ));

                ClassUser::insert([
                    'user_id' => $student,
                    'class_id' => $class_id,
                    'class_user_accountability' => 'sinh viên',
                ]);
            } else {
                $class_id = Classes::where('class_code', $user['Lớp'])->first();
                ClassUser::insert([
                    'user_id' => $student,
                    'class_id' => $class_id->class_id,
                    'class_user_accountability' => 'sinh viên',
            ]);
            }
            StatusUser::insert([
                'user_id' => $student,
                'status_id' => $status_id,
                'status_users_reason' => $user['Lý do'],
            ]);
            RoleUser::insert([
                'user_id' => $student,
                'role_id' => 4,
            ]);
        }

        return back()->with('success', 'Thêm danh sách Sinh viên thành công!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $userRoles = User::with('roles')
        //     ->join('role_users','users.user_id','=','role_users.user_id')
        //     ->join('roles','role_users.role_id','=','roles.role_id')
        //     ->where('users.user_id',Auth::user()->user_id)->pluck('role_name');
        // //$userRoles = Auth::user()->roles->pluck('role_name');
        // if(!$userRoles->contains('Admin'))
        // {
        //     return redirect()->route('error');
        // }
        return view('pages.admins.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'password' => 'required',
            'course' => 'required',
            'class_code' => 'required',
            'nation' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birth' => 'required',
       ]);
        $temp = Classes::where('class_code', $request->class_code)->first();
        if ($temp != null) {
            $student = User::insertGetId(
            array(
                'username' => $request->get('code'),
                'code' => $request->get('code'),
                'course' => $request->get('course'),
                'name' => $request->get('name'),
                'password' => Hash::make($request->get('password')),
                'nation' => $request->get('nation'),
                'tel' => $request->get('tel'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
                'birth' => $request->get('birth'),
                'gender' => $request->get('gender'),
                'family_tel' => $request->get('family_tel'),
                'family_address' => $request->get('family_address'),
                'status_id' => 1,
            ));

            ClassUser::insert([
            'user_id' => $student,
            'class_id' => $temp->class_id,
            'class_user_accountability' => 'sinh viên',
        ]);
            RoleUser::insert([
            'user_id' => $student,
            'role_id' => 4,
        ]);
            StatusUser::insert([
            'status_id' => 1,
            'user_id' => $student,
            'status_users_reason' => '',
        ]);

            return redirect('students')->with('success', 'Added Data Successfully');
        } else {
            return redirect('students/create')->with('error', 'Không tìm thấy lớp');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::with('statuses')->find($user_id);

        $classuser = ClassUser::where('user_id', $user->user_id)->first();
        $class = Classes::where('class_id', $classuser->class_id)->first();
        $majorbranch = MajorBranch::where('major_branch_id', $class->major_branch_id)->first();
        $major = Major::where('major_id', $class->major_id)->first();
        $academy = Academy::where('academy_id', $major->academy_id)->first();

        // dd($major);
        // $birthday = $user->birth->isoFormat('dd/mm/YYYY');
        // $ward = Ward::where('ward_id', $user->ward)->first();
        // $district = District::where('district_id', $ward->district_id)->first();
        // $city = City::where('city_id', $ward->city_id)->first();
        return view('pages.admins.students.show',
        ['user' => $user, 'class' => $class, 'majorbranch' => $majorbranch, 'major' => $major, 'academy' => $academy]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $classuser = ClassUser::where('user_id', $user->user_id)->first();
        $class = Classes::where('class_id', $classuser->class_id)->first();
        $majorbranch = MajorBranch::where('major_branch_id', $class->major_branch_id)->first();
        $major = Major::where('major_id', $class->major_id)->first();
        $academy = Academy::where('academy_id', $major->academy_id)->first();

        return view('pages.admins.students.edit', compact('user', 'user_id'), ['user' => $user, 'class' => $class, 'majorbranch' => $majorbranch, 'major' => $major, 'academy' => $academy]);
        //,['students' => $students]
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'tel' => 'required',
            'email' => 'required',
            'address' => 'required',
            'family_tel' => 'required',
            'family_address' => 'required',
        ]);
        $user = User::find($user_id);
        //TODO:  Nhan du lieu tu form cu
        $user->tel = $request->get('tel');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->family_tel = $request->get('family_tel');
        $user->family_address = $request->get('family_address');
        $user->save();

        return redirect('students')->with('success', 'Updated Data Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $student = User::findOrFail($user_id);
        $student->delete();

        return redirect('students')->with('success', 'Deleted Successfully!');
    }

    // TODO LIVE SEARCH STUDENT AJAX
    public function live_search_student(Request $request)
    {
        if (request()->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = User::with('classes')
                    ->where('username', 'like', '%'.$query.'%')
                    ->orWhere('course', 'like', '%'.$query.'%')
                    ->orWhere('name', 'like', '%'.$query.'%')
                    ->orWhere('nation', 'like', '%'.$query.'%')
                    ->orWhere('tel', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhere('gender', 'like', '%'.$query.'%')
                    ->orWhere('birth', 'like', '%'.$query.'%')
                    ->orWhere('address', 'like', '%'.$query.'%')
                    ->orWhere('family_tel', 'like', '%'.$query.'%')
                    ->orWhere('family_address', 'like', '%'.$query.'%')
                    ->orWhere('status_id', 'like', '%'.$query.'%')
                    ->orderBy('user_id', 'desc')
                    ->get();
            } else {
                $data = User::with('classes')->orderBy('user_id', 'desc')->get();
            }
            $total_row = $data->count();

            if ($total_row > 0) {
                foreach ($data as $row) {
                    $classes_output = '';
                    foreach ($row->classes as $class) {
                        $classes_output .= '
                            <td>'.$class->class_code.'</td>
                            <td>'.$class->class_name.'</td>
                        ';
                    }
                    $output .= '
                        <tr>
                            <td>'.$row->username.'</td>
                            <td>'.$row->name.'</td>
                            <td>'.$row->tel.'</td>
                            <td>'.$row->email.'</td>
                            '.$classes_output.'
                            <td>      
                                <form action="'.route('students.destroy', $row->user_id).'" method="post" class="delete_form">
                                            
                                    <a href="'.route('students.show', $row->user_id).'" data-toggle="tooltip"  data-original-title="Show"><i class="icon-user"></i></a>
                                    <a href="'.route('students.edit', $row->user_id).'" data-toggle="tooltip"  data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>
                                    <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    ';
                }
            } else {
                $output .= '
                    <tr>
                        <td align"center" colspan="5">No Data Found</td>
                    </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row,
            );
            echo json_encode($data);
        }
    }
}
