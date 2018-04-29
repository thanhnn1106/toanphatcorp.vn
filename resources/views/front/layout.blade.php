<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=-100%, user-scalable=yes" />
        <meta name="format-detection" content="telephone=no">
        <title></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link  href="{{ asset_front('css/styles.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/style_sp.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/slick.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset_front('js/jquery.min.js') }}" type="text/javascript"></script>
        <link  href="{{ asset_front('css/stype_02.css') }}" rel="stylesheet" type="text/css" />

        <!-- Google Analytics start -->
        <!-- Google Analytics end -->
        <script>
            var isLogged = '{{ Auth::check() }}';
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header" class="clearfix">
                @include('front.header')
            </div>

            @yield('content')

            <div id="footer">
                @include('front.footer')
            </div>
        </div>

        <form id="formDownload" action="{{ route('front.files_download') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="file_id" name="file_id" />
        </form>

        <!-- Javascript files-->
        <script src="{{ asset_front('js/fontawesome-all.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/top.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/slick.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/jquery.scroll.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/common.js') }}?v={{ VERSION }}" type="text/javascript"></script>

        <script>
        // Add token when use ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (window.location.hash && window.location.hash == '#_=_') {
            if (window.history && history.pushState) {
                window.history.pushState("", document.title, window.location.pathname);
            } else {
                // Prevent scrolling by storing the page's current scroll offset
                var scroll = {
                    top: document.body.scrollTop,
                    left: document.body.scrollLeft
                };
                window.location.hash = '';
                // Restore the scroll offset, should be flicker free
                document.body.scrollTop = scroll.top;
                document.body.scrollLeft = scroll.left;
            }
        }
        </script>

        @yield('footer_script')
    </body>
</html>
