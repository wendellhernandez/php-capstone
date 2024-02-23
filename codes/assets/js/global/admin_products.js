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

    $("body").on("submit" , ".add_product_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $('#add_product_name_error').html(res.product_name_error);
            $('#add_description_error').html(res.description_error);
            $('#add_price_error').html(res.price_error);
            $('#add_inventory_error').html(res.inventory_error);

            if(res.success){
                $.get("/products/admin_products_partial" , function(res) {
                    $("section").html(res);
                })

                $('.close_modal').trigger('click');
            }
        } , 'json')
        // return false;
    })

    for(let i=1; i<=5; i++){
        $("body").on("change", `.add_image_${i}`, function(event) {
            file = this.files[0];
    
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $(`.add_preview_image_${i}`).attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    for(let i=1; i<=5; i++){
        $("body").on("click", `.add_preview_image_${i}`, function() {
            $(`.add_image_${i}`).trigger('click');
        });
    }

    $("body").on("submit" , ".delete_product_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $("section").html(res);
            $('.popover_overlay').hide();
        })

        return false;
    })
});