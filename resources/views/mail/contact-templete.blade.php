<div style="background:#f3f3f3;">
<div style="padding:20px 0px 50px 0px">
<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td valign="top" align="center">
<table style="width:600px;max-width:96%" width="600" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td  valign="top" align="center">
<div style="background:#ffffff;font-family:Arial;font-weight:bold;vertical-align:middle;margin:0px 0px 0px 0px;border:none!important">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td align="left">
<div style="margin:24px 24px 24px 24px">
<h1 style="font:bold 26px Arial,sans-serif!important;color:#000000!important;margin:0;padding:0;text-align:left">Contact enquiry from {{ $data['title'] }}</h1>
</div>
</td>
</tr>
</tbody></table>
</div>

<div style="background:#ffffff;margin:0px 0px 0px 0px;border:none!important">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td valign="top" align="left">
<div style="margin:24px 24px 24px 24px">

<div>
<table style="width:552px;max-width:100%" width="552" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td valign="top">
<div style="color:#3d3d3d!important;font-family:Verdana,Geneva,sans-serif!important;font-size:14px!important;line-height:1.4em!important;font-weight:normal!important;font-style:normal!important">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tbody>

<tr>
<td width="100"><strong>Name : </strong></td>
<td>{{ $data['name'] }} </td>
</tr>
 

<tr>
<td width="100"><strong>Email : </strong></td>
<td>{{ $data['email'] }}  </td>
</tr>


<tr>
<td width="100"><strong>Phone : </strong></td>
<td>{{ $data['phone'] }}  </td>
</tr>
 
<tr>
<td width="100"><strong>Message : </strong></td>
<td>{{ $data['messages'] }}</td>
</tr>

<tr>
<td width="100"><strong>IP Address  : </strong></td>
<td>{{request()->ip()}}</td>
</tr>

</tbody></table>
<p style="margin:0 0 10px;padding:0">--<br>
This e-mail was sent from a contact enquiry form <br> <a href="{{ $data['weburl'] }}" rel="nofollow" target="_blank" >{{ $data['weburl'] }}</a></p>
</div>
</td>
</tr>
</tbody></table>
</div>

</div>
</td>
</tr>
</tbody></table>
</div>

<div style="background:#ffffff;margin:0px 0px 0px 0px;border:none!important">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td valign="middle" align="center">
<div style="margin:24px 24px 24px 24px">
<div style="font:normal 11px Arial,sans-serif!important;color:#999999!important;text-align:center">
<p style="text-align:center;margin-top:0;padding:0">
Copyright &copy; 2023 {{ $data['title'] }}. All Rights Reserved. 

</p> 
</div>
</div>
</td>
</tr>

</tbody></table>
</div>

</td>
</tr>
</tbody></table>
<br>
</td>
</tr>
</tbody></table>
</div>  
</div>
