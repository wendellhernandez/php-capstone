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

    $("body").on("submit", ".checkout_form", function() {
        let form = $(this);
        $.post(form.attr("action"), form.serialize(), function(res) {
            $(".wrapper > section").html(res);
            $("#card_details_modal").modal("show");
        } );

        return false;
    });

    $("body").on("submit", ".pay_form", function() {
        let form = $(this);
        $(this).find("button").addClass("loading");
        $.post(form.attr("action"), form.serialize(), function(res) {
            setTimeout(function(res) {
                $("#card_details_modal").find("button").removeClass("loading").addClass("success").find("span").text("Payment Successfull!");
            }, 2000, res);
            setTimeout(function(res) {
                $("#card_details_modal").modal("hide");
            }, 3000, res);
            setTimeout(function(res) {
                $(".wrapper > section").html(res);
            }, 3200, res);
        });
        return false;
    });

    $("body").on("change", ".quantity_form", function() {
        $(this).submit();
    })

    $("body").on("submit", ".quantity_form", function() {
        $.post($(this).attr('action') , $(this).serialize() , function(res){
            $(".cart_items_form").html(res);
        })

        return false;
    })

    $("body").on("submit", ".remove_form", function() {
        $.post($(this).attr('action') , $(this).serialize() , function(res){
            $(".cart_items_form").html(res);
            $(".popover_overlay").hide();

            $.get("/carts/add_to_cart_partial" , function(data){
                $(".show_cart").html(data);
            })
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
});