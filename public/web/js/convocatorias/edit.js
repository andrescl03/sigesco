const AppConvovatoriaEditWeb = () => {
    const dom = document.querySelector('#AppConvovatoriaEditWeb');

    const convocatoriaId = dom.getAttribute('data-id');
    dom.removeAttribute('data-id');

    const convocatoriaType = dom.getAttribute('data-type');
    dom.removeAttribute('data-type');

    const uid = dom.getAttribute('data-uid');
    dom.removeAttribute('data-uid');
    

    const forms = dom.querySelectorAll('.form-postulant');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (!form.checkValidity()) {
                e.stopPropagation()
            }
            form.classList.add('was-validated');
            if (form.checkValidity()) {
                const formData = new FormData(e.target);
                $.ajax({
                    url: window.AppMain.url + 'web/postulaciones/' + uid + '/update',
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                })
                .done(function ({success, data, message}) {
                    if (!success) {
                        sweet2.show({type:'error', html: message});
                        return;
                    }
                    dom.querySelectorAll('.modal').forEach(function(modalElem) {
                        const myModal = new bootstrap.Modal(modalElem);
                        myModal.hide();
                    });
                    sweet2.show({
                        type:'success', 
                        html: message,
                        onOk: () => {
                            sweet2.loading({text: 'Actualizando información...'});
                            window.location.reload();
                        }
                    });
                })
                .fail(function (xhr, status, error) {
                    sweet2.show({type:'error', text:error});
                });
            }
        });
    });
}
document.addEventListener('DOMContentLoaded', AppConvovatoriaEditWeb());