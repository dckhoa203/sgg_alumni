<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;

class CompanyController extends Controller
{
    // Hàm khởi tạo.
    public function __construct() {
        parent::__construct();
    }

    // Hàm đỗ dữ liệu của một công ty ra trang index
    public function index(Request $request) {
        $config = [
            "model" => new Company(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_index($this->request);
        return view("pages.admins.company.index", ["data" => $data]);
    }

    // Hàm thực hiện đỗ ra trang thêm
    public function create_render(Request $request) {
        $city = City::all();
        $district = District::all();
        $ward =  Ward::all();
        return view("pages.admins.company.create", ['city' => $city, 'district' => $district, 'ward' =>$ward]);
    }

    // Hàm thực hiện chức năng thêm thông qua method = post
    public function create_submit(Request $request) {
        $config = [
            "model" => new Company(),
            'request' => $request
        ];
        $this->config($config);
        $data = $this->model->web_insert($this->request);
        return redirect('company')->with('success','Added Successfully');
    }

    // Hàm thực hiện đỗ ra trang sửa 
    public function edit($company_id) {
        $city = City::all();
        $district = District::all();
        $ward = Ward::all();   
        $company = Company::findOrFail($company_id);
        return view('pages.admins.company.edit', compact('company','company_id', 'city', 'district', 'ward'));
    }

    // Hàm thực hiện chức năng sửa thông qua method = post
    public function update(Request $request, $company_id) {
        $company = Company::find($company_id);
        //TODO:  Nhan du lieu tu form
        $company->company_name = $request->get('company_name');
        $company->company_address = $request->get('company_address');
        $company->company_email = $request->get('company_email');
        $company->company_tel = $request->get('company_tel');
        $company->company_website = $request->get('company_website');
        $company->ward_id = $request->get('ward_id');
        $company->save();
        return redirect('company')->with('success','Updated Successfully');
    }

    // Hàm thực hiện chức năng xóa theo company_id
    public function destroy($company_id) {
        $data = Company::findOrFail($company_id);
        $data->delete();
        return redirect('company')->with('success','Deleted Successfully!');
    }

    // ajax lấy districts thông qua city_id
    public function getDistrict($city_id) {
        $district = District::where('city_id', $city_id)->get();
        echo "<option value='' selected>Chọn quận, huyện</option>";
        foreach($district as $item) {
            echo "<option value='".$item->district_id."'>".$item->district_name."</option>";
        }
    }

    // ajax lấy wards thông qua district_id
    public function getWard($district_id) {
        $ward = Ward::where('district_id', $district_id)->get();
        foreach($ward as $item) {
            echo "<option value='".$item->ward_id."'>".$item->ward_name."</option>";
        }
    }
}
