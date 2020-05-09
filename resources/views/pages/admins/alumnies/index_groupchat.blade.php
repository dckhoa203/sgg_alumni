@extends('layouts.admin')
@section('content')
<!-- row -->
<div class="chat-main-box">
        <!-- .chat-left-panel -->
        <div class="chat-left-aside">
            <div class="open-panel"><i class="ti-angle-right"></i></div>
            <div class="chat-left-inner">
                <div class="form-material">
                    <input class="form-control p-20" type="text" placeholder="Search Contact">
                </div>
                <ul class="chatonline style-none ">
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_admin.jpg')}}" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="active"><img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                    </li>
                    <li class="p-20"></li>
                </ul>
            </div>
        </div>
        <!-- .chat-left-panel -->
        <!-- .chat-right-panel -->
        <div class="chat-right-aside">
            <div class="chat-main-header">
                <div class="p-20 b-b">
                    <h3 class="box-title">Chat Message</h3>
                </div>
            </div>
            <div class="chat-box">
                <ul class="chat-list slimscroll p-t-30">
                    <li>
                        <div class="chat-image"> <img alt="male" src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Ritesh</h4>
                                <p> Hi, Genelia how are you and my son? </p>
                                <b>10.00 am</b> </div>
                        </div>
                    </li>
                    <li class="odd">
                        <div class="chat-image"> <img alt="Female" src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Genelia</h4>
                                <p> Hi, How are you Ritesh!!! We both are fine sweetu. </p>
                                <b>10.03 am</b> </div>
                        </div>
                    </li>
                    <li>
                        <div class="chat-image"> <img alt="male" src="{{asset('/images/myfiles_cit/avatar_admin.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Ritesh</h4>
                                <p> Oh great!!! just enjoy you all day and keep rocking</p>
                                <b>10.05 am</b> </div>
                        </div>
                    </li>
                    <li class="odd">
                        <div class="chat-image"> <img alt="Female" src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Genelia</h4>
                                <p> Your movei was superb and your acting is mindblowing </p>
                                <b>10.07 am</b> </div>
                        </div>
                    </li>
                </ul>
                <div class="row send-chat-box">
                    <div class="col-sm-12">
                        <textarea class="form-control" placeholder="Type your message"></textarea>
                        <div class="custom-send"><a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="Insert Emojis"><i class="ti-face-smile"></i></a> <a href="javacript:void(0)" class="cst-icon" data-toggle="tooltip" title="File Attachment"><i class="fa fa-paperclip"></i></a>
                            <button class="btn btn-danger btn-rounded" type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .chat-right-panel -->
    </div>
    <!-- /.row -->
{{-- <div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="white-box">
            <h3 class="box-title">You have 5 new messages</h3>
            <div class="message-center">
                <a href="#">
                    <div class="user-img"> <img src="{{asset('/images/myfiles_cit/avatar_admin.jpg')}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5>Teacher</h5>
                        <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                </a>
                <a href="#">
                    <div class="user-img"> <img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5>Sonu Nigam</h5>
                        <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                </a>
                <a href="#">
                    <div class="user-img"> <img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5>Arijit Sinh</h5>
                        <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                </a>
                <a href="#">
                    <div class="user-img"> <img src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5>Genelia Deshmukh</h5>
                        <span class="mail-desc">I love to do acting and dancing</span> <span class="time">9:08 AM</span> </div>
                </a>
                <a href="#" class="b-none">
                    <div class="user-img"> <img src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                    <div class="mail-contnet">
                        <h5>Pavan kumar</h5>
                        <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="white-box">
            <h3 class="box-title">Chat</h3>
            <div class="chat-box">
                <ul class="chat-list slimscroll" style="overflow: hidden;" tabindex="5005">
                    <li>
                        <div class="chat-image"> <img alt="male" src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Sonu Nigam</h4>
                                <p> Hi, All! </p>
                                <b>10.00 am</b> </div>
                        </div>
                    </li>
                    <li class="odd">
                        <div class="chat-image"> <img alt="Female" src="{{asset('/images/myfiles_cit/avatar_woman.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Genelia</h4>
                                <p> Hi, How are you Sonu? ur next concert? </p>
                                <b>10.03 am</b> </div>
                        </div>
                    </li>
                    <li>
                        <div class="chat-image"> <img alt="male" src="{{asset('/images/myfiles_cit/avatar_man.jpg')}}"> </div>
                        <div class="chat-body">
                            <div class="chat-text">
                                <h4>Ritesh</h4>
                                <p> Hi, Sonu and Genelia, </p>
                                <b>10.05 am</b> </div>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Say something">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button">Send</button>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection