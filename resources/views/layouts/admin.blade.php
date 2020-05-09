<!DOCTYPE html>
<html lang="en">
@include('layouts.admin.header')
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        @include('layouts.admin.navigation')
        @include('layouts.admin.sidebar')
        @include('layouts.admin.page')
    </div>
    @include('layouts.admin.js')
    @include('layouts.admin.custom_js')
    @include('layouts.admin.script')
</body>

</html>