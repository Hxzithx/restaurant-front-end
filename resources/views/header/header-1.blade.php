@php
    $isTransparent = !isset($headerDark) || !$headerDark;
@endphp
<header id="navbar-spy" class="header header-2 header-bordered header-fixed {{ $isTransparent ? 'header-transparent' : '' }}">
    <nav id="primary-menu" class="navbar navbar-fixed-top sticky-navbar {{ $isTransparent ? 'header-transparent style-1' : 'affix' }}"
         {{ !$isTransparent ? 'data-spy="affix" data-offset-top="0"' : '' }}>
         
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="logo" href="{{ url('/home') }}">
                    <img class="logo-light" src="{{ asset('assets/images/logo/logo-light.png') }}" alt="logo">
                    <img class="logo-dark" src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo">
                </a>
            </div>

            <div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
                <ul class="nav navbar-nav nav-pos-right navbar-left">
                    <li class="has-dropdown active">
                        <a href="{{ url('/home') }}" class="menu-item">home</a>
                    </li> 

                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">About</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/about') }}">our story</a></li>
                            <li><a href="{{ url('/chefs') }}">our chefs</a></li>
                            <li><a href="{{ url('/contact-us') }}">contact us</a></li>
                            <li><a href="{{ url('/faq') }}">FAQs</a></li>
                            <li><a href="{{ url('/guest-book') }}">guestbook</a></li>
                            <li><a href="{{ url('/reservation') }}">online reservation</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">Menu</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/menu') }}">menu board</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">Blog</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/blog') }}">blog carousel</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle menu-item">shop</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/shop') }}">shop products</a></li>
                            <li><a href="{{ url('/shopping-cart') }}">shop cart</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="module module-social pull-left">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa fa-tripadvisor"></i></a>
                </div>

                <div class="module module-reservation" style="margin-left: 15px;">
                    <a class="btn-popup" data-toggle="modal" data-target="#reservationModule"><i class="lnr lnr-users"></i>Reservation</a>
                    <div class="modal fade reservation-popup" tabindex="-1" role="dialog" id="reservationModule">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    <div class="row reservation">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="reservation-form mb-30 bg-white text-center">
                                                <form method="post" action="assets/php/reservation.php" class="reservationForm mb-0">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                                            <div class="form-select">
                                                                <i class="fa fa-angle-down"></i>
                                                                <select class="form-control" name="res-pepole" id="resPepole">
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
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                                            <div class="form-select">
                                                                <i class="fa fa-calendar"></i>
                                                                <input type="text" class="form-control" name="res-day" id="res-datepicker" placeholder="Select Date" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                                            <div class="form-select">
                                                                <i class="fa fa-clock-o"></i>
                                                                <input type="text" class="form-control" name="res-time" id="res-timepicker" placeholder="Select Time" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                                            <input type="text" class="form-control" name="res-name" id="resName" placeholder="Your Name" required>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                                            <input type="email" class="form-control" name="res-email" id="resEmail" placeholder="Your Email" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" name="res-phone" id="resNumber" placeholder="Phone Number" required>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <textarea class="form-control" name="res-message" id="resMessage" rows="2" placeholder="Add a special request (optional)"></textarea>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <input type="submit" value="Find Table" name="res-submit" class="btn btn--secondary btn--block">
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="reservation-result"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="text-uppercase text-center">
                                                <strong><span class="text-white">Reservation Powered by</span> <a class="reservation-link" href="#">Softo Solutions</a></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profile Dropdown --}}
                <div class="module module-profile">
                  <div class="dropdown profile-dropdown">
                   <a href="#" class="dropdown-toggle profile-toggle" data-toggle="dropdown">
                     <div class="profile-avatar">
                       @if(session('user_avatar'))
                        <img src="{{ session('user_avatar') }}" alt="profile">
                       @else
                         {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
                       @endif
                  </div>
                </a>

        <ul class="dropdown-menu dropdown-menu-right profile-menu">
            {{-- User Info --}}
              <li class="profile-info">
               <div class="profile-info-avatar">
                {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
              </div>
            <div class="profile-info-details">
              <strong>{{ session('user_name') }}</strong>
              <span>{{ session('user_email') }}</span>
          </div>
        </li>

            <li class="divider"></li>
            {{-- Menu Items --}}
            <li>
                <a href="{{ url('/profile') }}">
                    <i class="fa fa-user"></i> My Profile
                </a>
            </li>

            <li>
                <a href="{{ url('/my-orders') }}">
                    <i class="fa fa-list"></i> My Orders
                </a>
            </li>

            <li>
                <a href="{{ url('/reservation') }}">
                    <i class="fa fa-calendar"></i> My Reservations
                </a>
            </li>

            <li class="divider"></li>

            {{-- Logout --}}
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="profile-logout-btn">
                        <i class="fa fa-sign-out"></i> Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>

            </div>
        </div>
    </nav>
</header>