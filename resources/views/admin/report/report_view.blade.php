@extends('admin.layouts.app')
@section('content')

<div class="row">
<div class="col-sm-4">
<div class="card-body card card-primary">
<div class="card-header">
<h3 class="card-title">Search By Date</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<?php echo Form::open(['route' => 'admin.search-by-date','autocomplete'=>false]);
?>
<div class="card-body">
<div class="form-group">
<label>Select Date </label>
<?php echo Form::date('date', null,['class'=>'form-control']); ?>
@error('date')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<?php echo Form::submit('Search',['class' => 'btn btn-large btn-primary openbutton']); ?>
</div>
<?php echo Form::close(); ?>
</div>
</div>
</div>


<div class="col-sm-4">
    <div class="card-body card card-primary">
    <div class="card-header">
    <h3 class="card-title">Search By Month</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php echo Form::open(['route' => 'admin.search-by-month','autocomplete'=>false]);
    ?>
    <div class="card-body">
    <div class="form-group">
    <label>Select Month</label>
    <?php echo Form::selectMonth('month', null, ['class'=>'form-control']); ?>
    @error('month')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <div class="form-group">
    <label>Select Year</label>
    <?php echo Form::selectYear('year_name', 2020, 2025, null, ['class'=>'form-control']); ?>
    @error('year_name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <div class="form-group">
    <?php echo Form::submit('Search',['class' => 'btn btn-large btn-primary openbutton']); ?>
    </div>
    <?php echo Form::close(); ?>
    </div>
    </div>
    </div>


    <div class="col-sm-4">
        <div class="card-body card card-primary">
        <div class="card-header">
        <h3 class="card-title">Select Year</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php echo Form::open(['route' => 'admin.search-by-year','autocomplete'=>false]);
        ?>
        <div class="card-body">
        <div class="form-group">
        <label>Select Year</label>
        <?php echo Form::selectYear('year', 2020, 2025, null, ['class'=>'form-control']); ?>
        @error('year')
        <span class="text-danger">{{ $message }}</span>
        @enderror
       </div>

        <div class="form-group">
        <?php echo Form::submit('Search',['class' => 'btn btn-large btn-primary openbutton']); ?>
        </div>
        <?php echo Form::close(); ?>
        </div>
        </div>
        </div>

</div>
@endsection