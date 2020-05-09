@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('/css/khanh_ho/style_index_2.css')}}">
<script type="text/javascript"
    src="https://www.viralpatel.net/demo/jquery/jquery.shorten.1.0.js"></script>
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
                width: 100%;
                /* background-color: #f0f0f0; */
                margin: 10px;
            }
        </style>
<div class="container">


    <div class="content-border pager-offset">
        <h2 class="black-bar-header">BẢN TIN TUYỂN DỤNG VIỆC LÀM</h2>
        <div class="view view-news-recent view-id-news_recent view-display-id-paged_list view-dom-id-6eefa6e989759a55744d694dc2e0a2b2"> 
            @foreach ($post_categories as $row)
                
              
            <!-- Start item -->
            <div class="panelizer-view-mode node node-teaser node-article node-2274 node-promoted"> 
                            
                <!-- ########## NEW HTML ############## -->
                <div class="white-stone">
                    <div class="white-stone-content">
                        <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <div class="simple-border">
                                <div class="field field-name-field-article-media field-type-file field-label-hidden">
                                        <a title="" href="{{url('posts/news/'.$row->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">
                                        <div class="field field-name-field-article-media field-type-file field-label-hidden">
                                            <div class="file file-image file-image-jpeg" id="file-1321">
                                                <img width="320" height="180" alt="" src="{{asset('/images/myfiles_cit/test_posts/HEAD-5_Skills_Every_People_Manager_In_Your_Business_Should_Have__28According_to_Research_29_Hero_no_text-720x360.png')}}" typeof="foaf:Image">
                                            </div>
                                        </div>
                                    </a>
                
                                    </div>
                                </div>
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
                            <h4><a href="{{url('posts/news/'.$row->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">{{$row->post_title}}</a></h4>
                            <div class="teaser-content">
                                <div class="field field-name-field-body-medium field-type-text-long field-label-hidden">
                                    <div class="infor-datetime">
                                        <div class="infor-left">
                                            <i class="ti-alarm-clock"></i> Đăng ngày {{$row->created_at}}
                                        </div>
                                        <div class="infor-right">
                                            <i class="ti-user"></i> Viết bởi <b>{{$row->user['name']}}</b> IN {{$row->category_name}}
                                        </div>
                                    </div>

                                    {{-- // TODO: PHẦN NỘI DUNG  --}}
                                    <div>
                                        <div class="comment more">
                                            {!! $row->post_content !!}
                                        </div>
                                        <br /><br />
                                    <a href="#" class="click_comment" data-post-id="{{$row->post_id}}"><span id="count_comment-{{$row->post_id}}">
                                        {{-- TODO: Hiển thị số lượt comment theo Post_id --}}
                                        @foreach ($count_comment as $item)
                                            @if ($item->post_id == $row->post_id)
                                                {{$item->count_comment}}
                                            @endif
                                        @endforeach
                                    </span>Comment</a>
                                        <form id="form-{{$row->post_id}}" data-user-id="{{Auth::check() && Auth::user()->user_id}}" style="display: none" data-post-id="{{$row->post_id}}">
                                            @csrf
                                            <textarea name="comment_content" maxlength="160"></textarea>
                                            <button type="submit" class="btn btn-success">Đăng</button>
                                        </form>
                                        {{-- TODO: Show comment theo Post_id --}}
                                        <div id="show-{{$row->post_id}}" class="show-comment-button" data-post-id="{{$row->post_id}}" style="display:none;">
                                            {{-- <a href="#" class="load-more">view more comment previous</a><br> --}}
                                            <select multiple id="public-methods" name="public-methods[]" style="width:500px">
                                                @foreach ($show_comments as $show)
                                                    @if ($show->post_id === $row->post_id)
                                                        <b>{{$show->user['name']}}</b>: {{$show->comment_content}}. <br> 
                                                        <option><b>{{$show->user['name']}}</b>: {{$show->comment_content}}.
                                                        {{$show->created_at}} <a href="{{route('posts/delete_comment',$show->comment_id)}}">Remove</a>
                                                        </option>
                                                    @endif
                                                @endforeach 
                                            </select>
                                            
                                        </div>
                                    </div>
                                    {{--  END PHẦN NỘI DUNG --}}
                                    
                                </div>
                            </div>
                            {{-- TODO: PHẦN NGÀY THÁNG NĂM CUỐI --}}
                            <div class="horizontal-group">
                                <div class="horizontal-group-item">
                                    <div class="all-caps subtle icon-container icon-posted">   
                                        <span class="time-ago time-ago-node-2274">
                                            
                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            {{-- END PHẦN NGÀY THÁNG NĂM CUỐI --}}
                        </div>
                        </div>
                    </div>
                </div>		  
            </div>
            <!-- end item -->

            @endforeach 
            <div align="right">
                {!! $post_categories->links() !!}
            </div> 
            
        </div>
    </div>

</div>
{{-- end container --}}
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
                                // TODO: Sau khi comment xong thì form sẽ slideDown lại
                                // $(`#form-${postId}`).slideDown('slow');
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

        //  nếu chiều dài nội dung > 100 ký tự 
		if(content.length > showChar) {

            // nội dung của content không cắt
            var c = content.substr(0, showChar);
            //  nội dung của contentn đã cắt từ phần > 100 ký tự trở về sau
			var h = content.substr(showChar-1, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ 
                            '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

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
@endsection