<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-2">
            <p class="logo"><a href="#"><img src="{{ asset_front('images/logo.png') }}" alt="dj-compilations"></a></p>
        </div>
        <div class="col-lg-10 header_ct">
            <ul class="clearfix main_menu">
                <li><a href="">home</a></li>
                <li><a href="">F.A.Q</a></li>
                <li><a href="#title_contact">contacts</a></li>
            </ul>
            <ul class="clearfix box_search">
                <li>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button class="btn btn_search" type="button"><i class="fas fa-search"></i></button>
                        </span> </div>
                </li>
                <li>
                    @if(Auth::user())
                    <!-- Logout button -->
                    <p class="info_name float-left" style="color: #fff;margin-right: 10px;height: 38px;line-height: 38px;">
                      <a href="">{{ Auth::user()->full_name }}</a>
                    </p>
                    <a type="button" class="btn btn_02" href="{{ route('auth.logout') }}">Logout</a>
                    <!-- End logout button -->
                    @else
                    <!-- Login button -->
                    <button type="button" class="btn btn_01" data-toggle="modal" data-target="#myModal">login</button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog"> 
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <dl class="frm_login">
                                        <dt>LOGIN</dt>
                                        <dd>
                                            <ul class="clearfix">
                                                <li class="login_fb">
                                                    <a href="{{ route('auth.provider', ['service' => 'facebook']) }}" class="btn clearfix"
                                                        data-plugin="nsl" 
                                                        data-action="connect" 
                                                        data-redirect="{{ route("front.redirect") }}" 
                                                        data-provider="facebook" 
                                                        data-popupwidth="800" 
                                                        data-popupheight="500">
                                                        <span>Login with facebook</span>
                                                    </a><span><i class="fab fa-facebook-f"></i></span>
                                                </li>
                                                <li class="login_gg">
                                                    <a href="{{ route('auth.provider', ['service' => 'google']) }}" class="btn clearfix"
                                                        data-plugin="nsl" 
                                                        data-action="connect" 
                                                        data-redirect="{{ route("front.redirect") }}" 
                                                        data-provider="google" 
                                                        data-popupwidth="800" 
                                                        data-popupheight="500">
                                                        <span>Login with gmail</span>
                                                    </a>
                                                    <span><i class="fab fa-google"></i></span>
                                                </li>
                                            </ul>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </li>
            </ul>
        </div>
        <!-- gnavi sp start -->
        <div id="gnavi_sp" class="box_sp">
            <div id="nav-icon3" class="box_sp"> <span></span> <span></span> <span></span>
                <p>MENU</p>
            </div>
            <div class="content_menu_sp">
                <ul class="menu_sp_top clearfix">
                    <li><a href="">News</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Abuse Report / DMCA</a></li>
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">F.A.Q</a></li>
                    <li><a href="">DJ Tips</a></li>
                    <li><a href="#title_contact" class="link_close">Contacts</a></li>
                </ul>
                <p class="menu_sp_close clearfix close_sp"><a>CLOSE</a></p>
            </div>
        </div>
        <!-- gnavi sp end -->
        <dl class="frm_login frm_login_sp box_sp">
           <dt>login</dt>
            <dd>
                <ul class="clearfix">
                    <li class="login_fb">
                        <a href="{{ route('auth.provider', ['service' => 'facebook']) }}" class="btn clearfix"
                            data-plugin="nsl" 
                            data-action="connect" 
                            data-redirect="{{ route("front.redirect") }}" 
                            data-provider="facebook" 
                            data-popupwidth="800" 
                            data-popupheight="500">
                            <span>Login with facebook</span>
                        </a>
                        <span><i class="fab fa-facebook-f"></i></span>
                    </li>
                    <li class="login_gg">
                        <a href="{{ route('auth.provider', ['service' => 'google']) }}" class="btn clearfix"
                            data-plugin="nsl" 
                            data-action="connect" 
                            data-redirect="{{ route("front.redirect") }}" 
                            data-provider="google" 
                            data-popupwidth="800" 
                            data-popupheight="500">
                            <span>Login with gmail</span>
                        </a>
                        <span><i class="fab fa-google"></i></span>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
</div>