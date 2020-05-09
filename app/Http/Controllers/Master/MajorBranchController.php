<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\MajorBranch;

class MajorBranchController extends Controller
{
    // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một Chuyên Ngành ra trang index
    public function index(Request $request)
    {
        $major_name = Major::all();
        $config = [
            'model' => new MajorBranch(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);

        return view('pages.admins.major_branch.index', ['data' => $data], ['major_name' => $major_name]);
    }

    // TODO: Mỗi function chỉ thực hiện 1 nhiệm vụ. Cho người khác dễ sửa chửa code của mình.
    // Hàm chỉ thực hiện đỗ ra trang Thêm
    public function create_render(Request $request)
    {
        $nganh = Major::all();

        return view('pages.admins.major_branch.create', ['nganh' => $nganh]);
    }

    // Hàm chỉ thực hiện chức năng Thêm thông qua Method = POST
    public function create_submit(Request $request)
    {
        $this->validate($request, [
            'major_branch_name' => 'required',
        ]);
        $config = [
            'model' => new MajorBranch(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        // dd($data);
        return redirect('major_branch')->with('success', 'Added Successfully');
    }

    public function edit($major_branch_id)
    {
        $nganh = Major::all();
        $major_branch = MajorBranch::findOrFail($major_branch_id);

        return view('pages.admins.major_branch.edit', compact('major_branch', 'major_branch_id'), compact('nganh'));
    }

    public function update(Request $request, $major_branch_id)
    {
        $this->validate($request, [
            'major_branch_name' => 'required',
        ]);
        $major_branch = MajorBranch::find($major_branch_id);
        //TODO:  Nhan du lieu tu form cu
        $major_branch->major_id = $request->get('major_id');
        $major_branch->major_branch_name = $request->get('major_branch_name');
        $major_branch->save();
        // dd($major_branch);
        return redirect('major_branch')->with('success', 'Updated Successfully');
    }

    public function destroy($major_branch_id)
    {
        $data = MajorBranch::findOrFail($major_branch_id);
        $data->delete();
        // dd($data);
        return redirect('major_branch')->with('success', 'Deleted Successfully!');
    }
}
