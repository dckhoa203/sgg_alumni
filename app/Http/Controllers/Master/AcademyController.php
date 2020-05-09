<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academy;

class AcademyController extends Controller
{
    // Hàm khởi tạo.
    public function __construct()
    {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một Khoa ra trang index
    public function index(Request $request)
    {
        $config = [
            'model' => new Academy(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);

        return view('pages.admins.academy.index', ['data' => $data]);
    }

    // TODO: Mỗi function chỉ thực hiện 1 nhiệm vụ. Cho người khác dễ sửa chửa code của mình.
    // Hàm chỉ thực hiện đỗ ra trang Thêm
    public function create_render(Request $request)
    {
        return view('pages.admins.academy.create');
    }

    // Hàm chỉ thực hiện chức năng Thêm thông qua Method = POST
    public function create_submit(Request $request)
    {
        $this->validate($request, [
            'academy_code' => 'required',
            'academy_name' => 'required',
            'academy_description' => 'required',
        ]);
        $config = [
            'model' => new Academy(),
            'request' => $request,
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        // dd($data);
        return redirect('khoa-vien')->with('success', 'Added Successfully');
    }

    public function edit($academy_id)
    {
        $academy = Academy::findOrFail($academy_id);

        return view('pages.admins.academy.edit', compact('academy', 'academy_id'));
    }

    public function update(Request $request, $academy_id)
    {
        $academy = Academy::find($academy_id);
        //TODO:  Nhan du lieu tu form cu
        $academy->academy_code = $request->get('academy_code');
        $academy->academy_name = $request->get('academy_name');
        $academy->academy_description = $request->get('academy_description');
        $academy->save();
        // dd($academy);
        return redirect('khoa-vien')->with('success', 'Updated Successfully');
    }

    public function destroy($academy_id)
    {
        $data = Academy::findOrFail($academy_id);
        $data->delete();
        // dd($data);
        return redirect('khoa-vien')->with('success', 'Deleted Successfully!');
    }
}
