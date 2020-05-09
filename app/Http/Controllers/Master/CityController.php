<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;

class CityController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một thành phố - tỉnh ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new City(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);
        return view("pages.admins.city.index", ["data" => $data]);
    }

    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        return view("pages.admins.city.create");
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new City(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('city')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa
    public function edit($city_id) {   
        $city = City::findOrFail($city_id);
        return view('pages.admins.city.edit',compact('city','city_id'));
        
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request,$city_id) {
        $city = City::find($city_id);
        //TODO:  Nhan du lieu tu form
        $city->city_name = $request->get('city_name');
        $city->save();
        return redirect('city')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo city_id
    public function destroy($city_id) {
        $data = City::findOrFail($city_id);
        $data->delete();
        return redirect('city')->with('success','Deleted Successfully!');
    }
}
