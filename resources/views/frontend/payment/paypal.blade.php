@extends('layouts.nav')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-container">  
<div class="wrapper">
<ol class="breadcrumb">
<li class="breadcrumb-item active"><a href="{{route('mycart')}}">Cart</a></li>
<li class="breadcrumb-item active">Payment Status</li>
</ol>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Payment Status</h1>
@if (session()->has('success'))
<div class="alert alert-success">
{{ session()->get('success') }}
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger">
{{ session()->get('error') }}
</div>
@endif

</div>
</div>

@endsection