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

    $("body").on("click", '.add_image_button', function() {
        $('#add_image_input').trigger('click');
    });

    $("body").on("click", '.edit_image_button', function() {
        $('#edit_image_input').trigger('click');
    });

    $("body").on("click", '.add_category_button', function() {
        $('#add_category_input').trigger('click');
    });

    $("body").on("change", `#add_image_input`, function() {
        let html = '';

        for(let i=1; i<=5; i++){
            file = this.files[i-1];
        
            if (file) {
                html += 
                `<li>
                    <img src="" class="add_preview_image_${i}">
                </li>`;
            }
        }

        $('.add_preview_image_container').html(html);

        for(let i=1; i<=5; i++){
            file = this.files[i-1];
        
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $(`.add_preview_image_${i}`).attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("body").on("change", `#edit_image_input`, function() {
        let html = '';

        for(let i=1; i<=5; i++){
            file = this.files[i-1];
        
            if (file) {
                html += 
                `<li>
                    <img src="" class="edit_preview_image_${i}">
                </li>`;
            }
        }

        $('.edit_preview_image_container').html(html);

        for(let i=1; i<=5; i++){
            file = this.files[i-1];
        
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $(`.edit_preview_image_${i}`).attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $("body").on("change", `#add_category_input`, function() {
        file = this.files[0];
        
        if (file) {
            let html = '<img src="" class="category_preview_image">';

            $('.category_preview_image_container').html(html);

            let reader = new FileReader();
            reader.onload = function (event) {
                $(".category_preview_image").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $("body").on("submit" , ".delete_product_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $("section").html(res);
            $('.popover_overlay').hide();
        })

        return false;
    })

    $("body").on("submit" , ".update_edit_form" , function() {
        $.post($(this).attr("action") , $(this).serialize() , function(res) {
            $("#edit_product_modal").html(res);
        })

        $('#edit_product_modal').show();
        $(".modal-backdrop").show();

        return false;
    })

    $("body").on("click", '.edit_close_modal , .edit_cancel_modal', function() {
        $('#edit_product_modal').hide();
        $(".modal-backdrop").hide();
    });

    $("body").on("submit", ".pagination_form", function() {
        $.post($(this).attr("action"), $(this).serialize(), function(res) {
            $("section").html(res);
        });
        return false;
    });
});