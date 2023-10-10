window.AppMesaParteAdmin = {
    init: function (args) {
        new Vue({
            el: '#AppMesaParteAdmin',
            data() {
                return {
                    convenios: args.convenios != undefined ? args.convenios : [],
                    convenio: {},
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
                        order: [],
                        /*columnDefs: [
                            { targets: 11, className: 'all' },
                            { targets: 12, className: 'all' }
                        ],*/
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excel',
                                title: 'Convenios'
                            }
                        ]
                    });
                    $('.btn-export-excel').on('click', function(e){
                        e.preventDefault();
                        $('.buttons-excel').trigger('click');
                    });
                    $('#status').on('change', function () {
                        table.columns(2).search($(this).val()).draw();                
                    });
                    $('#search-table').on('keyup', function () {
                        table.search($(this).val()).draw();
                    });
                },
                onForm: function (index) {
                    this.convenio = this.convenios[index];
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
                                url: help.CONVERSA_URL + '/admin/convenios/mesaparte/save',
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
        });
    }
}
