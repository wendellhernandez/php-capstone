$(document).ready(function() {
    $('#card_details_modal').hide();

    $("body").on("submit", ".checkout_form", function() {
        $.post($(this).attr("action"), $(this).serialize(), function(res) {
            $('#first_name').html(res.first_name);
            $('#last_name').html(res.last_name);
            $('#address_1').html(res.address_1);
            $('#address_2').html(res.address_2);
            $('#city').html(res.city);
            $('#state').html(res.state);
            $('#zip').html(res.zip);

            if(res.no_error){
                $('#card_details_modal').fadeIn();
            }
        } , 'json' );

        return false;
    });

    $('.close_modal').on('click' , function() {
        $('#card_details_modal').hide();
    })
})