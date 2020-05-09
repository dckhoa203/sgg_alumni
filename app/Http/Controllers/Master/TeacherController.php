<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\Status;
use App\Models\StatusUser;
use DB;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
        // $teacher = DB::select(DB::raw("
        // SELECT * from users where NOT EXISTS
        // (SELECT user_id FROM class_users where class_users.user_id=users.user_id and class_users.class_user_accountability='sinh viên')"
        // ));
        $teacher = User::join('role_users', 'role_users.user_id', 'users.user_id')
        ->where('role_users.role_id', 2)->get();
        // dd($teacher);

        // $teacher = User::join('class_users', 'users.user_id', 'class_users.user_id')
        // ->where('class_users.class_user_accountability', 'cố vấn')
        // ->orWhere('')
        // ->get();

        return view('pages.admins.teacher.index', compact('teacher'));
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
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    //Chưa xong, để hỏi lại cô
    public function import(Request $request)
    {
        // Excel::import(new UsersImport(), $request->file('file'));
        $users = Excel::toArray(new UsersImport(), $request->file('file'));
        // dd($users);
        foreach ($users[0] as $user) {
            // if()
            $userid = User::insertGetId(
                array(
                'username' => $user['Mã giáo viên'],
                'name' => $user['Họ và Tên'],
                'password' => Hash::make($user['Mật khẩu']),
                'nation' => $user['Dân tộc'],
                'tel' => $user['SĐT'],
                'email' => $user['Email'],
                'address' => $user['Địa chỉ'],
                'birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user['Ngày sinh']),
                'gender' => $user['Giới tính'],
                'status_id' => 3,
                // 'ward_id' => $user['Mã phường xã'],
            ));

            $temp1 = Classes::where('class_code', $user['Mã lớp'])->first();
            $temp3 = Status::where('status_id', $user['Mã trạng thái'])->first();
            // dd($temp1);
            ClassUser::insert([
                'user_id' => $userid,
                'class_id' => $temp1->class_id,
                'class_user_accountability' => 'sinh viên',
            ]);
            StatusUser::insert([
                'user_id' => $temp1->user_id,
                'status_id' => $temp3->status_id,
                'status_users_reason' => '',
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
        return view('pages.admins.teacher.create');
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
            'nation' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birth' => 'required',
            'gender' => 'required',
       ]);
        $teacher = DB::table('users')->insertGetId(
            array(
            'username' => $request->get('code'),
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'nation' => $request->get('nation'),
            'tel' => $request->get('tel'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'birth' => $request->get('birth'),
            'gender' => $request->get('gender'),
            'status_id' => 3,
        ));
        //Tạo role cho giáo viên
        DB::table('role_users')->insert([
            'user_id' => $teacher,
            'role_id' => 2,
        ]);

        return redirect('teacher')->with('success', 'Added Data Successfully');
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
        $find = ClassUser::find($user_id);
        if ($find != null) {
            $teacher = User::join('class_users', 'users.user_id', 'class_users.user_id')
        ->join('classes', 'class_users.class_id', 'classes.class_id')
        ->where('users.user_id', $user_id)->get();
        } else {
            $teacher = User::where('user_id', $user_id)->get();
        }

        // dd($teacher[0]->classes);

        return view('pages.admins.teacher.show', ['teacher' => $teacher[0]]);
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
        $teacher = User::findOrFail($user_id);

        return view('pages.admins.teacher.edit', compact('teacher', 'user_id'));
        //,['teacher' => $teacher]
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
            'code' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'birth' => 'required',
            'nation' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $teacher = User::find($user_id);
        //TODO:  Nhan du lieu tu form cu
        $teacher->username = $request->get('code');
        $teacher->name = $request->get('name');
        $teacher->gender = $request->get('gender');
        $teacher->birth = $request->get('birth');
        $teacher->nation = $request->get('nation');
        $teacher->tel = $request->get('tel');
        $teacher->email = $request->get('email');
        $teacher->address = $request->get('address');
        $teacher->save();

        return redirect('teacher')->with('success', 'Updated Data Successfully');
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
        $teacher = User::findOrFail($user_id);
        $teacher->delete();

        return redirect('teacher')->with('success', 'Deleted Successfully!');
    }

    // TODO LIVE SEARCH teacher AJAX
    public function live_search_teacher(Request $request)
    {
        if (request()->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = User::with('classes')
                    ->where('username', 'like', '%'.$query.'%')
                    ->orWhere('name', 'like', '%'.$query.'%')
                    ->orWhere('nation', 'like', '%'.$query.'%')
                    ->orWhere('tel', 'like', '%'.$query.'%')
                    ->orWhere('email', 'like', '%'.$query.'%')
                    ->orWhere('gender', 'like', '%'.$query.'%')
                    ->orWhere('birth', 'like', '%'.$query.'%')
                    ->orWhere('address', 'like', '%'.$query.'%')
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
                                <form action="'.route('teacher.destroy', $row->user_id).'" method="post" class="delete_form">
                                            
                                    <a href="'.route('teacher.show', $row->user_id).'" data-toggle="tooltip"  data-original-title="Show"><i class="icon-user"></i></a>
                                    <a href="'.route('teacher.edit', $row->user_id).'" data-toggle="tooltip"  data-original-title="Edit"><i class="fa fa-pencil text-inverse m-r-10"></i></a>
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
