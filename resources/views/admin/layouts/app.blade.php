<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $pageTitle ?? config('app.name', 'Admin') }}</title>
<link rel="stylesheet" href="{{ asset('css/typicons.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" />
<script src="{{ asset('js/jquery.min.js')}}"></script>
@yield('css_role_page')
<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js')}}"></script>
 
</head>
<body>
<div class="container-scroller">
<!-- partial:partials/_navbar.html -->
@include('admin.layouts.topnavbar')
<!-- partial -->

<div class="container-fluid page-body-wrapper">
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
@include('admin.layouts.left_panel')
</nav>
<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
@yield('content')
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
@include('admin.layouts.footer')
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<script src="{{ asset('js/validation.js')}}"></script>
@yield('js_role_page')
<script src="{{ asset('js/vendor.bundle.base.js')}}"></script>
<script src="{{ asset('js/off-canvas.js')}}"></script>
<script src="{{ asset('js/template.js')}}"></script>
<script src="{{ asset('js/Chart.min.js')}}"></script>
<script src="{{ asset('js/dashboard.js')}}"></script>
<script src="{{ asset('js/code.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
$('.custom-file input').change(function (e) {
if (e.target.files.length) {
$(this).next('.custom-file-label').html(e.target.files[0].name);
}
});
</script>

</body>
</html>
