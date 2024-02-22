$(document).ready(function() {
    $("body").on("click", ".delete_product", function() {
        $(this).closest("tr").addClass("show_delete");
        $(".popover_overlay").fadeIn();
        $("body").addClass("show_popover_overlay");
    });

    $("body").on("click", ".cancel_remove", function() {
        $(this).closest("tr").removeClass("show_delete");
        $(".popover_overlay").fadeOut();
        $("body").removeClass("show_popover_overlay");
    });

    $("body").on("click", ".upload_image", function() {
        $(".image_input").trigger("click");
    });

    $.get("/products/admin_products_partial" , function(res) {
        $("section").html(res);
    })

    $("body").on("submit" , ".search_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $("section").html(res);
        })
        return false;
    })

    $("body").on("submit" , ".category_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $("section").html(res);
        })
        return false;
    })

    $("body").on("click" , ".category_form" , function(e) {
        e.preventDefault();
        $(this).submit();
    })
});