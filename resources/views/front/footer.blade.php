<div class="container-fluid">
    <div class="footer_01" id="title_contact">
        <div class="container">
            <div class="title">
                <p>dj - compilations</p>
                <p>Contacts TODAY</p>
                <p>Support is provided 7 days a week. Please allow up to 12h for a reply. Thank you!</p>
            </div>
            <div class="footer_frm">
                <form id="contactForm" method="POST" action="{{ route('front.submit_contact') }}">
                    <input class="form-control" type="text" id="contactName" name="contactName" placeholder="Your name">
                    <h5 style="display: none;" class="text-danger validate-name ">Name was invalid.</h5>
                    <input class="form-control" type="email" id="contactEmail" name="contactEmail" placeholder="Your email">
                    <h5 style="display: none;" class="text-danger validate-email">Email was invalid.</h5>
                    <input class="form-control" type="text" id="contactTitle" name="contactTitle" placeholder="Title">
                    <h5 style="display: none;" class="text-danger validate-title">Title was invalid.</h5>
                    <textarea class="form-control" id="contactMessage" rows="3" name="contactMessage" placeholder="Message"></textarea>
                    <h5 style="display: none;" class="text-danger validate-message">Message was invalid.</h5>
                    <a type="button" href="javascript:validateContact()" class="btn btn_03">Contacts TODAY</a>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid box_pc">
    <div class="footer_02">
        <ul class="container">
            <li><a href="">News</a></li>
            <li><a href="{{ route('front.static_page', ['slug' => 'about-us']) }}">About Us</a></li>
            <!--<li><a href="">Abuse Report / DMCA</a></li>-->
            <li><a href="{{ route('front.static_page', ['slug' => 'privacy-policy']) }}">Privacy Policy</a></li>
            <li><a href="{{ route('front.faqs') }}">F.A.Q</a></li>
            <li><a href="{{ route('front.static_page', ['slug' => 'dj-tips']) }}">DJ Tips</a></li>
            <li><a href="#title_contact">Contacts</a></li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <address>
    Pack4djs.com &copy; 2018 | Mixing Your world!
    </address>
</div>
<div id="btn_top" class="toTop" style="display: block;">
    <p><a href="#wrapper"><img src="{{ asset_front('images/toTop.png') }}" alt="toTop"></a></p>
</div>
@section('footer_script')

@endsection
