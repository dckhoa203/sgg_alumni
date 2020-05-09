@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Hiển thị chi tiết của bài viết</h3>
                <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>File đính kèm</th>
                            <th>Link</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$posts->post_id}}</td>
                            <td>{{$posts->post_title}}</td>
                            <td><a href="{{$posts->post_file}}" target="_blank">{{$posts->post_file}}</a></td>
                            <td><a href="{{$posts->post_link}}" target="_blank">{{$posts->post_link}}</a></td>
                            <td>{!! $posts->post_content !!}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('posts.list_post')}}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
    <!-- /.row -->

@endsection