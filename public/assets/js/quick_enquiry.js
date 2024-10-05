function rootpath() {
  var root = '/'
  return root
}
$(document).ready(function () {
  $('#quickid').on('submit', function (e) {
    e.preventDefault()
    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: new FormData(this),
      processData: false,
      dataType: 'json',
      contentType: false,
      beforeSend: function () {
        $(document).find('span.error-text').text('')
        $('#quickid').after('<span class="wait"></span>')
        $('#quickid').attr('disabled', true)
      },
      complete: function () {
        $('.wait').remove()
        $('#quickid').attr('disabled', false)
      },
      success: function (data) {
        if (data.status == 0) {
          $.each(data.error, function (prefix, val) {
            $('span.' + prefix + '_error').text(val[0])
          })
        } else {
          toastr.success(data.msg)
          $('#quickid')[0].reset()
        }
      },
    })
  })

  $('#contactid').on('submit', function (e) {
    e.preventDefault()
    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: new FormData(this),
      processData: false,
      dataType: 'json',
      contentType: false,
      beforeSend: function () {
        $(document).find('span.error-text').text('')
      },
      success: function (data) {
        if (data.status == 0) {
          $.each(data.error, function (prefix, val) {
            $('span.' + prefix + '_error').text(val[0])
          })
        } else {
          $('#contactid')[0].reset()
          alert(data.msg)
        }
      },
    })
  })

  $('#tourid').on('submit', function (e) {
    e.preventDefault()
    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: new FormData(this),
      processData: false,
      dataType: 'json',
      contentType: false,
      beforeSend: function () {
        $(document).find('span.error-text').text('')
      },
      success: function (data) {
        if (data.status == 0) {
          $.each(data.error, function (prefix, val) {
            $('span.' + prefix + '_error').text(val[0])
          })
        } else {
          $('#tourid')[0].reset()
          alert(data.msg)
        }
      },
    })
  })
 
})
