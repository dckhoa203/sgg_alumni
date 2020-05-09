@extends('layouts.admin')

@section('content')
<div class="row">
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
        <p>{{$message}}</p>
        <p class="mb-0"></p>
        </div>
    @endif
    <div class="white-box m-auto">
        <form action="{{action('Master\MajorBranchController@update',$major_branch_id)}}" method="POST">
            @csrf
            <fieldset class="form-group row">
                <label for="major_code" class="col-sm-1-12 col-form-label">Mã ngành:</label>
                <select name="major_id" class="form-control pull-right">
                    @foreach($nganh as $n)
                    <option value="{{$n->major_id}}" @if($n->major_id == $major_branch->major_id) selected @endif>{{$n->major_name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="form-group row">
                <label for="major_branch_name" class="col-sm-1-12 col-form-label">Tên chuyên ngành:</label>
                    <input type="text" class="form-control" name="major_branch_name" id="major_branch_name" placeholder="" value="{{$major_branch->major_branch_name}}">
            </fieldset>
            <div class="form-group">
                <button style="width:80px" type="submit" class="btn btn-success">Lưu</button>
                <a style="width:80px" href="{{route('major_branch/index')}}" class="btn btn-default">Trở lại</a>
            </div>{{-- end div form-group --}}
        </form>
    </div>{{-- end div white-box --}}
</div>{{-- end div row --}}
@endsection