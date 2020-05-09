<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        @include('layouts.admin.breadcrumb')
        @yield('content')
        @include('layouts.admin.right_sidebar')
        @include('layouts.admin.footer')
        @include('layouts.admin.modal')
    </div>
</div>
<!-- /#page-wrapper -->
