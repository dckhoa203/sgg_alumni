<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Company;

class WorkController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một quận-huyện ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new Work(),
            'request' => $request,
        ];
        $this->config($config); 
        $data = $this->model->web_index($this->request);
        return view("pages.admins.work.index", ["data" => $data]);
    }

    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        $company = Company::all();
        return view("pages.admins.work.create", ['company' => $company]);
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new Work(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('work')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa 
    public function edit($work_id) {
        $company = Company::all();   
        $work = Work::findOrFail($work_id);
        return view('pages.admins.work.edit',compact('work','work_id', 'company'));
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request, $work_id) {
        $work = Work::find($work_id);
        //TODO:  Nhan du lieu tu form
        $work->work_name = $request->get('work_name');
        $work->work_position = $request->get('work_position');
        $work->work_note = $request->get('work_note');
        $work->company_id = $request->get('company_id');
        $work->save();
        return redirect('work')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo district_id
    public function destroy($work_id) {
        $data = Work::findOrFail($work_id);
        $data->delete();
        return redirect('work')->with('success','Deleted Successfully!');
    }
}
