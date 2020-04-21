$(document).ready(function() {

    $(".button").click(function(e) {
        var parentOffset = $(this).offset(),
            cursorX      = e.pageX - parentOffset.left,
            cursorY      = e.pageY - parentOffset.top;
        $(this).children(".ripple").remove();
        $(this).append('<div class="ripple"></div>');
        $(this).children(".ripple").css({"left" : cursorX + "px", "top" : cursorY + "px"});
        $(".ripple").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend", function() {
            $(this).remove();
        });
    });


    $(".button").hover(function(e) {
        
        var parentOffset = $(this).offset(),
            cursorX      = e.pageX - parentOffset.left,
            cursorY      = e.pageY - parentOffset.top;
        $(this).children(".ripple").remove();
        $(this).append('<div class="ripple"></div>');
        $(this).children(".ripple").css({"left" : cursorX + "px", "top" : cursorY + "px"});

        $(".ripple").one("webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend", function() {
            $(this).remove();
        });
        

    });
});


