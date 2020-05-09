@extends('layouts.admin')

@section('content')
<link href="{{asset('/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
<link rel="stylesheet" href="{{asset('/css/style_posts_index.css')}}">
<style>
    a {
	color: #0254EB
    }
    a:visited {
        color: #0254EB
    }
    a.morelink {
        text-decoration:none;
        outline: none;
    }
    .morecontent span {
        display: none;
    }
    .comment {
        width: 400px;
        /* background-color: #f0f0f0; */
        margin: 10px;
    }
</style>
        <div class="row main">
            <div class="col-md-12 col-xs-12">
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    <p>{{$message}}</p>
                    <p class="mb-0"></p>
                </div>
                @endif
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="posts_recommend">
                            <h3>Gợi ý thể loại bài viết</h3>
                            <ul>
                            <li><a href="{{route('posts.categories_apply_job')}}">Tuyển dụng việc làm</a></li>
                            <li><a href="{{route('posts.categories_notifications')}}">Thông báo</a></li>
                            <li><a href="{{route('posts.categories_support_scholarship')}}">Hỗ trợ học bổng</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="text-center">
                            <center>
                                <div id="datepicker-inline"></div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                @foreach ($posts as $row)
                <div class="row" style="padding-top:20px; height:380px;background-color:white">
                    <div class="col-md-3 col-xs-3">
                        <a href="{{url('posts/news/'.$row->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">
                            @switch($row->category_slug)
                                @case('tim-viec-lam')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/jobs660_090518050232_103118054303_020119063725.webp')}}" alt="img" width="260px" height="180xp">
                                    @break

                                @case('tuyen-viec-lam')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/coaching-and-developing-employees-1200x630.png')}}" alt="img" width="260px" height="180xp">
                                    @break

                                @case('hop-lop')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/31823189-business-meeting-and-brainstorming-flat-design-.jpg')}}" alt="img" width="260px" height="180xp">
                                    @break

                                @case('hoc-bong')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/51963440-modern-thin-line-design-concept-for-support-website-banner-vector-illustration-concept-for-contact-a.jpg')}}" alt="img" width="260px" height="180xp">
                                    @break

                                @case('quyen-gop')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/51963440-modern-thin-line-design-concept-for-support-website-banner-vector-illustration-concept-for-contact-a.jpg')}}" alt="img" width="260px" height="180xp">
                                    @break
                                
                                @case('thong-bao')
                                    <img src="{{asset('/images/myfiles_cit/test_posts/51963439-modern-thin-line-design-concept-for-news-website-banner-vector-illustration-concept-for-product-and-.jpg')}}" alt="img" width="260px" height="180xp">
                                    @break
                                
                                @default
                                <img src="{{asset('/images/myfiles_cit/test_posts/default.jpg')}}" alt="img" width="260px" height="180xp">
                            @endswitch
                        </a>
                    </div>
                    
                    <div class="col-md-9 col-xs-9">
                        @if (Auth::check() && Auth::user()->hasRole('Admin'))
                            <div class="action" style="display: block;
                            width: 20px;
                            position: relative;
                            left: 80%;
                            top: 10%;">
                                <button type="button" class="btn btn-twitter btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gear"></i> <span class="caret"></span> </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><form action="{{ route('posts/destroy', $row->post_id) }}" method="post" class="delete_form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn">Delete post</button>
                                    </form></li>
                                </ul>
                                    
                            </div>
                        @endif
                        <div class="title">
                            <h3><a href="{{url('posts/news/'.$row->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">{{$row->post_title}}</a></h3>
                            <h5>Viết bởi <b>{{$row->user['name']}}</b> on {{date("d",strtotime($row->created_at))}} tháng {{date("m",strtotime($row->created_at))}} năm {{date("Y",strtotime($row->created_at))}}</h5>
                        </div>
                        <div class="content">
                            <div>
                                <div class="comment more">
                                    {!! $row->post_content !!}
                                </div>
                                <br /><br />
                            {{-- <a href="#" class="click_comment" data-post-id="{{$row->post_id}}"><span id="count_comment-{{$row->post_id}}"> --}}
                                {{-- TODO: Hiển thị số lượt comment theo Post_id --}}
                                {{-- @foreach ($count_comment as $item)
                                    @if ($item->post_id == $row->post_id)
                                        {{$item->count_comment}}
                                    @endif
                                @endforeach --}}
                            {{-- </span>Comment</a> --}}
                                {{-- <form id="form-{{$row->post_id}}" data-user-id="{{Auth::user()->user_id}}" style="display: none" data-post-id="{{$row->post_id}}">
                                    @csrf
                                    <textarea name="comment_content" maxlength="160"></textarea>
                                    <button type="submit" class="btn btn-success">Đăng</button>
                                </form> --}}
                                {{-- TODO: Show comment theo Post_id --}}
                                <div id="show-{{$row->post_id}}" class="show-comment-button" data-post-id="{{$row->post_id}}" style="display:none;">
                                    {{-- <a href="#" class="load-more">view more comment previous</a><br> --}}
                                    <select multiple id="public-methods" name="public-methods[]" style="width:350px">
                                        @foreach ($show_comments as $show)
                                            @if ($show->post_id === $row->post_id)
                                                <b>{{$show->user['name']}}</b>: {{$show->comment_content}}. <br> 
                                                <option><b>{{$show->user['name']}}</b>: {{$show->comment_content}}.
                                                {{$show->created_at}}</option>
                                            @endif
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            {{-- Start like button --}}
                            <div class="fb-like" 
                                data-href="https://ssgssgalumni19.000webhostapp.com/posts/news/{{$row->category_slug}}/{{$row->post_slug}}/{{$row->post_id}}" 
                                data-width="" 
                                data-layout="standard" 
                                data-action="like" 
                                data-size="small" 
                                data-show-faces="true" 
                                data-share="true">
                            </div>
                            {{-- End like butotn --}}
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
                <div align="center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
<script>
    $('.delete_form').on('submit',function(){
            if(confirm('Bạn có muốn xóa bài viết này?'))
            {
                return true;
            }
            else
            {
                return false;
            }
    });
    
</script>
<script>
$(document).ready(function () {
        /*
        $('.click_comment').click(function(e){
            e.preventDefault();
            const post_id = $(this).attr("data-postID");
            const user_id = $(this).attr("data-user_id");

            console.log(post_id);
            console.log(user_id);   

            //$('#comment_form').slideToggle('slow');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $('#submit').click(function(e){
                e.preventDefault();
                const comment_content = $('#comment_content').val();

                // console.log(comment_content);
                
                $.ajax({
                    type: "POST",
                    url: "{{route('posts.comment_ajax')}}",
                    data: {comment_content: comment_content},
                    dataType: "JSON",
                    success: function (response) {
                        console.log("Content: ",response.commnet_content);
                        console.log(response.message);
                    }
                }); 
            })

            $.ajax({
                type: "POST",
                url: "{{route('posts.list_post_students')}}",
                data: {post_id : post_id, user_id: user_id},
                dataType: "JSON",
                success: function (response) {
                    console.log("Post_id: ",response.post_id);
                    console.log("User_id: ",response.user_id);
                }
            }); 
        })
        */
       $('.click_comment').click(function (event) {
            event.preventDefault();
            const post_id = $(this).attr("data-post-id");
            console.log(post_id);
            $(this).next('form').slideToggle();
            $(`div[id*=show-${post_id}]`).show()
       })

       $('form[id*="form-"').on('submit', function (event) {
           event.preventDefault();
           const userId = $(this).attr('data-user-id')
           const postId = $(this).attr('data-post-id')
           const commentContent = $(this).find('textarea').val();

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "POST",
                url: "{{route('posts.comment_ajax')}}",
                data: {userId: userId, postId: postId, commentContent: commentContent},
                dataType: "json",
                success: function (response) {
                    // $(`#count_comment-${postId}`).text(response.count_comment.count_comment);
                    console.log(response.count_comment);
                    if (response.status === 'success') {
                        $(`#count_comment-${postId}`).text(response.count_comment[0].count_comment);
                        alert('Add comment successfully!');
                        $('form[id*=form-').slideDown();
                        location.reload();
                    }
                }
            });
            
       });
    });
</script>
<script>
$(document).ready(function() {
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "See more";
	var lesstext = "Less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});
</script>
<script src="{{asset('/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
    jQuery('#datepicker-inline').datepicker({

        todayHighlight: true
    });

</script>
@endsection