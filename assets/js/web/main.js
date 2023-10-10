$(document).ready(function() {

    $('.side-nav').on('click','a',function(event){
        event.preventDefault();
            var body = $("html, body"),
            link = $(this).attr('data-scroll');
            body.stop().animate({scrollTop: $('.section[data-scrolled="'+link+'"]').offset().top}, '600', 'swing', function() { 
        });
        return false;
    });

    var scrollTop = $(".scrollTop");
    $(window).scroll(function() {
        var topPos = $(this).scrollTop();
        if (topPos > 100) {
            $(scrollTop).css("opacity", "1");
        } else {
            $(scrollTop).css("opacity", "0");
        }
    });
    
    $(scrollTop).click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;  
    });

});