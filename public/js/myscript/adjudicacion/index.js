const AppAdjudicacionAdmin = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        const object = {
            data() {
                return {
                    table: {},
                    plaza: {},
                    postulacion: {},
                    valueBuscador: ''
                }
            },
            mounted: function () {
                self.initialize();
            },
            methods: {
                initialize: () => {
                    self.clicks();
                    self.pagination(self.onActionRows);
                },
                isValid: () => {
                    return Object.keys(self.plaza).length > 0 && Object.keys(self.postulacion).length > 0;
                },
                clicks: () => {

                    const btnSearchs = dom.querySelectorAll('.btn-search');
                    btnSearchs.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const input = dom.querySelector('#txt_buscador');
                            if (input) {
                                self.table.search(input.value.trim()).draw();
                            }
                        });                        
                    });

                    const btnReporteAdjudicados = dom.querySelectorAll('.btn-reporte-adjudicados');

                    btnReporteAdjudicados.forEach(btn => {
                        btn.addEventListener('click', (e) => {
 
                            if (self.valueBuscador != null) {
                                let formData = new FormData();
                                formData.append('value', self.valueBuscador);
                                sweet2.loading();
                                $.ajax({
                                    url: window.AppMain.url + `admin/adjudicaciones/reporte`,
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    xhrFields: {
                                        responseType: 'blob'
                                    },
                                    success: function (data, status, xhr) {
                                        sweet2.loading(false);
                                        var filename = "";
                                        var disposition = xhr.getResponseHeader('Content-Disposition');
                                        if (disposition && disposition.indexOf('attachment') !== -1) {
                                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                            var matches = filenameRegex.exec(disposition);
                                            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                                        }
                                        var type = xhr.getResponseHeader('Content-Type');
                                        var blob = new Blob([data], { type: type });

                                         var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = filename;
                                        link.click();
                                    },
                                    error: function (xhr, status, error) {
                                        sweet2.show({ type: 'error', text: error });
                                    }
                                });
                            }
                        })
                    })

                },
                getResource: (formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/adjudicaciones/resource`,
                            method: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                        .done(function ({success, data, message}) {
                            resolve(data);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', text:error});
                        });
                    });
                },
                newAdjudicacion: (formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/adjudicaciones/store`,
                            method: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                        .done(function ({success, data, message}) {
                            resolve(data);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', text:error});
                        });
                    });
                },
                pagination: (_callback = ()=>{}) => {
         
                        self.table = $('#tableIndexAdjudicacion').DataTable({
                            language: {
                                "sProcessing": "Procesando...",
                                "sLengthMenu": "Mostrar _MENU_ registros",
                                "sZeroRecords": "No se encontraron resultados",
                                "sEmptyTable": "Ningún dato disponible en esta tabla",
                                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "sInfoPostFix": "",
                                "sSearch": "Buscar:",
                                "sUrl": "",
                                "sInfoThousands": ",",
                                "sLoadingRecords": "Cargando...",
                                "oPaginate": {
                                   "sFirst": "Primero",
                                   "sLast": "Último",
                                   "sNext": "Siguiente",
                                   "sPrevious": "Anterior"
                                },
                                "oAria": {
                                   "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                   "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                            },
                            searching: true,
                            ordering: false,  
                            responsive: true,
                            "processing" : true,
                            "serverSide" : true,
                            "order" : [],
                            "retrieve": true,
                            "dom": '<l<t>ip>',	
                            "ajax": {
                               "url": window.AppMain.url + 'admin/adjudicaciones/pagination',
                               "method": "POST",
                               "dataType": "json",
                               "data": {}
                            },
                            "fnDrawCallback": function (oSettings, json) {
                                const response = oSettings.json;
                                if (response.success) {
                                    const input = dom.querySelector('#txt_buscador');
                                    self.valueBuscador = input.value.trim();
                                    _callback();
                                }
                            },
                            "columnDefs": [
                                {
                                    "targets": 0,
                                    "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.id;
                                    }
                                },
                                {
                                    "targets": 1,
                                    "data": "plaza_id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.codigo_plaza;
                                    }
                                },
                                {
                                    "targets": 2,
                                    "data": "numero_documento",
                                    "render": function ( data, type, row, meta ) {
                                        return row.numero_documento;
                                    }
                                },
                                {
                                    "targets": 3,
                                    "data": "postulacion_id",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nombre + ' ' + row.apellido_paterno + ' ' + row.apellido_materno;
                                    }
                                },
                                {
                                    "targets": 4,
                                    "data": "fecha_inicio",
                                    "render": function ( data, type, row, meta ) {
                                        return row.fecha_inicio;
                                    }
                                },
                                {
                                    "targets": 5,
                                    "data": "fecha_final",
                                    "render": function ( data, type, row, meta ) {
                                        return row.fecha_final;
                                    }
                                },
                                {
                                    "targets": 6,
                                    "data": "fecha_registro",
                                    "render": function ( data, type, row, meta ) {
                                        return row.fecha_registro;
                                    }
                                },
                                {
                                    "targets": 7,
                                    "data": "ie",
                                    "render": function ( data, type, row, meta ) {
                                        return row.ie;
                                    }
                                },
                                {
                                    "targets": 8,
                                    "data": "mod_abreviatura",
                                    "render": function ( data, type, row, meta ) {
                                        return row.mod_abreviatura;
                                    }
                                },
                                {
                                    "targets": 9,
                                    "data": "niv_descripcion",
                                    "render": function ( data, type, row, meta ) {
                                        return row.niv_descripcion;
                                    }
                                },
                                {
                                    "targets": 10,
                                    "data": "especialidad",
                                    "render": function ( data, type, row, meta ) {
                                        return row.especialidad;
                                    }
                                },
                                {
                                    "targets": 11,
                                    "data": "fecha_registro",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return  `
                                        <button type="button" class="btn btn-sm btn-danger btn-active-danger me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-file" aria-hidden="true"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-2 dropdown-menu dropdown-menu-start">
                                            <div class="menu-item px-3 py-2">
                                                <a target="_blank" href="${window.AppMain.url}reportes/adjudicaciones/${row.id}/acta" class="menu-link text-danger px-3">Acta</a>
                                            </div>
                                            <div class="menu-item px-3 py-2">
                                            <a target="_blank" href="${window.AppMain.url}reportes/adjudicaciones/${row.id}/rd" class="menu-link text-danger px-3">Resolución Directoral</a>
                                        </div>  
                                            <!---<div class="menu-item px-3 py-2">
                                                <a target="_blank" href="${window.AppMain.url}reportes/adjudicaciones/${row.id}/contrato" class="menu-link text-danger px-3" data-id="${row.id}">Contrato</a>
                                            </div>-->
                                        </div>`;
                                    }
                                },
                                {
                                    "targets": 12,
                                    "data": "created_at",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return  `
                                        <button type="button" class="btn btn-sm btn-light btn-active-light me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Acción
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-2 dropdown-menu dropdown-menu-start">
                                            <div class="menu-item px-3 py-2">
                                                <a href="${window.AppMain.url}adjudicaciones/${row.id}/edit" class="menu-link text-danger px-3">Editar</a>
                                            </div>
                                            <!--div class="menu-item px-3 py-2">
                                                <a href="javascript:void(0);" class="menu-link text-danger px-3 btn-remove" data-id="${row.id}">Liberar</a>
                                            </div-->
                                        </div>`;
                                    }
                                }
                            ]
                        });

                 
            

                },
                liberar: (formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `configuracion/plazas/postulantes/liberar`,
                            method: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                        .done(function (response) {
                            resolve(response);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', text:error});
                        });
                    });
                },
                remove: (id) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/adjudicaciones/${id}/remove`, 
                            method: 'POST',
                            dataType: 'json',
                            data: {},
                            processData: false,
                            contentType: false,
                        })
                        .done(function (response) {
                            resolve(response);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', text:error});
                        });
                    });
                }, 
                onActionRows: () => {
                    const btnEdits = document.querySelector('#' + container).querySelectorAll('.btn-edit'),
                        btnRemoves = document.querySelector('#' + container).querySelectorAll('.btn-remove');
                    /*btnEdits.forEach(btn => {
                        btn.addEventListener('click', async function (e) {
                            try {
                                sweet2.loading();
                                const id = e.target.getAttribute('data-id');
                                const { user } = await self.getUser(id);
                                self.user = user;
                                console.log(self.user);                            
                                sweet2.loading(false);
                                bootstrap.Modal.getOrCreateInstance(document.getElementById('modalUpdateUser')).show();                        
                            } catch (error) {
                                sweet2.error({text: error});                                
                            }
                        });
                    });*/
                    btnRemoves.forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            sweet2.show({
                                type: 'question',
                                title: '¿Estás seguro de liberar esta plaza?',
                                showCancelButton: true,
                                onOk: () => {
                                    sweet2.loading();
                                    const id = e.target.getAttribute('data-id');
                                    const formData = new FormData();
                                    formData.append('id', id);
                                    // self.remove(id)
                                    self.liberar(formData)
                                    .then(({success, data, message}) => {
                                        if (!success) {
                                            throw message;
                                        }
                                        self.table.ajax.reload( null, false );
                                        sweet2.show({type:'success', text:message});
                                    })
                                    .catch(error => {
                                        sweet2.show({type:'error', text:error});
                                    });
                                }
                            });
                        });
                    });
                },
            },
            renders: {

            },
            utilities: {
                modal: (el) => {
                    return new bootstrap.Modal(dom.querySelector('#' + el));
                },
            }
        };
        const self = {
            ...object.data,
            ...object.methods,
            ...object.renders,
            ...object.events,
            ...object.utilities,
        }
        object.mounted();
    }

    const indexContainer = 'AppIndexAdjudicacionAdmin';
    index(indexContainer);
};

document.addEventListener('DOMContentLoaded', AppAdjudicacionAdmin());
