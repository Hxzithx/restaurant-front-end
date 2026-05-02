@extends('layouts.app')

@section('content')

@include('header.header-1')

<section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
    <div class="bg-section">
        <img src="/assets/images/page-title/5.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-4 text-center">
                    <div class="title--content">
                        <div class="title--subtitle">Book a table</div>
                        <div class="title--heading">
                            <h1>Online Reservation</h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="/index.php">Home</a></li>
                        <li class="active">Reservation</li>
                    </ol>
                    <div class="divider--shape-1down"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="reservation1" class="reservation bg-white pt-0 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <div class="reservation-form mt-10 mb-10 text-center">
                    <div class="reservation--dec">
                        You can Book a table online easily in just a couple of minutes. We take reservations for lunch and dinner, just check the availability of your table & book it now!
                    </div>
                    <form method="post" action="assets/php/reservation.php" class="reservationForm mb-0">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-select">
                                    <i class="fa fa-angle-down"></i>
                                    <select class="form-control" name="res-pepole" id="num">
									<option value="2">2 People</option>
									<option value="3">3 People</option>
									<option value="4">4 People</option>
									<option value="5">5 People</option>
									<option value="6">6 People</option>
									<option value="8">8 People</option>
									<option value="10">10 People</option>
								</select>
                                </div>
                            </div>
                             {{-- Calender --}}
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-select">
                             <i class="fa fa-calendar"></i>
                              <input type="text" 
                                class="form-control" 
                                name="res-day" 
                                id="res-datepicker" 
                                placeholder="Select Date" 
                                readonly>
                             </div>
                            </div>
                            {{-- Clock --}}
                            <div class="col-xs-12 col-sm-12 col-md-4">
                              <div class="form-select">
                               <i class="fa fa-clock-o"></i>
                                 <input type="text" 
                                  class="form-control" 
                                  name="res-time" 
                                  id="res-timepicker" 
                                  placeholder="Select Time" 
                                  readonly>
                               </div> 
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <input type="text" class="form-control" name="res-name" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <input type="email" class="form-control" name="res-email" id="email" placeholder="Email">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="contact-phone" id="phone" placeholder="Phone Number" required>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <textarea class="form-control" name="res-message" id="message" rows="2" placeholder="Add a special request (optional)"></textarea>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="submit" value="Find Table" name="submit" class="btn btn--secondary btn--block">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
												<!--Alert Message-->
                            <div class="reservation-result"></div>
							</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="testimonial5" class="testimonial testimonial-5 bg-overlay bg-overlay-dark bg-parallax text-center">
    <div class="bg-section">
        <img src="{{ asset('assets/images/background/2.jpg') }}" alt="Background" />
    </div>
    <div class="container">
        <div class="divider--shape-1up"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                <div id="testimonial-wide" class="carousel carousel-white" data-slide="1" data-slide-rs="1" data-autoplay="true" data-nav="false" data-dots="false" data-space="0" data-loop="true" data-speed="800">
                    <div class="testimonial-panel">
                        <div class="testimonial--img">
                            <img src="/assets/images/testimonial/chef-hat.png" alt="hat">
                        </div>
                        <div class="testimonial--body">
                            <p class="color-white">I think the most wonderful thing in the world is another chef. I'm always excited about learning new things about food.</p>
                        </div>
                        <div class="testimonial--meta">
                            <div class="testimonial--author">
                                <h4>- Todd Stephen</h4>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-panel">
                        <div class="testimonial--img">
                            <img src="/assets/images/testimonial/chef-hat.png" alt="hat">
                        </div>
                        <div class="testimonial--body">
                            <p class="color-white">I think the most wonderful thing in the world is another chef. I'm always excited about learning new things about food.</p>
                        </div>
                        <div class="testimonial--meta">
                            <div class="testimonial--author">
                                <h4>- David Casper</h4>
                            </div>
                        </div>
                    </div>
    
                    <div class="testimonial-panel">
                        <div class="testimonial--img">
                            <img src="/assets/images/testimonial/chef-hat.png" alt="hat">
                        </div>
                        <div class="testimonial--body">
                            <p class="color-white">I think the most wonderful thing in the world is another chef. I'm always excited about learning new things about food.</p>
                        </div>
                        <div class="testimonial--meta">
                            <div class="testimonial--author">
                                <h4>- John Arax</h4>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial-panel">
                        <div class="testimonial--img">
                            <img src="/assets/images/testimonial/chef-hat.png" alt="hat">
                        </div>
                        <div class="testimonial--body">
                            <p class="color-white">I think the most wonderful thing in the world is another chef. I'm always excited about learning new things about food.</p>
                        </div>
                        <div class="testimonial--meta">
                            <div class="testimonial--author">
                                <h4>- Anthony Kevin</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider--shape-1down"></div>
    </div>
</section>

<section id="tabs1" class="tabs text-center bg-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
                        <ul class="tab--logos list-unstyled list-inline mb-50">
                            <li><img src="/assets/images/tabs/1.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/2.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/3.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/4.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/5.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/6.png" alt="logo"></li>
                            <li><img src="/assets/images/tabs/7.png" alt="logo"></li>
                        </ul>
                        <h3 class="tab--heading">Since our grand opening in May 1995, Steak In has won great awards from food critics and organizations all over the world.</h3>
                    </div>
                    <!-- .col-md-10 end -->
                </div>
                <!-- .row end -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2">
                        <ul class="tab--details text-left">
                            <li>The Good Food Award, Gold Seal (2017)</li>
                            <li>The Organic Food Award, Soil Association (2017)</li>
                            <li>The Great British & Egyptian Food Award (2016)</li>
                            <li>The Food Made Good Award (2015)</li>
                            <li>The Great Food Taste Award (2014)</li>
                            <li>The Food Award, Egypt (2014)</li>
                        </ul>
                    </div>
                    <!-- .col-md-4 end -->
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <ul class="tab--details text-left">
                            <li>The Best Food Award, Egypt (2013)</li>
                            <li>The Best Chef in Egypt & Best Restaurant (2012, 2013)</li>
                            <li>The Best Emerging Egypt Cuisine (2012)</li>
                            <li>The Best Dining Experience (2011)</li>
                            <li>The Best Chef in Egypt (2010)</li>
                            <li>The Egyptian Star (2009)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('footer.footer-1')

@endsection

                    