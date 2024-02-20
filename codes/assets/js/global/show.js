$(document).ready(function(){
    $("body").on("click", ".increase_decrease_quantity", function() {
        let input = $(this).closest("#add_to_cart_form").find("input");
        let input_val = parseFloat(input.val());
        let price = parseFloat(($(".amount").text()).substring(2));

        if($(this).attr("data-quantity-ctrl") == 1) {
            input.val(input_val + 1);
        }
        else {
            if(input_val != 1) {
                input.val(input_val - 1)
            }
        };

        let total_amount = parseFloat(input.val()) * price;
        total_amount = total_amount.toFixed(2)
        $("#add_to_cart_form").find(".total_amount").text("$ " + total_amount);
    });

    $("body").on("change", "#quantity", function() {
        let input = $(this).closest("#add_to_cart_form").find("input");
        let price = parseFloat(($(".amount").text()).substring(2));

        let total_amount = parseFloat(input.val()) * price;
        total_amount = total_amount.toFixed(2)
        $("#add_to_cart_form").find(".total_amount").text("$ " + total_amount);
    });

    $("body").on("click", ".show_image", function() {

        let show_image_btn = $(this);
        show_image_btn.closest("ul").find(".active").removeClass("active");
        show_image_btn.closest("li").addClass("active");
        show_image_btn.closest("ul").closest("li").children().first().attr("src", show_image_btn.find("img").attr("src"));
    });

    $("body").on("submit", "#add_to_cart_form", function() {
        $.post($(this).attr("action"), $(this).serialize(), function(res) {
            $("<span class='added_to_cart'>Added to cart succesfully!</span>")
            .insertAfter("#add_to_cart")
            .fadeIn()
            .delay(5000)
            .fadeOut(function() {
                $(this).remove();
            });

            $('.show_cart').text(res);
        });

        return false;
    });
});

