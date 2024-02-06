const AppAdjudicacionAdmin = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        const any = dom.getAttribute('data-any'),
              convocatoria_id = dom.getAttribute('data-convocatoria'),
              inscripcion_id = dom.getAttribute('data-inscripcion');
        dom.removeAttribute('data-any');
        dom.removeAttribute('data-convocatoria');
        dom.removeAttribute('data-inscripcion');
        const object = {
            data() {
                return {
                    table: {},
                    modalAttachedFiles: new bootstrap.Modal(dom.querySelector('#modalAttachedFiles'))
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
                           "url": window.AppMain.url + 'evaluacion/convocatoria/inscripcion/pagination',
                           "method": "POST",
                           "dataType": "json",
                           "data": {
                                any: any,
                                convocatoria_id: convocatoria_id,
                                inscripcion_id: inscripcion_id 
                           }
                        },
                        "fnDrawCallback": function(oSettings, json) {
                            const response = oSettings.json;
                            if (response.success) {
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
                                "data": "usu_apellidos",
                                "render": function ( data, type, row, meta ) {
                                    return row.usu_apellidos + ' ' + row.usu_nombre;
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
                                "data": "apellido_paterno",
                                "render": function ( data, type, row, meta ) {
                                    return row.apellido_paterno + ' ' + row.apellido_materno;
                                }
                            },
                            {
                                "targets": 4,
                                "data": "nombre",
                                "render": function ( data, type, row, meta ) {
                                    return row.nombre;
                                }
                            },
                            {
                                "targets": 5,
                                "data": "uid",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return '';
                                }
                            },
                            {
                                "targets": 6,
                                "data": "id",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return `<span class="badge bg-success" style="font-size: 0.9em;">${row.uid}</span>`;
                                }
                            },
                            {
                                "targets": 7,
                                "data": "id",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return `<span class="badge bg-success" style="font-size: 0.9em;">${row.numero_expediente}</span>`;
                                }
                            },
                            {
                                "targets": 8,
                                "data": "id",
                                "render": function ( data, type, row, meta ) {
                                    return `<div class="d-flex justify-content-center gap-2">                  
                                                <svg class="svg-inline--fa fa-table-list fa-2xl text-danger btn-files" data-id="${row.id}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table-list" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M0 96C0 60.65 28.65 32 64 32H448C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96zM64 160H128V96H64V160zM448 96H192V160H448V96zM64 288H128V224H64V288zM448 224H192V288H448V224zM64 416H128V352H64V416zM448 352H192V416H448V352z"></path></svg><!-- <i class="fa fa-th-list fa-2xl text-danger" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal1"></i> Font Awesome fontawesome.com -->
                                            </div>`;
                                }
                            },
                            {
                                "targets": 9,
                                "data": "created_at",
                                "className": "text-center",
                                "render": function ( data, type, row, meta ) {
                                    return  any == 'preliminar' ? `<button type="button" class="btn btn-sm btn-light btn-active-light me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-2 dropdown-menu dropdown-menu-start">
                                                <div class="menu-item px-3 py-2">
                                                    <a href="${window.AppMain.url}evaluacion/convocatoria/inscripcion/postulante/${row.id}/revaluar" class="menu-link text-danger px-3">Revaluar</a>
                                                </div>
                                                <div class="menu-item px-3 py-2">
                                                    <a href="${window.AppMain.url}evaluacion/convocatoria/inscripcion/postulante/${row.id}/editar" class="menu-link text-danger px-3">Editar</a>
                                                </div>
                                            </div>` : '-';
                                }
                            }
                        ]
                    });
                },
                attachedfiles: (id) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `evaluacion/convocatoria/inscripcion/postulantes/${id}/attachedfiles`,
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
                        btnFiles = document.querySelector('#' + container).querySelectorAll('.btn-files');
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
                    btnFiles.forEach(btn => {
                        const id = btn.getAttribute('data-id');
                        btn.removeAttribute('data-id');
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();                        
                            sweet2.loading();
                            self.attachedfiles(id)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                self.attachedfilesRender(data.archivos);
                                sweet2.loading(false);
                                self.modalAttachedFiles.show();
                            })
                            .catch(error => {
                                sweet2.show({type:'error', text:error});
                            });
                        });
                    });
                },
            },
            renders: {
                attachedfilesRender: (files) => {
                    console.log(files);
                    let html = `<tr><td colspan="3" class="text-center">No hay registros para mostrar<td></tr>`;
                    if (files.length > 0) {
                        html = ``,
                        files.forEach(file => {
                            const url = window.AppMain.url + 'public' + file.url;
                            html += `
                            <tr class="">
                                <td>${file.tipo_nombre}</td>
                                <td>${file.nombre}</td>
                                <td class="text-center">
                                    <a href="${url}" class="text-danger" target="_blank" donwload>
                                        <svg class="svg-inline--fa fa-file-pdf fa-2xl" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M184 208c0-4.406-3.594-8-8-8S168 203.6 168 208c0 2.062 .2969 23.31 9.141 50.25C179.1 249.6 184 226.2 184 208zM256 0v128h128L256 0zM80 422.4c0 9.656 10.47 11.97 14.38 6.375C99.27 421.9 108.8 408 120.1 388.6c-14.22 7.969-27.25 17.31-38.02 28.31C80.75 418.3 80 420.3 80 422.4zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM292 312c24.26 0 44 19.74 44 44c0 24.67-18.94 44-43.13 44c-5.994 0-11.81-.9531-17.22-2.805c-20.06-6.758-38.38-15.96-54.55-27.39c-23.88 5.109-45.46 11.52-64.31 19.1c-14.43 26.31-27.63 46.15-36.37 58.41C112.1 457.8 100.8 464 87.94 464C65.92 464 48 446.1 48 424.1c0-11.92 3.74-21.82 11.18-29.51c16.18-16.52 37.37-30.99 63.02-43.05c11.75-22.83 21.94-46.04 30.33-69.14C136.2 242.4 136 208.4 136 208c0-22.05 17.95-40 40-40c22.06 0 40 17.95 40 40c0 24.1-7.227 55.75-8.938 62.63c-1.006 3.273-2.035 6.516-3.082 9.723c7.83 14.46 17.7 27.21 29.44 38.05C263.1 313.4 284.3 312.1 287.6 312H292zM156.5 354.6c17.98-6.5 36.13-11.44 52.92-15.19c-12.42-12.06-22.17-25.12-29.8-38.16C172.3 320.6 164.4 338.5 156.5 354.6zM292.9 368C299 368 304 363 304 356.9C304 349.4 298.6 344 292 344H288c-.3438 .0313-16.83 .9687-40.95 4.75c11.27 7 24.12 13.19 38.84 18.12C288 367.6 290.5 368 292.9 368z"></path></svg><!-- <i class="fa-solid fa-file-pdf fa-2xl"></i> Font Awesome fontawesome.com -->
                                    </a>
                                </td>
                            </tr>`;
                        });
                    }
                    const tbodies = dom.querySelectorAll('.tbody-attachedfiles');
                    tbodies.forEach(tbody => {
                        tbody.innerHTML = html;
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

    const indexContainer = 'AppIndexEvaluationGroupInscripcion';
    index(indexContainer);
};

document.addEventListener('DOMContentLoaded', AppAdjudicacionAdmin());
