
<!doctype html>
<html lang="en">

<head>
    @include('backend.layouts.header')
</head>
<body class="theme-blue">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('admin/assets/images/loader.webp')}}" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

   @include('backend.layouts.nav')
   @include('backend.layouts.sidebar')

    @yield('content')

</div>
@include('backend.layouts.footer')
</body>
</html>
