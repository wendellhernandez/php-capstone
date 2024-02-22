$(document).ready(function() {
    $('.profile_dropdown').on('click', function() {
        let newTop = $(this).offset().top + $(this).outerHeight();
        let newLeft = $(this).offset().left;
        
        $('.admin_dropdown').css({
            'top': newTop + 'px',
            'left': newLeft + 'px'
        });
    });

    $.get('/orders/admin_orders_partial' , function(res){
        $("section").html(res);
        $(".selectpicker").selectpicker("refresh");
    })

    $("body").on("submit", ".search_form", function() {
        ajax($(this));
        return false;
    });

    $("body").on("submit", ".status_forms", function() {
        ajax($(this));
        return false;
    });

    $("body").on("click", ".status_forms", function(e) {
        e.preventDefault();
        $(this).submit();
    });

    $("body").on("submit", ".status_picker", function() {
        ajax($(this));
        return false;
    });

    $("body").on("change", ".selectpicker", function() {
        $(this).parent().submit();
    });

    $("body").on("submit", ".pagination_form", function() {
        ajax($(this));
        return false;
    });
});

function ajax(element){
    $.post(element.attr("action"), element.serialize(), function(res) {
        $("section").html(res);
        $(".selectpicker").selectpicker("refresh");
    });
}