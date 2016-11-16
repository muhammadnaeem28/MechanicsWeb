<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>(0332) HiGenie 444 3643</strong></div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul id="top_links">
                        @if(Auth::guest())
                            <li>
                                <a href="{{route('auth.login.index')}}" >SIGN IN</a>
                            </li>
                            <li>
                                <a href="{{route('auth.register.index')}}">SIGN UP</a>
                            </li>
                        @endif

                        <li><a href="/auto#/home/-1">GET QUOTE</a></li>
                    </ul>
                </div>
            </div><!-- End row -->
        </div><!-- End container-->
    </div><!-- End top line-->

    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <div id="logo">
                    <a href="{{route('home.index')}}"><img src="/img/logo-2.png"  alt="City tours" data-retina="true" class="logo_normal"></a>
                    <a href="{{route('home.index')}}"><img src="/img/logo-1.png"  alt="City tours" data-retina="true" class="logo_sticky"></a>
                </div>
            </div>
            <nav class="col-md-10 col-sm-10 col-xs-10">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="/img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>

                        <li class="submenu">
                            <a href="{{route('home.how-it-works')}}">How It Works</a>
                        </li>

                        <li class="submenu">
                            <a href="{{route('home.reviews')}}">Reviews</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('home.services')}}">Services</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('home.pricing')}}">Pricing</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('mechanics.index')}}">Mechanics</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('home.advice')}}">Advice</a>
                        </li>
                        <li class="submenu">
                            <a href="{{route('home.contact')}}">Contact</a>
                        </li>


                        @if(Auth::guest())
                        @else
                            <li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu">{{Auth::user()->email}}<i class="icon-down-open-mini"></i></a>
                                <ul>
                                    @if(Auth::user()->role=='admin')
                                        <li><a href="{{route('admin.dashboard')}}">ADMIN PANEL</a></li>
                                    @endif
                                    @if(Auth::user()->role=='customer')
                                        <li><a href="{{route('customer.dashboard')}}">Dashboard</a></li>
                                    @endif

                                    <li><a href="{{route('auth.logout')}}">Sign out</a></li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!-- End main-menu -->
                <ul id="top_tools">

                    <li>
                        <div class="dropdown dropdown-cart">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-basket-1"></i>Cart (0) </a>
                            {{--<ul class="dropdown-menu" id="cart_items">
                                <li>
                                    <div class="image"><img src="/img/thumb_cart_1.jpg" alt=""></div>
                                    <strong>
                                        <a href="#">Louvre museum</a>1x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div class="image"><img src="/img/thumb_cart_2.jpg" alt=""></div>
                                    <strong>
                                        <a href="#">Versailles tour</a>2x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div class="image"><img src="/img/thumb_cart_3.jpg" alt=""></div>
                                    <strong>
                                        <a href="#">Versailles tour</a>1x $36.00 </strong>
                                    <a href="#" class="action"><i class="icon-trash"></i></a>
                                </li>
                                <li>
                                    <div>Total: <span>$120.00</span></div>
                                    <a href="cart.html" class="button_drop">Go to cart</a>
                                    <a href="payment.html" class="button_drop outline">Check out</a>
                                </li>
                            </ul>--}}
                        </div><!-- End dropdown-cart-->
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- container -->
</header>