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
                    <h3 class="box-title">Statistic Table</h3>
                    <br>
                    {{-- <a href="{{route('city/create')}}" class="btn btn-success waves-effect waves-light m-r-10">Add</a>
                    <br> --}}
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Survey ID:</th>
                                    <th>Survey Name</th>
                                    <th>User ID:</th>
                                    <th>Survey Start</th>
                                    <th>Survey End</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item['survey_id']}}</td>
                                        <td>{{$item['survey_name']}}</td>
                                        <td>{{$item['user_id']}}</td>
                                        <td>{{$item['survey_start']}}</td>
                                        <td>{{$item['survey_end']}}</td>
                                        <td>
                                            <form action="{{ route('statistic.show_statistics', $item->survey_id) }}" method="post" class="statistic_form">
                                                <a href="{{ action('Master\SurveyController@view_survey_answers',$item->survey_id) }}" class="btn btn-warning">Show</a>
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Statistic</button>
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