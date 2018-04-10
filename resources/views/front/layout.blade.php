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

        <link  href="{{ asset_front('css/styles.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/style_sp.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link  href="{{ asset_front('css/slick.css') }}" rel="stylesheet" type="text/css" />

        <!-- Google Analytics start -->
        <!-- Google Analytics end -->
    </head>
    <body>
        <div id="wrapper">
            <div id="header" class="clearfix">
                @include('front.header');
            </div>

            @yield('content')

            <div id="footer">
                @include('front.footer');
            </div>
        </div>

        <!-- Javascript files-->
        <script src="{{ asset_front('s/fontawesome-all.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset_front('js/jquery.min.js') }}" type="text/javascript"></script>
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
        </script>

        @yield('footer_script')
    </body>
</html>
