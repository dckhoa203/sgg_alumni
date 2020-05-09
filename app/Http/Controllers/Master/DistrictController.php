<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\City;

class DistrictController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một quận-huyện ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new District(),
            'request' => $request,
        ];
        $this->config($config); 
        $data = $this->model->web_index($this->request);
        return view("pages.admins.district.index", ["data" => $data]);
    }

    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        $city = City::all();
        return view("pages.admins.district.create", ['city' => $city]);
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new District(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('district')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa 
    public function edit($district_id) {
        $city = City::all();   
        $district = District::findOrFail($district_id);
        return view('pages.admins.district.edit',compact('district','district_id', 'city'));
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request, $district_id) {
        $district = District::find($district_id);
        //TODO:  Nhan du lieu tu form
        $district->district_name = $request->get('district_name');
        $district->city_id = $request->get('city_id');
        $district->save();
        return redirect('district')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo district_id
    public function destroy($district_id) {
        $data = District::findOrFail($district_id);
        $data->delete();
        return redirect('district')->with('success','Deleted Successfully!');
    }
}
