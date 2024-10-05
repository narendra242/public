<form method="POST" enctype="multipart/form-data" class="upload_image_form" action="javascript:void(0)" >
    <div class="form-group">
    <label>Title</label>
    <?php echo Form::text('title', null,['class'=>'form-control']); ?>
    <span class="text-danger small error-text title_error"> </span>
     </div>  
    <div class="form-group">
    <label class="ltitle">Image Upload</label>
    <div class="input-group">
    <div class="custom-file">
    <?php echo Form::file('image',array('class' => 'custom-file-input')); ?>
    <label class="custom-file-label">Choose file</label>
    </div>
    </div>
    <span class="text-danger small error-text image_error"> </span>
    </div>
    <div class="modal-footer">
    <input type="hidden" data-service="{{$data->product_id}}" value="{{$data->id}}" name="product_id">
    <button type="submit" class="btn btn-success" id="formSubmit">Submit</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
    </form>
    </div>

    <div class="col-md-12">
    <table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">Sr no</th>
    <th scope="col">Title</th>
    <th scope="col">Photo</th>
    <th scope="col">Action</th>      
    </tr>
    </thead>
    <tbody id="imd">
    @if(!$datas->isEmpty())
    @foreach($datas as $records)
    <tr id="dels{{ $records->id }}">
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{ $records->title }}</td>
    <td>
    @if(!empty($records->image))
    <img width="50" src="<?php echo asset("product_more_images/$records->image")?>">
    @else
    <img width="80" src="<?php echo asset("images/no-image-available.jpg")?>"> 
    @endif
    </td>
    <td>
    <a id="delete_single" data-url="product/imgdelete" data-id="{{ $records->id }}" data-token="{{ csrf_token() }}"> <i class="btn btn-danger typcn typcn-trash"></i></a></td>
    </tr>
    @endforeach
    @else
    <tr id="trhides">
    <td colspan="4">No record found</td>
    </tr>
    @endif
    </tbody>
    </table>
  <script type="text/javascript">
  $('.custom-file input').change(function (e) {
  if (e.target.files.length) {
  $(this).next('.custom-file-label').html(e.target.files[0].name);
  }
  });
  </script>
    <script>
   $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('.upload_image_form').submit(function(e) {  
    var formData = new FormData(this); 
    var url = "<?php echo asset("product_more_images")?>";
    $.ajax({
    type:'POST',
    url: "{{ route('admin.product.addimages')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => { 
    this.reset(data);
    if(data.status == 0){
    $.each(data.error, function(prefix, val){
    $('span.'+prefix+'_error').text(val[0]);
    });
    }else{
    alert(data.msg);
    var html = '<tr id="dels'+data.datas.id+'">';
     html += '<td>'+data.datas.id+'</td>';
     html += '<td>'+data.datas.title+'</td>';
     html += '<td><img width="50" src='+url+'/'+data.datas.image+'></td>';
     html += '<td><a id="delete_single" data-url="product/imgdelete" data-id="'+data.datas.id+'"> <i class="btn btn-danger typcn typcn-trash"></i></a></td></tr>';
     $('#imd').prepend(html);
     $('#upload_image_form')[0].reset();
     $('#trhides').hide();
    }
    },
    });
    });
    </script>
   

  </div>

  