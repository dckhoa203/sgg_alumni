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
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Thống kê theo khảo sát</h3>
                    <br>
                    {{-- <a href="{{route('city/create')}}" class="btn btn-success waves-effect waves-light m-r-10">Add</a>
                    <br> --}}
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Phiên bản</th>
                                    <th>Tên khảo sát</th>
                                    <th>Người tạo</th>
                                    <th>Mã người tạo</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->survey_version}}</td>
                                        <td>{{$item['survey_name']}}</td>
                                        <td>{{$item->users['name']}}</td>
                                        <td>{{$item->users['username']}}</td>
                                        <td>{{$item['survey_start']}}</td>
                                        <td>{{$item['survey_end']}}</td>
                                        <td>
                                            <form action="{{ route('statistic.show_statistic_surveys', $item->survey_id) }}" method="post" class="statistic_form">
                                                <a href="{{ action('Master\SurveyController@view_survey_answers',$item->survey_id) }}"data-toggle="tooltip" data-placement="top" title="Xem câu trả lời"><i style="font-size:17px" class="far fa-clipboard  fa-lg"></i></a>
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-placement="top" title="Thống kê"><i style="font-size:17px" class="far fa-chart-bar fa-lg"></i></button>

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
    {{-- end div white-box --}}
    </div>
    {{-- end div container-fluid --}}
</div>
{{-- end div page-wrapper --}}

@endsection
@section('script')
<script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    $(function () 
        $('[data-toggle="tooltip"]').tooltip();
    )
</script>
@endsection