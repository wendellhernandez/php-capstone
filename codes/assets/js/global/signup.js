$(document).ready(function() {
    $("form").submit(function(event) {
        $.post($(this).attr('action') , $(this).serialize() , function(data){
            $('#first_name').html(data.first_name);
            $('#last_name').html(data.last_name);
            $('#email').html(data.email);
            $('#password').html(data.password);
            $('#confirm_password').html(data.confirm_password);
            $('.form_success').html(data.success);
        } , 'json');

        return false;
    });
});