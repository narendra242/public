@extends('admin.layouts.app')
@section('content')
<div class="card-body card card-primary">
<div class="card-header">
<h3 class="card-title">{{$head}}</h3>
</div>
<!-- /.card-header -->
<!-- form start -->
<?php  
if(isset($get_record)){
echo Form::model($get_record,array('id'=>'update','class' => 'states','url' => 'admin/states/update','autocomplete'=>false,'files'=>true,'method'=>'patch'));
echo Form::hidden('id');
} else {
echo Form::open(array('id'=>'create','class' => 'states','url' => 'admin/states/store','autocomplete'=>false,'files'=>true));
}
?>
<div class="card-body">
<div class="form-group">
<label>Division Name</label>
{!! Form::select('division_id', $divisions, old('division_id'), ['class' => 'form-control']) !!}
<span class="text-danger small error-text division_id_error"> </span>
</div>
<div class="form-group">
<label>District Name</label>
{!! Form::select('district_id', $districts, old('district_id'), ['id' => 'district_id','class' => 'form-control']) !!}
<span class="text-danger small error-text district_id_error"> </span>
</div>
<div class="form-group">
<label>State Name</label>
<?php echo Form::text('state_name', null,['class'=>'form-control']); ?>
<span class="text-danger small error-text state_name_error"></span>
</div>
<div class="form-group">
<label>Sort Order</label>
<select name="sort_order" id="sort_order" class="form-control">
{{ GeneralHelper::sortOrder(@$get_record->id,"ship_states","id","state_name") }}
</select>
</div>
<div class="form-group">
<label class="ltitle">Status</label>
<?php echo Form::select('status', array(1 => 'Yes', 0 => 'No'), null, array('class' => 'form-control')); ?>
</div>
<div class="form-group">
<?php echo Form::submit('Submit',['class' => 'btn btn-large btn-primary openbutton']); ?>
</div>
<?php echo Form::close(); ?>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="division_id"]').on('change', function(){
          var division_id = $(this).val();
          if(division_id) {
              $.ajax({
                  url: "{{ url('/admin/shipping/states/ajax') }}/"+division_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    console.log(data);
                    $('select[name="district_id"]').html('');
                       var d =$('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
  </script>
@endsection