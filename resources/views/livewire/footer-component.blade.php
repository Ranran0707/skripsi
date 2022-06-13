<footer id="footer">
    <div class="wrap-footer-content footer-style-1">

        <div class="wrap-function-info" style="height: 40px">
            <div class="container"></div>
        </div>

        <div class="main-footer-content" style="padding-bottom: 30px">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Contact Details</h3>
                            <div class="item-content">
                                <div class="wrap-contact-detail">
                                    <ul>
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p class="contact-txt">{{ $setting->address }}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p class="contact-txt">{{ $setting->phone }}</p>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <p class="contact-txt">{{ $setting->email }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Hot Line</h3>
                            <div class="item-content">
                                <div class="wrap-hotline-footer">
                                    <span class="desc">Call Us toll Free</span>
                                    <b class="phone-number">{{ $setting->phone2 }}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 box-twin-content ">
                        <div class="row">
                            <div class="wrap-footer-item twin-item">
                                <h3 class="item-header">My Account</h3>
                                <div class="item-content">
                                    <div class="wrap-vertical-nav">
                                        <ul>
                                            <li class="menu-item"><a href="#" class="link-term">My
                                                    Account</a></li>
                                            <li class="menu-item"><a href="#" class="link-term">Brands</a>
                                            </li>
                                            <li class="menu-item"><a href="#" class="link-term">Gift
                                                    Certificates</a></li>
                                            <li class="menu-item"><a href="#" class="link-term">Affiliates</a>
                                            </li>
                                            <li class="menu-item"><a href="#" class="link-term">Wish
                                                    list</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-footer-item twin-item">
                                <h3 class="item-header">Infomation</h3>
                                <div class="item-content">
                                    <div class="wrap-vertical-nav">
                                        <ul>
                                            <li class="menu-item"><a href="#" class="link-term">Contact
                                                    Us</a></li>
                                            <li class="menu-item"><a href="#" class="link-term">Returns</a>
                                            </li>
                                            <li class="menu-item"><a href="#" class="link-term">Site
                                                    Map</a></li>
                                            <li class="menu-item"><a href="#" class="link-term">Specials</a>
                                            </li>
                                            <li class="menu-item"><a href="#" class="link-term">Order
                                                    History</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">Social network</h3>
                            <div class="item-content">
                                <div class="wrap-list-item social-network">
                                    <ul>
                                        <li><a href="{{ $setting->twitter }}" class="link-to-item"
                                                title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="{{ $setting->facebook }}" class="link-to-item"
                                                title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="{{ $setting->pinterest }}" class="link-to-item"
                                                title="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="{{ $setting->instagram }}" class="link-to-item"
                                                title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="{{ $setting->youtube }}" class="link-to-item"
                                                title="youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="wrap-footer-item">
                            <h3 class="item-header">We Using Midtrans Payments Gateway:</h3>
                            <div class="item-content">
                                <div class="wrap-list-item wrap-gallery">
                                    <img src="assets/images/midtrans.png" style="max-width: 260px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="coppy-right-box" style="float: none">
            <div class="container text-center">
                <div class="coppy-right-item text-center" style="float: none">
                    <p class="coppy-right-text text-center">Copyright </p>
                </div>
            </div>
        </div>

    </div>
</footer>
