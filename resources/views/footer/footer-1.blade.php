<footer id="footer" class="footer footer-1 text-center">
    <div class="footer--widget text--center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-4">
                    <div class="footer--widget-content">
                        <h3>Our address</h3>
                        <p>22 Alnahas Building, 2 AlBahr St, Tanta<br> Al-Gharbia Governorate, Egypt</p>
                        <a class="link--styled" href="#">View On Map</a>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="footer--reservation">
                        <div class="divider--shape-10up"></div>
                        <h3>Make A Reservation</h3>
                        <div class="divider--shape-11"></div>
                        <div class="footer--reservation-wrapper">
                            <ul class="list-unstyled">
                                <li>Week days <span>09.00 – 24:00</span></li>
                                <li>Saturday <span>08:00 – 03.00</span></li>
                                <li>Sunday <span>Day off</span></li>
                            </ul>
                            <a class="btn btn--primary btn--bordered btn--block" data-toggle="modal" href="{{ route('reservation') }}">Make a Reservation</a>
                            
                            <div class="modal fade reservation-popup" tabindex="-1" role="dialog" id="reservationPopup">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                            <div class="row reservation">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="reservation-form mb-30 bg-white text-center">
                                                        <div class="reservation--dec">
                                                            You can Book a table online easily in just a couple of minutes. We take reservations for lunch and dinner, just check the availability of your table & book it now!
                                                        </div>
                                                        <form class="mb-0">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                                    <div class="form-select">
                                                                        <i class="fa fa-angle-down"></i>
                                                                        <select class="form-control" name="res-pepole" id="footerNum">
                                                                            <option value="2">2 People</option>
                                                                            <option value="4">4 People</option>
                                                                            <option value="6">6 People</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                                    <input type="text" class="form-control" name="res--name" id="footerName" placeholder="Your Name" required>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                                    <input type="submit" value="Find Table" name="submit" class="btn btn--secondary btn--block">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider--shape-10down"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3 col-md-4">
                    <div class="footer--widget-content">
                        <h3>Contact us</h3>
                        <p class="mb-0">Main Email: 7oroof@7oroof.com</p>
                        <p class="mb-0">Phone: 02 01065370701</p>
                        <a class="link--styled" href="#">Send A Message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer--social">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 text-right">
                    <div class="footer--social-icons">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-tripadvisor"></i></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 widget--newsletter">
                    <form class="footer--social-newsletter mailchimp">
                        <input type="email" name="email" class="form-control" placeholder="Subscribe Our Newsletter">
                        <button type="submit"><i class="fa fa-long-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer--copyright text-center">
        <div class="divider--shape-dark"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <span>&copy; 2026 Granny, With Love by </span> <a href="#">Softo Solutions</a>
                </div>
            </div>
        </div>
    </div>
</footer>


</body>
</html>