@extends('admin.layouts.app')
@section('content')
<div class="card-body card card-primary">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<form method="POST" action="{{ route('admin.changepassword.store') }}">
@csrf 
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger">
<p>{{ $message }}</p>
</div>
@endif

<div class="card-body">
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
<p class="text-danger">{{ $error }}</p>
</div>
@endforeach 
<div class="form-group">
<label for="password" class="ltitle">Current Password</label>
<input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
</div>
<div class="form-group">
<label for="password" class="ltitle">New Password</label>
<input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
</div>
<div class="form-group">
<label for="password" class="ltitle">New Confirm Password</label>
<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
</div>
<div class="form-group">
<?php echo Form::submit('Submit',['class' => 'btn btn-large btn-primary openbutton']); ?>
</div>
</div>
</form>
</div>
@endsection