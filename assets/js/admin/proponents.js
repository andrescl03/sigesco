window.AppProponentAdmin = {
    list: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
                    proponents: [],
                    areas: args.areas != undefined ? args.areas : [],
                    proponent: Object.create({}),
                    convenio: Object.create({}),
                    convenios: args.convenios != undefined ? args.convenios : [],
                    users: args.users != undefined ? args.users : {},
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
                            { targets: 12, className: 'all' },
                            { targets: 13, className: 'all' }
                        ],*/
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                title: 'Convenios - Proponentes'
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
                onFormAssign: function (index) {
                    this.convenio = this.convenios[index];
                    $('#modal-proponent').modal();
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    formData.append('manage_id', this.user_session.id);
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
                },
                onRemove: function (id) {
                    var formData = new FormData();
                    formData.append('id', id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de eliminar a este proponente?',
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
                                if (rsp.success){
                                    $('#modal-proponent').modal('hide');
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
                                swal2.show({icon:'error', text:error});
                            })                                    
                        }
                    });
                }
            }
        });
    },
    detail: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
                    proponents: args.proponents != undefined ? args.proponents : [],
                    proponent: Object.create({}),
                    convenio: args.convenio != undefined ? args.convenio : {},
                    user: args.user != undefined ? args.user : {},
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
                onDataTable: function () {
                    $('#table-proponents').DataTable({
                        "language": help.dataTable.language,
                        "ordering": true,
                        "info":     false,
                        "paging": false,
                        "scrollCollapse": true,
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
                    this.sobservation = this.convenio.status_proponent == 'favorable' ? false : true;
                },
                onForm: function (index) {
                    if (index === -1) {
                        $('#modal-label').text('Nuevo Proponente');
                        this.proponent = Object.create({});
                        if (this.user) {
                            this.proponent.email = this.user.email;
                            this.proponent.specialist = this.user.name + ' ' + this.user.lastname;
                        }
                    } else {
                        $('#modal-label').text('Editar Proponente');
                        this.proponent = this.proponents[index];
                    }
                    $('#modal-proponents').modal('show');
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    formData.append('user_id', this.user.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/save',
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
                },
                onManagement: function (e) {
                    e.preventDefault();
                    try {
                        var formData = new FormData(e.target);
                        formData.append('convenio_id', this.convenio.id);
                        if (!formData.get('status_proponent')) {
                            throw 'Debe de seleccionar una opinión técnica';
                        }
                        swal2.show({
                            icon: 'question',
                            text: '¿Estás seguro de guardar cambios, el convenio pasará al módulo de Planificación y Presupuesto?',
                            showCancelButton: true,
                            onOk: function () {
                                swal2.loading();
                                $.ajax({
                                    url: help.CONVERSA_URL + '/admin/convenios/proponentes/management',
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
                                                location.href = help.CONVERSA_URL + '/admin/convenios/proponentes';
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
    detail_old: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
                    proponents: args.proponents != undefined ? args.proponents : [],
                    proponent: Object.create({}),
                    convenio: args.convenio != undefined ? args.convenio : {},
                    user: args.user != undefined ? args.user : {},
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
                onDataTable: function () {
                    $('#table-proponents').DataTable({
                        "language": help.dataTable.language,
                        "ordering": true,
                        "info":     false,
                        "paging": false,
                        "scrollCollapse": true,
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
                    this.sobservation = this.convenio.status_proponent == 'favorable' ? false : true;
                },
                onForm: function (index) {
                    if (index === -1) {
                        $('#modal-label').text('Nuevo Proponente');
                        this.proponent = Object.create({});
                        if (this.user) {
                            this.proponent.email = this.user.email;
                            this.proponent.specialist = this.user.name + ' ' + this.user.lastname;
                        }
                    } else {
                        $('#modal-label').text('Editar Proponente');
                        this.proponent = this.proponents[index];
                    }
                    $('#modal-proponents').modal('show');
                },
                onSave: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('convenio_id', this.convenio.id);
                    formData.append('user_id', this.user.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/convenios/proponentes/save',
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
                },
                onManagement: function (e) {
                    e.preventDefault();
                    try {
                        var formData = new FormData(e.target);
                        formData.append('convenio_id', this.convenio.id);
                        if (!formData.get('status_proponent')) {
                            throw 'Debe de seleccionar una opinión técnica';
                        }
                        swal2.show({
                            icon: 'question',
                            text: '¿Estás seguro de guardar cambios?',
                            showCancelButton: true,
                            onOk: function () {
                                swal2.loading();
                                $.ajax({
                                    url: help.CONVERSA_URL + '/admin/convenios/proponentes/management',
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
    }
}
