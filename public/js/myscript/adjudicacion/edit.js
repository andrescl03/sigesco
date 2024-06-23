const AppAdjudicacionAdmin = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        const object = {
            data() {
                return {
                    table: {},
                    modalNewAdjudicacion: {},
                    plazas: [],
                    postulaciones: [],
                    plaza: {},
                    postulacion: {}
                }
            },
            mounted: function () {
                self.modalNewAdjudicacion = self.modal('modalNewAdjudicacion');
                self.initialize();
            },
            methods: {
                initialize: () => {
                    self.clicks();
                    self.pagination();
                },
                isValid: () => {
                    return Object.keys(self.plaza).length > 0 && Object.keys(self.postulacion).length > 0;
                },
                clicks: () => {
                    const btnNews = document.querySelectorAll('.btn-new');
                    btnNews.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            sweet2.loading();
                            self.getResource()
                            .then((response) => {
                                self.plazas = response.plazas;
                                self.postulaciones = response.postulaciones;
                                console.log(response);
                                sweet2.loading(false);
                                document.querySelector(".search-plazas").addEventListener('input', function () {
                                    var searchTerm = this.value.toLowerCase();
                                    var tableRows = document.querySelectorAll('.table-plazas tbody tr');
                            
                                    tableRows.forEach(function (row) {
                                        var textContent = row.textContent || row.innerText;
                                        var isVisible = textContent.toLowerCase().includes(searchTerm);
                                        row.style.display = isVisible ? 'table-row' : 'none';
                                    });
                                });

                                document.querySelector(".search-postulaciones").addEventListener('input', function () {
                                    var searchTerm = this.value.toLowerCase();
                                    var tableRows = document.querySelectorAll('.table-postulaciones tbody tr');
                            
                                    tableRows.forEach(function (row) {
                                        var textContent = row.textContent || row.innerText;
                                        var isVisible = textContent.toLowerCase().includes(searchTerm);
                                        row.style.display = isVisible ? 'table-row' : 'none';
                                    });
                                });

                                const formAdjudicacion = document.getElementById('formAdjudicacion');
                                if (formAdjudicacion) {
                                    formAdjudicacion.addEventListener('submit', (e) => {
                                        e.preventDefault();
                                        if (!self.isValid()) {
                                            sweet2.show({type:'error', text:'Debe de seleccionar un docente y una plaza'});
                                            return;
                                        }
                                        const formData = new FormData(e.target);
                                        formData.append('plaza_id', self.plaza.plz_id);
                                        formData.append('postulacion_id', self.postulacion.id);

                                        self.newAdjudicacion(formData)
                                        .then((response) =>{
                                            e.target.reset();
                                            self.modalNewAdjudicacion.hide();
                                            sweet2.show({type:'success', text: 'Se guardo correctamente'});
                                            //self.table.ajax.reload();
                                        });
                                    });
                                }

                                let html = ``;
                                let tbodies = document.querySelectorAll('.table-plazas tbody');
                                if (tbodies) {
                                    tbodies.forEach(tbody => {
                                        if (self.plazas.length > 0) {
                                            self.plazas.forEach(plaza => {
                                                html +=`<tr>
                                                            <td>${plaza.plz_id}</td>
                                                            <td>${plaza.codigo_plaza}</td>
                                                            <td>${plaza.ie}</td>
                                                            <td>${plaza.mod_id}</td>
                                                            <td>${plaza.cargo}</td>
                                                            <td>${plaza.especialidad}</td>
                                                            <td>${plaza.jornada}</td>
                                                            <td>${plaza.tipo_vacante}</td>
                                                            <td>${plaza.motivo_vacante}</td>
                                                            <td>
                                                                <input class="form-check-input" name="check_plaza" type="checkbox" value="${plaza.plz_id}">
                                                            </td>
                                                        </tr>`;
                                            });
                                        } else {
                                            html = `<tr>
                                                        <td colspan="5">No hay resultados</td>
                                                    </tr>`;
                                        }
                                        tbody.innerHTML = html;
                                    });
                                }

                                html = ``;
                                tbodies = document.querySelectorAll('.table-postulaciones tbody');
                                if (tbodies) {
                                    tbodies.forEach(tbody => {
                                        if (self.postulaciones.length > 0) {
                                            self.postulaciones.forEach(postulacion => {
                                                html +=`<tr>
                                                            <td>${postulacion.id}</td>
                                                            <td>${postulacion.apellido_paterno} ${postulacion.apellido_materno} ${postulacion.nombre}</td>
                                                            <td>${postulacion.numero_documento}</td>
                                                            <td>${postulacion.modalidad_nombre}</td>
                                                            <td>${postulacion.nivel_nombre}</td>
                                                            <td>${postulacion.especialidad_nombre}</td>
                                                            <td>${postulacion.puntaje ?? 0}</td>
                                                            <td>${postulacion.fecha_registro}</td>
                                                            <td>
                                                                <input class="form-check-input" name="check_postulacion" type="checkbox" value="${postulacion.id}">
                                                            </td>
                                                        </tr>`;
                                            });
                                        } else {
                                            html = `<tr>
                                                        <td colspan="5">No hay resultados</td>
                                                    </tr>`;
                                        }
                                        tbody.innerHTML = html;
                                    });
                                }
                                
                                const check_plaza = document.querySelector("input[name='check_plaza']");
                                if (check_plaza) {
                                    self.plaza = {};
                                    check_plaza.addEventListener('change', function (e) {
                                        if (e.target.checked) {
                                            const plaza_id = e.target.value;
                                            if (plaza_id > 0) {
                                                self.plaza = self.plazas.find((o) => { return o.plz_id === plaza_id });
                                                console.log(self.plaza);
                                            }
                                        }
                                    });
                                }
                                
                                const check_postulacion = document.querySelector("input[name='check_postulacion']");
                                if (check_postulacion) {
                                    self.postulacion = {};
                                    check_postulacion.addEventListener('change', function (e) {
                                        if (e.target.checked) {
                                            const postulacion_id = e.target.value;
                                            self.postulacion = self.postulaciones.find((o) => { return o.id === postulacion_id });
                                            console.log(self.postulacion);
                                        }
                                    });
                                }

                                self.modalNewAdjudicacion.show();
                            });
                        });
                    });
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
                        "ajax": {
                           "url": '/admin/adjudicaciones/pagination',
                           "method": "POST",
                           "dataType": "json",
                           "data": {}
                        },
                        "fnDrawCallback": function(oSettings, json) {
                            _callback();
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
                                "data": "postulacion_id",
                                "render": function ( data, type, row, meta ) {
                                    return row.nombre + ' ' + row.apellido_paterno + ' ' + row.apellido_materno;
                                }
                            },
                            {
                                "targets": 3,
                                "data": "fecha_inicio",
                                "render": function ( data, type, row, meta ) {
                                    return row.fecha_inicio;
                                }
                            },
                            {
                                "targets": 4,
                                "data": "fecha_final",
                                "render": function ( data, type, row, meta ) {
                                    return row.fecha_final;
                                }
                            },
                            {
                                "targets": 5,
                                "data": "fecha_registro",
                                "render": function ( data, type, row, meta ) {
                                    return row.fecha_registro;
                                }
                            },
                            {
                                "targets": 6,
                                "data": "created_at",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return  `
                                    <button type="button" class="btn btn-sm btn-light btn-active-light me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acción
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4 dropdown-menu dropdown-menu-start">
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0);" class="menu-link text-danger px-3 btn-remove" data-id="${row.id}">Eliminar</a>
                                        </div>
                                    </div>`;
                                }
                            }
                        ]
                    });
                },    
                onActionRows: () => {
                    /*const btnEdits = document.querySelector('#' + container).querySelectorAll('.btn-edit'),
                        btnRemoves = document.querySelector('#' + container).querySelectorAll('.btn-remove');*/
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
                    /*btnRemoves.forEach(btn => {
                        btn.addEventListener('click', function (e) {
                            sweet2.question({
                                title: '¿Estás seguro de eliminar este elemento?',
                                onOk: () => {
                                    const id = e.target.getAttribute('data-id');
                                    self.onDelete(id);
                                }
                            });
                        });
                    });*/
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
