<div class="comment-area">


<div class="content_title">
<h5>Write a comment</h5>
</div>
<form class="field_form" method="POST" autocomplete="off" id="quickid" action="{{route('contact.send')}}">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="row">
<div class="form-group col-md-6 mb-3">
<input name="name" id="name" class="form-control" placeholder="Your Name" type="text">
<span class="text-danger small error-text name_error" id="name_error"></span>
</div>
<div class="form-group col-md-6 mb-3">
<input name="email" id="email" class="form-control" placeholder="Your Email" type="email">
<span class="text-danger small error-text email_error" id="email_error"></span>
</div>

<div class="form-group col-md-6 mb-3">
<input placeholder="Enter Phone No. *" id="phone" class="form-control" name="phone">
<span class="text-danger small error-text name_error" id="phone_error"></span>
</div>
<div class="form-group col-md-6 mb-3">
<input placeholder="Enter City" id="city" class="form-control" name="city">
<span class="text-danger small error-text name_error" id="city_error"></span>

</div>

<div class="form-group col-md-12 mb-3">
<textarea rows="3" name="messages" id="messages" class="form-control" placeholder="Your Comment"></textarea>
</div>

<div class="form-group col-md-12 mb-3">
<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
@if ($errors->has('g-recaptcha-response'))
<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
@endif
<span class="text-danger  small error-text g-recaptcha-response_error"> </span>
</div>

<div class="form-group col-md-12 mb-3">
<input type="hidden" class="form-control" name="page_url" id="page_url" value="{{url()->current()}}">
<button value="Submit" name="submit" id="quickid" class="btn btn-fill-out" title="Submit Your Message!" type="submit">Submit</button>
</div>
</div>
</form>
</div>