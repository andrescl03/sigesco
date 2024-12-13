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
                    modalFiltroBusqueda: {},

                    modalPlazas: {},
                    modalUsuarioFirmas: {},

                    plazas: [],
                    tplazas: [],
                    postulaciones: [],
                    modalidades: [],
                    tmodalidades: [],
                    
                    tpostulaciones: [],
                    usuarios: [],
                    tipo_postulacion: 0,
                    tipo_postulacion_name: 0,
                    
                    plaza: {},
                    postulacion: {},
                    firmas: [],
                    edit: adjudicacion_id > 0,
                    adjudicacion: {},
                    usuarioFirmas: [],
                    dataTableModalidades: {},
                    dataTablePlazas: {},
                    dataTablePostulantes: {},
                    
                    modalidadesData: [],
                    nivelesData: [],
                    especialidadesData: [],

                    assignment: {},

                    modalidad_id: 0,
                    nivel_id: 0,
                    especialidad_id: 0,
                 }
            },
            mounted: function () {
                self.modalDocentes = self.modal('modalDocentes');
                self.modalFiltroBusqueda = self.modal('modalFiltroBusqueda');
                self.modalPlazas = self.modal('modalPlazas');
                self.modalFirmas = self.modal('modalFirmas');
                self.modalUsuarioFirmas = self.modal('modalUsuarioFirmas');
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
                        self.modalidades = response.modalidades;
                        self.tmodalidades = response.modalidades;

                        self.usuarios = response.usuarios;
                        self.usuarioFirmas = response.usuario_firmas;
                        self.firmasReload();
                        self.listModalidades();
                        self.listPostulantes();
                        self.listPlazas();
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
                firmasReload: () => {
                    self.firmas = [];
                    self.usuarioFirmas.forEach(item => {
                        self.firmas.push(item);
                    });

                    if (self.firmas.length > 0) {
                        self.firmasRender();
                    }
                },
                isValid: () => {
                    return Object.keys(self.plaza).length > 0 && Object.keys(self.postulacion).length > 0;
                },
                clicks: () => {

                    const inputSearchs = dom.querySelectorAll('.input-search');
                    inputSearchs.forEach(input => {
                        input.addEventListener('search', (e) => {
                            self.dataTablePostulantes.search(e.target.value.trim()).draw();
                        });
                    });

                    const btnSearchs = dom.querySelectorAll('.btn-search');
                    btnSearchs.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const input = dom.querySelector('#txtBuscador');
                            if (input) {
                                self.dataTablePlazas.search(input.value.trim()).draw();
                            }
                        });                        
                    });

                    const inputSearchs1 = dom.querySelectorAll('.input-search-1');
                    inputSearchs1.forEach(input => {
                        input.addEventListener('search', (e) => {
                            self.dataTablePostulantes.search(e.target.value.trim()).draw();
                        });
                    });

                    const btnSearchs1 = dom.querySelectorAll('.btn-search-1');
                    btnSearchs1.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const input = dom.querySelector('#txtBuscador1');
                            if (input) {
                                self.dataTablePostulantes.search(input.value.trim()).draw();
                            }
                        });                        
                    });

                    const btnSearchs2 = dom.querySelectorAll('.btn-search-2');
                    btnSearchs2.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const input = dom.querySelector('#txtBuscador2');
                            if (input) {
                                self.dataTableModalidades.search(input.value.trim()).draw();
                            }
                        });                        
                    });

                    const inputSearchs2 = dom.querySelectorAll('.input-search-2');
                    inputSearchs2.forEach(input => {
                        input.addEventListener('search', (e) => {
                            self.dataTableModalidades.search(e.target.value.trim()).draw();
                        });
                    });

                    const btnUsuarioFirmaAdds = document.querySelectorAll('.btn-usuario-firma-add');
                    btnUsuarioFirmaAdds.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const selectedItems = Array.from(document.getElementById('right-listbox').querySelectorAll('li'));
                            const ids = [];
                            selectedItems.forEach(li => {
                                ids.push(Number(li.getAttribute('data-value')));
                            });
                            const formData = new FormData();
                            formData.append('ids', JSON.stringify(ids));
                            self.setUsuarioFirma(formData)
                            .then(({success, data, message}) => {
                                if (!success) {
                                    throw message;
                                }
                                self.usuarioFirmas = data.usuario_firmas;
                                self.firmasReload();
                                self.modalUsuarioFirmas.hide();
                                sweet2.show({type:'success', text: message});
                            })
                            .catch((error) => {
                                sweet2.show({type:'error', text: error});
                            })
                        });
                    });

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
                                                status = '<span class="text-danger fw-bold">NO SE PRESENTO</span>';
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
                                                    <td class="text-center">${!postulacion.intentos_adjudicacion ? 0 : postulacion.intentos_adjudicacion}</td>
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

                            $('.table-postulaciones').DataTable({
                                "destroy": true,
                                "ordering": false,
                                "bAutoWidth": false,
                                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],   
                                "oLanguage": dt_Idioma,
                                "paging":true		        	
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
                                        text: '¿Estás seguro de separar al auxiliar de la adjudicación?',
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
                                        text: '¿Estás seguro de poner en espera al auxiliar?',
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

                    
                    const selectModalidades = document.querySelectorAll('.select-modalidades');
                    selectModalidades.forEach(select => {
                        select.addEventListener('change', (e) => {
                            self.modalidad_id = e.target.value;
                            self.nivel_id = 0;
                            self.especialidad_id = 0;
                            nivelSelectRender();
                            especialidadSelectRender();
                            self.listModalidades();
                        });
                    });
                
                    const selectNiveles = document.querySelectorAll('.select-niveles');
                    selectNiveles.forEach(select => {
                        select.addEventListener('change', (e) => {
                            self.nivel_id = e.target.value;
                            self.especialidad_id = 0;
                            self.listModalidades();
                            especialidadSelectRender();
                        });
                    });
            
                    const selectEspecialidades = document.querySelectorAll('.select-especialidades');
                    selectEspecialidades.forEach(select => {
                        select.addEventListener('change', (e) => {
                            self.especialidad_id = e.target.value;
                            self.listModalidades();
                        });
                    });

                    const modalidadSelectRender = () => {
                        self.modalidades = [];
                        self.modalidadesData.forEach(o => {
                            self.modalidades.push(o);
                        });
                        const selects = document.querySelectorAll('.select-modalidades');
                        selects.forEach(select => {
                            select.innerHTML = `<option value="0" hidden selected>[SELECCIONE]</option>`;
                            select.innerHTML = `<option value="0">[TODOS]</option>`;
                            self.modalidades.forEach(o => {
                                select.innerHTML += `<option value="${o.mod_id}" ${o.mod_id == self.modalidad_id ? 'selected' : ''}>${o.mod_nombre}</option>`;
                            });
                        });
                    }

                    const nivelSelectRender = () => {
                        self.niveles = [];
                        self.nivelesData.forEach(o => {
                            if (o.modalidad_mod_id === self.modalidad_id) {
                                self.niveles.push(o);
                            }
                        });
                        const selects = document.querySelectorAll('.select-niveles');
                        selects.forEach(select => {
                            select.innerHTML = `<option value="0" hidden selected>[SELECCIONE]</option>`;
                            if (self.modalidad_id > 0) {
                                select.innerHTML = `<option value="0">[TODOS]</option>`;
                            }
                            self.niveles.forEach(o => {
                                select.innerHTML += `<option value="${o.niv_id}" ${o.niv_id == self.nivel_id ? 'selected' : ''}>${o.niv_descripcion}</option>`;
                            });
                        });
                    }

                    const especialidadSelectRender = () => {
                        self.especialidades = [];
                        self.especialidadesData.forEach(o => {
                            if (o.niveles_niv_id === self.nivel_id) {
                                self.especialidades.push(o);
                            }
                        });
                        const selects = document.querySelectorAll('.select-especialidades');
                        selects.forEach(select => {
                            select.innerHTML = `<option value="0" hidden selected>[SELECCIONE]</option>`;
                            if (self.nivel_id > 0) {
                                select.innerHTML = `<option value="0">[TODOS]</option>`;
                            }
                            self.especialidades.forEach(o => {
                                select.innerHTML += `<option value="${o.esp_id}" ${o.esp_id == self.especialidad_id ? 'selected' : ''}>${o.esp_descripcion}</option>`;
                            });
                        });
                    }

                    const btnFiltro = document.querySelectorAll('.btn-filtro-busqueda');
                    btnFiltro.forEach(btn => {
                        btn.addEventListener('click', async (e) => {
                            const response = await self.getSearching(e.target);
                            self.modalidadesData = response.modalidades;
                            self.nivelesData = response.niveles;
                            self.especialidadesData = response.especialidades;
                            modalidadSelectRender();
                            self.modalFiltroBusqueda.show();
                            sweet2.loading(false);
                            return;
                        });
                    });

                    const btnDocente = document.querySelectorAll('.btn-docente');
                    btnDocente.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            console.log(self.modalidades);
                            if (!self.modalidades || self.modalidades.length === 0) {
                                 sweet2.show({type:'info', text:'Debe de seleccionar la modalidad/nivel/especialidad'});
                                return;
                            }
                            setTimeout(() => {
                                self.listPostulantes(self.onActionRowsPostulantes);
                            }, 250);
                            return;
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
                                    console.log(self.postulacion, self.postulaciones, isvalid);
                                    self.postulacion = self.postulaciones.find((o) => { return o.id === isvalid });
                                    self.docenteRender();
                                    self.modalDocentes.hide();
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar un auxiliar'});
                            }
                        });
                    });


                    const btnPlaza = document.querySelectorAll('.btn-plaza');
                    btnPlaza.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            if (Object.keys(self.postulacion).length == 0) {
                                sweet2.show({type:'info', text:'Debe de seleccionar un auxiliar'});
                                return;
                            }
                           // self.modalPlazas.show();
                            setTimeout(() => {
                                self.listPlazas();                                
                            }, 250);
                            
                            return;
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
                                                        <td>${plaza.codigo_plaza}</td>
                                                        <td>${plaza.ie}</td>
                                                        <td>${plaza.mod_abreviatura}</td>
                                                        <td>${plaza.niv_descripcion}</td>
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

                                $('.table-plazas').DataTable({
                                    "destroy": true,
                                    "ordering": false,
                                    "bAutoWidth": false,
                                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],   
                                    "oLanguage": dt_Idioma,
                                    "paging":true		        	
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
                                    self.plazaRender();
                                    self.modalPlazas.hide();
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar una plaza'});
                            }
                        });
                    });


                    const btnModalidadAdd = document.querySelectorAll('.btn-modalidad-add');
                    btnModalidadAdd.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            let isvalid = false; 
                            const radios = document.querySelectorAll("input[name='check_modalidad']");
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
                                    const result = self.assignmentRender(isvalid);
                                    if (result) {
                                        self.modalFiltroBusqueda.hide();
                                        self.listPostulantes();
                                        self.listPlazas();
                                    }
                                }
                            } else {
                                sweet2.show({type:'error', text:'Debe de seleccionar una modalidad'});
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

                    const btnUsuarioFirma = document.querySelectorAll('.btn-usuario-firma');
                    btnUsuarioFirma.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            self.duallistbox(self.usuarios, self.usuarioFirmas);
                            self.modalUsuarioFirmas.show();
                        })
                    });

                    const btnObtenerFechaActual = document.querySelectorAll('.btn-obtener-fecha-actual');

                    btnObtenerFechaActual.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            $.ajax({
                                url: window.AppMain.url + `admin/auxiliares/adjudicaciones/datedefault`,
                                method: 'get',
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                            })
                                .done(function ({ success, data, message }) {

                                    document.querySelector('input[name="fecha_registro"]').value = data;
                                })
                                .fail(function (xhr, status, error) {
                                    sweet2.show({ type: 'error', text: error });
                                });
                        })
                    });

                    const btnObtenerFechaInicioFin = document.querySelectorAll('.btn-obtener-fecha-inicio-fin');
                    btnObtenerFechaInicioFin.forEach(btn => {
                        btn.addEventListener('click', (e) => {

                            document.querySelector('input[name="fecha_inicio"').value = '2024-03-01';
                            document.querySelector('input[name="fecha_final"').value = '2024-12-31';


                        })
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
                                sweet2.show({type:'error', text:'Debe de seleccionar un auxiliar y una plaza'});
                                return;
                            }
                            const formData = new FormData(e.target);
                            formData.append('tipo_convocatoria', self.plaza.tipo_convocatoria);
                            formData.append('plaza_id', self.plaza.plz_id);
                            formData.append('postulacion_id', self.postulacion.id);
                            formData.append('firmas', JSON.stringify(self.firmas));
                            const url = self.edit ? `admin/auxiliares/adjudicaciones/${adjudicacion_id}/update` : `admin/auxiliares/adjudicaciones/store`;
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
                                    window.location.href = window.AppMain.url + `admin/auxiliares/adjudicaciones`;
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
                setUsuarioFirma: (formData) => {
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/auxiliares/adjudicaciones/usuarios/firmas`,
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
                listPlazas: () => {
                    if (Object.keys(self.dataTablePlazas).length == 0) {
                        self.dataTablePlazas = $('#tablePlazas').DataTable({
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
                                "url": window.AppMain.url + 'admin/auxiliares/adjudicaciones/plazas',
                                "method": "POST",
                                "dataType": "json",
                                "data": function(d) {
                                    d.especialidad_id = self.assignment ? self.assignment.especialidad_id : 0;
                                },
                            },
                            "fnDrawCallback": function(oSettings, json) {
                                const response = oSettings.json;
                                if (response.success) {
                                    self.plazas = response.data;
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
                                    "data": "especialidad",
                                    "render": function ( data, type, row, meta ) {
                                        return row.especialidad;
                                    }
                                },
                                {
                                    "targets": 4,
                                    "data": "jornada",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.jornada;
                                    }
                                },
                                {
                                    "targets": 5,
                                    "data": "tipo_vacante",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.tipo_vacante;
                                    }
                                },
                                {
                                    "targets": 6,
                                    "data": "motivo_vacante",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.motivo_vacante;
                                        // return `<span class="badge bg-secondary" style="font-size: 0.9em;">${row.uid}</span>`;
                                    }
                                },
                                {
                                    "targets": 7,
                                    "data": "descripcion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.descripcion;
                                        // return `<span class="badge bg-secondary" style="font-size: 0.9em;">${row.uid}</span>`;
                                    }
                                },
                                {
                                    "targets": 8,
                                    "data": "deleted_at",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        // return ` <input class="form-check-input" name="check_plaza" type="radio" value="${row.plz_id}">`;
                                        return `<label class="btn btn-sm btn-light btn-award-plaza mb-2" data-id="${row.plz_id}" for="input2Radio${row.plz_id}" style="cursor:pointer;"><input class="me-2 shadow-none" name="check_plaza" type="radio" id="input2Radio${row.plz_id}" value="${row.plz_id}"> Agregar</label>`;
                                    }
                                }
                            ],                            
                            "createdRow": function(row, data, index) {
                                $(row).find('.btn-award-plaza').off('click').on('click', function() { 
                                    var id = Number($(this).data('id'));
                                    if (id > 0) {
                                        self.plaza = self.plazas.find((o) => { return Number(o.plz_id) === id });
                                        self.plazaRender();
                                        sweet2.show({type:'success', text: 'Se ha seleccionado correctamente'});
                                    }
                                });
                            }
                        });
                    } else {
                        self.dataTablePlazas.ajax.reload();
                    }
                },
                listModalidades: () => {

                    if (Object.keys(self.dataTableModalidades).length == 0) {

                        self.dataTableModalidades = $('#tableModalidades').DataTable({
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
                                "url": window.AppMain.url + 'admin/auxiliares/adjudicaciones/listarGruposInscripcion',
                                "method": "POST",
                                "dataType": "json",
                                "data": function(d) {
                                    d.modalidad_id = self.modalidad_id;
                                    d.especialidad_id = self.especialidad_id;
                                    d.nivel_id = self.nivel_id;
                                },
                                "beforeSend": function() {
                                    sweet2.loading();
                                }, 
                                "complete": function() { 
                                    sweet2.loading(false);
                                }
                            },
                            "columnDefs": [
                                {
                                    "targets": 0,
                                    "data": "mod_abreviatura",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return '#';
                                    }
                                },
                                {
                                    "targets": 1,
                                    "data": "mod_abreviatura",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.mod_abreviatura;
                                    }
                                },
                                {
                                    "targets": 2,
                                    "data": "niv_descripcion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.niv_descripcion;
                                    }
                                },
                                {
                                    "targets": 3,
                                    "data": "esp_descripcion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.esp_descripcion;
                                    }
                                },
                                {
                                    "targets": 4,
                                    "data": "esp_id",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return ` <input class="form-check-input" name="check_modalidad" type="radio" value="${row.esp_id}" style="cursor:pointer;">`;
                                    }
                                }
                            ]
                        });
                    } else {
                        self.dataTableModalidades.ajax.reload();
                    }
                },
                listPostulantes: () => {
                    if (Object.keys(self.dataTablePostulantes).length == 0) {
                     
                        self.dataTablePostulantes = $('#tablePostulantes').DataTable({
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
                                "url": window.AppMain.url + 'admin/auxiliares/adjudicaciones/postulantes',
                                "method": "POST",
                                "dataType": "json",
                                "data": function(d) {
                                    d.especialidad_id = self.assignment ? self.assignment.especialidad_id : 0;
                                },
                                "beforeSend": function() {
                                    sweet2.loading();
                                }, 
                                "complete": function() { 
                                    sweet2.loading(false);
                                }
                            },
                            "fnDrawCallback": function(oSettings, json) {
                                const response = oSettings.json;
                                if (response.success) {
                                    self.postulaciones = response.data;
                                }
                            },
                            "columnDefs": [
                                {
                                    "targets": 0,
                                    "data": "id",
                                    "render": function ( data, type, row, meta ) {
                                        // return meta.row + meta.settings._iDisplayStart + 1;
                                        return row.con_code;
                                    }
                                },
                                {
                                    "targets": 1,
                                    "data": "con_tipo",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return `${row.con_tipo_nombre}`;
                                    }
                                },
                                {
                                    "targets": 2,
                                    "data": "apellido_paterno",
                                    "render": function ( data, type, row, meta ) {
                                        return `${row.apellido_paterno} ${row.apellido_materno} ${row.nombre}`;
                                    }
                                },
                                {
                                    "targets": 3,
                                    "data": "numero_documento",
                                    "render": function ( data, type, row, meta ) {
                                        return row.numero_documento;                                    
                                    }
                                },
                                {
                                    "targets": 4,
                                    "data": "modalidad_nombre",
                                    "render": function ( data, type, row, meta ) {
                                        return row.modalidad_nombre;
                                    }
                                },
                                {
                                    "targets": 5,
                                    "data": "nivel_nombre",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.nivel_nombre;
                                    }
                                },
                                {
                                    "targets": 6,
                                    "data": "especialidad_nombre",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.especialidad_nombre;
                                    }
                                },
                                {
                                    "targets": 7,
                                    "data": "puntaje",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.puntaje;
                                    }
                                },
                                {
                                    "targets": 8,
                                    "data": "prelacion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.prelacion;
                                    }
                                },
                                {
                                    "targets": 9,
                                    "data": "fecha_registro",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return row.fecha_registro;
                                    }
                                },
                                {
                                    "targets": 10,
                                    "data": "estado_adjudicacion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        let status = '<span class="text-primary fw-bold">PENDIENTE</span>';
                                        switch (Number(row.estado_adjudicacion)) {
                                            case 1:
                                                status = 'REGISTRADO';
                                            break;
                                            case 2:
                                                status = '<span class="text-danger fw-bold">NO SE PRESENTO</span>';
                                            break;
                                            case 3:
                                                status = '<span class="text-warning fw-bold">EN ESPERA</span>';
                                            break;
                                        }
                                        return status;
                                    }
                                },
                                {
                                    "targets": 11,
                                    "data": "intentos_adjudicacion",
                                    "className": "text-center",
                                    "render": function ( data, type, row, meta ) {
                                        return `${!row.intentos_adjudicacion ? 0 : row.intentos_adjudicacion}`;
                                    }
                                },
                                {
                                    "targets": 12,
                                    "data": "deleted_at",
                                    "className": "text-center  min-width-table-postulant",
                                    "render": function ( data, type, row, meta ) {
                                        // <input class="form-check-input fs-4" style="cursor:pointer;" name="check_docente" type="radio" value="${row.id}">
                                        return `<label class="btn btn-sm btn-light btn-award-postulante mb-2" data-id="${row.id}" for="inputRadio${row.id}"><input class="me-2 shadow-none" name="check_docente" type="radio" id="inputRadio${row.id}" value="${row.id}"> Adjudicar</label>
                                                <button class="btn btn-sm btn-light btn-wait-postulante mb-2" data-id="${row.id}"><i class="fa fa-clock-o me-2" aria-hidden="true"></i>En espera</button>
                                                <button class="btn btn-sm btn-light btn-unlink-postulante mb-2" data-id="${row.id}"><i class="fa fa-user-times me-2" aria-hidden="true"></i>No se presento</button>`;
                                    }
                                }
                            ],
                            "createdRow": function(row, data, index) {
                                // Aquí puedes agregar eventos a los elementos de la fila 
                                $(row).find('.btn-unlink-postulante').off('click').on('click', function() { 
                                    var id = $(this).data('id'); 
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
                                                sweet2.show({
                                                    type:'success', 
                                                    text:message,
                                                    onOk:()=>{
                                                        sweet2.loading({text:'Actualizando...'});                                            
                                                        self.dataTablePostulantes.ajax.reload();
                                                    }
                                                });
                                            })
                                            .catch(error => sweet2.show({type:'error', text:error}));
                                        }
                                    });
                                }); 
                                $(row).find('.btn-wait-postulante').off('click').on('click', function() { 
                                    var id = $(this).data('id'); 
                                    sweet2.show({
                                        type: 'question',
                                        text: '¿Estás seguro de poner en espera al auxiliar?',
                                        showCancelButton: true,
                                        onOk: () => {
                                            sweet2.loading();
                                            const formData = new FormData();
                                            formData.append('status', 3);
                                            self.updateStatus(`adjudicaciones/postulantes/${id}/status`, formData)
                                            .then(({success, data, message}) => {
                                                if (!success) {
                                                    throw message;
                                                }
                                                sweet2.show({
                                                    type:'success', 
                                                    text:message,
                                                    onOk:()=>{
                                                        sweet2.loading({text:'Actualizando...'});                                            
                                                        self.dataTablePostulantes.ajax.reload();
                                                    }
                                                });
                                            })
                                            .catch(error => sweet2.show({type:'error', text:error}));
                                        }
                                    })
                                }); 

                                $(row).find('.btn-award-postulante').off('click').on('click', function() { 
                                    var id = Number($(this).data('id'));
                                    if (id > 0) {
                                        self.postulacion = self.postulaciones.find((o) => { return Number(o.id) === id });
                                        self.docenteRender();
                                        sweet2.show({type:'success', text: 'Se ha seleccionado correctamente'});
                                    }
                                });
                            }
                        });
                    } else {
                        self.dataTablePostulantes.ajax.reload();
                    }
                },
                onActionRowsPostulantes: () => {
                    const unlinks = document.querySelectorAll(".btn-unlink-postulante");
                    if (unlinks.length > 0) {
                        unlinks.forEach(btn => {
                            const id = btn.getAttribute('data-id');
                            btn.addEventListener('click', function (e) {
                                sweet2.show({
                                    type: 'question',
                                    text: '¿Estás seguro de separar al auxiliar de la adjudicación?',
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
                                            sweet2.show({
                                                type:'success', 
                                                text:message,
                                                onOk:()=>{
                                                    sweet2.loading({text:'Actualizando...'});                                            
                                                    self.dataTablePostulantes.ajax.reload();
                                                }
                                            });
                                            // self.postulaciones = data.postulaciones;
                                            // docenteRender();
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
                                    text: '¿Estás seguro de poner en espera al auxiliar?',
                                    showCancelButton: true,
                                    onOk: () => {
                                        sweet2.loading();
                                        const formData = new FormData();
                                        formData.append('status', 3);
                                        self.updateStatus(`adjudicaciones/postulantes/${id}/status`, formData)
                                        .then(({success, data, message}) => {
                                            if (!success) {
                                                throw message;
                                            }
                                            sweet2.show({
                                                type:'success', 
                                                text:message,
                                                onOk:()=>{
                                                    sweet2.loading({text:'Actualizando...'});                                            
                                                    self.dataTablePostulantes.ajax.reload();
                                                }
                                            });
                                            // self.postulaciones = data.postulaciones;
                                            // docenteRender();
                                        })
                                        .catch(error => sweet2.show({type:'error', text:error}));
                                    }
                                })
                            })
                        })
                    }    
                },
                getResource: () => {
                    const formData = new FormData();
                    formData.append('adjudicacion_id', adjudicacion_id);
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/auxiliares/adjudicaciones/resource`,
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
                getSearching: () => {
                    const formData = new FormData();
                    formData.append('adjudicacion_id', adjudicacion_id);
                    return new Promise((resolve, reject)=>{
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + `admin/auxiliares/adjudicaciones/assignment/searching`,
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
                duallistbox: (rights, lefts) => {

                    const leftListbox = document.getElementById('left-listbox');
                    const rightListbox = document.getElementById('right-listbox');
                    const moveRightBtn = document.getElementById('move-right');
                    const moveLeftBtn = document.getElementById('move-left');
                    leftListbox.innerHTML = ``;
                    rightListbox.innerHTML = ``;
                    const aux_rights = [];
                    rights.forEach(e1 => {
                        let free = true;
                        lefts.forEach(e2 => {
                            if (e1.usu_id == e2.usu_id) {
                                free = false;     
                            }
                        });
                        if (free) {
                            aux_rights.push(e1);
                        }
                    });
                    rights = aux_rights;

                    if (leftListbox) {
                        rights.forEach(o => {
                            leftListbox.innerHTML += `<li data-value="${o.usu_id}"> <div class="d-block">${o.usu_dni}</div> ${o.usu_apellidos} ${o.usu_nombre}</li>`;
                        });
                    }

                    if (rightListbox) {
                        lefts.forEach(o => {
                            rightListbox.innerHTML += `<li data-value="${o.usu_id}"> <div class="d-block">${o.usu_dni}</div> ${o.usu_apellidos} ${o.usu_nombre}</li>`;
                        });
                    }
                    
                    moveRightBtn.addEventListener('click', function () {
                      moveSelectedItems(leftListbox, rightListbox);
                    });
                  
                    moveLeftBtn.addEventListener('click', function () {
                      moveSelectedItems(rightListbox, leftListbox);
                    });
                  
                    function moveSelectedItems(source, destination) {
                      const selectedItems = Array.from(source.querySelectorAll('li[data-selected="true"]'));
                  
                      selectedItems.forEach((item) => {
                        const clonedItem = item.cloneNode(true);
                        clonedItem.removeAttribute('data-selected');
                        destination.appendChild(clonedItem);
                        item.remove();
                      });
                    }
                  
                    document.addEventListener('click', function (event) {
                      const clickedItem = event.target;
                  
                      if (clickedItem.tagName === 'LI') {
                        toggleSelection(clickedItem);
                      }
                    });
                  
                    function toggleSelection(item) {
                      const isSelected = item.getAttribute('data-selected') === 'true';
                      isSelected ? item.removeAttribute('data-selected') : item.setAttribute('data-selected', 'true');
                      if (!isSelected) {
                        item.style.fontWeight = '700';
                        item.style.backgroundColor = 'yellow';
                      } else {
                        item.style.fontWeight = '500';
                        item.style.backgroundColor = 'white';
                      }
                    }
                  
                    document.addEventListener('dragstart', function (event) {
                      event.dataTransfer.setData('text/plain', event.target.dataset.value);
                    });
                  
                    document.addEventListener('dragover', function (event) {
                      event.preventDefault();
                    });
                  
                    document.addEventListener('drop', function (event) {
                      const data = event.dataTransfer.getData('text/plain');
                      const targetList = event.target.dataset.list;
                  
                      if (targetList === 'left' || targetList === 'right') {
                        const target = document.getElementById(`${targetList}-listbox`);
                        const item = document.querySelector(`li[data-value="${data}"]`);
                  
                        if (item && target) {
                          item.setAttribute('data-selected', 'true');
                          target.appendChild(item);
                        }
                        event.preventDefault();
                      }
                    });

                }
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
                        

                    
                        dom.querySelector('input[name="fecha_inicio"]').value = '2024-06-20';
                        dom.querySelector('input[name="fecha_final"]').value = '2024-10-20';

                        html = `
                        <p><strong>Código plaza</strong> ${self.plaza.codigo_plaza}</p>
                        <p><strong>I.E</strong> ${self.plaza.ie}</p>
                        <p><strong>Cargo</strong> ${self.plaza.cargo}</p>
                        <p><strong>Especialidad</strong> ${self.plaza.especialidad}</p>
                        <p><strong>Jornada</strong> ${self.plaza.jornada}</p>
                        <p><strong>Tipo vacante</strong> ${self.plaza.tipo_vacante}</p>
                        <p><strong>Motivo vacante</strong> ${self.plaza.motivo_vacante}</p>`;
                        /*<p><strong>Tipo de convocatoria</strong>
                        <input type="radio" name="tipoConvocatoria" value="1" ${self.plaza.tipo_convocatoria === "1" ? "checked" : ""}> PUN (Prueba Única Nacional)
                        <input type="radio" name="tipoConvocatoria" value="2" ${self.plaza.tipo_convocatoria === "2" ? "checked" : ""}> Evaluación de Expediente</p>`;*/
                    }
                    const divs = dom.querySelectorAll('.list-plaza');
                    divs.forEach(div => {
                        div.innerHTML = html;
                    });

                    const btnUpdateTipoConvocatoria = document.querySelectorAll('input[name="tipoConvocatoria"]');

                    btnUpdateTipoConvocatoria.forEach(radioButton => {

                        radioButton.addEventListener('click', function (event) {
                            event.preventDefault();

                            if (self.plaza.tipo_convocatoria != event.target.value) {

                                swal.fire({
                                    text: '¿Estás seguro que desea actualizar el tipo de convocatoria de la plaza?',
                                    icon: 'question',
                                    confirmButtonText: 'Sí',
                                    showCancelButton: true,
                                    cancelButtonText: 'No'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        self.plaza.tipo_convocatoria = event.target.value;
                                        event.target.checked = true;
                                    }
                                });
                            }
                        });
                    });
                },
                assignmentRender: (especialidad_id) => {
                    let html = `No hay registro para mostrar`;
                    const especialidad = self.especialidadesData.find(o => o.esp_id == especialidad_id);
                    if (especialidad) {
                        const nivel = self.nivelesData.find(o => o.niv_id == especialidad.niveles_niv_id);
                        if (nivel) {
                            const modalidad = self.modalidadesData.find(o => o.mod_id == nivel.modalidad_mod_id);
                            if (modalidad) {
                                html = `
                                    <p><strong>Modalidad:</strong> ${modalidad.mod_abreviatura}</p>
                                    <p><strong>Nivel:</strong> ${nivel.niv_descripcion}</p>
                                    <p><strong>Especialidad:</strong> ${especialidad.esp_descripcion}</p>             
                                `;
                                self.assignment = {
                                    modalidad_id: modalidad.mod_id,
                                    nivel_id: nivel.niv_id,
                                    especialidad_id: especialidad.esp_id
                                };
                            }
                            const divs = dom.querySelectorAll('.list-modalidades');
                            divs.forEach(div => {
                                div.innerHTML = html;
                            });
                            return true;
                        }
                    }
                    return false;
                },
                modalidadRender: () => {
                    let html = `No hay registro para mostrar`;
                    if (Object.keys(self.modalidades).length > 0) {
                        console.log(self.modalidades);
                        html = `
                        <p><strong>Modalidad:</strong> ${self.modalidades.mod_abreviatura}</p>
                         <p><strong>Nivel:</strong> ${self.modalidades.niv_descripcion}</p>
                          <p><strong>Especialidad:</strong> ${self.modalidades.esp_descripcion}</p>
                          <p><strong>Tipo de postulación:</strong> ${self.tipo_postulacion_name} </p>
                          
                       `;
                    }
                    const divs = dom.querySelectorAll('.list-modalidades');
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
