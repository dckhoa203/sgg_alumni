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
                    <h3 class="box-title">City Table</h3>
                    <br>
                    <a href="{{route('city/create')}}" class="btn btn-success waves-effect waves-light m-r-10">Add</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>City ID:</th>
                                    <th>City Name:</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item['city_id']}}</td>
                                        <td>{{$item['city_name']}}</td>
                                        <td>
                                            <form action="{{ route('city/destroy', $item->city_id) }}" method="post" class="delete_form">
                                                <a href="{{ action('Master\CityController@edit',$item->city_id) }}" class="btn btn-warning">Edit</a>
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