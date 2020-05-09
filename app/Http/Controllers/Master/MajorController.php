<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Academy;

class MajorController extends Controller
{
    // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một Ngành ra trang index
    public function index(Request $request)
    {
        $academy_name = Academy::all();
        $config = [
            'model' => new Major(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);

        return view('pages.admins.major.index', ['data' => $data], ['academy_name' => $academy_name]);
    }

    // TODO: Mỗi function chỉ thực hiện 1 nhiệm vụ. Cho người khác dễ sửa chửa code của mình.
    // Hàm chỉ thực hiện đỗ ra trang Thêm
    public function create_render(Request $request)
    {
        $khoa = Academy::all();

        return view('pages.admins.major.create', ['khoa' => $khoa]);
    }

    // Hàm chỉ thực hiện chức năng Thêm thông qua Method = POST
    public function create_submit(Request $request)
    {
        $this->validate($request, [
            'major_code' => 'required',
            'major_name' => 'required',
            'major_description' => 'required',
        ]);
        $config = [
            'model' => new Major(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        // dd($data);
        return redirect('major')->with('success', 'Added Successfully');
    }

    public function edit($major_id)
    {
        $khoa = Academy::all();
        $major = Major::findOrFail($major_id);

        return view('pages.admins.major.edit', compact('major', 'major_id'), compact('khoa'));
    }

    public function update(Request $request, $major_id)
    {
        $major = Major::find($major_id);
        //TODO:  Nhan du lieu tu form cu
        $major->academy_id = $request->get('academy_id');
        $major->major_code = $request->get('major_code');
        $major->major_name = $request->get('major_name');
        $major->major_description = $request->get('major_description');
        $major->save();
        // dd($major);
        return redirect('major')->with('success', 'Updated Successfully');
    }

    public function destroy($major_id)
    {
        $data = Major::findOrFail($major_id);
        $data->delete();
        // dd($data);
        return redirect('major')->with('success', 'Deleted Successfully!');
    }
}
