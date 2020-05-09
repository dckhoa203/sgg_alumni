@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <form action="{{action('Master\WorkController@update',$work_id)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="work_name" class="col-sm-1-12 col-form-label">Tên công việc:</label>
        <input type="text" class="form-control" name="work_name" id="work_name" placeholder="" value="{{$work->work_name}}">
        </div>
        <div class="form-group row">
            <label for="work_position" class="col-sm-1-12 col-form-label">Vị trí làm việc:</label>
                <input type="text" class="form-control" name="work_position" id="work_position" placeholder="" value="{{$work->work_position}}">
        </div>
        <div class="form-group row">
            <label for="work_note" class="col-sm-1-12 col-form-label">Ghi chú:</label>
                <input type="text" class="form-control" name="work_note" id="work_note" placeholder="" value="{{$work->work_note}}">
        </div>
        <div class="form-group row">
            <label for="company" class="col-sm-1-12 col-form-label">Tên công ty:</label>
                <select name="company_id" class="form-control pull-right" id="company">
                    @foreach($company as $item)
                    <option value="{{$item->company_id}}" @if($item->company_id == $work->company_id) selected @endif>{{$item->company_name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('work/index')}}" class="btn btn-default">Back</a>
        </div>
    </form>
</div>
@endsection