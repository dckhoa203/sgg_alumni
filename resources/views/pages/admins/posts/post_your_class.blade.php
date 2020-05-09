@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="{{asset('/css/khanh_ho/style_index_2.css')}}">
<script type="text/javascript"
    src="https://www.viralpatel.net/demo/jquery/jquery.shorten.1.0.js"></script>
<div class="container">
    <div class="content-border pager-offset">
        <h2 class="black-bar-header">BẢN TIN TRÊN LỚP CỦA BẠN</h2>
        <div class="view view-news-recent view-id-news_recent view-display-id-paged_list view-dom-id-6eefa6e989759a55744d694dc2e0a2b2"> 
            @foreach ($post_user as $row)
                
              
            <!-- Start item -->
            <div class="panelizer-view-mode node node-teaser node-article node-2274 node-promoted"> 
                            
                <!-- ########## NEW HTML ############## -->
                <div class="white-stone">
                    <div class="white-stone-content">
                        <div class="row">
                        <div class="col-md-3 col-xs-3">
                            <div class="simple-border">
                                <div class="field field-name-field-article-media field-type-file field-label-hidden">
                                        @foreach ($row->posts_categories as $item)
                                            <a title="" href="{{url('posts/news/'.$item->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">
                                        @endforeach
                                        <div class="field field-name-field-article-media field-type-file field-label-hidden">
                                            <div class="file file-image file-image-jpeg" id="file-1321">
                                                <img width="320" height="180" alt="" src="{{asset('/images/myfiles_cit/test_posts/IMEFndZ7QSmArlg0trf4_project.png')}}" typeof="foaf:Image">
                                            </div>
                                        </div>
                                    </a>
                
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-9 col-xs-9">
                            @if (Auth::user()->hasRole('Teacher'))
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
                            @foreach ($row->posts_categories as $item)
                                <h4><a href="{{url('posts/news/'.$item->category_slug.'/'.$row->post_slug.'/'.$row->post_id)}}">{{$row->post_title}}(
                                    {{-- TODO: SUCCESS {{$row->post_classes->pluck('class_name')}} --}}
                                    @foreach ($row->post_classes as $item)
                                        {{$item->class_name}}
                                    @endforeach
                                )</a></h4>
                            @endforeach
                            <div class="teaser-content">
                                <div class="field field-name-field-body-medium field-type-text-long field-label-hidden">
                                    <div class="infor-datetime">
                                        <div class="infor-left">
                                            <i class="ti-alarm-clock"></i> {{$days[$row->post_id]}}
                                        </div>
                                        <div class="infor-right">
                                            <i class="ti-user"></i> Viết bởi <b>{{$row->user['name']}}</b> IN 
                                            {{-- TODO: TÊN THỂ LOẠI --}}
                                            @foreach ($row->posts_categories as $item)
                                                {{$item->category_name}}
                                            @endforeach
                                        </div>
                                    </div>
                                    <br>
                                    <div class="display">
                                        {!!$row->post_content!!}
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                        
                                            $(".display").shorten();
                                        
                                        });
                                    </script>
                                    
                                </div>
                            </div>
                            <div class="horizontal-group">
                                <div class="horizontal-group-item">
                                    <div class="all-caps subtle icon-container icon-posted">   
                                        <span class="time-ago time-ago-node-2274">
                                            {{$row->created_at}}
                                        </span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>		  
            </div>
            <!-- end item -->

            @endforeach 
            <div align="right">
                {!! $post_user->links() !!}
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
@endsection