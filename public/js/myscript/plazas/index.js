const AppPlazaIndex = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        var choiceCboxColegio = 0;
        const object = {
            data() {
                return {
                    table: {},
                    modalPlaza: new bootstrap.Modal(dom.querySelector('#modalPlaza')),
                    modalAdjudicaciones: new bootstrap.Modal(dom.querySelector('#modalAdjudicaciones')),
                    modalConfirmAdjudicacion: new bootstrap.Modal(dom.querySelector('#modalConfirmAdjudicacion')),
                    modalUploadPlaza: new bootstrap.Modal(dom.querySelector('#modalUploadPlaza')),
                    modalResponsePlazas: new bootstrap.Modal(dom.querySelector('#modalResponsePlazas')),
                    any: 0,
                    niveles: [],
                    modalidades: []
                }
            },
            mounted: function () {
                self.initialize();
            },
            methods: {
                initialize: () => {
                    self.clicks();
                    self.pagination(self.onActionRows);

                    choiceCboxColegio = new Choices(document.querySelector(".choices-single"));

                },
                clicks: () => {
                    
                    const btnCreates = dom.querySelectorAll('.btn-create');
                    btnCreates.forEach(btn => {
                        btn.addEventListener('click', async (e) => {
                            try {
                                sweet2.loading();
                                const formPlazas = dom.querySelectorAll('.form-plaza');
                                formPlazas.forEach(form => {
                                    form.reset();
                                });
                                const { success, data, message } = await self.create();
                                if (!success) {
                                    throw message;
                                }
                                sweet2.loading(false);
                                self.any = 0;
                                self.modalidades = data.modalidades;
                                self.niveles = data.niveles;
                                self.colegios = data.colegios;
                                self.listModalidades();
                                self.modalPlaza.show();             
                            } catch (error) {
                                sweet2.show({type:'error', text:error});                             
                            }

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

                    const formPlazas = dom.querySelectorAll('.form-plaza');
                    formPlazas.forEach(form => {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            const formData = new FormData(e.target);
                            let url = `configuracion/plazas/store`;
                            if (Number(self.any) > 0) {
                               url = `configuracion/plazas/${self.any}/update`
                            }
                            self.createUpdate(url, formData)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                self.modalPlaza.hide();
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

                    const formConfirmAdjudicacions = dom.querySelectorAll('.form-confirm-adjudicacion');
                    formConfirmAdjudicacions.forEach(form => {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            const formData = new FormData(e.target);
                            const id = self.any;
                            self.liberar(formData)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                self.edit(id)
                                .then((response) => {
                                    if (!response.success) {
                                        throw response.message;
                                    }
                                    sweet2.show({type:'success', text:message});
                                    self.modalConfirmAdjudicacion.hide();
                                    const { plaza_adjudicaciones } = response.data;
                                    self.renderAwards(plaza_adjudicaciones);
                                    self.table.ajax.reload();
                                })
                                .catch(error => {
                                    sweet2.show({type:'error', text:error});
                                })
                                
                            })
                            .catch(error => {
                                sweet2.show({type:'error', text:error});
                            });
                        })
                    });

                    const formUploads = dom.querySelectorAll('.form-upload-plaza');
                    formUploads.forEach(form => {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            sweet2.loading();
                            const formData = new FormData(e.target);
                            self.upload(formData)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                e.target.reset();
                                self.modalUploadPlaza.hide();
                                sweet2.show({
                                    type: 'success',
                                    text: message,
                                    onOk: () => {
                                        self.table.ajax.reload();
                                    }
                                });
                                console.log(data);
                                if (success) {
                                    self.listResponsePlazas(data.items);
                                }
                            })
                            .catch(error => {
                                sweet2.show({type:'error', text:error});
                            });
                        })
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
                           "url": window.AppMain.url + 'configuracion/plazas/pagination',
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
                                "data": "plz_id",
                                "render": function ( data, type, row, meta ) {
                                    return row.plz_id;
                                }
                            },
                            {
                                "targets": 1,
                                "data": "codigo_plaza",
                                "render": function ( data, type, row, meta ) {
                                    return row.codigo_plaza;
                                }
                            },
                            {
                                "targets": 2,
                                "data": "ie",
                                "render": function ( data, type, row, meta ) {
                                    return row.ie;                                    
                                }
                            },
                            {
                                "targets": 3,
                                "data": "mod_abreviatura",
                                "render": function ( data, type, row, meta ) {
                                    return row.mod_abreviatura;                                    
                                }
                            },
                            {
                                "targets": 4,
                                "data": "niv_descripcion",
                                "render": function ( data, type, row, meta ) {
                                    return row.niv_descripcion;                                    
                                }
                            },
                          
                            {
                                "targets": 5,
                                "data": "especialidad",
                                "render": function ( data, type, row, meta ) {
                                    return row.especialidad;
                                }
                            },
                            {
                                "targets": 6,
                                "data": "especialidad_general",
                                "render": function ( data, type, row, meta ) {
                                    return row.especialidad_general;                                    
                                }
                            },
                            {
                                "targets": 7,
                                "data": "jornada",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.jornada;
                                }
                            },
                            {
                                "targets": 8,
                                "data": "tipo_vacante",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.tipo_vacante;
                                }
                            },
                            {
                                "targets": 9,
                                "data": "motivo_vacante",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.motivo_vacante;
                                }
                            },
                            {
                                "targets": 10,
                                "data": "descripcion",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.descripcion;
                                }
                            },
                            {
                                "targets": 11,
                                "data": "estado",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return row.estado == 0 ? `<span class="badge bg-danger">Cerrado</span>` : `<span class="badge bg-success">Abierto</span>`;
                                }
                            },
                            {
                                "targets": 12,
                                "data": "deleted_at",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return `<button type="button" class="btn btn-sm btn-light btn-active-light me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-2 dropdown-menu dropdown-menu-start">
                                                <div class="menu-item px-3 py-2">
                                                    <a href="#" class="menu-link text-danger px-3 btn-edit" data-id="${row.plz_id}">Editar</a>
                                                </div>
                                                <div class="menu-item px-3 py-2">
                                                    <a href="#" class="menu-link text-danger px-3 btn-award" data-id="${row.plz_id}">Adjudicados</a>
                                                </div>
                                                <div class="menu-item px-3 py-2">
                                                    <a href="#" class="menu-link text-danger px-3 btn-remove" data-id="${row.plz_id}">Eliminar</a>
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
                            url: window.AppMain.url + `configuracion/plazas/${id}/edit`,
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
                            url: window.AppMain.url + `configuracion/plazas/create`,
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
                            url: window.AppMain.url + `configuracion/plazas/${id}/remove`,
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
                upload: (formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `configuracion/plazas/upload`,
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
                renderAwards: (items) => {
                    const tbodies = dom.querySelectorAll('.tbody-adjudicaciones');
                    tbodies.forEach(tbody => {
                        let rows = ``;
                        if (items.length == 0) {
                            rows = `<tr><td colspan="8" class="text-center">No hay registros para mostrar</td></tr>`;
                        } else {
                            items.forEach(o => {
                                rows += `<tr>
                                            <td>
                                                ${o.nombre} ${o.apellido_paterno} ${o.apellido_materno}
                                                <br>${o.numero_documento}
                                            </td>
                                            <td>${o.fecha_registro}</td>
                                            <td>${o.fecha_inicio}</td>
                                            <td>${o.fecha_final}</td>
                                            <td>${o.observacion ?? ''}</td>
                                            <td>${o.fecha_liberacion ?? ''}</td>
                                            <td>${
                                                o.estado == 1 ? `<span class="badge bg-success">Adjudicado</span>` : `<span class="badge bg-info">Liberado</span>`
                                            }</td>
                                            <td>
                                                ${
                                                    o.estado == 1 ?  
                                                    `<button class="btn btn-sm btn-danger btn-remove-adj" data-id="${o.id}">Liberar</button>`
                                                    : ``
                                                }
                                            </td>
                                         </tr>`;
                            });
                        }
                        tbody.innerHTML = rows;
                    });
                    const btns = dom.querySelectorAll('.btn-remove-adj');
                    btns.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            dom.querySelector('#formConfirmAdjudicacion').reset();
                            const id = e.target.getAttribute('data-id');
                            dom.querySelector('#adjudicacion_id').value = id;
                            self.modalConfirmAdjudicacion.show();
                        });
                    });
                },
                onActionRows: () => {
                    const btnEdits = document.querySelector('#' + container).querySelectorAll('.btn-edit'),
                        btnRemoves = document.querySelector('#' + container).querySelectorAll('.btn-remove'),
                        btnAwards = document.querySelector('#' + container).querySelectorAll('.btn-award');


                    btnAwards.forEach(btn => {
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
                                const { plaza_adjudicaciones } = data;
                                self.renderAwards(plaza_adjudicaciones);
                                self.modalAdjudicaciones.show();
                            } catch (error) {
                                sweet2.show({type:'error', text:error});                             
                            }
                        });
                    });
                    
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
                                console.log(data);
                                self.any = id;
                                self.modalidades = data.modalidades;
                                self.niveles = data.niveles;
                                self.colegios = data.colegios;
                                self.setPlaza(data.plaza);
                                self.modalPlaza.show();             
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
                setPlaza: (plaza) => {
                    dom.querySelector('select[name="periodo_id"]').value = plaza.periodo_id;
                    dom.querySelector('select[name="tipo_proceso"]').value = plaza.tipo_proceso;
                    dom.querySelector('input[name="codigo_plaza"]').value = plaza.codigo_plaza;
                    dom.querySelector('select[name="tipo_convocatoria"]').value = plaza.tipo_convocatoria;
                    choiceCboxColegio.setChoiceByValue(plaza.colegio_id);
                    dom.querySelector('input[name="especialidad"]').value = plaza.especialidad;
                    dom.querySelector('input[name="especialidad_general"]').value = plaza.especialidad_general;
                    dom.querySelector('input[name="jornada"]').value = plaza.jornada;
                    dom.querySelector('select[name="tipo_vacante"]').value = plaza.tipo_vacante;
                    dom.querySelector('input[name="motivo_vacante"]').value = plaza.motivo_vacante;
                    dom.querySelector('input[name="cargo"]').value = plaza.cargo;
                    self.listModalidades(plaza.mod_id, plaza.nivel_id);
                }
            },
            renders: {
                listResponsePlazas: (items) => {
                    self.modalResponsePlazas.show();
                    const tbodies = dom.querySelectorAll('.tbody-response-plazas');
                    tbodies.forEach(tbody => {
                        let html = ``;
                        items.forEach(({success, data, message}) => {
                            const item = data;
                            html += `
                                <tr>
                                    <td class="text-center">
                                        ${
                                            success ? 
                                            `<i class="far fa-check-circle text-success me-2"></i>` : 
                                            `<i class="far fa-times-circle text-danger me-2"></i>`
                                        }
                                        ${message}
                                    </td>
                                    <td class="text-center">${item.plz_id ?? ''}</td>
                                    <td class="text-center">${item.codigo_plaza}</td>
                                    <td>${item.ie}</td>
                                    <td class="text-center">${item.especialidad}</td>
                                    <td class="text-center">${item.especialidad_general}</td>
                                    <td class="text-center">${item.jornada}</td>
                                    <td class="text-center">${item.tipo_vacante}</td>
                                    <td class="text-center">${item.motivo_vacante}</td>
                                </tr>`;
                        });
                        tbody.innerHTML = html;
                    });
                },
                listModalidades: (mod_id = 0, niv_id = 0) => {
                    const selects = dom.querySelectorAll('.select-modalidad');
                    selects.forEach(select => {
                        let html = `<option value="" hidden selected>Elegir...</option>`;
                        if (self.modalidades.length > 0) {
                            self.modalidades.forEach(n => {
                                html += `<option value="${n.mod_id}">${n.mod_abreviatura} ${n.mod_nombre}</option>`;
                            });
                        }
                        select.innerHTML = html;
                        select.addEventListener('change', (e) => {
                            self.listNiveles(e.target.value);
                        });
                    });
                    dom.querySelector('select[name="mod_id"]').value = Number(mod_id) > 0 ? mod_id : '';
                    self.listNiveles(mod_id, niv_id);
                },
                listNiveles: (mod_id = 0, niv_id = 0) => {
                    const niveles = [];
                    if (Number(mod_id) > 0) {
                        self.niveles.forEach(n => {
                            if (mod_id == n.modalidad_mod_id) {
                                niveles.push(n);
                            }
                        });
                    }
                    const selects = dom.querySelectorAll('.select-nivel');
                    selects.forEach(select => {
                        let html = `<option value="" hidden selected>Elegir...</option>`;
                        if (niveles.length > 0) {
                            niveles.forEach(n => {
                                html += `<option value="${n.niv_id}">${n.niv_descripcion}</option>`;
                            });
                        }
                        select.innerHTML = html;
                    });
                    dom.querySelector('select[name="niv_id"]').value = Number(niv_id) > 0 ? niv_id : '';
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

document.addEventListener('DOMContentLoaded', AppPlazaIndex());
