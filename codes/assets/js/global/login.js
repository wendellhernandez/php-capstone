$(document).ready(function() {
    $("form").submit(function() {
        $.post($(this).attr('action') , $(this).serialize() , function(data){
            $('#email').html(data.email);
            $('#password').html(data.password);
            $('#credentials').html(data.credentials);

            if(data.success == 'success'){
                window.location.href = "/login";
            }
        } , 'json');

        return false;
    });
});