$( document ).ready(function() {
    $.LoadingOverlay("show");
});

$( window ).on( "load", function() {
    $.LoadingOverlay("hide");
});
