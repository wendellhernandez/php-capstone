$(document).ready(function() {
    $("body").on("click", ".remove_item", function() {
        $(this).closest("ul").closest("li").addClass("confirm_delete");
        $(".popover_overlay").fadeIn();
        $(".cart_items_form").find("input[name=action]").val("delete_cart_item");
        $(".cart_items_form").find("input[name=update_cart_item_id]").val($(this).val());
    });

    $("body").on("click", ".cancel_remove", function() {
        $(this).closest("li").removeClass("confirm_delete");
        $(".popover_overlay").fadeOut();
        $(".cart_items_form").find("input[name=action]").val("update_cart");
    });

    $("body").on("change", ".quantity_form", function() {
        $(this).submit();
    })

    $("body").on("submit", ".quantity_form", function() {
        $.post($(this).attr('action') , $(this).serialize() , function(res){
            $(".cart_items_form").html(res);

            $.get('/carts/cart_total_price_partial' , function(res){
                $('.total_cart_amount').html(res.total_cart_amount);
                $('.shipping_fee').html(res.shipping_fee);
                $('.total_plus_shipping').html(res.total_plus_shipping);
            } , 'json')
        })

        return false;
    })

    $("body").on("submit", ".remove_form", function() {
        $.post($(this).attr('action') , $(this).serialize() , function(res){
            $(".cart_items_form").html(res);
            $(".popover_overlay").hide();

            $.get("/carts/add_to_cart_partial" , function(res){
                $(".show_cart").html(res);
            })

            $.get('/carts/cart_total_price_partial' , function(res){
                $('.total_cart_amount').html(res.total_cart_amount);
                $('.shipping_fee').html(res.shipping_fee);
                $('.total_plus_shipping').html(res.total_plus_shipping);
            } , 'json')
        })

        return false;
    })

    $("body").on("click", ".remove", function(e) {
        e.preventDefault();
        $(this).parent().submit();
    })

    $.get('/carts/edit_cart_partial' , function(res){
        $(".cart_items_form").html(res);
    })

    $.get('/carts/cart_total_price_partial' , function(res){
        $('.total_cart_amount').html(res.total_cart_amount);
        $('.shipping_fee').html(res.shipping_fee);
        $('.total_plus_shipping').html(res.total_plus_shipping);
    } , 'json')

    $("body").on("click", ".increase_decrease_quantity", function() {
        let input = $(this).closest(".quantity_form").find("input");
        let input_val = parseFloat(input.val());

        if($(this).attr("data-quantity-ctrl") == 1) {
            input.val(input_val + 1);
        }
        else {
            if(input_val != 1) {
                input.val(input_val - 1)
            }
        };

        $(this).closest(".quantity_form").submit();
    });

    $("body").on("click" , "form.pay_form button" , function(e){
        $(this).text('Processing Payment')
    })

    /*
    DOCU: Stripe payment scripts

    AUTHOR: Wendell
    */
    $(function () {
        var $stripeForm = $(".pay_form");
        $('form.pay_form').bind('submit', function (e) {
            var $stripeForm = $(".pay_form")

            if (!$stripeForm.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, res) {
            if (res.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(res.error.message);
            } else {
                var token = res['id'];
                $stripeForm.find('input[type=text]').empty();
                $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $stripeForm.get(0).submit();
            }
        }
    });
});