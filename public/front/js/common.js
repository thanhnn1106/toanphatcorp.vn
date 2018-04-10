//totop
$(document).ready(function () {
    "use strict";
    $("#btn_top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $("#btn_top").fadeIn();
        } else {
            $("#btn_top").fadeOut();
        }
    });
});

//accordion
$(document).ready(function () {
    "use strict";
    $('#accordion').find('.content').hide();
    $('#accordion').find('.active').hide();
    // Accordion
    $('#accordion').find('.accordion-header').click(function () {
        var next = $(this).next();
        next.slideToggle('fast');
        $('.content').not(next).slideUp('fast');
        return false;
    });
});
//click box
$(document).ready(function () {
    "use strict";
    $(".box").click(function () {
        window.location = $(this).find("a").attr("href");
        return false;
    });
});
// button menu
$(document).ready(function () {
    "use strict";
    $('#nav-icon3,.close_sp').click(function () {
        $('#nav-icon3').toggleClass('open');
        $(".content_menu_sp").stop().slideToggle(500);
    });
    $('.link_close').click(function () {
        $(".content_menu_sp").slideUp(500);
        $('#nav-icon3').removeClass('open');
    });
});