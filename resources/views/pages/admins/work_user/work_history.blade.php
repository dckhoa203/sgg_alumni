@extends('layouts.admin')
@section('content')
<div id="page-wrapper">
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            <p>{{$message}}</p>
            <p class="mb-0"></p>
        </div>
        @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                    <h3 class="box-title">Work History Table of user {{$user->code}}</h3>
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Work_user ID:</th>
                                    <th>Company Name:</th>
                                    <th>Work Name:</th>
                                    <th>Thời gian bắt đầu:</th>
                                    <th>Lương:</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item['work_user_id']}}</td>
                                        <td>{{$item->work->Company['company_name']}}</td>
                                        <td>{{$item->work['work_name']}}</td>
                                        <td>{{$item['work_user_begin']}}</td>
                                        <td>{{$item['work_user_salary']}}</td>
                                        <td>
                                            <form action="{{ route('work_user/destroy', $item->work_user_id) }}" method="post" class="delete_form">
                                                <a href="{{ action('Master\WorkUserController@edit',$item->work_user_id) }}" class="btn btn-warning">Edit</a>
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            {{-- end div col-sm-6 --}}
        </div> 
        {{-- end div row --}}
    </div>
    {{-- end div container-fluid --}}
</div>
{{-- end div page-wrapper --}}

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.delete_form').on('submit',function(){
            if(confirm('Are you sure delete id??'))
            {
                return true;
            }
            else
            {
                return false;
            }
        });
    });
</script>
@endsection