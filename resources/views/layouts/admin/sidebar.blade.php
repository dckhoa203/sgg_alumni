<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
    <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
    </span> </div>
                <!-- /input-group -->
            </li>

            
                {{-- TODO: QUẢN LÝ KHOA --}}
                
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                    <li> 
                        <a href="{{route('khoa-vien/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ PHÒNG BAN</span></a> 
                        <ul class="nav nav-second-level">
                            <li> <a href="{{route('khoa-vien/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">KHOA/VIỆN</span></a> </li>
                            {{-- TODO: QUẢN LÝ NGÀNH --}}
                            <li> <a href="{{route('major/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">NGÀNH HỌC</span></a> </li>
                            {{-- TODO: QUẢN LÝ CHUYÊN NGÀNH --}}
                            <li> <a href="{{route('major_branch/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">CHUYÊN NGÀNH</span></a> </li>
                            {{-- TODO: QUẢN LÝ LỚP --}}
                            <li> <a href="{{route('class/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">LỚP</span></a> </li>
                        </ul>
                    </li>
                @else
                    <li> 
                        {{-- <a href="{{route('khoa-vien/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DANH SÁCH PHÒNG BAN</span></a>  --}}
                        <ul class="nav nav-second-level">
                            {{-- <li> <a href="{{route('khoa-vien/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">KHOA/VIỆN</span></a> </li> --}}
                            {{-- TODO: QUẢN LÝ NGÀNH --}}
                            {{-- <li> <a href="{{route('major/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">NGÀNH HỌC</span></a> </li> --}}
                            {{-- TODO: QUẢN LÝ CHUYÊN NGÀNH --}}
                            {{-- <li> <a href="{{route('major_branch/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">CHUYÊN NGÀNH</span></a> </li> --}}
                            @if (Auth::check() && Auth::user()->hasRole('Teacher') || Auth::check() && Auth::user()->hasRole('Manager'))
                                {{-- TODO: QUẢN LÝ LỚP --}}
                                <li> <a href="{{route('class/index_teacher')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">LỚP</span></a> </li>
                            @endif
                        </ul>
                    </li>
                @endif                
                
                
                {{-- TODO: QUẢN LÝ THÔNG TIN SINH VIÊN --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                    <li> <a href="{{route('students.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ SINH VIÊN</span></a> </li>
                @else
                    @if (Auth::check() && Auth::user()->hasRole('Manager') || Auth::check() && Auth::user()->hasRole('Teacher'))
                        <li> <a href="{{route('students.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DANH SÁCH SINH VIÊN</span></a> </li>
                    @endif
                @endif
                {{-- TODO: QUẢN LÝ THÔNG TIN  GIÁO VIÊN--}}
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                    <li> <a href="{{route('teacher.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ GIẢNG VIÊN</span></a> </li>
                @else
                    @if (Auth::check() && Auth::user()->hasRole('Teacher'))
                        <li> <a href="{{route('teacher.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DANH SÁCH GIÁO VIÊN</span></a> </li>
                    @endif
                @endif
                
                {{-- TODO: QUẢN LÝ THÔNG TIN CỰU SINH VIÊN --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                    <li> <a href="{{route('alumnies/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ CỰU SINH VIÊN</span></a> </li>
                @else
                    @if (Auth::check() && Auth::user()->hasRole('Manager') || Auth::check() && Auth::user()->hasRole('Teacher'))
                    <li> <a href="{{route('alumnies/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DANH SÁCH CỰU SINH VIÊN</span></a> </li>
                    @endif
                @endif
                
                {{-- TODO: QUẢN LÝ BÀI ĐĂNG --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                    <li> 
                        <a href="{{route('posts.index')}}" class="waves-effect posts"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ BÀI ĐĂNG</span></a> 
                        <ul class="nav nav-second-level" class="sub-menu">
                            <li><a href="{{route('posts.index')}}">BẢN TIN</a></li>
                            <li><a href="{{route('posts.add_posts')}}">ĐĂNG BÀI</a></li>
                            <li><a href="javascript:void(0)" class="waves-effect">DANH SÁCH BẢN TIN<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="{{route('posts.categories_find_job')}}">TÌM VIỆC LÀM</a></li>
                                    <li> <a href="{{route('posts.categories_apply_job')}}">TUYỂN DỤNG VIỆC LÀM</a></li>
                                    <li> <a href="{{route('posts.categories_class_meeting')}}">HỌP LỚP</a></li>
                                    <li> <a href="{{route('posts.categories_support_scholarship')}}">HỖ TRỢ HỌC BỔNG</a></li>
                                    <li> <a href="{{route('posts.categories_donations')}}">HỖ TRỢ TRANG THIẾT BỊ</a></li>
                                    <li> <a href="{{route('posts.categories_notifications')}}">THÔNG BÁO KHÁC</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('posts.list_post')}}">DUYỆT BÀI</a></li>
                            <li><a href="{{route('posts.list_post_students')}}">BẢN TIN CHO SINH VIÊN</a></li>
                            <li><a href="{{route('posts.list_post_teachers')}}">BẢN TIN CHO GIẢNG VIÊN</a></li>
                            {{-- <li><a href="{{route('posts.post_yourself')}}">Bài đăng của mình đăng</a></li> --}}
                            <li><a href="{{route('posts.post_your_class')}}">BẢN TIN TRÊN LỚP CỦA TÔI</a></li>
                            <li><a href="{{route('posts.lists_account_blocked')}}">TÀI KHOẢN BỊ KHÓA</a></li>
                        </ul> 
                    </li>
                @else
                <li>
                    <a href="{{route('posts.index')}}" class="waves-effect posts"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">BẢN TIN</span></a> 
                    <ul class="nav nav-second-level" class="sub-menu">
                        <li><a href="{{route('posts.index')}}">BẢN TIN</a></li>
                        <li><a href="{{route('posts.add_posts')}}">ĐĂNG BÀI</a></li>
                        <li><a href="javascript:void(0)" class="waves-effect">DANH SÁCH BẢN TIN<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li> <a href="{{route('posts.categories_find_job')}}">TÌM VIỆC LÀM</a></li>
                                <li> <a href="{{route('posts.categories_apply_job')}}">TUYỂN DỤNG VIỆC LÀM</a></li>
                                <li> <a href="{{route('posts.categories_class_meeting')}}">HỌP LỚP</a></li>
                                <li> <a href="{{route('posts.categories_support_scholarship')}}">HỖ TRỢ HỌC BỔNG</a></li>
                                <li> <a href="{{route('posts.categories_donations')}}">HỖ TRỢ TRANG THIẾT BỊ</a></li>
                                <li> <a href="{{route('posts.categories_notifications')}}">THÔNG BÁO KHÁC</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('posts.list_post_students')}}">BẢN TIN CHO SINH VIÊN</a></li>
                        @if (Auth::check() && Auth::user()->hasRole('Teacher') || Auth::check() && Auth::user()->hasRole('Manager'))
                            <li><a href="{{route('posts.list_post_teachers')}}">BẢN TIN CHO GIẢNG VIÊN</a></li>
                        @endif
                        {{-- <li><a href="{{route('posts.post_yourself')}}">Bài đăng của mình đăng</a></li> --}}
                        <li><a href="{{route('posts.post_your_class')}}">BẢN TIN TRÊN LỚP CỦA TÔI</a></li>
                    </ul>
                </li>
                @endif


                {{-- TODO: QUẢN LÝ KHẢO SÁT --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin') || Auth::check() && Auth::user()->hasRole('Manager'))
                    <li> <a href="{{route('survey.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ KHẢO SÁT</span></a> </li>
                @else
                    @if (Auth::check() && Auth::user()->hasRole('Alumni') || Auth::check() && Auth::user()->hasRole('Student') || Auth::check() && Auth::user()->hasRole('Teacher'))
                        <li> <a href="{{route('survey.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">THỰC HIỆN KHẢO SÁT</span></a> </li>
                    @endif
                @endif
                {{-- SEND EMAIL --}}
                @if (Auth::check() && Auth::user()->hasRole('Alumni') || Auth::check() && Auth::user()->hasRole('Student') || Auth::check() && Auth::user()->hasRole('Teacher'))
                    <li> <a href="{{route('mails.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">GMAIL</span></a> </li>
                @endif
                {{-- TODO: QUẢN LÝ THỐNG KÊ --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin') || Auth::check() && Auth::user()->hasRole('Manager'))
                <li> 
                    <a href="{{route('statistic.student')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ THỐNG KÊ</span></a>
                    <ul class="nav nav-second-level"> 
                        {{-- TODO: THỐNG KÊ SINH VIÊN TỐT NGHIỆP --}}
                        <li> <a href="{{route('statistic.student')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">TỐT NGHIỆP</span></a> </li>
                        {{-- TODO: THỐNG KÊ THEO FORM --}}
                        <li> <a href="{{route('statistic.show_surveys')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">KHẢO SÁT</span></a> </li>
                        {{-- TODO: THỐNG KÊ vIỆC LÀM --}}
                        <li> <a href="{{route('statistic.job')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">VIỆC LÀM</span></a> </li>
                        {{-- TODO: THỐNG KÊ vIỆC LÀM THỰC TẾ --}}
                        <li> <a href="{{route('statistic.job_profile')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">VIỆC LÀM THỰC TẾ</span></a> </li>
                    </ul>
                </li>
                @endif
                
                {{-- PHÂN QUYỀN  --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin') || Auth::check() && Auth::user()->hasRole('Manager'))
                    <li> <a href="{{route('permissions/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">QUẢN LÝ PHÂN QUYỀN</span></a> </li>
                @endif
                {{-- IMPORT --}}
                @if (Auth::check() && Auth::user()->hasRole('Admin'))
                <li>
                    <a href="{{route('imports.index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">IMPORT</span></a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->hasRole('Teacher'))
                    <li> <a href="{{route('lop_co_van/index')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">DANH SÁCH LỚP CỐ VẤN</span></a> </li>
                    
                @endif

                @if (Auth::check() && Auth::user()->hasRole('Alumni') || Auth::check() && Auth::user()->hasRole('Teacher'))
                <li>
                    <a href="#" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">LỚP CỦA TÔI</span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('alumnies.myClass')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">LỚP CỦA TÔI</span></a> </li>
                        <li><a href="{{route('alumnies.myClass.groupChat')}}" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">GROUP CHAT</span></a> </li>
                    </ul> 
                </li>
                @endif
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->
