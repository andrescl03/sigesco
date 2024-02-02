const AppAdjudicacionAdmin = () => {
    const index = (container) => {
        const dom = document.getElementById(container);
        const adjudicacion_id = dom.getAttribute('data-id');
        const now = dom.getAttribute('data-now');
        dom.removeAttribute('data-id');
        dom.removeAttribute('data-now');
        const object = {
            data() {
                return {
                    modalFirmas: {},
                    modalDocentes: {},
                    modalPlazas: {},

                    plazas: [],
                    tplazas: [],
                    postulaciones: [],
                    tpostulaciones: [],
                    usuarios: [],

                    plaza: {},
                    postulacion: {},
                    firmas: [],
                    edit: adjudicacion_id > 0,
                    adjudicacion: {}
                }
            },
            mounted: function () {
                self.modalDocentes = self.modal('modalDocentes');
                self.modalPlazas = self.modal('modalPlazas');
                self.modalFirmas = self.modal('modalFirmas');
                self.initialize();
            },
            methods: {
                initialize: () => {
                    self.getResource()
                    .then((response) => {
                        self.postulaciones = response.postulaciones;
                        self.tpostulaciones = response.postulaciones;
                        self.plazas = response.plazas;
                        self.tplazas = response.plazas;
                        self.usuarios = response.usuarios;
                        dom.querySelector('input[name="fecha_registro"]').value = now;
                        if (self.edit) {
                            if (Object.keys(response.adjudicacion).length > 0) {
                                self.adjudicacion = response.adjudicacion;
                                self.editForm();
                            }
                        }
                        self.clicks();
                        sweet2.loading(false);
                    });
                },
                isValid: () => {
                    return Object.keys(self.plaza).length > 0 && Object.keys(self.postulacion).length > 0;
                },
                clicks: () => {

                    const docenteRender = () => {
                        document.querySelector(".search-postulaciones").value = '';
                        let html = ``;
                        const tbodies = document.querySelectorAll('.table-postulaciones tbody');
                        if (tbodies) {
                            tbodies.forEach(tbody => {
                                if (self.postulaciones.length > 0) {
                                    self.postulaciones.forEach(postulacion => {
                                        let status = '<span class="text-primary fw-bold">PENDIENTE</span>';
                                        switch (Number(postulacion.estado_adjudicacion)) {
                                            case 1:
                                                status = 'REGISTRADO';
                                            break;
                                            case 2:
                                                status = 'NO SE PRESENTO';
                                            break;
                                            case 3:
                                                status = '<span class="text-warning fw-bold">EN ESPERA</span>';
                                            break;
                                        }
                                        html +=`<tr>
                                                    <td>${postulacion.id}</td>
                                                    <td>${postulacion.apellido_paterno} ${postulacion.apellido_materno} ${postulacion.nombre}</td>
                                                    <td>${postulacion.numero_documento}</td>
                                                    <td>${postulacion.modalidad_nombre}</td>
                                                    <td>${postulacion.nivel_nombre}</td>
                                                    <td>${postulacion.especialidad_nombre}</td>
                                                    <td>${postulacion.puntaje ?? 0}</td>
                                                    <td>${postulacion.fecha_registro}</td>
                                                    <td>${status}</td>
                                                    <td>
                                                        <input class="form-check-input" name="check_docente" type="radio" value="${postulacion.id}">
                                                    </td>
                                                    <td>
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-file-signature fa-lg"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item btn-wait-postulante" href="#" data-id="${postulacion.id}"><i class="fa fa-clock-o me-2" aria-hidden="true"></i> En espera</a></li>
                                                                <li><a class="dropdown-item btn-unlink-postulante" href="#" data-id="${postulacion.id}"><i class="fa fa-user-times me-2" aria-hidden="true"></i> No se presento</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>`;
                                    });
                                } else {
                                    html = `<tr>
                                                <td colspan="10" class="text-center">No hay resultados</td>
                                            </tr>`;
                                }
                                tbody.innerHTML = html;
                            });
                        }

                        document.querySelector(".search-postulaciones").addEventListener('input', function () {
                            var searchTerm = this.value.toLowerCase();
                            var tableRows = document.querySelectorAll('.table-postulaciones tbody tr');
                    
                            tableRows.forEach(function (row) {
                                var textContent = row.textContent || row.innerText;
                                var isVisible = textContent.toLowerCase().includes(searchTerm);
                                row.style.display = isVisible ? 'table-row' : 'none';
                            });
                        });
                        const unlinks = document.querySelectorAll(".btn-unlink-postulante");
                        if (unlinks.length > 0) {
                            unlinks.forEach(btn => {
                                const id = btn.getAttribute('data-id');
                                btn.addEventListener('click', function (e) {
                                    sweet2.show({
                                        type: 'question',
                                        text: '¿Estás seguro de separar al docente de la adjudicación?',
                                        showCancelButton: true,
                                        onOk: () => {
                                            sweet2.loading();
                                            const formData = new FormData();
                                            formData.append('status', 2);
                                            self.updateStatus(`adjudicaciones/postulantes/${id}/status`, formData)
                                            .then(({success, data, message}) => {
                                                if (!success) {
                                                    throw message;
                                                }
                                                sweet2.show({type:'success', text:message});
                                                self.postulaciones = data.postulaciones;
                                                docenteRender();
                                            })
                                            .catch(error => sweet2.show({type:'error', text:error}));
                                        }
                                    });
                                }); 
                            });
                        }
                        const waits = document.querySelectorAll(".btn-wait-postulante");
                        if (waits.length > 0) {
                            waits.forEach(btn => {
                                const id = btn.getAttribute('data-id');
                                btn.addEventListener('click', function (e) {
                                    sweet2.show({
                                        type: 'question',
                                        text: '¿Estás seguro de poner en espera al docente?',
                                        showCancelButton: true,
                                        onOk: () => {
                                            sweet2.loading();
                                            const formData = new FormData();
                                            formData.append('status', 3);
                                            self.updateStatus(`adjudicaciones/postulantes/${id}/status`, formData)
                                            .then(({success, data, message}) => {
                                                console.log({success, data, message});
                                                if (!success) {
                                                    throw message;
                                                }
                                                console.log(1);
                                                sweet2.show({type:'success', text:message});
                                                console.log(2);

                                                self.postulaciones = data.postulaciones;
                                                console.log(3);

                                                docenteRender();
                                            })
                                            .catch(error => sweet2.show({type:'error', text:error}));
                                        }
                                    })
                                })
                            })
                        }
                    }

                    const selectTipoDocente = document.querySelectorAll('.select-tipo-docente');
                    selectTipoDocente.forEach(btn => {
                        btn.addEventListener('change', (e) => {
                            const value = e.target.value;
                            if (Number(value) > 0) {
                                const auxs = [];
                                self.tpostulaciones.forEach(o => {
                                    if (o.con_tipo == value) {
                                        auxs.push(o);
                                    }
                                });
                                self.postulaciones = auxs;
                            } else {
                                self.postulaciones = self.tpostulaciones;
                            }
                            docenteRender();
                        });
                    });


                    const btnDocente = document.querySelectorAll('.btn-docente');
                    btnDocente.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            docenteRender();
                            self.modalDocentes.show();
                        });
                    });
                    
                    const btnDocenteAdd = document.querySelectorAll('.btn-docente-add');
                    btnDocenteAdd.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            let isvalid = false;
                            const radios = document.querySelectorAll("input[name='check_docente']");
                            if (radios) {
                                radios.forEach(radio => {
                                    if (radio.checked) {
                                        isvalid = radio.value;
                                        return;
                                    }                      
                                });
                            }
                            if (isvalid) {
                                if (isvalid > 0) {
                                    self.postulacion = self.postulaciones.find((o) => { return o.id === isvalid });
                                    self.docenteRender();
                                    self.modalDocentes.hide();
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar un docente'});
                            }
                            console.log('click');
                        });
                    });

                    const btnPlaza = document.querySelectorAll('.btn-plaza');
                    btnPlaza.forEach(btn => {
                        btn.addEventListener('click', (e) => {

                            if (Object.keys(self.postulacion).length == 0) {
                                sweet2.show({type:'info', text:'Debe de seleccionar un docente'});
                                return;
                            } else {
                                const auxs = [];
                                self.tplazas.forEach(o => {
                                    if (o.tipo_id == self.postulacion.con_tipo) {
                                        auxs.push(o);
                                    }
                                });
                                self.plazas = auxs;
                            }

                            let html = ``;
                            const tbodies = document.querySelectorAll('.table-plazas tbody');
                            if (tbodies) {
                                tbodies.forEach(tbody => {
                                    if (self.plazas.length > 0) {
                                        self.plazas.forEach(plaza => {
                                            html +=`<tr>
                                                        <td>${plaza.plz_id}</td>
                                                        <td>${plaza.codigoPlaza}</td>
                                                        <td>${plaza.ie}</td>
                                                        <td>${plaza.mod_id}</td>
                                                        <td>${plaza.cargo}</td>
                                                        <td>${plaza.especialidad}</td>
                                                        <td>${plaza.jornada}</td>
                                                        <td>${plaza.tipo_vacante}</td>
                                                        <td>${plaza.motivo_vacante}</td>
                                                        <td>
                                                            <input class="form-check-input" name="check_plaza" type="radio" value="${plaza.plz_id}">
                                                        </td>
                                                    </tr>`;
                                        });
                                    } else {
                                        html = `<tr>
                                                    <td colspan="10" class="text-center">No hay resultados</td>
                                                </tr>`;
                                    }
                                    tbody.innerHTML = html;
                                });
                            }

                            document.querySelector(".search-plazas").addEventListener('input', function () {
                                var searchTerm = this.value.toLowerCase();
                                var tableRows = document.querySelectorAll('.table-plazas tbody tr');
                        
                                tableRows.forEach(function (row) {
                                    var textContent = row.textContent || row.innerText;
                                    var isVisible = textContent.toLowerCase().includes(searchTerm);
                                    row.style.display = isVisible ? 'table-row' : 'none';
                                });
                            });

                            self.modalPlazas.show();
                        });
                    });

                    const btnPlazaAdd = document.querySelectorAll('.btn-plaza-add');
                    btnPlazaAdd.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            let isvalid = false;
                            const radios = document.querySelectorAll("input[name='check_plaza']");
                            if (radios) {
                                radios.forEach(radio => {
                                    if (radio.checked) {
                                        isvalid = radio.value;
                                        return;
                                    }                      
                                });
                            }
                            if (isvalid) {
                                if (isvalid > 0) {
                                    self.plaza = self.plazas.find((o) => { return o.plz_id === isvalid });
                                    console.log(self.plaza);
                                    self.plazaRender();
                                    self.modalPlazas.hide();
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar una plaza'});
                            }
                        });
                    });

                    const btnFirma = document.querySelectorAll('.btn-firma');
                    btnFirma.forEach(btn => {
                        btn.addEventListener('click', (e) => {

                            let html = ``;
                            const tbodies = document.querySelectorAll('.table-firmas tbody');
                            if (tbodies) {
                                tbodies.forEach(tbody => {
                                    if (self.usuarios.length > 0) {
                                        self.usuarios.forEach(usuario => {
                                            html +=`<tr>
                                                        <td>${usuario.usu_id}</td>
                                                        <td>${usuario.usu_nombre || ''} ${usuario.usu_apellidos || ''}</td>
                                                        <td>${usuario.usu_dni}</td>
                                                        <td>
                                                            <input class="form-check-input" name="check_firma" type="radio" value="${usuario.usu_id}">
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

                            document.querySelector(".search-firmas").addEventListener('input', function () {
                                var searchTerm = this.value.toLowerCase();
                                var tableRows = document.querySelectorAll('.table-firmas tbody tr');
                        
                                tableRows.forEach(function (row) {
                                    var textContent = row.textContent || row.innerText;
                                    var isVisible = textContent.toLowerCase().includes(searchTerm);
                                    row.style.display = isVisible ? 'table-row' : 'none';
                                });
                            });

                            self.modalFirmas.show();
                        });
                    });
                    
                    const btnFirmaAdd = document.querySelectorAll('.btn-firma-add');
                    btnFirmaAdd.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            let isvalid = false;
                            const radios = document.querySelectorAll("input[name='check_firma']");
                            if (radios) {
                                radios.forEach(radio => {
                                    if (radio.checked) {
                                        isvalid = radio.value;
                                        return;
                                    }                      
                                });
                            }
                            if (isvalid) {
                                if (isvalid > 0) {

                                    self.firmas.forEach(firma => {
                                        if (firma.usu_id == isvalid) {
                                            isvalid = false;
                                            return;
                                        }
                                    });

                                    if (isvalid) {
                                        const usu = self.usuarios.find((o) => { return o.usu_id === isvalid });
                                        self.firmas.push(usu);
                                        self.firmasRender();
                                        self.modalFirmas.hide();    
                                    } else {
                                        sweet2.show({type:'error', text:'El usuario ya se encuentra registrado'});
                                    }
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar una firma'});
                            }
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
                            formData.append('firmas', JSON.stringify(self.firmas));
                            const url = self.edit ? `admin/adjudicaciones/${adjudicacion_id}/update` : `admin/adjudicaciones/store`;
                            self.createUpdate(url, formData)
                            .then((response) =>{
                                e.target.reset();
                                sweet2.show({
                                    type: 'success', 
                                    text: 'Se guardo correctamente',
                                    showConfirmButton: false,
                                });

                                setTimeout(() => {
                                    sweet2.loading();
                                    window.location.href = '/adjudicaciones';                                
                                }, 2500);
                            
                            });
                        });
                    }
                },
                editForm: () => {
                    self.plaza = self.adjudicacion.plaza;
                    self.postulacion = self.adjudicacion.postulacion;
                    self.firmas = self.adjudicacion.firmas;
                    dom.querySelector('input[name="fecha_registro"]').value = self.adjudicacion.fecha_registro;
                    dom.querySelector('input[name="fecha_inicio"]').value = self.adjudicacion.fecha_inicio;
                    dom.querySelector('input[name="fecha_final"]').value = self.adjudicacion.fecha_final;
                    self.plazaRender();
                    self.docenteRender();
                    self.firmasRender();
                },
                getResource: () => {
                    const formData = new FormData();
                    formData.append('adjudicacion_id', adjudicacion_id);
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
                        .done(function ({success, data, message}) {
                            resolve(data);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', text:error});
                        });
                    });
                },
                updateStatus: (url, formData) => {
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
            },
            renders: {
                firmasRender: () => {
                    let html = `No hay registro para mostrar`;
                    if (self.firmas.length > 0) {
                        html = `<ul class="list-group list-group-numbered list-group-flush">`;
                        self.firmas.forEach(firma => {
                            html += `  <li class="list-group-item">${firma.usu_nombre || ''} ${firma.usu_apellidos || ''} <button class="btn btn-sm btn-danger float-end btn-remove-firma" data-id="${firma.usu_id}">X</button> </li>`;
                        });
                        html += `</ul>`;
                    }
                    const divs = dom.querySelectorAll('.list-firmas');
                    divs.forEach(div => {
                        div.innerHTML = html;
                    });
                    const btnFirmaRemove = document.querySelectorAll('.btn-remove-firma');
                    btnFirmaRemove.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const id = e.target.getAttribute('data-id');
                            sweet2.show({
                                type: 'question',
                                text: '¿Estás seguro de eliminar este elemento?',
                                showCancelButton: true,
                                onOk: () => {
                                    const filters = [];
                                    self.firmas.forEach(element => {
                                        if (element.usu_id != id) {
                                            filters.push(element);
                                        }
                                    });
                                    self.firmas = filters;
                                    self.firmasRender();
                                }
                            });
                        })
                    });
                },
                docenteRender: () => {
                    let html = `No hay registro para mostrar`;
                    if (Object.keys(self.postulacion).length > 0) {
                        html = `                        
                        <p><strong>Apellidos y nombres </strong> ${self.postulacion.apellido_paterno} ${self.postulacion.apellido_materno} ${self.postulacion.nombre}</p>
                        <p><strong>Número de documento </strong> ${self.postulacion.numero_documento}</p>
                        <p><strong>Estado civil </strong> ${self.postulacion.estado_civil}</p>
                        <p><strong>Correo </strong> ${self.postulacion.correo}</p>
                        <p><strong>Modalidad </strong> ${self.postulacion.modalidad_nombre}</p>
                        <p><strong>Nivel </strong> ${self.postulacion.nivel_nombre}</p>
                        <p><strong>Especialidad </strong> ${self.postulacion.especialidad_nombre}</p>`;
                    }
                    const divs = dom.querySelectorAll('.list-docente');
                    divs.forEach(div => {
                        div.innerHTML = html;
                    });
                },
                plazaRender: () => {
                    let html = `No hay registro para mostrar`;
                    if (Object.keys(self.plaza).length > 0) {
                        html = `
                        <p><strong>Código plaza</strong> ${self.plaza.codigoPlaza}</p>
                        <p><strong>I.E</strong> ${self.plaza.ie}</p>
                        <p><strong>Cargo</strong> ${self.plaza.cargo}</p>
                        <p><strong>Especialidad</strong> ${self.plaza.especialidad}</p>
                        <p><strong>Jornada</strong> ${self.plaza.jornada}</p>
                        <p><strong>Tipo vacante</strong> ${self.plaza.tipo_vacante}</p>
                        <p><strong>Motivo vacante</strong> ${self.plaza.motivo_vacante}</p>`;
                    }
                    const divs = dom.querySelectorAll('.list-plaza');
                    divs.forEach(div => {
                        div.innerHTML = html;
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

    const indexContainer = 'AppFormAdjudicacionAdmin';
    index(indexContainer);
};

document.addEventListener('DOMContentLoaded', AppAdjudicacionAdmin());
