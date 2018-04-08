fncDeleteConfirm = function (obj) {
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