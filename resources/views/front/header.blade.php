<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-2">
            <p class="logo"><a href="{{ route('front.home') }}"><img style="width: 70px; height: 82px;" src="{{ asset_front('images/logo_dj.png') }}" alt="dj-compilations"></a></p>
        </div>
        <div class="col-lg-10 header_ct">
            <ul class="clearfix main_menu">
                <li><a href="{{ route('front.home') }}">home</a></li>
                <li><a href="{{ route('front.faqs') }}">F.A.Q</a></li>
                <li><a href="#title_contact">contacts</a></li>
            </ul>
            <ul class="clearfix box_search">
                <li>
                    <form action="{{ route('front.home') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn_search" type="submit"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </li>
                <li>
                    @if(isset($isLogged) && $isLogged)
                    <!-- Logout button -->
                    <p class="info_name float-left" style="color: #fff;margin-right: 10px;height: 38px;line-height: 38px;">
                      <a href="{{ route('front.account') }}">{{ $user->full_name }}</a>
                    </p>
                    <a type="button" class="btn btn_02" href="{{ route('auth.logout') }}">Logout</a>
                    <!-- End logout button -->
                    @else
                    <!-- Login button -->
                    <button type="button" class="btn btn_01" data-toggle="modal" data-target="#myModal">login</button>
                    <!-- Modal -->
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
                    <li class="user"><a href="{{ route('front.account') }}">Your Information</a></li>
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
            @if(isset($isLogged) && ! $isLogged)
           <dt>login</dt>
            <dd>
                <ul class="clearfix">
                    <li class="login_fb">
                        <a href="{{ route('auth.provider', ['service' => 'facebook']) }}" class="btn clearfix"
                            data-plugin="nsl" 
                            data-action="connect" 
                            data-redirect="{{ route("front.redirect") }}" 
                            data-provider="facebook" 
                            data-popupwidth="475" 
                            data-popupheight="475">
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
        @endif
    </div>
</div>