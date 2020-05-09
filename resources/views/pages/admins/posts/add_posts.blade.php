@extends('layouts.admin')
@section('content')
<style>
    tr:nth-child(even) {background-color: #f2f2f2;}
    tr:hover {background-color:#f5f5f5;}
</style>
<div class="row">
    @if (Auth::user()->hasRole('Admin'))
        <div class="col-md-8 index">
            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error}}    </li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{$message}}</p>
                <p class="mb-0"></p>
            </div>
            @endif
            {{-- <p>Welcome to the: {{Auth::user()->name}}</p>
            <p>{{Auth::user()->user_id}}</p> --}}
            @if ($userID === Auth::user()->user_id)
                <script>
                    alert('Tài khoản của bạn đã bị khóa!');
                </script>
                <h2 align="center" style="color:#2570BB;">Tài khoản của bạn đã bị khóa, không thể đăng bài</h2>
            @else
                <div class="panel panel-default index">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8 index">
                                <h3 class="panel-title">SOẠN BÀI VIẾT</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" id="dynamic_field">
                                <div class="form-group">
                                    <label for="category_id">Chọn thể loại:</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Chọn thể loại</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="post_title">Tiêu đề</label>
                                    <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Write your short title" aria-describedby="helpId">
                                </div>
    
                                <div class="form-group">
                                    <label for="post_file">Chọn file upload</label>
                                    <input type="file" name="post_file[]" id="post_file" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="post_slug">Tên viết tắt bài đăng</label>
                                    <input type="text" name="post_slug" id="post_slug" class="form-control" placeholder="Tên viết tắt bài đăng" aria-describedby="helpId">
                                </div> --}}
                                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Teacher') || Auth::user()->hasRole('Manager'))
                                    <div class="form-group">
                                        <label for="role_name">Đăng trên phân quyền</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                                <option value="">Tất cả</option>
                                                @foreach ($roles as $item)
                                                    <option value="{{$item->role_id}}">{{$item->role_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_id">Đăng trên Khóa - lớp</label>
                                        <select class="form-control" name="class_id" id="class_id">
                                            <option value="">Chọn Khóa - lớp</option>
                                                @foreach ($course as $item)
                                                    <option value="{{$item->class_id}}"> Khóa {{($item->year - 1974)}} - {{$item->class_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    {{-- <a href="#" class="btn btn-success btn-accept">Chọn nhiều lớp</a>
                                    <br>
                                    <br>
                                    <div class="show-classes" style="display:none;">
                                        <div class="col-sm-6">
                                            @foreach ($course as $item)
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                    <label for="class_id">Khóa {{($item->year - 1974)}} - {{$item->class_name}}</label>
                                                    <hr>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                    <div class="table-responsive">
                                        <table class="table color-table info-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Khóa</th>
                                                    <th>Tên lớp</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th><div class="checkbox checkbox-info">
                                                            <input id="selectAll" name="selectAll" type="checkbox">
                                                            <label for="selectAll">Select All</label>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($course as $item)
                                                        <tr>
                                                            <td>{{$item->class_id}}</td>
                                                            <td>{{$item->year - 1974}}</td>
                                                            <td>{{$item->class_name}}</td>
                                                            <td>
                                                                <div class="checkbox checkbox-info">
                                                                    @if (isset($only_class))
                                                                        @if (($only_class == $item->class_id))
                                                                        <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}" checked> 
                                                                        <label for="class_id"></label>
                                                                        @else
                                                                            <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                                            <label for="class_id"></label>
                                                                        @endif
                                                                    @else
                                                                        <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                                        <label for="class_id"></label>
                                                                    @endif
                                                                    
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label for="post_content">Nội dung</label>
                                    <textarea name="post_content" id="post_content" class="form-control" placeholder="Write your short story" style="height:200px"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="post_link">Link muốn chèn</label>
                                    <input type="text" name="post_link" id="post_link" class="form-control" placeholder="Link" aria-describedby="helpId">
                                </div> --}}
                            </div>
                            <div id="link_content"></div>
                            <div class="form-group" align="right">
                                <input type="submit" name="share_post" id="share_post" class="btn btn-primary" value="Đăng" />
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="col-md-12 col-xs-12 index">
            @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{  $error}}    </li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{$message}}</p>
                <p class="mb-0"></p>
            </div>
            @endif
            {{-- <p>Welcome to the: {{Auth::user()->name}}</p>
            <p>{{Auth::user()->user_id}}</p> --}}
            @if ($userID === Auth::user()->user_id)
                <script>
                    alert('Tài khoản của bạn đã bị khóa chức năng đăng bài. Click OK để tiếp tục!');
                </script>
                <h2 align="center" style="color:#2570BB;">Tài khoản của bạn đã bị khóa chức năng đăng bài</h2>
            @else
                <div class="panel panel-default index">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-8 index">
                                <h3 class="panel-title">SOẠN BÀI VIẾT</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" id="dynamic_field">
                                <div class="form-group">
                                    <label for="category_id">Chọn thể loại:</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Chọn thể loại</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="post_title">Tiêu đề</label>
                                    <input type="text" name="post_title" id="post_title" class="form-control" placeholder="Write your short title" aria-describedby="helpId">
                                </div>
    
                                <div class="form-group">
                                    <label for="post_file">Chọn file upload</label>
                                    <input type="file" name="post_file[]" id="post_file" class="form-control" placeholder="" aria-describedby="helpId">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="post_slug">Tên viết tắt bài đăng</label>
                                    <input type="text" name="post_slug" id="post_slug" class="form-control" placeholder="Tên viết tắt bài đăng" aria-describedby="helpId">
                                </div> --}}
                                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Teacher') || Auth::user()->hasRole('Manager'))
                                    <div class="form-group">
                                        <label for="role_name">Đăng trên phân quyền</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                                <option value="">Tất cả</option>
                                                @foreach ($roles as $item)
                                                    <option value="{{$item->role_id}}">{{$item->role_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_name">Đăng trên Khóa - lớp</label>
                                        <select class="form-control" name="class_id" id="class_id">
                                            <option value="">Chọn Khóa - lớp</option>
                                                @foreach ($course as $item)
                                                    <option value="{{$item->class_id}}"> Khóa {{($item->year - 1974)}} - {{$item->class_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    {{-- <a href="#" class="btn btn-success btn-accept">Chọn nhiều lớp</a>
                                    <br>
                                    <br>
                                    <div class="show-classes" style="display:none;">
                                        <div class="col-sm-6">
                                            @foreach ($course as $item)
                                                <div class="checkbox checkbox-info">
                                                    <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                    <label for="class_id">Khóa {{($item->year - 1974)}} - {{$item->class_name}}</label>
                                                    <hr>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                    <div class="table-responsive">
                                        <table class="table color-table info-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Khóa</th>
                                                    <th>Tên lớp</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3"></th>
                                                    <th><div class="checkbox checkbox-info">
                                                            <input id="selectAll" name="selectAll" type="checkbox">
                                                            <label for="selectAll">Select All</label>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($course as $item)
                                                        <tr>
                                                            <td>{{$item->class_id}}</td>
                                                            <td>{{$item->year - 1974}}</td>
                                                            <td>{{$item->class_name}}</td>
                                                            <td>
                                                                <div class="checkbox checkbox-info">
                                                                    @if (isset($only_class))
                                                                        @if (($only_class == $item->class_id))
                                                                        <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}" checked> 
                                                                        <label for="class_id"></label>
                                                                        @else
                                                                            <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                                            <label for="class_id"></label>
                                                                        @endif
                                                                    @else
                                                                        <input type="checkbox" id="class_id" name="class_id[]" value="{{$item->class_id}}"> 
                                                                        <label for="class_id"></label>
                                                                    @endif
                                                                    
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if (Auth::user()->hasRole('Alumni'))
                                    <div class="form-group">
                                        <label for="class_name">Đăng trên Khóa - lớp của tôi</label>
                                        <select class="form-control" name="class_id" id="class_id">
                                            <option value="">Chọn Khóa - lớp</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{$item->class_id}}"> Khóa {{($item->year - 1974)}} - {{$item->class_name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="post_content">Nội dung</label>
                                    <textarea name="post_content" id="post_content" class="form-control" placeholder="Write your short story" style="height:200px"></textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="post_link">Link muốn chèn</label>
                                    <input type="text" name="post_link" id="post_link" class="form-control" placeholder="Link" aria-describedby="helpId">
                                </div> --}}
                            </div>
                            <div id="link_content"></div>
                            <div class="form-group" align="right">
                                <input type="submit" name="share_post" id="share_post" class="btn btn-primary" value="Đăng" />
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    @endif

    @if (Auth::user()->hasRole('Admin'))
        <div class="col-md-4 index">
            {{-- <div class="panel panel-default index">
                <div class="panel-heading">
                    <h3 class="panel-title">Action</h3>
                    Welcome to <span style="color:red;">{{Auth::user()->name}} / ID: {{Auth::user()->user_id}}</span>
                        <br>
                        <hr> --}}
                        {{-- <a href="{{route('posts.login')}}" class="btn btn-default">Login</a>
                        <a href="{{route('posts.login2')}}" class="btn btn-default">Login2</a>
                        <a href="{{route('posts.logout')}}" class="btn btn-success">Logout</a> --}}
                {{-- </div>
                <div class="panel-body">
                    <div id="user_list"></div>
                </div>
            </div> --}}
            @foreach ($count as $item)
            <div class="panel panel-default index">
                <div class="panel-body">
                    <h3>Tên người post: {{$item->user['name']}}</h3>
                    {{-- <p>ID người post: <b>{{$item->user_id}}</b>.  --}}
                    Số lượt post đã đăng: <b>{{$item->user_count}}</b></p>
                    {{-- <a href="#" class="label label-primary">View</a>
                    <a href="#" class="label label-success">Pending</a>
                    <a href="#" class="label label-danger">Delete</a> --}}
                </div>
                <div class="panel-footer">
                </div>
            </div>
            @endforeach
        </div> 
    @endif

</div>
<script>
    $("#selectAll").click(function () {
       $('input:checkbox').not(this).prop('checked', this.checked);
   });
   </script>
<script>
    $(function () {
            $('.btn-accept').click(function(event){
                event.preventDefault();
                $('.show-classes').toggle("slow");
            });
        });
    </script>
<script src="{{asset('/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    $('textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
@endsection