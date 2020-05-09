@extends('layouts.admin')       
{{-- extend layouts.admin là cái thg này nè --}}
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Danh sách bài viết cần Admin duyệt</h3>
                <div class="table-responsive">
                    <table class="table color-table inverse-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                {{-- <th>ID Người dùng đăng</th> --}}
                                <th>Họ và tên</th>
                                {{-- <th>ID Lớp</th> --}}
                                <th>Tên lớp</th>
                                {{-- <th>ID Phân quyền</th> --}}
                                <th>Tên phân quyền</th>
                                <th>Thể loại</th>
                                <th>Tiêu đề bài viết</th>
                                {{-- <th>Nội dung bài viết</th> --}}
                                <th>Trạng thái bài viết</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $row)
                                <tr id="{{$row->post_id}}">
                                    <td>{{$row->post_id}}</td>
                                    <td>{{$row->user['name']}}</td>
                                    <td>
                                       @foreach ($row->classes as $item)
                                           {{$item->class_name}}
                                       @endforeach
                                    </td>
                                    <td>
                                        @foreach ($row->roles as $role_name)
                                            {{$role_name->role_name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($row->posts_categories as $item)
                                            {{$item->category_name}}
                                        @endforeach
                                    </td>                                   
                                    <td>{{$row->post_title}}</td>
                                    {{-- <td>{{$row->post_content}}</td> --}}
                                    <td id="td{{$row->post_id}}">{{$row->post_status}}</td>
                                    <td>
                                        {{-- <button class="btn btn-success accept-btn" data-postID="{{$row->post_id}}">Accept</button> --}}
                                        <a href="{{route('posts.show_post_detail_of_admin',$row->post_id)}}" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Show"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a> 
                                        <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn accept-btn"  data-postID="{{$row->post_id}}" data-toggle="tooltip" data-original-title="Accept"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn block-user" data-userID="{{$row->user_id}}" data-toggle="tooltip" data-original-title="Block User"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    // DUYET BAI
    $(document).ready(function () {
        $('.accept-btn').click(function(){
            const confirmResult = confirm('Bạn có chắc muốn duyệt bài này không?');
            if (!confirmResult) { // Neu khong dong y
                return;
            }
            const postId = $(this).attr('data-postID');
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('posts.list_post_ajax')}}",
                data: {postId : postId},
                dataType: "JSON",
                success: function (response) {
                    if (response.result === 'success') {
                        alert('Duyệt bài thành công!');
                        $(`#${postId}`).fadeOut();
                    }
                }
            });
        })
    });
    // BLOCK USER
    $(document).ready(function () {
        $('.block-user').click(function(){
            const confirmBlock = confirm('Bạn có chắc khóa tài khoản này?');
            if(!confirmBlock)
            {
                return;
            }
            const userID = $(this).attr('data-userID');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('posts.block_user_ajax')}}",
                data: {userID : userID},
                dataType: "JSON",
                success: function (response) {
                    if(response.result === "success")
                    {
                        alert('Đã khóa tài khoản thành công!');
                        location.reload();
                    }
                }
            });
        })
    });
</script>
@endsection
@section('script')

<script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
$(function () 
    $('[data-toggle="tooltip"]').tooltip();
);
</script>
@endsection