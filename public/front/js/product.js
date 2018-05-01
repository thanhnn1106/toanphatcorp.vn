$(document).ready(function() {
    $('.buy-budget').on('click', function (event) {
        $('.alert').hide();

        var me = $(this);
        event.preventDefault();

        if ( me.data('requestRunning') ) {
            return;
        }

        $.ajax({
            url: me.attr('data-url'),
            type: 'POST',
            dataType: 'JSON',
            data: {packageId: me.attr('package-id')},
            cache: false,
            success: function (data) {
                if (data.error === 0) {
                    $('#triggerClick').trigger('click', [data.result.urlResult]);
                } else {
                    $('.alert').show().find('p').html(data.result);
                }
            },
            complete: function() {
                me.data('requestRunning', false);
            }
        });
    });

    $('#triggerClick').on('click', function (event, urlProcess) {
        var mc_flow = new NGANLUONG.apps.MCFlow({trigger:'triggerClick',url: urlProcess});
    });
});