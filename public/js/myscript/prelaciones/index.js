const AppPrelacionIndex = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        const object = {
            data() {
                return {
                    table: {},
                    modalPrelacion: new bootstrap.Modal(dom.querySelector('#modalPrelacion')),
                    any: 0,
                    niveles: [],
                    colegio_niveles: []
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
                clicks: () => {

                    const btnCreates = dom.querySelectorAll('.btn-create');
                    btnCreates.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            self.any = 0;
                            const forms = dom.querySelectorAll('.form-create-update');
                            forms.forEach(form => {
                                form.reset();
                            });
                            self.create()
                            .then(({success, data, message}) => {
                                if (!success) { 
                                    throw message;
                                }
                                self.renderEspecialidades(data.especialidades);
                                sweet2.loading(false);
                                self.modalPrelacion.show();
                            })
                            .catch((error)=>{
                                sweet2.show({type:'error', text:error});
                            })
                        });
                    });

                    const btnSearchs = dom.querySelectorAll('.btn-search');
                    btnSearchs.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const input = dom.querySelector('#txtBuscador');
                            if (input) {
                                sweet2.loading({text:'Buscando...'});
                                self.table.search(input.value.trim()).draw();
                            }
                        });                        
                    });

                    const forms = dom.querySelectorAll('.form-create-update');
                    forms.forEach(form => {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            const formData = new FormData(e.target);
                            let url = `configuracion/prelaciones/store`;
                            if (Number(self.any) > 0) {
                               url = `configuracion/prelaciones/${self.any}/update`
                            }
                            self.createUpdate(url, formData)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                self.modalPrelacion.hide();
                                e.target.reset();
                                sweet2.show({
                                    type: 'success',
                                    text: message,
                                    onOk: () => {
                                        sweet2.loading({text: 'Actualizando información...'});
                                        self.table.ajax.reload();
                                    }
                                });
                            })
                            .catch((error)=>{
                                sweet2.show({type:'error', text:error});
                            })
                        });
                    });
                },
                pagination: (_callback = ()=>{}) => {
                    self.table = $('#tableIndex').DataTable({
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
                           "url": window.AppMain.url + 'configuracion/prelaciones/pagination',
                           "method": "POST",
                           "dataType": "json",
                           "data": {
                           }
                        },
                        "fnDrawCallback": function(oSettings, json) {
                            sweet2.loading(false);
                            const response = oSettings.json;
                            if (response.success) {
                                _callback();
                            }
                        },
                        "columnDefs": [
                            {
                                "targets": 0,
                                "data": "id",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.id;
                                }
                            },
                            {
                                "targets": 1,
                                "data": "prelacion",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.prelacion;
                                }
                            },
                        
                            {
                                "targets": 2,
                                "data": "especialidad_nombre",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.especialidad_nombre;
                                }
                            },
                           
                            {
                                "targets": 3,
                                "data": "deleted_at",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return `<button type="button" class="btn btn-sm btn-light btn-active-light me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-2 dropdown-menu dropdown-menu-start">
                                                <div class="menu-item px-3 py-2">
                                                    <a href="#" class="menu-link text-danger px-3 btn-edit" data-id="${row.id}">Editar</a>
                                                </div>
                                                <div class="menu-item px-3 py-2">
                                                    <a href="#" class="menu-link text-danger px-3 btn-remove" data-id="${row.id}">Eliminar</a>
                                                </div>
                                            </div>`;
                                }
                            }
                        ]
                    });
                    sweet2.loading();
                },
                edit: (id) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `configuracion/prelaciones/${id}/edit`,
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
                create: () => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `configuracion/prelaciones/create`,
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
                createUpdate: (url, formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + url,
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
                            url: window.AppMain.url + `configuracion/prelaciones/${id}/remove`,
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
                    
                    btnEdits.forEach(btn => {
                        btn.addEventListener('click', async function (e) {
                            try {
                                sweet2.loading();
                                const id = e.target.getAttribute('data-id');
                                const { success, data, message } = await self.edit(id);
                                if (!success) {
                                    throw message;
                                }
                                sweet2.loading(false);
                                self.any = id;
                                console.log(data);
                                self.renderEspecialidades(data.especialidades);
                                self.setEspecialidadPrelacion(data.especialidad_prelacion);
                                self.modalPrelacion.show();             
                            } catch (error) {
                                sweet2.show({type:'error', text:error});                             
                            }
                        });
                    });

                    btnRemoves.forEach(btn => {
                        const id = btn.getAttribute('data-id');
                        
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();                        

                            sweet2.show({
                                type: 'question',
                                title: '¿Estás seguro de eliminar este registro?',
                                showCancelButton: true,
                                onOk: () => {
                                    sweet2.loading();
                                    self.remove(id)
                                    .then(({success, data, message}) => {
                                        if (!success) {
                                            throw message;
                                        }
                                        sweet2.show({
                                            type: 'success',
                                            text: message,
                                            onOk: () => {
                                                sweet2.loading({text: 'Actualizando información...'});
                                                self.table.ajax.reload();
                                            }
                                        });
                                    })
                                    .catch(error => {
                                        sweet2.show({type:'error', text:error});
                                    });
                                }
                            });
                        });
                    });
                },
                setEspecialidadPrelacion: (item) => {
                    dom.querySelector('select[name="especialidad_id"]').value = item.especialidad_id;
                    dom.querySelector('input[name="prelacion"]').value = item.prelacion;
                }
            },
            renders: {
                renderEspecialidades: (items) => {
                    const selects = dom.querySelectorAll('.select-especialidades');
                    selects.forEach(select => {
                        let html = `<option value="" hidden selected>Elegir...</option>`;
                        if (items.length > 0) {
                            items.forEach(n => {
                                html += `<option value="${n.esp_id}">${n.esp_descripcion}</option>`;
                            });
                        }
                        select.innerHTML = html;
                    });
                }
            },
            utilities: {
                modal: (el) => {
                    return new bootstrap.Modal(dom.querySelector('#' + el));
                },
            }
        };
        const self = {
            ...object.data(),
            ...object.methods,
            ...object.renders,
            ...object.events,
            ...object.utilities,
        }
        object.mounted();
    }

    const indexContainer = 'AppIndexPlaza';
    index(indexContainer);
};

document.addEventListener('DOMContentLoaded', AppPrelacionIndex());
