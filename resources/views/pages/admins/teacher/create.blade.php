@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-sm-6 m-auto">
            <div class="white-box ">
                <h3 class="box-title m-b-0">Tạo giáo viên</h3>
                <br>
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
                <form data-toggle="validator" novalidate="true" action="{{route('teacher.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="code" class="control-label">Mã giáo viên</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Mã giáo viên" onkeyup="show_result()">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="control-label">Họ và tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" >
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" disabled>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="control-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="birth" name="birth" placeholder="Ngày sinh">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="control-label">Giới tính</label>
                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Giới tính">
                    </div>
                    <div class="form-group">
                        <label for="nation" class="control-label">Dân tộc</label>
                        <input type="text" class="form-control" id="nation" name="nation" placeholder="Dân tộc">
                    </div>
                    <div class="form-group">
                        <label for="tel" class="control-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ">
                    </div>
                    {{-- <div class="form-group">
                        <label for="class_code" class="control-label">Lớp cố vấn</label>
                        <input type="text" class="form-control" id="class_code" name="class_code" placeholder="Lớp cố vấn">
                    </div> --}}
                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{route('teacher.index')}}" class="btn btn-default">Trờ lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script language="javascript">
      function show_result()
      {
        // Lấy hai thẻ HTML
       	var input = document.getElementById("code");
        var div = document.getElementById("username");
        
        // Gán nội dung ô input vào thẻ div
        div.value = input.value;
      }
    
    </script>
    
@endsection