window.AppProponentAdmin = {
    init: function (args) {
        new Vue({
            el: '#AppProponentAdmin',
            data() {
                return {
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
                    $('#table-convenios').DataTable({
                        language: help.dataTable.language,
                        responsive: true,
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
                    convenio: args.convenio != undefined ? args.convenio : {}
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
                    $('#table-proponents').DataTable({
                        language: help.dataTable.language,
                        responsive: true,
                    });
                },
                onForm: function (index) {
                    if (index === -1) {
                        $('#modal-label').text('Nuevo Proponente');
                        this.proponent = Object.create({});
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
                    swal2.show({
                        icon: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: function () {
                            swal2.loading();
                            $.ajax({
                                url: '/convenios/proponentes/save',
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
