@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Danh sách tài khoản bị khóa và UNLOCKED ACCOUNT</h3>
                <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe">
                    <thead>
                        <tr>
                            <th>ID Người dùng</th>
                            <th>Họ và tên</th>
                            <th>Tiêu đề bài viết không hợp lệ</th>
                            <th>Nội dung bài viết không hợp lệ</th>
                            <th>Trạng thái người dùng</th>
                            <th>Số lần bị khóa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($account_blocked as $item)
                            <tr>
                                <td>{{$item->user_id}}</td>
                                <td>{{$item->user['name']}}</td>
                                <td>{{$item->post_title}}</td>
                                <td>{{$item->post_content}}</td>
                                <td>{{$item->status_user}}</td>
                                <td>{{$count_block}}</td>
                                <td>
                                    <button class="btn btn-danger unblock-account" data-userID="{{$item->user_id}}">Unlock</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route('posts.list_post')}}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
    <!-- /.row -->
<script>
    $(document).ready(function () {
        $('.unblock-account').click(function(){
            const confirmUnblock = confirm('Mở khóa tài khoản này?');
            if(!confirmUnblock)
            {
                return;
            }
            const userID = $(this).attr("data-userID");
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('posts.unblock_account_ajax')}}",
                data: {userID : userID},
                dataType: "JSON",
                success: function (response) {
                    if(response.result === "success")
                    {
                        alert('Mở khóa tài khoản thành công!');
                        location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection