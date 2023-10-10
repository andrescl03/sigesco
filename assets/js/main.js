/** TOGGLE ASIDE */
$(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
/** SCROLLTOP */
$(document).ready(function () {
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
/** SIGN OUT */
window.signout = function() {
    swal2.show({
        icon: 'question',
        text: '¿Estás seguro de cerrar sesión?',
        showCancelButton: true,
        onOk: function () {
            swal2.loading();
            var formData = new FormData();
            $.ajax({
                url: help.CONVERSA_URL + '/signout',
                method: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
            })
            .done(function (rsp) { 
                if (rsp.success) {
                    window.location.href = '';
                } else {
                    swal2.show({icon:rsp.success ? 'success' : 'error', text:rsp.message});
                }
            })
            .fail(function (xhr, status, error) {
                swal2.show({icon:'error', text:error});
            })    
        }
    });
}

