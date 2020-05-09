@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{asset('/css/khanh_ho/style_details_an_article.css')}}">
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>
<div class="row">
    <div class="details-container">
        <div class="col-md-3 col-s-12">
            <h4>Bài viết gợi ý</h4>
            <div class="content-border">
                <div class="recommend-posts">
                    <div class="white-stone">
                        <div class="white-stone-content">
                            <ul>
                                @foreach ($post_radom as $item)
                                    <li><a href="{{url('posts/news/'.$item->category_slug.'/'.$item->post_slug.'/'.$item->post_id)}}">{{$item->post_title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        <div class="col-md-9 col-s-12">
            @foreach ($post_slug as $row)
                <div class="content-details">
                    <h2 id="title">{{$row->post_title}}</h2>
                    <div class="main-content">
                        <div class="infor-content">
                            <div class="date-create">
                                @foreach ($create_post as $item)
                                <i class="ti-alarm-clock"></i> Đăng ngày {{$item->created_at}}
                                @endforeach
                            </div>
                            <div class="author">
                                <i class="ti-user"></i> Viết bởi {{$row->name}}
                            </div>
                        </div>
                        <div class="content col-s-12">
                            <h4>
                                @switch($row->category_slug)
                                    @case('tim-viec-lam')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/jobs660_090518050232_103118054303_020119063725.webp')}}" alt="img">
                                        @break

                                    @case('tuyen-viec-lam')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/coaching-and-developing-employees-1200x630.png')}}" alt="img">
                                        @break

                                    @case('hop-lop')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/31823189-business-meeting-and-brainstorming-flat-design-.jpg')}}" alt="img">
                                        @break

                                    @case('hoc-bong')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/51963440-modern-thin-line-design-concept-for-support-website-banner-vector-illustration-concept-for-contact-a.jpg')}}" alt="img">
                                        @break

                                    @case('quyen-gop')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/51963440-modern-thin-line-design-concept-for-support-website-banner-vector-illustration-concept-for-contact-a.jpg')}}" alt="img">
                                        @break
                                    
                                    @case('thong-bao')
                                        <img src="{{asset('/images/myfiles_cit/test_posts/51963439-modern-thin-line-design-concept-for-news-website-banner-vector-illustration-concept-for-product-and-.jpg')}}" alt="img">
                                        @break
                                    
                                    @default
                                    <img src="{{asset('/images/myfiles_cit/test_posts/default.jpg')}}" alt="img">
                                @endswitch
                            </h4>
                            <p>{!! $row->post_content !!} <br> <br>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit vel optio rem illo aperiam! Exercitationem ratione qui ipsum, sed dolor blanditiis rem iure rerum et accusantium nesciunt voluptate, asperiores delectus?
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas consequuntur aperiam error repellendus laudantium dolor, impedit tenetur nemo, ratione quasi iusto ducimus nostrum, asperiores corporis? Animi, nam? Omnis, sunt officiis!
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati aperiam perferendis iste maiores perspiciatis minima ad magni itaque consequatur, accusantium facilis exercitationem, tenetur, doloribus non eveniet. Praesentium ducimus rerum tenetur?
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, recusandae ratione voluptates a suscipit harum maxime quis nulla excepturi, quam fugiat dolorum sed rem deleniti vitae dolorem, vel illo enim!</p>
                            
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="fb-comments col-s-12" 
                data-href="https://developers.facebook.com/docs/plugins/comments#configurator" 
                data-width="220" 
                data-numposts="5">
            </div>
        </div>
    </div>
</div>
@endsection