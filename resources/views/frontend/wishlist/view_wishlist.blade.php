@extends('layouts.nav')
@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
<div class="container"><!-- STRART CONTAINER -->
<div class="row align-items-center">
<div class="col-md-6">
<div class="page-title">
<h1>Wishlist Cart</h1>
</div>
</div>
<div class="col-md-6">
<ol class="breadcrumb justify-content-md-end">
<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li> 
<li class="breadcrumb-item active">Wishlist Cart</li>
</ol>
</div>
</div>
</div><!-- END CONTAINER-->
</div>
<!-- END MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
<div class="container">
<div class="row">
<div class="col-12">
<table class="table">
<thead>
<tr>
<th colspan="4" class="heading-title">My Wishlist</th>
</tr>
</thead>
<tbody id="wishlist">
</tbody>
</table>
</div>
</div>


</div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
@endsection