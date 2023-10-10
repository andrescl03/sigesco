window.AppUserAdmin = {
    init: function (args) {
        new Vue({
            el: '#AppUserAdmin',
            data() {
                return {
                    users: args.users != undefined ? args.users : [],
                    areas: args.areas != undefined ? args.areas : [],
                    all_areas: args.all_areas != undefined ? args.all_areas : [],
                    user: Object.create({}),
                    modules: [],
                    user_session: args.user_session,
                    myareas: [],
                    mymodules: [],
                    areas_ids: [],
                    area: Object.create({})
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
                    if (this.user_session.profile_id == 1) {
                        this.areas = this.all_areas;
                    }
                },
                onDataTable: function () {
                    var table_users = $('#table-users').DataTable({
                        "language": help.dataTable.language,
                        "ordering": true,
                        "info":     false,
                        "paging": false,
                        "scrollCollapse": true,
                    });
                    $('#search-table').on('keyup', function () {
                        table_users.search($(this).val()).draw();
                    });
                },
                onForm: function (index) {
                    let areas_ids = [];
                    if (index === -1) {
                        $('#modal-label').text('Nuevo Usuario');
                        this.user = Object.create({});
                    } else {
                        $('#modal-label').text('Editar Usuario');
                        this.user = this.users[index];
                        areas_ids = this.user.areas_ids;
                    }
                    $('.selectpicker').val(areas_ids);
                    $('.selectpicker').selectpicker('refresh');
                    $('#modal-users').modal('show');
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
                                url: help.CONVERSA_URL + '/admin/users/save',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) {
                                if (rsp.success) {
                                    $('#modal-users').modal('hide');
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
                },
                onSavePermits: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('user_id', this.user.id);
                    formData.append('area_id', this.area.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/users/permisos/save',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) {
                                if (rsp.success) {
                                    $('#modal-permits').modal('hide');
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
                },
                onRemove: function (index) {
                    var formData = new FormData();
                    this.user = this.users[index];
                    formData.append('id', this.user.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de eliminar a este usuario?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/users/remove',
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
                onPermits: function (index) {
                    this.user = this.users[index];
                    this.myareas = this.user.areas;
                    if(this.myareas.length > 0) {
                        this.mymodules = this.myareas[0].modules;
                        this.area = this.myareas[0];
                    }
                    $('#modal-permits').modal();
                },
                onMypermits: function (item) {
                    this.area = item;
                    this.mymodules = item.modules;
                }
            }
        });
    },
    profile: function (args) {
        new Vue({
            el: '#AppUserAdmin',
            data() {
                return {
                    user: args.user != undefined ? args.user: Object.create({})
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
                                url: help.CONVERSA_URL + '/admin/users/perfil/save',
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
