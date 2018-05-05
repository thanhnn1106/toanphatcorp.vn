$(document).ready(function() {
    $('.buy-budget').on('click', function (event) {

        var me = $(this);
        event.preventDefault();

        $('#formPackage').attr('action', me.attr('data-url'));
        $('#formPackage #packageId').val(me.attr('package-id'));
        $('#formPackage #paymentMethod').val(me.attr('payment-method'));
        $('#formPackage').submit();
    });
});