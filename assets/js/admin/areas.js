window.AppAreaAdmin = {
    init: function (args) {
        new Vue({
            el: '#AppAreaAdmin',
            data() {
                return {
                    areas: args.areas != undefined ? args.areas : [],
                    area: Object.create({}),
                    modules: [],
                    externals: args.externals != undefined ? args.externals : []
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
                    var table_areas = $('#table-areas').DataTable({
                        "language": help.dataTable.language,
                        "ordering": true,
                        "info":     false,
                        "paging": false,
                        "scrollCollapse": true,
                    });
                    $('#search-table').on('keyup', function () {
                        table_areas.search($(this).val()).draw();
                    });
                },
                onForm: function (index) {
                    if (index === -1) {
                        $('#modal-label').text('Nueva Área');
                        this.area = Object.create({});
                    } else {
                        $('#modal-label').text('Editar Área');
                        this.area = this.areas[index];
                    }
                    $('#modal-areas').modal('show');
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
                                url: help.CONVERSA_URL + '/admin/areas/save',
                                method: 'POST',
                                dataType: 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function (rsp) { 
                                if (rsp.success) {
                                    $('#modal-areas').modal('hide');
                                }
                                swal2.show({
                                    icon:rsp.success ? 'success' : 'error', 
                                    text:rsp.message,
                                    onOk: function () {
                                        if (rsp.success) {
                                            $('#modal-areas').modal('hide');
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
                    this.area = this.areas[index];
                    let formData = new FormData();
                    formData.append('id', this.area.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de eliminar?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/areas/remove',
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
                onSavePermits: function (e) {
                    e.preventDefault();
                    var formData = new FormData(e.target);
                    formData.append('area_id', this.area.id);
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: help.CONVERSA_URL + '/admin/areas/permisos/save',
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
                onPermits: function (index) {
                    this.area = this.areas[index];
                    this.modules = this.area.modules;
                    $('#modal-permits').modal();
                },
                onItem: function (sid) {
                    document.getElementById(sid).checked = false;
                }
            }
        });
    }
}
