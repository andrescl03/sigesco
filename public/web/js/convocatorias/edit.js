const AppConvovatoriaEditWeb = () => {
    const dom = document.querySelector('#AppConvovatoriaEditWeb');

    const convocatoriaId = dom.getAttribute('data-id');
    dom.removeAttribute('data-id');

    const convocatoriaType = dom.getAttribute('data-type');
    dom.removeAttribute('data-type');

    const _uid = dom.getAttribute('data-uid');
    dom.removeAttribute('data-uid');

    let _distritos = [], _departamentos = [], _provincias = [], _especialidades = [], _niveles = [], _modalidades = [];
    
    const formSubmit = (formData) => {
        $.ajax({
            url: window.AppMain.url + 'web/postulaciones/' + _uid + '/update',
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
                formSubmit(formData);
            }
        });
    });

    const btns = dom.querySelectorAll('.btn-delete');
    btns.forEach(btn => {
        const myId = btn.getAttribute('data-id');
        dom.removeAttribute('data-id');
        const myAny = btn.getAttribute('data-any');
        dom.removeAttribute('data-any');
        btn.addEventListener('click', (e) => {
            sweet2.show({
                type: 'question',
                html: '¿Estás seguro de eliminar este elemento?',
                showCancelButton: true,
                onOk: () => {
                    const formData = new FormData();
                    formData.append('id', myId);
                    formData.append('any', myAny);
                    formSubmit(formData);
                }
            });
        });
    });

    const init = () => {
        $.ajax({
            url: window.AppMain.url + 'web/convocatorias/detail',
            method: 'POST',
            dataType: 'json',
            cache: 'false'
        })
        .done(function ({success, data, message}) {
            if (success) {
                _distritos = data.distritos; 
                _departamentos = data.departamentos; 
                _provincias = data.provincias; 
                _especialidades = data.especialidades; 
                _niveles = data.niveles; 
                _modalidades = data.modalidades;
            }
        })
        .fail(function (xhr, status, error) {
            sweet2.show({type:'error', html: error});
        });
    }

    // init();
    
}
document.addEventListener('DOMContentLoaded', AppConvovatoriaEditWeb());