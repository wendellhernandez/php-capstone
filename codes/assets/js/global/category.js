$(document).ready(function() {
    $(document).on('submit' , 'form' , function() {
        $.post($(this).attr('action') , $(this).serialize() , function(data){
            $('section').html(data);
        });
        return false;
    });

    $(document).on('click' , '.category_form' , function(event){
        event.preventDefault();
        event.stopPropagation();
        $(this).submit();
    })
    
    $('form').submit();

    $("body").on("submit", ".pagination_form", function() {
        $.post($(this).attr("action"), $(this).serialize(), function(res) {
            $("section").html(res);
        });
        return false;
    });
});