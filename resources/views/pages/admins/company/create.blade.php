@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('company/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="company_name" class="col-sm-1-12 col-form-label">Tên công ty:</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="company_address" class="col-sm-1-12 col-form-label">Địa chỉ công ty:</label>
                    <input type="text" class="form-control" name="company_address" id="company_address" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-1-12 col-form-label">Tên tỉnh:</label>
                    <select name="city_id" class="form-control pull-right" id="city">
                        <option value="" selected>Chọn tỉnh</option>
                        @foreach($city as $item)
                        <option value="{{$item->city_id}}">{{$item->city_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group row">
                <label for="district_id" class="col-sm-1-12 col-form-label">Tên huyện:</label>
                    <select name="district_id" class="form-control pull-right" id="district">
                        <option value="" selected>Chọn quận, huyện</option>
                    </select>
            </div>
            <div class="form-group row">
                <label for="ward" class="control-label">Tên xã:</label>
                    <select name="ward_id" class="form-control" id="ward">
                        <option value="" selected>Chọn phường, xã</option>
                    </select>
            </div>
            <div class="form-group row">
                <label for="company_email" class="col-sm-1-12 col-form-label">Email:</label>
                    <input type="text" class="form-control" name="company_email" id="company_email" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="company_tel" class="col-sm-1-12 col-form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" name="company_tel" id="company_tel" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="company_website" class="col-sm-1-12 col-form-label">website:</label>
                    <input type="text" class="form-control" name="company_website" id="company_website" placeholder="" value="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
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
                $.get("../company/district/"+city_id, function(data){
                    $("#district").html(data);
                });
            });

            // Ajax district xổ ra wards
            $("#district").change(function(){
                var district_id = $(this).val();
                $.get("../company/ward/"+district_id, function(data){
                    $("#ward").html(data);
                });
            });
        });
    </script>
@endsection