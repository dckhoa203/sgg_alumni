<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;

class WardController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một phường-xã ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new Ward(),
            'request' => $request
        ];
        $district = District::all();
        $this->config($config);
        $data = $this->model->web_index($this->request);
        return view("pages.admins.ward.index", ["data" => $data, 'district' => $district]);
    }

    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        $city = City::all();
        $district = District::all();
        return view("pages.admins.ward.create", ['district' => $district, 'city' =>$city]);
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new Ward(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('ward')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa 
    public function edit($ward_id) {
        $city = City::all();
        $district = District::all();   
        $ward = Ward::findOrFail($ward_id);
        return view('pages.admins.ward.edit',compact('ward','ward_id', 'district', 'city'));
        
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request, $ward_id) {
        $ward = Ward::find($ward_id);
        //TODO:  Nhan du lieu tu form
        $ward->ward_name = $request->get('ward_name');
        $ward->district_id = $request->get('district_id');
        $ward->save();
        return redirect('ward')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo district_id
    public function destroy($ward_id) {
        $data = Ward::findOrFail($ward_id);
        $data->delete();
        return redirect('ward')->with('success','Deleted Successfully!');
    }

    // ajax lấy district thông qua city_id đổ ra trang thêm
    public function getDistrict($city_id) {
        $district = District::where('city_id', $city_id)->get();
        foreach($district as $item) {
            echo "<option value='".$item->district_id."'>".$item->district_name."</option>";
        }
    }
}
?>