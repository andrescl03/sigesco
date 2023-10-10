window.AppEvaluationAdmin = {
    planning: function (args) {
        new Vue({
            el: '#AppPlanningAdmin',
            data() {
                return {
                    convenio: args.convenio != undefined ? args.convenio : Object.create({}),
                    services: {
                        basics: args.services.basics != undefined ? args.services.basics : [],
                        places: args.services.places != undefined ? args.services.places : []
                    },
                    proponent: {},
                    sobservation: false,
                    sobservation_irroga: false,
                    base_url: help.CONVERSA_URL,
                    proponents: args.proponents != undefined ? args.proponents : [],
                    proponent: {}
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
                    this.onEvents();
                    this.sobservation_irroga = this.convenio.status_irroga == 1 ? true : false;
                    this.sobservation = this.convenio.status_planning == 'favorable' || this.convenio.status_planning == '' ? false : true;
                    if (this.proponents.length > 0) {
                        this.proponent = this.proponents[0];
                    }
                },
                onIrroga: function (e) {
                    this.sobservation_irroga = e.target.value == 1 ? true : false;
                },
                onObserved: function (e) {
                    this.sobservation = e.target.value == 'favorable' ? false : true;
                },
                onProponent: function (e) {
                    let id = e.target.value;
                    this.proponent = this.proponents.find(o=>{return o.id == id});
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
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios, Sí es favorable el convenio pasará al módulo Asesoría Jurídica?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/planificacion/management',
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
                                            location.href = help.CONVERSA_URL + '/admin/convenios/planificacion';
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
                onDeleteFile: function (index) {
                    if (this.convenio.files.length > 0) {
                        let id = this.convenio.files[index].id;
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
                                    if (rsp.success) {
                                        $('#modal-convenios').modal('hide');
                                    }
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
                }
            }
        });
    },
    legal: function (args) {
        new Vue({
            el: '#AppLegalAdmin',
            data() {
                return {
                    convenios: args.convenios != undefined ? args.convenios : [],
                    convenio: Object.create({}),
                    proponent: {},
                    sobservation: false,
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
                    this.onEvents();
                },
                onDataTable: function () {
                    var table = $('#table-convenios').DataTable({
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
                                title: 'Convenios - Planificación y presupuesto'
                            }
                        ]
                    });
                    $('.btn-export-excel').on('click', function(e){
                        e.preventDefault();
                        $('.buttons-excel').trigger('click');
                    });
                    $('#search-table').on('keyup', function () {
                        table.search($(this).val()).draw();
                    });
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
                },
                onForm: function (index) {
                    this.convenio = this.convenios[index];
                    this.sobservation = this.convenio.status_legal == 'viable' ? false : true;
                    $('#modal-convenios').modal('show');
                },
                onSave: function (e) {
                    e.preventDefault();
                    try {
                        var formData = new FormData(e.target);
                        formData.append('convenio_id', this.convenio.id);
                        if (!formData.get('status_legal')) {
                            throw 'Debe de seleccionar una opinión técnica';
                        }
                        swal2.show({
                            icon: 'question',
                            text: '¿Estás seguro de guardar cambios?',
                            showCancelButton: true,
                            onOk: function () {
                                swal2.loading();
                                $.ajax({
                                    url: help.CONVERSA_URL + '/admin/convenios/asesoria/save',
                                    method: 'POST',
                                    dataType: 'json',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                })
                                .done(function (rsp) {
                                    if (rsp.success) {
                                        $('#modal-convenios').modal('hide');
                                    }
                                    swal2.show({
                                        icon:rsp.success ? 'success' : 'error', 
                                        text:rsp.message,
                                        onOk: function () {
                                            if (rsp.success) {
                                                swal2.loading();
                                                location.href = help.CONVERSA_URL + '/admin/convenios/asesoria';
                                            }
                                        }
                                    });
                                })
                                .fail(function (xhr, status, error) {
                                    swal2.show({icon:'error', html:error});
                                })                                    
                            }
                        });
                    } catch (error) {
                        swal2.show({icon:'error', html:error});
                    }
                },
                onDeleteFile: function (index) {
                    if (this.convenio.files.length > 0) {
                        let id = this.convenio.files[index].id;
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
                                    if (rsp.success) {
                                        $('#modal-convenios').modal('hide');
                                    }
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
                    this.convenio.status_legal = e.target.value;
                    this.sobservation = e.target.value == 'viable' ? false : true;
                },
            }
        });
    },
    direction: function (args) {
        new Vue({
            el: '#AppDirectionAdmin',
            data() {
                return {
                    convenios: args.convenios != undefined ? args.convenios : [],
                    convenio: Object.create({}),
                    user_session: args.user_session != undefined ? args.user_session : Object.create({}),
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
                    this.onEvents();
                },
                onDataTable: function () {
                    $('#table-convenios').DataTable({
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
                                title: 'Convenios - Dirección'
                            }
                        ]
                    });
                    $('.btn-export-excel').on('click', function(e){
                        e.preventDefault();
                        $('.buttons-excel').trigger('click');
                    });
                },
                onForm: function (index) {
                    this.convenio = this.convenios[index];
                    if (!this.convenio.email_responsible) {
                        this.convenio.email_responsible = this.user_session.email;
                    }
                    $('#modal-convenios').modal('show');
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
                                url: help.CONVERSA_URL + '/admin/convenios/direccion/save',
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
                                            location.href = help.CONVERSA_URL + '/admin/convenios/direccion';
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
                onDeleteFile: function (index) {
                    if (this.convenio.files.length > 0) {
                        let id = this.convenio.files[index].id;
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
                                    if (rsp.success) {
                                        $('#modal-convenios').modal('hide');
                                    }
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
                }
            }
        });
    },
    proponent: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
                    proponents: args.proponents != undefined ? args.proponents : [],
                    areas: args.areas != undefined ? args.areas : [],
                    convenio: args.convenio != undefined ? args.convenio : {},
                    user_session: args.user_session != undefined ? args.user_session : {},
                    base_url: help.CONVERSA_URL,
                    specialist: {},
                    specialists: [],
                    jefes: [],
                    area: {}
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

                },
                onForm: function (index) {
                    $('#modal-proponent').modal();
                },
                onArea: function (e) {
                    var area_id = e.target.value;
                    this.area = this.areas.find(o => { return o.id == area_id });
                    this.specialists = this.area.users;
                    this.jefes = [];
                    for (let i = 0; i < this.specialists.length; i++) {
                        if (this.specialists[i].user_profile_id != 3) {
                            this.jefes.push(this.specialists[i]);
                        }
                    }
                },
                onRemove: function (index) {
                    var id = this.proponents[index].id;
                    var formData = new FormData();
                    formData.append('id', id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de desvincular a este usuario como proponente?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/remove',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) {
                                console.log
                                swal2.show({
                                    icon:rsp.success ? 'success' : 'error', 
                                    text:rsp.message,
                                    onOk: function () {
                                        if (rsp.success) {
                                            swal2.loading();
                                            window.location.reload();
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
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/assign',
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
                                            window.location.reload();
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
    },
    proponentArea: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
                    proponents_areas: args.proponents_areas != undefined ? args.proponents_areas : [],
                    areas: args.areas != undefined ? args.areas : [],
                    convenio: args.convenio != undefined ? args.convenio : {},
                    user_session: args.user_session != undefined ? args.user_session : {},
                    base_url: help.CONVERSA_URL,
                    area: {}
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

                },
                onForm: function (index) {
                    $('#modal-proponent').modal();
                },
                onRemove: function (index) {
                    var area_id = this.proponents_areas[index].area_id;
                    var formData = new FormData();
                    formData.append('area_id', area_id);
                    formData.append('convenio_id', this.convenio.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de desvincular esta área?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/area/remove',
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
                                            window.location.reload();
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
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/area/save',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) { 
                                if (rsp.success) {
                                    $('#modal-proponent').modal('hide');
                                }
                                swal2.show({
                                    icon:rsp.success ? 'success' : 'error', 
                                    text:rsp.message,
                                    onOk: function () {
                                        if (rsp.success) {
                                            swal2.loading();
                                            window.location.reload();
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
    },
}
