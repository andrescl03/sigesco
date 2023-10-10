window.AppProccessAdmin = {
    tracing: function (args) {
        new Vue({
            el: '#AppProccessAdmin',
            data() {
                return {
                    proponents: args.proponents != undefined ? args.proponents : [],
                    proponent: Object.create({}),
                    convenio: args.convenio != undefined ? args.convenio : {},
                    user_session: args.user_session != undefined ? args.user_session : {},
                    sobservation: false,
                    base_url: help.CONVERSA_URL,
                    specialist: Object.create({}),
                    specialists: args.specialists != undefined ? args.specialists : []
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
                isProponent: function () {
                    let isvalid = false;
                    for (let i = 0; i < this.proponents.length; i++) {
                        if (this.proponents[i].user_id == this.user.id) {
                            isvalid = true;
                        }                        
                    }
                    return isvalid;
                }
            },
            methods: {
                onLoad: function () {
                    this.onEvents();
                },
                onEvents: function () {
                    $('.custom-file-input').on('change', function(e) {
                        let names = [];
                        if (e.target.files.length > 0) {
                            for (let i = 0; i < e.target.files.length; i++) {
                                names.push(e.target.files[i].name);
                            }
                        }
                        $(this).next('.custom-file-label').text(names.length > 0 ? names.join(',') : 'Seleccionar');
                    });
                    this.sobservation = this.convenio.status_proponent == 'favorable' ? false : true;
                },
                onForm: function (index) {
                    if (index === -1) {
                        this.specialist = Object.create({});
                        if (this.user_session) {
                            this.specialist.name = this.user_session.name + ' ' + this.user_session.lastname;
                        }
                    } else {
                        this.specialist = this.specialists[index];
                    }
                    $('#modal-specialists').modal('show');
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/seguimiento/save',
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
                                            swal2.loading();
                                            location.reload();
                                        }
                                    }
                                });
                            })
                            .fail(function (xhr, status, error) {
                                swal2.show({icon:'error', html:error});
                            })                                    
                        }
                    });
                },
                onDeleteFile: function (index) {
                    if (this.specialist.files.length > 0) {
                        let id = this.specialist.files[index].id;
                        let formData = new FormData();
                        formData.append('id', id);
                        swal2.show({
                            icon: 'question',
                            text: '¿Estás seguro de eliminar?',
                            showCancelButton: true,
                            onOk: function () {
                                swal2.loading();
                                $.ajax({
                                    url: help.CONVERSA_URL + '/files/remove',
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
                                                swal2.loading();
                                                location.reload();
                                            }
                                        }
                                    });
                                })
                                .fail(function (xhr, status, error) {
                                    swal2.show({icon:'error', html:error});
                                })                                    
                            }
                        });
                    }  
                },
                onObserved: function (e) {
                    this.sobservation = e.target.value == 'favorable' ? false : true;
                }
            }
        });
    },
    compliance: function (args) {
        new Vue({
            el: '#AppProccessAdmin',
            data() {
                return {
                    convenios: args.convenios != undefined ? args.convenios : [],
                    convenio: Object.create({}),
                    user_session: args.user_session != undefined ? args.user_session : {},
                    base_url: help.CONVERSA_URL
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
                    this.onDataTable();
                },
                onDataTable: function () {
                    var table_convenios = $('#table-convenios').DataTable({
                        "language": help.dataTable.language,
                        "ordering": true,
                        "info":     false,
                        "paging": false,
                        "scrollCollapse": true,
                        aLengthMenu: [
                            [10, 50, 100, 200, -1],
                            [10, 50, 100, 200, "All"]
                        ],
                        iDisplayLength: -1,
                        order: [[0,'desc']],
                        /*columnDefs: [
                            { targets: 11, className: 'all' },
                            { targets: 12, className: 'all' }
                        ],*/
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                title: 'Convenios - Cumplimiento'
                            }
                        ]
                    });
                    $('.btn-export-excel').on('click', function(e){
                        e.preventDefault();
                        $('.buttons-excel').trigger('click');
                    });
                    $('#search-table').on('keyup', function () {
                        table_convenios.search($(this).val()).draw();
                    });
                },
                onForm: function (index) {
                    this.convenio = this.convenios[index];
                    this.convenio.name_specialist = this.convenio.name_specialist ? this.convenio.name_specialist : this.user_session.name + ' ' + this.user_session.lastname;
                    $('#modal-convenios').modal('show');
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/cumplimiento/save',
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
                                            swal2.loading();
                                            location.reload();
                                        }
                                    }
                                });
                            })
                            .fail(function (xhr, status, error) {
                                swal2.show({icon:'error', text:error});
                            })                                    
                        }
                    });
                }
            }
        });
    }
}
