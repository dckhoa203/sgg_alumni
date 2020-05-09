@extends('layouts.admin')

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="white-box">
                @if($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <p>{{$message}}</p>
                        <p class="mb-0"></p>
                    </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Upload Validation Error
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="white-box">
               
                    <div class="col-lg-3 col-sm-3 col-xs-12 m-t-40">
                        <h3 class="box-title">Danh sách file tốt nghiệp đã import</h3>
                        <ul class="list-icons">
                            @foreach ($phase as $row)
                                <li><i class="fa fa-caret-right text-info"></i> 
                                    <a href="{{url('imports/show_file_import/'.$row->register_graduate_phase.'/'.date('Y', strtotime($row->register_graduate_date)))}}">
                                        ĐỢT: {{$row['register_graduate_phase']}} 
                                        - NGÀY KÝ: {{date('d-m-Y', strtotime($row->register_graduate_date))}}
                                    </a> <br>
                                </li>
                            @endforeach
                    </ul>
                    </div>
                
            </div>
        </div>
        <div class="col-sm-6 ol-md-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">IMPORT DANH SÁCH SINH VIÊN</h3>
                <form name="import_student" action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return ImportStudent()">
                    @csrf
                    <label for="file">Import danh sách sinh viên</label>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-warning">Import</button>
                        <span class="text-muted">.xlsx, .csv, .xls</span>
                </form>
            </div>
        </div>
        {{-- <div class="col-sm-6 ol-md-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">File Upload DANH SÁCH CỰU SINH VIÊN</h3>
                <form name="import_alumnies" action="{{ route('alumnies/import') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return ImportAlumni()">
                    @csrf
                    <label for="file">Import file danh sách cựu sinh viên</label>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div> --}}
        <div class="col-sm-6 ol-md-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">IMPORT DANH SÁCH TỐT NGHIỆP</h3>
                <form name="import_graduate" action="{{route('alumnies/import_register_graduate')}}" method="post" enctype="multipart/form-data"
                onsubmit="return ImportGraduate()">
                    @csrf
                    <label for="file_graduate">Import danh sách tốt nghiệp</label>
                        <input type="file" name="file_graduate" id="file_graduate" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-danger">Import</button>
                        <span class="text-muted">.xlsx, .csv, .xls</span>
                </form> 
            </div>
        </div>
    </div>
<script>
    function ImportStudent()
    {
        var x = document.forms["import_student"]["file"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import");
            return false;
        }
    }

    function ImportAlumni()
    {
        var x = document.forms["import_alumnies"]["file"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import");
            return false;
        }
    }
    function ImportGraduate()
    {
        var x = document.forms["import_graduate"]["file_graduate"].value;
        if(x == "" || x == NULL)
        {
            alert("Bạn phải chọn file import");
            return false;
        }
    }
    </script>
@endsection