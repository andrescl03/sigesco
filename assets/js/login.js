$(document).ready(function () {
    $('#frm-login').on('submit', function (e) {
        e.preventDefault();
        swal2.loading();
        var formData = new FormData(e.target);
        $.ajax({
            url: help.CONVERSA_URL + '/signin',
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
    });
});