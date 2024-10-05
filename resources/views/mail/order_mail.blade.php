<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: green;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: green;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          <!-- {{-- <img src="" alt="" width="150"/> --}} -->
          <h2 style="color: green; font-size: 26px;"><strong> {{ $data['general']->title }}</strong></h2>
        </td>
        <td align="right">
        <pre class="font" >
        {{ $data['general']->title }} Head Office
        Email:{{ $data['general']->email }} <br>
        Website:{{ $data['general']->weburl }} <br>
        Mob: {{ $data['general']->phone }} <br>
        {{ strip_tags($data['general']->address) }} <br>
        </pre>
        </td>
    </tr>

  </table>


  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
          <strong>Name:</strong> {{ $data['name'] }}<br>
           <strong>Email:</strong> {{ $data['email'] }} <br>
           <strong>Phone:</strong> {{ $data['phone'] }} <br>
            
           @php
            $dis = $data['district']->district_name;
            $state = $data['state'];
           @endphp

           <strong>Address:</strong> {{ $dis }}.{{ $state }} <br>
           <strong>Post Code:</strong> {{ $data['post_code'] }}
         </p>
        </td>
        <td>
          <p class="font">
          <h3><span style="color: green;">Invoice:</span> #{{ $data['invoice_no']}}</h3>
            Order Date: {{ $data['order_date'] }} <br>
             Delivery Date: {{ $data['delivered_date'] }} <br>
            Payment Type : {{ $data['payment_method'] }} </span>
         </p>
        </td>
    </tr>
  </table>
  <br/>
<h3>Products</h3>
  <table width="100%">
    <thead style="background-color: green; color:#FFFFFF;">
      <tr class="font">
        <th>Image</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>
    @foreach($data['orderItem'] as $item)
      <tr class="font">
        <td align="center">
        <img src="{{ public_path('product_images/'.$item->product->image)  }}" height="60px;" width="60px;" alt="">
        </td>
        <td align="center"> {{ $item->product->title }}</td>
        <td align="center">
        @if($item->size == NULL)
        ----
        @else
        {{ $item->size }}
        @endif
        </td>
        <td align="center">
        @if($item->color == NULL)
        ----
        @else
        {{ $item->color }}
        @endif  
        </td>
        <td align="center">{{ $item->product->product_code }}</td>
        <td align="center">{{ $item->qty }}</td>
        <td align="center"><i class="fa fa-rupee"></i><span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span> {{ $item->price }}</td>
        <td align="center"><i class="fa fa-rupee"></i><span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span> {{ $item->price * $item->qty }} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
        <h2><span style="color: green;">Subtotal: </span><span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>{{ $data['amount'] }}</h2>
            <h2><span style="color: green;">Total: </span><span style="font-family: DejaVu Sans, sans-serif;">&#8377;</span>{{ $data['amount'] }}</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
        </td>
    </tr>
  </table>
  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>
  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>