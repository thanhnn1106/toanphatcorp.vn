/*global $, document, Chart, LINECHART, data, options, window*/
$(document).ready(function () {
    // Main Template Color
    var brandPrimary = '#33b35a';

    // ------------------------------------------------------- //
    // Custom Scrollbar
    // ------------------------------------------------------ //

    if ($(window).outerWidth() > 992) {
         $(window).on("load",function(){
            $("nav.side-navbar").mCustomScrollbar({
                scrollInertia: 200
            });
        });
    }


    // ------------------------------------------------------- //
    // Side Navbar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {

        e.preventDefault();

        if ($(window).outerWidth() > 1194) {
            $('nav.side-navbar').toggleClass('shrink');
            $('.page').toggleClass('active');
        } else {
            $('nav.side-navbar').toggleClass('show-sm');
            $('.page').toggleClass('active-sm');
        }
    });

    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Jquery Progress Circle
    // ------------------------------------------------------ //
    var progress_circle = $("#progress-circle").gmpc({
        color: brandPrimary,
        line_width: 5,
        percent: 80
    });
    progress_circle.gmpc('animate', 80, 3000);

    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });
});
function fncDeleteConfirm (obj) {
    $('.alert').hide();
    var dialog = $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        Delete: function() {
          window.location.href = $(obj).attr('data-url');
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    dialog.find('.delete-text').html($(obj).attr('data-message'));
}
