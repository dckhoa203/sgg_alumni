@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 m-auto">
                @if (count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{  $error}}    </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <p>{{  \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="white-box">
                    <h2 align="center">Thông tin về cựu sinh viên</h2>
                    <br>
                    <form data-toggle="validator" novalidate="true" action="{{route('alumnies/store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code" class="control-label">MSSV</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Code">
                        </div>
                        <div class="form-group">
                            <label for="course" class="control-label">Khóa</label>
                            <input type="text" class="form-control" id="course" name="course" placeholder="Khóa">
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên">
                        </div>
                        {{-- <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>  --}}
                        <div class="form-group">
                            <label for="nation" class="control-label">Dân tộc</label>
                            <input type="text" class="form-control" id="nation" name="nation" placeholder="Nation">
                        </div>  
                        <div class="form-group">
                            <label for="tel" class="control-label">Số diện thoại</label>
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="birth" class="control-label">Ngày sinh</label>
                            {{-- <input type="date" class="form-control" id="birth" name="birth" placeholder="Birth"> --}}
                            <select name="gender" id="gender" class="form-control">
                                <option value=''>Nam</option>
                                <option value='N'>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="birth" name="birth" placeholder="Birth">
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="family_tel" class="control-label">Số điện thoại gia đình</label>
                            <input type="text" class="form-control" id="family_tel" name="family_tel" placeholder="Family Phone">
                        </div>
                        <div class="form-group">
                            <label for="family_address" class="control-label">Địa chỉ gia đình</label>
                            <input type="text" class="form-control" id="family_address" name="family_address" placeholder="Family Address.....">
                        </div>
                        <div class="form-group">
                            <label for="status_id">Chọn trạng thái:</label>
                            <select class="form-control" name="status_id" id="status_id">
                                <option name="" value="">Choose</option>
                                <option name="di-hoc" value="1">Đi học</option>
                                <option name="nghi-hoc" value="2">Nghỉ học</option>
                                <option name="di-lam" value="3">Đi làm</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('alumnies/index')}}" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
                {{-- end white-box --}}
            </div>
            {{-- end col-sm-6 --}}
        </div>
    </div>
    {{-- <script>
        $(function() {
            $('#status_id').change(function(){
                $('#form_work').hide();
                $('#form_work').show();
            })
        });
    </script> --}}
@endsection