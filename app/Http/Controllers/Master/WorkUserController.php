<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkUser;

class WorkUserController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một công việc của một user ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new WorkUser(),
            'request' => $request,
        ];
        $this->config($config); 
        $data = $this->model->web_index($this->request);
        return view("pages.admins.work_user.index", ["data" => $data]);
    }

    // Lịch sử công việc của 1 user
    public function work_history($user_id) {
        $user = User::find($user_id);  
        $data = WorkUser::all()->where('user_id', $user_id);
        return view('pages.admins.work_user.work_history', ['data' => $data, 'user' => $user]);
    }
    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        $user = User::all();
        $work = Work::all();
        return view("pages.admins.work_user.create", ['user' => $user, 'work' => $work]);
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new WorkUser(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('work_user')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa 
    public function edit($work_user_id) {
        $user = User::all();
        $work = Work::all();
        $work_user = WorkUser::findOrFail($work_user_id);
        return view('pages.admins.work_user.edit',compact('work_user','work_user_id', 'user', 'work'));
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request, $work_user_id) {
        $work_user = WorkUser::find($work_user_id);
        //TODO:  Nhan du lieu tu form
        $work_user->work_id = $request->get('work_id');
        $work_user->user_id = $request->get('user_id');
        $work_user->work_user_salary = $request->get('work_user_salary');
        $work_user->work_user_begin = $request->get('work_user_begin');
        $work_user->save();
        return redirect('work_user')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo district_id
    public function destroy($work_user_id) {
        $data = WorkUser::findOrFail($work_user_id);
        $data->delete();
        return redirect('work_user')->with('success','Deleted Successfully!');
    }
}
