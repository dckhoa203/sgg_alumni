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
                    <h3 class="box-title">Company Table</h3>
                    <br>
                    <a href="{{route('company/create')}}" class="btn btn-success waves-effect waves-light m-r-10">Add</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table color-table primary-table">
                            <thead>
                                <tr>
                                    <th>Company ID:</th>
                                    <th>Company Name:</th>
                                    <th>Company Address:</th>
                                    <th>City Name:</th>
                                    <th>District Name:</th>
                                    <th>Ward Name:</th>
                                    <th>Company Email:</th>
                                    <th>Company Tel:</th>
                                    <th>Company Website:</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item['company_id']}}</td>
                                        <td>{{$item['company_name']}}</td>
                                        <td>{{$item['company_address']}}</td>
                                        <td>{{$item->ward->district->city->city_name}}</td>
                                        <td>{{$item->ward->district->district_name}}</td>
                                        <td>{{$item->ward->ward_name}}</td>
                                        <td>{{$item['company_email']}}</td>
                                        <td>{{$item['company_tel']}}</td>
                                        <td>{{$item['company_website']}}</td>
                                        <td>
                                            <form action="{{ route('company/destroy', $item->company_id) }}" method="post" class="delete_form">
                                                <a href="{{ action('Master\CompanyController@edit',$item->company_id) }}" class="btn btn-warning">Edit</a>
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