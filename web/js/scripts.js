$(function() {

    $('#newContact').click(function() {
        $('.form-create').slideDown();
        $(this).hide();
        $('#hideNewContact').show();
    });

    $('#hideNewContact').click(function() {
        $('.form-create').slideUp();
        $(this).hide();
        $('#newContact').show();
    });
});
