<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Hv Expert" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('frontend.includes.metanames')
<link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.png')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">	 
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">    
<link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/simple-line-icons.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.theme.css')}}">
<link rel="stylesheet" href="{{asset('assets/owlcarousel/css/owl.theme.default.min.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}"> 
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/toastr.css')}}">
<script src="{{asset('assets/js/jquery-3.7.0.min.js')}}"></script> 
@if(!empty(GeneralHelper::Generals()->analytics))
{!!GeneralHelper::Generals()->analytics!!}
@endif

@if(Route::is('index') )
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Corporation",
  "name": "the hve closet",
  "url": "https://www.thehvecloset.com/",
  "logo": "https://www.thehvecloset.com/general_images/hve_1709968006.jpg",
  "sameAs": [
    "https://www.facebook.com/thehveclosetstore",
    "https://www.instagram.com/thehvecloset/",
    "https://www.pinterest.com/thehve",
    "https://www.youtube.com/@thehvecloset9867"
  ]
}
</script>

<meta property="og:title" content="Online Hand Bag, Tote Bag, Sling Bag, Cotton Scarf by The Hve Closet.">
<meta property="og:site_name" content="the hve closet">
<meta property="og:url" content="https://www.thehvecloset.com/">
<meta property="og:description" content="Explore wide range of stylish and affordable hand bags, Tote Bags, Sling Bags, Cotton Scarf at The Hve Closet. Shop online customize bags that suit every occasion.">
<meta property="og:type" content="website">
<meta property="og:image" content="https://www.thehvecloset.com/general_images/hve_1709968006.jpg">
@endif

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '800596011900113');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=800596011900113&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

</head> 
<body>
 
@include('frontend.common.header')
@yield('content')
@include('frontend.common.footer')
<!-- aos js -->


<!-- quick_enquiry js -->
<script src="{{asset('assets/js/quick_enquiry.js')}}"></script>
<!-- sweetalert2 min js  --> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- toastr min js  --> 
<script type="text/javascript" src="{{asset('assets/js/toastr.min.js')}}"></script>
<!-- recaptchajs  --> 
<script defer src='https://www.google.com/recaptcha/api.js?onload=onloadCallback'></script>

<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('assets/owlcarousel/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('assets/js/magnific-popup.min.js')}}"></script> 
<script src="{{asset('assets/js/waypoints.min.js')}}"></script> 
<script src="{{asset('assets/js/parallax.js')}}"></script> 
<script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script> 
<script src="{{asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/isotope.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dd.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.elevatezoom.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
 
<script type="text/javascript">
    $.ajaxSetup({
    headers:{
    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
    })
    function addToCart(id){
    var quantity = 1;
    $.ajax({
    type:"POST",
    dataType:"json",
    data:{
    quantity:quantity,id:id,
    },
    url:"{{ url('/cart/data/store') }}" + '/' + id,
    success:function(data){
    miniCart();
    window.location="{{ url('mycart') }}",
    $('#closeModel').click();
    const Toast = Swal.mixin({
    toast:true,
    position: 'top-end',
    icon: 'success',
    showConfirmButton: false,
    timer: 3000
    })
    if($.isEmptyObject(data.error))
    {
    Toast.fire({
    type:'success',
    title:data.success,
    })
    }
     else {
    Toast.fire({
    type:'error',
    title:data.error,
    })
    }
    }
    })
    }
    
function goToCart(){
var product_name = $('#pname').text();
var id = $('#product_id').val();
var user_name = $('#user_name').val();
var color = $(".cactive").attr("color-title");
var size = $(".sactive").attr("size-title");
const Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000
})  
if(color==null){
Toast.fire({
type:'error',    
"title": "Select Color!",
})
return false;
}
if(size==null){
Toast.fire({
type:'error',    
"title": "Select Size!",
})
return false;
} 
var quantity = $('#qty').val();
$.ajax({
type:"POST",
dataType:"json",
data:{
color:color,size:size,quantity:quantity,product_name:product_name,user_name:user_name,
},
url:"{{ url('/cart/data/store') }}" + '/' + id,
success:function(data){
    miniCart();
    $('#closeModel').click();
    if($.isEmptyObject(data.error))
    {
    Toast.fire({
    type:'success',
    title:data.success,
    })
    }
    else {
    Toast.fire({
    type:'error',
    title:data.error,
    })
    }
    }
    })
}
    function miniCart(){
    $.ajax({
     type:'GET',
     url:"{{ url('/product/mini/cart') }}",
     dataType:'json',
     success:function(response){
      couponCalculation();
     var rows = '';
     var rowss = '';
    $.each(response.carts,function(key,value){
        var total = (value.price);
        var subtotal = (value.subtotal);
        rows += `<li>
        <a id="${value.rowId}" onclick="cartRemove(this.id)" title="Remove" class="item_remove"><i class="ion-close"></i></a>
        <a href="{{url('product/${value.options.slug_url}')}}"><img src="{{asset('product_images/${value.options.image}')}}" alt="cart_thumb1">${value.name}</a>
        <span class="cart_quantity"> ${value.qty} x <span class="cart_amount"> <span class="price_symbole"></span></span>${total}</span>
        </li>`;
     });
    if(response.cartTotal!=0.00){ 
    rowss += `<div class="cart_footer">
    <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole"><i class="fa fa-${response.curIcons}"></i></span></span>${response.cartTotal}</p><p class="cart_buttons"><a href="{{route('mycart')}}" class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="{{route('checkout')}}" class="btn btn-fill-out rounded-0 checkout">Checkout</a></p> 
    </div>`;
    }
     $('#miniCart').html(rows);
     $('#CartSubTotals').html(rowss);
     $('span[id="CartSubTotals"]').text(response.cartTotal);
     $('#cart-total').text(response.cartQty);
     }
     })
    }
    miniCart();
    
    
    function cart(){
    $.ajax({
    type:'GET',
    url:"{{ url('/user/get-cart-product') }}",
    dataType:'json',
    success:function(response){
        var rows = '';
    $.each(response.carts,function(key,value){
        var total = (value.price);
        var subtotal = (value.subtotal);
        rows += `<tr>
        <td class="product-thumbnail"><a href="{{url('product/${value.options.slug_url}')}}"><img src="{{asset('product_images/${value.options.image}')}}" alt="${value.name}"></a></td>
        <td class="product-name" data-title="Product"><a href="{{url('product/${value.options.slug_url}')}}">${value.name}</a>
        <br> <span> ${value.options.size!='null'?"Size:" + value.options.size:''}</span><br><span>${value.options.color!='null'?"Color:" + value.options.color:''}</span>
        <span> ${value.options.user_name!=null?"Name:" + value.options.user_name:''}</span>
        </td>
        <td class="product-price" data-title="Price"><i class="fa fa-${response.curIcons}"></i> ${total}</td>
        <td class="product-quantity" data-title="Quantity"><div class="quantity">
        ${value.qty > 1 ? `<input type="button" id="${value.rowId}" onclick="cartDecrement(this.id)" value="-" class="minus">`:`<input type="button" disabled value="-" class="minus">` }
        <input type="text" name="quantity[${value.rowId}]" value="${value.qty}" title="Qty" class="qty" size="4">
        <input  type="button" id="${value.rowId}" onclick="cartIncrement(this.id)" value="+" class="plus">
        </div></td>
        <td class="product-subtotal" data-title="Total"><i class="fa fa-${response.curIcons}"></i> ${subtotal}</td>
        <td class="product-remove" id="${value.rowId}" onclick="cartRemove(this.id)" data-title="Remove"><a href="#"><i class="ti-close"></i></a></td>
        </tr>`;
        });
        $('#cartPage').html(rows);
        }
        })
        }
        cart();
    
    function cartRemove(id){
            $.ajax({
                type: 'GET',
                url:"{{ url('/user/cart-remove') }}" + '/' + id,
                dataType:'json',
                success:function(data){
                if (data.cartQty === 0) {
                // If the cart is empty, redirect the user to another page
                 window.location.href = "{{ route('index') }}"; // Replace with your desired URL
                 } else {
                   couponCalculation();
                   cart();
                   miniCart();
                   $('#couponField').show();
                   $('#coupon_name').val('');
                    const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            }
            });
        }
        
        
    function cartAllRemove(){
            $.ajax({
                type: 'GET',
                url:"{{ url('/user/cart-allremove') }}",
                dataType:'json',
                success:function(data){
                   couponCalculation();
                   cart();
                   miniCart();
                   window.location="{{ url('mycart') }}",
                   $('#couponField').show();
                   $('#coupon_name').val('');
                    const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          showConfirmButton: false,
                          timer: 3000
                        })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                
                }
                
            });
        }    
    //--Cart Increment---Start--//
    function cartIncrement(rowId){
    $.ajax({
        type:'GET',
        url:"{{ url('/cart-increment') }}" + '/' + rowId,
        dataType:"json",
        success:function(data){
        couponCalculation();
        cart();
        miniCart();
        }
    })
    }
    function cartDecrement(rowId){
    $.ajax({
        type:'GET',
        url:"{{ url('/cart-decrement') }}" + '/' + rowId,
        dataType:"json",
        success:function(data){
        couponCalculation();
        cart();
        miniCart();
        }
    })
    }
    </script>
<script type="text/javascript">
    function applyCoupon(){
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {coupon_name:coupon_name},
            url: "{{ url('/coupon-apply') }}",
            success:function(data){
             couponCalculation();
             if(data.validity == true){
             $('#couponField').hide();
              }
       const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
             })
          if ($.isEmptyObject(data.error)) {
             Toast.fire({
                type: 'success',
                icon: 'success',
                title: data.success
             })
          }else{
             Toast.fire({
                type: 'error',
                icon: 'error',
                title: data.error
             })
          }
          // End Message
          }
       })
    }
function couponCalculation(){
$.ajax({
typ:'GET',
url:"{{url('/coupon-calculation')}}",
dataType:'json',
success:function(data){
    if(data.total!=null){
    $('#couponCalField').html(
    `<tr>
    <td class="cart_total_label"><strong>Cart Subtotal</strong></td>
    <td class="cart_total_amount"><strong><i class="fa fa-${data.curIcons}"></i> ${data.total}</strong></td>
    </tr>
    <tr>
    <td class="cart_total_label"><strong>Total</strong></td>
    <td id="cart_total_amount" class="cart_total_amount"><strong><i class="fa fa-${data.curIcons}"></i> ${data.total} </strong></td>
    </tr>`
    )
    }
    else {
    $('#couponCalField').html(
    `<tr>
    <td class="cart_total_label"><strong>Cart Subtotal</strong></td>
    <td class="cart_total_amount"><i class="fa fa-${data.curIcons}"></i> ${data.subtotal}</td>
    </tr>

    <tr>
    <td class="cart_total_label"><strong>Coupon</strong></td>
    <td class="cart_total_amount">${data.coupon_name}
        <button type="button" onclick="couponRemove()"><i class="fa fa-trash"></i></button></td>

        </td> 
    </tr>
 
    <tr>
    <td class="cart_total_label"><strong>Discount Amount</strong></td>
    <td class="cart_total_amount"><i class="fa fa-${data.curIcons}"></i> ${data.discount_amount}</td>
    </tr>
 
    <tr>
    <td class="cart_total_label"><strong>Total</strong></td>
    <td id="cart_total_amount" class="cart_total_amount"><strong><i class="fa fa-${data.curIcons}"></i> ${data.total_amount} </strong></td>
    </tr>`
    )
    }
}
})
}
couponCalculation();

</script>
<script type="text/javascript">
function couponRemove(){
$.ajax({
    type:'GET',
    url:"{{url('/coupon-remove')}}",
    dataType:'json',
    success:function(data){
        couponCalculation();
        $('#couponField').show();
        $('#coupon_name').val('');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            })
        if ($.isEmptyObject(data.error)) {
            Toast.fire({
            type: 'success',
            icon: 'success',
            title: data.success
            })
        }else{
            Toast.fire({
            type: 'error',
            icon: 'error',
            title: data.error
            })
        }
        // End Message
    }
})
}
</script>


<script type="text/javascript">
function addToWishlist(product_id){
$.ajax({
type:'POST',
dataType:'json',
url:"{{ url('/add-to-wishlist') }}" + '/' + product_id,
success:function(data){
const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })
if ($.isEmptyObject(data.error)) {
    Toast.fire({
        type: 'success',
        icon: 'success',
        title: data.success
    })
}else{
    Toast.fire({
        type: 'error',
        icon: 'error',
        title: data.error
    })
}
// End Message
}
})
}
</script>
<script type="text/javascript">
function wishlist(){
$.ajax({
type:'GET',
url:"{{ url('/user/get-wishlist-product') }}",
dataType:'json',
success:function(response){
var rows = '';
$.each(response,function(key,value){
if(value.product.discount == null){
var totaldisc = value.product.price
} else {
var damount= value.product.discount/100*value.product.price;
var totaldisc = value.product.price-damount;
}
rows += `<tr>
<td class="col-md-2"><img src="{{asset('product_images/${value.product.image}')}}" alt="imga" style="width:85px; height:90px"></td>
<td class="col-md-7">
<div class="product-name"><a href="#">${value.product.title}</a></div>
<div class="price">
${value.product.discount == null
? `${totaldisc}`:`${totaldisc} <span>${value.product.price}</span>`}
</div>
</td>
<td class="col-md-2">
<button  class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)">
Add to Cart</button>
</td>
<td class="col-md-1 close-btn">
<button type="submit" class="" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fa fa-times"></i></button>
</td>
</tr>`;
});
$('#wishlist').html(rows);
}
})
}
wishlist();
function wishlistRemove(id){
$.ajax({
type: 'GET',
url:"{{ url('/user/wishlist-remove') }}" + '/' + id,
dataType:'json',
success:function(data){
wishlist();
const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    })
if ($.isEmptyObject(data.error)) {
    Toast.fire({
        type: 'success',
        icon: 'success',
        title: data.success
    })
}else{
    Toast.fire({
        type: 'error',
        icon: 'error',
        title: data.error
    })
}
// End Message
}
});
}
</script>



<script>
$(document).ready(function(){
function filter_data()
{
 $('.filter_data').html('<div id="loading" style="" ></div>');
  var color = get_filter('color');
  var size = get_csfilter('size');
  var brand = get_filter('brand');
  var sort = get_selector('price_sorting');
  var cat_id = $('#cat_id').val();
 
  $.ajax({
  url:"{{ url('/filter/product') }}",
  method:"POST",
  dataType:"json",
  data:{cat_id:cat_id,color:color,size:size,brand:brand,sort:sort},
  success:function(data){
  $('.filter_data').append(data);
  }
  });
  }

function get_filter(class_name)
{
var filter = [];
$('.'+class_name+':checked').each(function(){
filter.push($(this).val());
});

return filter;
}

function get_csfilter()
{
var filter = null;
$("#mySelectioncsBox span").each(function() {
filter= $(".sactive").attr("data-size");

});

return filter;
}

function get_selector(class_name)
{
var filter = null;    
$("#mySelectionBox select").each(function() {
filter = $(this).val();
});
return filter;
}
$('.common_selector').click(function(){
filter_data();
$('#list_view_product').hide();
});
});
</script>

<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type){
case 'info':
toastr.info("{{ Session::get('message') }}");
break;
case 'success':
toastr.success("{{ Session::get('message') }}");
break;
case 'warning':
toastr.warning("{{ Session::get('message') }}");
break;
case 'error':
toastr.error("{{ Session::get('message') }}");
break;
}
@endif
</script>    
</body>
</html>
