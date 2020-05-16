@extends('layouts.header-front')
@section('main-content')


<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
    <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Contact US  </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

          <!-- Main content -->
        <div class="row mb-2">
        <div class="col-sm-12">

        <div class="container-contact100">
		    <div class="wrap-contact100">

			    <form class="contact100-form validate-form" method="post" role="form" action="{{ route("admin.messages.store") }}">
                @csrf
								@if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif
				<span class="contact100-form-title">
					Send Us A Message
				</span>

				<label class="label-input100" for="first_name">Tell us your name *</label>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Type first name">
					<input id="first_name" class="input100" type="text" name="first_name" placeholder="First name">
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 rs2-wrap-input100 validate-input" data-validate="Type last name">
					<input class="input100" type="text" name="last_name" placeholder="Last name">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="email">Enter your email *</label>
				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input id="email" class="input100" type="text" name="email" placeholder="Eg. example@email.com">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="phone">Enter phone number</label>
				<div class="wrap-input100">
					<input id="phone" class="input100" type="text" name="phone" placeholder="Eg. +1 800 000000">
					<span class="focus-input100"></span>
				</div>

				<label class="label-input100" for="message">Message *</label>
				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<input type= "textarea" id="message" class="input100" name="message" placeholder="Write us a message">
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
               <button type="submit" name="submit" class="btn btn-warning">Send Message</button>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('{{asset('img/bg-01.jpg')}}');">
				<div class="flex-w size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-map-marker"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Address
						</span>

						<span class="txt2">
							Mada Center 8th floor, 379 Hudson St, New York, NY 10018 US
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-phone-handset"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							Lets Talk
						</span>

						<span class="txt3">
							+1 800 1236879
						</span>
					</div>
				</div>

				<div class="dis-flex size1 p-b-47">
					<div class="txt1 p-r-25">
						<span class="lnr lnr-envelope"></span>
					</div>

					<div class="flex-col size2">
						<span class="txt1 p-b-20">
							General Support
						</span>

						<span class="txt3">
							contact@example.com
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
                  </div>
                  <!-- /.col-lg-6 -->
                <!-- /.row -->

        </div><!-- /.row -->


    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-header -->
</div>


@endsection
