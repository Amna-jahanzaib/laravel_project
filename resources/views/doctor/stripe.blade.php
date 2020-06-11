@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Make Withdrwal </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Pauout</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<div class="card">
    <div class="card-header">
        Payment Details
    </div>

    <div class="card-body">
        <div class="form-group">
              <!-- title row -->
              <div class="row ">
              <div class="col-md-3 ">
              </div>

        <div class="col-md-6 ">
            <div class="panel panel-default credit-card-box">

                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form role="form" action="{{ route('transfer') }}" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                        @csrf
  
                        <div class='form-row'>
<div class='col-xs-12 col-md-12 form-group required'>
<label class='control-label'>Name on Card</label> <input
class='form-control' name="name" size='4' type='text' requieds>
</div>
</div>
<div class='form-row'>
<div class='col-xs-12 col-md-12 form-group required'>
<label class='control-label'>Name on Card</label> 
<select class='form-control' name="type" requied>
<option value="individual">Individual</option>
</select>
</div>
</div>
<div class='form-row'>
<div class='col-xs-12 col-md-12 form-group required'>
<label class='control-label'>Tax ID</label> <input
class='form-control' name="tax_id" size='4' type='text' requieds>
</div>
</div>


<div class='form-row'>
<div class='col-xs-12  col-md-12 form-group card required'>
<label class='control-label'>Card Number</label> <input
autocomplete='off' class='form-control card-number' size='20'
type='text'>
</div>
</div>
<div class='form-row'>
<div class='col-xs-4  col-md-4 form-group cvc required'>
<label class='control-label'>CVC</label> <input autocomplete='off'
class='form-control card-cvc' placeholder='ex. 311' size='4'
type='text'>
</div>
<div class='col-xs-4 col-md-4 form-group expiration required'>
<label class='control-label'>Expiration</label> <input
class='form-control card-expiry-month' placeholder='MM' size='2'
type='text'>
</div>
<div class='col-xs-4 col-md-4 form-group expiration required'>
<label class='control-label'> Year</label> <input
class='form-control card-expiry-year' placeholder='YYYY' size='4'
type='text'>
</div>
</div>
<div class='form-row'>
<div class='col-md-12'>
<div class='form-control total'>
<a href="https://connect.stripe.com/express/oauth/authorize?client_id=ca_32D88BD1qLklliziD7gYQvctJIhWBSQ7&state={STATE_VALUE}&suggested_capabilities[]=transfers&stripe_user[email]=ak877307@gmail.com" class="btn btn-primary">connect with stripe</a>
</div>
</div>
</div>
<div class='form-row'>
<div class='col-md-12 form-group'>
<button class='form-control btn btn-primary submit-button'
type='submit' style="margin-top: 10px;">Pay »</button>
</div>
</div>
<div class='form-row'>
<div class='col-md-12 error form-group hide'>
<div class='alert-danger alert'>Please correct the errors and try
again.</div>
</div>
</div>
</form>                </div>
        </div>
    </div>



                </div>
              </div>
            </div>
        </div>
    </div>
</div>
  
@endsection
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  
  });
var x;  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
    
    //4242 4242 4242 4242
   
   
});
</script>
@endsection
