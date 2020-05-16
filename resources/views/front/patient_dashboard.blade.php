@extends('layouts.header-front')
@section('main-content')
<!-- Navigation -->

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{asset('dist/img/waqar.jpg')}}" alt="User profile picture">
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="height:146%"  class="profile-head">
                        <div>
                                    <h5>
                                       {{Auth::User()->name}}
                                    </h5>
                                    <h6>
                                        Patient
                                    </h6>
                                    </div>
                               <!--     <p class="proile-rating">RANKINGS : <span>8/10</span></p>-->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Treatment Record</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Notifications</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>

                    <div class="col-md-4">
                        <div class="profile-work">
                            <!-- <p>Address</p>
                            <a href="">{{Auth::User()->address}}</a><br/> -->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p> {{Auth::User()->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::User()->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::User()->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::User()->address}}</p>
                                            </div>
                                        </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                    <div class="col-12">
                                    <h4>
                                        <i class="fas fa-wheelchair"></i> Session Record
                                        <small class="float-right">Date: 2/10/2014</small>
                                    </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>

                         <div class="row">
                             <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Session No:</th>
                                            <td>
                                            1
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Problem Diagnosed:</th>
                                            <td>Autism</td>
                                        </tr>
                                        <tr>
                                            <th>Recommend Exercise:</th>
                                            <td>Bear crawls: Bear crawls help develop body awareness, improve coordination and motor planning, and build strength in the trunk.</td>
                                        </tr>
                                        <tr>
                                            <th>Recommend Medicine:</th>
                                            <td>Effexor XR</td>
                                        </tr>
                                        <tr>
                                            <th>Improvements:</th>
                                            <td>Patient Under Observation</td>
                                        </tr>
                                        <tr>
                                            <th>Session Date and Time:</th>
                                            <td>1 March 2019 2:00 pm</td>
                                        </tr>
                                        <tr>
                                            <th>Next Session Date and Time:</th>
                                            <td>11 March 2019 2:00 pm</td>
                                        </tr>
                                    </table>
                                 </div>
                             </div>
                           <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>

@endsection
