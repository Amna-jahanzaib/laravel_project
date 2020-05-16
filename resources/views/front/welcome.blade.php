@extends('layouts.header-front')
@section('main-content')
<!-- Navigation -->


<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('{{asset('dist/img/bg2.jpg')}}')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Find and Book a Speech Therapist </h2>
                    <p class="lead">Appointment right now </p>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('{{asset('dist/img/bg1.jpg')}}')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Find and Book a Speech Therapist </h2>
                    <p class="lead">Appointment right now </p>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('{{asset('dist/img/bg3.jpeg')}}')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Find and Book a Speech Therapist </h2>
                    <p class="lead">Book Appointment </p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

@if ($message = Session::get('success'))

    <div class="alert alert-success">
        <p>{{$message}}
    </div>
@endif
<!-- Page Content -->
<section class="py-5 text-center">
    <div class="container">
        <h2 class="text-center">Our Services</h2>
        <p class="text-muted mb-5 text-center">Search a Doctor and Book appointments online instantly!</p>
        <div class="row">

        <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-magnifier"></use>
                </svg>
                <h6>Search Doctors near You</h6>
                <p class="text-muted">Patients can search nearest speech therapists from their location.</p>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-earth"></use>
                </svg>
                <h6>Online Consultation</h6>
                <p class="text-muted">Now no worries about traffic jam issues or any other you can take your Speech therapy sessions from your home.</p>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-smile"></use>
                </svg>
                <h6>Speech Exercises</h6>
                <p class="text-muted">For patients we have diffrent types of speech exercises wher he/she can take speech exercises.</p>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-heart-pulse"></use>
                </svg>
                <h6>Qualified Doctors</h6>
                <p class="text-muted">Around 200+ qualified Speech Therapists work for Speech Assistant.</p>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-clock"></use>
                </svg>
                <h6>Online Appointments</h6>
                <p class="text-muted">Patients Can book Online Appointments from any where any time.</p>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <svg class="lnr text-primary services-icon">
                    <use xlink:href="#lnr-screen"></use>
                </svg>
                <h6>Online Sessions</h6>
                <p class="text-muted">Now no worries about traffic jam issues or any other you can take your Speech therapy sessions from your home.</p>
            </div>

        </div>
    </div>

</section>
<!-- about section -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">
                    <h1 class="heading bold">Thing You Love About Pakistan</h1>
                    <hr>
                </div>
            </div>
            <div class="col-md-6 col-sm-12" style="padding-right:15px; ">
                <img src="{{asset('dist/img/blog1.png')}}" class="img-responsive" alt="about img">
            </div>
            <div class="col-md-6 col-sm-12">
                <h3 class="bold">Fresh Environment</h3>
                <!-- Nav tabs -->
                <div class="container">
  <!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#home">Search</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu1">Book Appointment</a>
    </li>
  <!--  <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu2">Review Service</a>
    </li>-->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h5>From primary care to a wide wariety of highly qualified specialist!</h5>
      <p>We help to find an available doctor and book your appointment online.From primary care to a wide wariety of highly qualified specialists, we help to find the convinient Doctor near you.</p>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
    <h5>From primary care to a wide wariety of highly qualified specialist!</h5>
      <p>We Save your presious time to book your appointment online.From primary care to a wide wariety of highly qualified specialists, we help to find the convinient Doctor near you.</p>
    </div>
  <!--  <div id="menu2" class="container tab-pane fade"><br>
    <h5>From primary care to a wide wariety of highly qualified specialist!</h5>
      <p>We help to find an available doctor and book your appointment online.From primary care to a wide wariety of highly qualified specialists, we help to find the convinient Doctor near you.</p>
    </div>-->
  </div>
</div>


            </div>
        </div>
    </div>
    </div>
</section>

<section class="main" style="padding-top:0px">
    <div class="container mt-4">
        <h1 class="text-center mb-4 p-4 text-secondary">Speech Assistant Blogs</h1>
        <div class="row">

            <div class="card-columns">

                <div class="card shadow border-0">
                    <img class="card-img-top" src="{{asset('dist/img/blogg1.jpg')}}" alt="Card image cap" style="width:400px;height:225px;">
                    <div class="card-body"><b>Speech Related Products</b></h5>
                        <p class="card-text">AbleNet Augmentative and Alternative Communication (AAC) products from AbleNet allow persons with disabilities the chance to engage with others and connect with their world.
                        <p class="card-text"><small class="text-muted">Last updated 15 mins ago</small></p>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <img class="card-img-top" src="{{asset('dist/img/blogg2.jpg')}}" alt="Card image cap" style="width:400px;height:225px;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Child Talk</b></h5>
                        <p class="card-text">I’ve written a lot about the power of talking to your toddler.  I’ve shared how techniques such as parallel talk & extension can be used to help your child’s language grow. I’ve discussed how indirect language facilitation has been proven to be an effective means of language intervention for toddlers .</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <img class="card-img-top" src="{{asset('dist/img/blogg3.jpg')}}" alt="Card image cap" style="width:400px;height:225px;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Telegraphic speech</b></h5>
                        <p class="card-text">Telegraphic speech occurs when we speak like we would in, well, a telegraph.  In other words, we omit the “small” words that make a sentence grammatically correct and include only the important words - mainly nouns and verbs.</p>
                        <p class="card-text"><small class="text-muted">Last updated 10 mins ago</small></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- Header -->
<header class="bg-primary text-center py-5 mb-4">
    <div class="container">
        <h1 class="font-weight-light text-white">Meet the Team</h1>
    </div>
</header>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Team Member 1 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
                <!--<img src="https://source.unsplash.com/TMgQMXoglsM/500x350" class="card-img-top" alt="...">-->
                <img src="dist/img/waqar.jpg" class="card-img-top" alt="User Image">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0">Mirza Waqar</h5>
                    <div class="card-text text-black-50">CEO,Founder,Director</div>
                </div>
            </div>
        </div>
        <!-- Team Member 2
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow">
            <img src="dist/img/doctor7.jpg"  class="card-img-top" alt="User Image">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0">Umair altaf</h5>
                    <div class="card-text text-black-50">CEO,Founder,Director</div>
                </div>
            </div>
        </div>-->
        <!-- Team Member 3 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
            <img src="dist/img/tayyab2.jpg" class="card-img-top" alt="User Image">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0" >Tayyab Hussain</h5>
                    <div class="card-text text-black-50">CEO,Founder,Director</div>
                </div>
            </div>
        </div>
        <!-- Team Member 4 -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow">
            <img src="dist/img/faizan.jpg" class="card-img-top" alt="User Image">
                <div class="card-body text-center">
                    <h5 class="card-title mb-0">Faizan Khan</h5>
                    <div class="card-text text-black-50">CEO,Founder,Director</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Header -->
<header class="bg-primary text-center py-5 mb-4" id="header00">
    <div class="container">
        <h1 class="font-weight-light text-white">Online Speech Assistant</h1>
        <h6 class=""><small>50,000+ people book appointments via Speech-Assistant every month.</small></h6>
            <a href="{{route('patient.search_doctor')}}"  class="btn  btn-warning">Book Appointment</a>
    </div>
</header>
<div class="container" style="height:450px">
    <div class="row">
        <div class="col-md-8 col-center m-auto">

            <h2 class="text-center">Testimonials</h2>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    <div class="item carousel-item active">
                        <div class="img-box"><img src="dist/img/2.jpg" alt=""></div>
                        <p class="testimonial">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem
                            tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper
                            malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non
                            aliquet.</p>
                        <p class="overview"><b>Paula Wilson</b>, Media Analyst</p>
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>

                    </div>
                    <div class="item carousel-item">
                        <div class="img-box"><img src="dist/img/doctor1.jpg" alt=""></div>
                        <p class="testimonial">Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget nisi
                            a mi suscipit tincidunt. Utmtc tempus dictum risus. Pellentesque viverra sagittis quam at
                            mattis. Suspendisse potenti. Aliquam sit amet gravida nibh, facilisis gravida odio.</p>
                        <p class="overview"><b>Antonio Moreno</b>, Web Developer</p>
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="item carousel-item">
                        <div class="img-box"><img src="dist/img/doctor2.jpg" alt=""></div>
                        <p class="testimonial">Phasellus vitae suscipit justo. Mauris pharetra feugiat ante id lacinia.
                            Etiam faucibus mauris id tempor egestas. Duis luctus turpis at accumsan tincidunt.
                            Phasellus risus risus, volutpat vel tellus ac, tincidunt fringilla massa. Etiam hendrerit
                            dolor eget rutrum.</p>
                        <p class="overview"><b>Michael Holz</b>, Seo Analyst</p>
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- Carousel controls -->
                <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- contact section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <div class="section-title">

                    <h1 class="heading bold" style="margin:0px!important;"> <strong>Contact US</strong></h1>
                    <hr>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 contact-info">
                <h2 class="heading bold">CONTACT INFO</h2>
                <p>Search a Doctor and Book appointments online instantly!</p>
                <div class="col-md-6 col-sm-4">
                    <h3><i class="icon-envelope medium-icon wow bounceIn" data-wow-delay="0.6s"></i><a href="">Email Us
                            On:</a> </h3>
                    <p>www.speech-assistant.com or<b> <a href="form.html">Sign up</a></b> for becoming a member</p>
                </div>
                <div class="col-md-6 col-sm-4">
                    <h3><i class="icon-phone medium-icon wow bounceIn" data-wow-delay="0.6s"></i> PHONES</h3>
                    <p>010-020-0340 | 090-080-0760</p>
                    <button class="btn btn-primery" onclick="window.location.href='login.html'"> Sign In</button>
                    <button class="btn btn-warning" onclick="window.location.href='form.html'">Sign Up</button>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <form action="#" method="get" class="wow fadeInUp" data-wow-delay="0.6s">
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <textarea class="form-control" placeholder="Message" rows="7" name="message"></textarea>
                    </div>
                    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8">
                        <input type="submit" class="form-control" onclick="alertify.alert('The message is sent')" value="SEND MESSAGE">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
