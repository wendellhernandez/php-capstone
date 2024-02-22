$(document).ready(function() {
    $('#card_details_modal').hide();

    $("body").on("submit", ".checkout_form", function() {
        $.post($(this).attr("action"), $(this).serialize(), function(res) {
            /*
                SHIPPING ERRORS
            */
            $('#first_name').html(res.first_name);
            $('#last_name').html(res.last_name);
            $('#address_1').html(res.address_1);
            $('#address_2').html(res.address_2);
            $('#city').html(res.city);
            $('#state').html(res.state);
            $('#zip').html(res.zip);

            /*
                BILLING ERRORS
            */
            $('#first_name_billing').html(res.first_name_billing);
            $('#last_name_billing').html(res.last_name_billing);
            $('#address_1_billing').html(res.address_1_billing);
            $('#address_2_billing').html(res.address_2_billing);
            $('#city_billing').html(res.city_billing);
            $('#state_billing').html(res.state_billing);
            $('#zip_billing').html(res.zip_billing);

            if(res.no_error){
                $('#card_details_modal').fadeIn();
            }
        } , 'json' );

        return false;
    });

    $('.close_modal').on('click' , function() {
        $('#card_details_modal').hide();
    })

    $('#same_billing_checkbox').on('click' , function() {
        $('#first_name_billing').closest('ul').toggle();
        $('.billing_title').toggle();

        let first_name = $('#first_name').siblings('input').val();
        $('#first_name_billing').siblings('input').val(first_name);

        let last_name = $('#last_name').siblings('input').val();
        $('#last_name_billing').siblings('input').val(last_name);

        let address_1 = $('#address_1').siblings('input').val();
        $('#address_1_billing').siblings('input').val(address_1);

        let address_2 = $('#address_2').siblings('input').val();
        $('#address_2_billing').siblings('input').val(address_2);

        let city = $('#city').siblings('input').val();
        $('#city_billing').siblings('input').val(city);

        let state = $('#state').siblings('input').val();
        $('#state_billing').siblings('input').val(state);

        let zip = $('#zip').siblings('input').val();
        $('#zip_billing').siblings('input').val(zip);
    })
})

