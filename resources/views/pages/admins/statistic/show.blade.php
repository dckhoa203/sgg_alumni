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
                <h3 class="box-title">Bảng thống kê theo câu hỏi </h3>
                    <br>
                    <form action="{{ action('Master\StatisticController@export') }}" method="POST">
                        @csrf
                        <input type="hidden" name="data" value="{{$data_json}}">

                        <button type="submit" class="btn btn-success">Export</button>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Câu trả lời</th>
                                    <th>Tổng số</th>
                                    <th>Tỷ lệ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td>{{$value['label']}}</td>
                                        <td>{{$value['total']}}</td>
                                        <td>{{$value['ratio']}}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div>
                        <center>
                            {!! $chart->render() !!}
                        </center>
                    </div> --}}
                </div>
            </div>
            {{-- end div col-sm-6 --}}
        </div> 
        {{-- end div row --}}
    </div>
    {{-- end div container-fluid --}}
</div>
{{-- end div page-wrapper --}}
{{-- {!! Charts::assets() !!} --}}
@endsection
