window.AppConvenio = {
    insert: function (args) {
        new Vue({
            el: '#AppConvenio',
            data() {
                return {
                    type_institution: 1,
                    type_entity: 1,
                    type_management: 1
                }
            },
            created: function() {
            },
            mounted: function () {
                this.onLoad();
            },
            watch: {
            },
            computed: {
            },
            methods: {
                onLoad: function () {
                    this.onDeleteFile();
                    this.onEvent();
                },
                onSave: function (e) {
                    e.preventDefault();
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            var formData = new FormData(e.target);
                            $.ajax({
                                url: help.CONVERSA_URL + '/save',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) { 
                                swal2.show({
                                    icon:rsp.success ? 'success' : 'error', 
                                    text:rsp.message,
                                    onOk: function () {
                                        if (rsp.success) {
                                            $('#frmSave').trigger("reset");
                                            swal2.loading();
                                            window.location.href = help.CONVERSA_URL + '/convenio/' + rsp.data.code; 
                                            // window.location.reload();
                                        }
                                    }
                                });
                            })
                            .fail(function (xhr, status, error) {
                                swal2.show({icon:'error', text:error});
                            })                                    
                        }
                    });
                },
                onTypeInstitution: function (e) {
                    this.type_institution = e.target.value;
                },
                onTypeManagement: function (e) {
                    this.type_management = e.target.value;
                },
                onTypeEntity: function (e) {
                    this.type_entity = e.target.value;
                },
                onAddFile: function () {
                    const d = new Date();
                    let time = d.getTime();
                    $('#panel-file').append(`
                    <div class="d-flex mb-4">
                        <div class="custom-file">
                            <input type="file" name="files[]" class="custom-file-input" id="customFile-${time}" multiple required>
                            <label class="custom-file-label" for="customFile-${time}">Seleccionar</label>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger btnDeleteFile ml-2"><i class="fa fa-times p-0" aria-hidden="true"></i></button>
                        </div>
                    <div>`);
                    this.onDeleteFile();
                    this.onEvent();
                },
                onDeleteFile: function () {
                    $('.btnDeleteFile').off('click');
                    $('.btnDeleteFile').on('click', function (e) {
                        $(this).parent().parent().remove();
                    });                    
                },
                onEvent: function () {
                    $('.custom-file-input').on('change', function(e) {
                        let names = [];
                        if (e.target.files.length > 0) {
                            for (let i = 0; i < e.target.files.length; i++) {
                                names.push(e.target.files[i].name);
                            }
                        }
                        $(this).next('.custom-file-label').text(names.length > 0 ? names.join(',') : 'Seleccionar');
                    });
                    $('.summernote').summernote({
                        height: 75,
                        toolbar: false,
                        minHeight: null,
                        maxHeight: null,
                        focus: true
                    });
                },
                onNumberOnly: function (evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                      evt.preventDefault();;
                    } else {
                      return true;
                    }
                },
                onSearchDNI: function () {
                    let val = document.getElementById('dni_solicitant').value;
                    if (!(val.length > 0)) {
                        swal2.show({icon:'error', text:'El campo DNI es obligatorio'}); return;
                    }
                    swal2.loading();
                    var formData = new FormData();
                    formData.append('dni', val);
                    $.ajax({
                        url: help.CONVERSA_URL + '/dni',
                        method: 'POST',
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                    })
                    .done(function (rsp) {
                        swal2.loading(false);
                        if (!rsp.success) {
                            swal2.show({icon:'error', text:rsp.message});
                        }
                        document.getElementById('name_solicitant').value = rsp.data ? rsp.data.user.names : '';
                        document.getElementById('last_name_solicitant').value = rsp.data ?  (rsp.data.user.last_name_paternal +' '+rsp.data.user.last_name_maternal) : '';
                        document.getElementById('dni_solicitant').value = val;
                    })
                    .fail(function (xhr, status, error) {
                        swal2.show({icon:'error', text:error});
                    }) 
                }
            }
        });
    }
}
