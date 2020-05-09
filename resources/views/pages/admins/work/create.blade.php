@extends('layouts.admin')
@section('content')
    <div class="row">
    <form action="{{route('work/create/submit')}}" method="post">
        @csrf
            <div class="form-group row">
                <label for="work_name" class="col-sm-1-12 col-form-label">Tên công việc:</label>
                    <input type="text" class="form-control" name="work_name" id="work_name" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="work_position" class="col-sm-1-12 col-form-label">Vị trí làm việc:</label>
                    <input type="text" class="form-control" name="work_position" id="work_position" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="work_note" class="col-sm-1-12 col-form-label">Ghi chú:</label>
                    <input type="text" class="form-control" name="work_note" id="work_note" placeholder="" value="">
            </div>
            <div class="form-group row">
                <label for="company" class="col-sm-1-12 col-form-label">Tên công ty:</label>
                    <select name="company_id" class="form-control pull-right" id="company">
                        <option value="" selected>Chọn công ty</option>
                        @foreach($company as $item)
                        <option value="{{$item->company_id}}">{{$item->company_name}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('company/index')}}" class="btn btn-default">Back</a>
            </div>
        </form>
    </div>
@endsection
