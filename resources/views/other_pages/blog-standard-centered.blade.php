@extends('layouts.app')

@section('content')

@include('header.header-1')

<!-- Page Title #4
============================================= -->
<section id="page-title" class="page-title bg-overlay bg-parallax bg-overlay-gradient">
    <div class="bg-section">
        <img src="/assets/images/page-title/7.jpg" alt="Background" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="title title-4 text-center">
                    <div class="title--content">
                        <div class="title--subtitle">Don't miss</div>
                        <div class="title--heading">
                            <h1>Our News & Events</h1>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}">Home</a>
                        </li>
                        <li><a href="{{ url('/blog') }}">blog</a>
                        </li>
                        <li class="active">blog standard</li>
                    </ol>
                    <div class="divider--shape-1down divider--shape-gray"></div>
                </div>
                <!-- .title end -->
            </div>
            <!-- .col-md-12 end -->
        </div>
        <!-- .row end -->
    </div>
    <!-- .container end -->
</section>
<!-- #page-title end -->

<!-- Blog Standard
============================================= -->
<section id="blog" class="blog blog-standard bg-gray pb-90">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                <div class="row">
                    <!-- Blog Entry #1 -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="blog-entry">
                            <div class="entry--img">
                                <a href="#">
										<img src="/assets/images/blog/standard/1.jpg" alt="entry image"/>
									</a>
                            </div>
                            <div class="entry--content">
                                <div class="entry--meta">
                                    <span>Oct 25, 2017</span> / <span>comments <a href="#">11</a></span> / <span><a href="#">Casserole</a></span>
                                </div>
                                <div class="entry--title">
                                    <h4><a href="#">The Best Side Dishes for Next Dinner</a></h4>
                                </div>
                                <div class="entry--bio">
                                    We’ve all been dying to know which type of magic the Gaines would bring to the café, a landmark on Waco’s bustling traffic circle that closed down in February of 2016. The Fixer Upper stars’ Magnolia brand, which includes the Magnolia Market, a premium interior paint line, a bakery, and a quarterly home magazine, has already reshaped the culture and perception of Waco, Texas. The Elite Café, which was originally opened in 1919, has catered to Elvis Presley when he was training at Fort Hood in the 1950s, and previously served steaks, burgers, and salads. It was a landmark for locals and passersby traveling from Austin to Dallas, most recognizable by a baby-blue ’56 Cadillac parked right out front.
                                </div>
                                <div class="entry--more">
                                    <a class="btn btn--secondary" href="#">read more</a>
                                </div>
                            </div>
                            <!-- .entry-content end -->
                        </div>
                        <!-- .blog-entry end -->
                    </div>

                    <!-- Blog Entry #2 -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="blog-entry">
                            <div class="entry--img">
                                <a href="#">
										<img src="/assets/images/blog/standard/2.jpg" alt="entry image"/>
									</a>
                            </div>
                            <div class="entry--content">
                                <div class="entry--meta">
                                    <span>sep 25, 2017</span> / <span>comments <a href="#">30</a></span> /
                                    <span><a href="#">Apple</a> , <a href="#">Stuffing And Dressing</a></span>
                                </div>
                                <div class="entry--title">
                                    <h4><a href="#">The Very Simple Recipes for Spring & Winter</a></h4>
                                </div>
                                <div class="entry--bio">
                                    We’ve all been dying to know which type of magic the Gaines would bring to the café, a landmark on Waco’s bustling traffic circle that closed down in February of 2016. The Fixer Upper stars’ Magnolia brand, which includes the Magnolia Market, a premium interior paint line, a bakery, and a quarterly home magazine, has already reshaped the culture and perception of Waco, Texas. The Elite Café, which was originally opened in 1919, has catered to Elvis Presley when he was training at Fort Hood in the 1950s, and previously served steaks, burgers, and salads. It was a landmark for locals and passersby traveling from Austin to Dallas, most recognizable by a baby-blue ’56 Cadillac parked right out front.
                                </div>
                                <div class="entry--more">
                                    <a class="btn btn--secondary" href="#">read more</a>
                                </div>
                            </div>
                            <!-- .entry-content end -->
                        </div>
                        <!-- .blog-entry end -->
                    </div>

                    <!-- Blog Entry #3 -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="blog-entry">
                            <div class="entry--img">
                                <a href="#">
									<img src="/assets/images/blog/standard/3.jpg" alt="entry image"/>
								</a>
                            </div>
                            <div class="entry--content">
                                <div class="entry--meta">
                                    <span>sep 15, 2017</span> /
                                    <span><a href="#">Fall</a> , <a href="#">Side Dish</a></span> / <span>comments <a href="#">6</a></span>
                                </div>
                                <div class="entry--title">
                                    <h4><a href="#">Cornbread Stuffing Apples and Sausage</a></h4>
                                </div>
                                <div class="entry--bio">
                                    We’ve all been dying to know which type of magic the Gaines would bring to the café, a landmark on Waco’s bustling traffic circle that closed down in February of 2016. The Fixer Upper stars’ Magnolia brand, which includes the Magnolia Market, a premium interior paint line, a bakery, and a quarterly home magazine, has already reshaped the culture and perception of Waco, Texas. The Elite Café, which was originally opened in 1919, has catered to Elvis Presley when he was training at Fort Hood in the 1950s, and previously served steaks, burgers, and salads. It was a landmark for locals and passersby traveling from Austin to Dallas, most recognizable by a baby-blue ’56 Cadillac parked right out front.
                                </div>
                                <div class="entry--more">
                                    <a class="btn btn--secondary" href="#">read more</a>
                                </div>
                            </div>
                            <!-- .entry-content end -->
                        </div>
                        <!-- .blog-entry end -->
                    </div>
                </div>
                <!-- .row end -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 clearfix mt-20 text--center">
                        <ul class="pagination">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" aria-label="Next">
					  <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
				  </a>
                            </li>
                        </ul>
                    </div>
                    <!-- .col-md-12 end -->
                </div>
                <!-- .row end -->
            </div>
            <!-- .col-md-8 end -->

        </div>
        <!-- .row end -->
    </div>
    <!-- .container end -->
</section>
<!-- #blog end -->

<div class="clearfix"></div>

@include('footer.footer-1')

@endsection

