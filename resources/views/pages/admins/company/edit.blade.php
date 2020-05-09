@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\CompanyController@update',$company_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="company_name" class="col-sm-1-12 col-form-label">Tên công ty:</label>
        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="" value="{{$company->company_name}}">
        </div>
        <div class="form-group row">
            <label for="company_address" class="col-sm-1-12 col-form-label">Địa chỉ công ty:</label>
        <input type="text" class="form-control" name="company_address" id="company_address" placeholder="" value="{{$company->company_address}}">
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                <select name="city_id" class="form-control pull-right" id="city">
                    @foreach($city as $item)
                    <option value="{{$item->city_id}} @if($item->city_id == $company->ward->district->city_id) selected @endif">{{$item->city_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="district_id" class="col-sm-1-12 col-form-label">Tên huyện:</label>
                <select name="district_id" class="form-control pull-right" id="district">
                    @foreach($district as $item)
                    <option value="{{$item->district_id}} @if($item->district_id == $company->ward->district_id) selected @endif">{{$item->district_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="ward" class="control-label">Tên xã:</label>
                <select name="ward_id" class="form-control" id="ward">
                    @foreach($ward as $item)
                        <option value="{{$item->ward_id}}" @if($item->ward_id == $company->ward->ward_id) selected @endif>{{$item->ward_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="company_email" class="col-sm-1-12 col-form-label">Email:</label>
        <input type="text" class="form-control" name="company_email" id="company_email" placeholder="" value="{{$company->company_email}}">
        </div>
        <div class="form-group row">
            <label for="company_tel" class="col-sm-1-12 col-form-label">Số điện thoại:</label>
        <input type="text" class="form-control" name="company_tel" id="company_tel" placeholder="" value="{{$company->company_tel}}">
        </div>
        <div class="form-group row">
            <label for="company_website" class="col-sm-1-12 col-form-label">website:</label>
        <input type="text" class="form-control" name="company_website" id="company_website" placeholder="" value="{{$company->company_website}}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('company/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            // Ajax city xổ ra districts
            $("#city").change(function(){
                var city_id = $(this).val();
                $.get("../../company/district/"+city_id, function(data){
                    $("#district").html(data);
                });
            });

            //district xổ ra wards
            $("#district").change(function(){
                var district_id = $(this).val();
                $.get("../../company/ward/"+district_id, function(data){
                    $("#ward").html(data);
                });
            });
        });
    </script>
@endsection