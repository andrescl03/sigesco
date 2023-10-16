const AppConvovatoriaWeb = () => {
    const { data, methods, mounted, utilities, el } = {
        el: 'AppConvocatoriaWeb',
        mounted: () => {
            self.convocatoriaId = dom.getAttribute('data-id');
            dom.removeAttribute('data-id');
            self.convocatoriaType = dom.getAttribute('data-type');
            dom.removeAttribute('data-type');
            self.modalWorkExperience = self.modal('modalWorkExperience');
            self.modalSpecialization = self.modal('modalSpecialization');
            self.modalAcademicTraining = self.modal('modalAcademicTraining');
            self.modalPreviewPostulant = self.modal('modalPreviewPostulant');
            self.initialize();
        },
        data: () => { 
            return {
                numberDocument: 0,
                typeDocument: 1,
                convocatoriaId: 0,
                convocatoriaType: 1, // 1 Expediente - 2 PUN
                convocatoria: {},
                workExperiences: [],
                academicTrainings: [],
                specializations: [],
                modalWorkExperience: {},
                modalSpecialization: {},
                modalAcademicTraining: {},
                index: -1,
                user: {},
                postulant: {},
                formData: {},
                nameDepartamnt: '',
                nameProvince: '',
                nameDistrict: ''
            }
        },
        methods: {
            initialize: () => {
                self.events();
            },
            events: () => {

                const formPostulants = dom.querySelectorAll('.form-postulant');
                formPostulants.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        self.formData = new FormData(e.target);
                        self.postulant = helper.formSerialize(e.target);
                        self.renderPreviewPostulant({el: 'previewPostulant', postulant: self.postulant, toString: false});
                        self.modalPreviewPostulant.show();
                    });
                });

                self.eventClick('btn-save', () => {
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de enviar sus datos?',
                        showCancelButton: true,
                        onOk: () => {
                            sweet2.loading();
                            self.modalPreviewPostulant.hide();
                            dom.querySelector('#formPostulant').reset();
                            setTimeout(() => {
                                sweet2.loading(false);
                                self.renderCompletedPostulant();
                            }, 2000);
                        }
                    });
                });

                self.eventClick('btn-documento-cancel', () => {
                    self.formInputDocument(true);
                    self.formInputEvent(true);
                });

                self.eventClick('btn-work-experience', () => {
                    self.index = -1;
                    self.modalWorkExperience.show();
                });

                self.eventClick('btn-academic-training', () => {
                    self.index = -1;
                    self.modalAcademicTraining.show();
                });

                self.eventClick('btn-specialization', () => {
                    self.index = -1;
                    self.modalSpecialization.show();
                });

                self.eventClick('btn-documento', (e) => {
                    const input = dom.querySelector('#inputDocumento');
                    if (input) {
                        const value = input.value.trim();
                        if (value == 0) {
                            sweet2.show({
                                type: 'info',
                                html: 'Por favor ingrese el número de documento'
                            });
                            return;
                        }
                        sweet2.loading();
                        $.ajax({
                            url: window.AppMain.url + 'web/postulantes/' + value,
                            method: 'GET',
                            dataType: 'json',
                            cache: 'false'
                        })
                        .done(function ({success, data, message}) {
                            if (success) {
                                self.numberDocument = dom.querySelector('input[name="numero_documento"]').value;
                                self.typeDocument = dom.querySelector('input[name="tipo_documento"]').value;
                                self.user = data.postulante;
                                dom.querySelector('input[name="nombre"]').value = self.user.cpe_nombres;
                                dom.querySelector('input[name="apellido_paterno"]').value = self.user.cpe_apaterno;
                                dom.querySelector('input[name="apellido_materno"]').value = self.user.cpe_amaterno;
                                sweet2.loading(false);
                            } else {
                                self.numberDocument = 0;
                                sweet2.show({type:'error', html: message});
                            }
                            self.formInputEvent(!success);
                            self.formInputDocument(!success);
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', html: error});
                        });
                    }
                });

                self.formSubmit('form-work-experience', 'workExperiences', () => {
                    self.renderWorkExperiences();
                    self.modalWorkExperience.hide();
                });

                self.formSubmit('form-academic-training', 'academicTrainings', () => {
                    self.renderAcademicTraining();
                    self.modalAcademicTraining.hide();
                });

                self.formSubmit('form-specialization', 'specializations', () => {
                    self.renderSpecialization();
                    self.modalSpecialization.hide();
                });

                self.formInputEvent(self.convocatoriaType == 2);
                self.renderDepartments();
                self.renderUbigeo();
                self.renderWorkExperiences();
                self.renderSpecialization();
                self.renderAcademicTraining();

            },
            formInputDocument: (valid) => {
                const btns2 = dom.querySelectorAll('.btn-documento-cancel');
                btns2.forEach(btn => {
                    btn.style.display = valid == true ? 'none' :  'inline-block';
                });
                const btns1 = dom.querySelectorAll('.btn-documento');
                btns1.forEach(btn => {
                    btn.style.display = valid == true ? 'inline-block' :  'none';
                });
                const inputs = dom.querySelectorAll('.form-input-document');
                inputs.forEach(input => {
                    input.readOnly = !valid;
                });
                const radios = dom.querySelectorAll('.form-radio-document');
                radios.forEach(radio => {
                    radio.disabled = !valid;
                });
            },
            formInputEvent: (valid) => {
                const inputs = dom.querySelectorAll('.form-input-validate');
                inputs.forEach(input => {
                    input.disabled = valid == true;
                });
            },
            renderWorkExperiences: () => {
                self.tableCrudRender({
                    el: 'table-work-experience',
                    name: 'workExperiences',
                    columns: [
                        'institucion_educativa',
                        'sector',
                        'puesto',
                        'numero_rd',
                        'numero_contrato'
                    ],
                    actions: {
                        edit: () => { self.modalWorkExperience.show(); },
                        delete: () => { self.renderWorkExperiences(); }
                    }
                });
            },
            renderSpecialization: () => {
                self.tableCrudRender({
                    el: 'table-specialization',
                    name: 'specializations',
                    columns: [
                        'tipo_especializacion',
                        'tema_especializacion',
                        'nombre_entidad',
                        'fecha_inicio',
                        'fecha_termino',
                        'numero_horas'
                    ],
                    actions: {
                        edit: () => { self.modalSpecialization.show(); },
                        delete: () => { self.renderSpecialization(); }
                    }
                });
            },
            renderAcademicTraining: () => {
                self.tableCrudRender({
                    el: 'table-academic-training',
                    name: 'academicTrainings',
                    columns: [
                        'nivel_educativo',
                        'grado_academico',
                        'universidad',
                        'carrera_profesional',
                        'registro_titulo',
                        'rd_titulo',
                        'obtencion_grado'
                    ],
                    actions: {
                        edit: () => { self.modalAcademicTraining.show(); },
                        delete: () => { self.renderAcademicTraining(); }
                    }
                });
            },
            renderDepartments: () => {
                $.ajax({
                    url: window.AppMain.url + 'ubigeo/obtenerDepartamentos',
                    method: 'GET',
                    dataType: 'json',
                    cache: 'false'
                })
                .done(function ({departamentos}) {
                    const selectDepartments = dom.querySelectorAll('.select-department');
                    selectDepartments.forEach(select => {
                        let html = `<option value="" hidden>[SELECCIONE]</option>`;
                        departamentos.forEach(department => {
                            html += `<option value="${ department.id }"> ${ department.name }</option>`;
                        });
                        select.innerHTML = html;
                    });
                })
                .fail(function (xhr, status, error) {
                    swal2.show({type:'error', html: error});
                });
            },
            renderUbigeo: () => {
                const selectDepartments = dom.querySelectorAll('.select-department');
                selectDepartments.forEach(select => {
                    select.addEventListener('change', (e) => {
                        self.nameDepartamnt = select.options[e.target.selectedIndex].text;
                        const departmentId = e.target.value;           
                        // Llamada AJAX para obtener provincias basadas en el ID del departamento
                        $.ajax({
                            url: window.AppMain.url + 'ubigeo/obtenerProvincias',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                department_id: departmentId
                            },
                            cache: 'false'
                        })
                        .done(function ({provincias}) {
                            const selectProvinces = dom.querySelectorAll('.select-province');
                            selectProvinces.forEach(select => {
                                let html = `<option value="" hidden>[SELECCIONE]</option>`;
                                provincias.forEach(provincia => {
                                    html += `<option value="${ provincia.id }"> ${ provincia.name }</option>`;
                                });
                                select.innerHTML = html;
                            });
                            const selectDistricts = dom.querySelectorAll('.select-district');
                            selectDistricts.forEach(select => {
                                select.innerHTML = `<option value="" hidden>[SELECCIONE]</option>`;
                            });
                        })
                        .fail(function (xhr, status, error) {
                            swal2.show({type:'error', html: error});
                        });
                    });
                });

                const selectProvinces = dom.querySelectorAll('.select-province');
                selectProvinces.forEach(select => {
                    select.addEventListener('change', (e) => {
                        self.nameProvince = select.options[e.target.selectedIndex].text;
                        const provinceId = e.target.value;                       
                        // Llamada AJAX para obtener provincias basadas en el ID del departamento
                        $.ajax({
                            url: window.AppMain.url + 'ubigeo/obtenerDistritos',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                province_id: provinceId
                            },
                            cache: 'false'
                        })
                        .done(function ({distritos}) {
                            const selectDistricts = dom.querySelectorAll('.select-district');
                            selectDistricts.forEach(select => {
                                let html = `<option value="" hidden>[SELECCIONE]</option>`;
                                distritos.forEach(distrito => {
                                    html += `<option value="${ distrito.id }"> ${ distrito.name }</option>`;
                                });
                                select.innerHTML = html;
                            });
                        })
                        .fail(function (xhr, status, error) {
                            swal2.show({type:'error', html: error});
                        });
                    });
                });
                const selectDistricts = dom.querySelectorAll('.select-district');
                selectDistricts.forEach(select => {
                    select.addEventListener('change', (e) => {     
                        self.nameDistrict = select.options[e.target.selectedIndex].text;
                    });
                });
            },
            renderPreviewPostulant: ({el, postulant, toString = false}) => {
                let html = `<div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Datos de postulación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Tipo de Documento </label></div>
                                        <div class="col-lg-7"><span>${ self.typeDocument == 2 ? 'Carnet de Extranjería': 'DNI' }</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Número de Documento </label></div>
                                        <div class="col-lg-7"><span>${postulant.numero_documento}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Modalidad </label></div>
                                        <div class="col-lg-7"><span>${postulant.modalidad}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Nivel </label></div>
                                        <div class="col-lg-7"><span>${postulant.nivel}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Especialidad </label></div>
                                        <div class="col-lg-7"><span>${postulant.especialidad}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Datos personales del postulante</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Nombres </label></div>
                                        <div class="col-lg-7"><span>${postulant.nombre}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Apellido Paterno </label></div>
                                        <div class="col-lg-7"><span>${postulant.apellido_paterno}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Apellido Materno </label></div>
                                        <div class="col-lg-7"><span>${postulant.apellido_materno}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Género </label></div>
                                        <div class="col-lg-7"><span>${postulant.genero}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Estado Civil </label></div>
                                        <div class="col-lg-7"><span>${postulant.estado_civil}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Nacionalidad </label></div>
                                        <div class="col-lg-7"><span>${postulant.nacionalidad}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Fecha de Nacimiento </label></div>
                                        <div class="col-lg-7"><span>${postulant.fecha_nacimiento}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Correo Electrónico </label></div>
                                        <div class="col-lg-7"><span>${postulant.correo}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Número de Celular </label></div>
                                        <div class="col-lg-7"><span>${postulant.numero_celular}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Número de Teléfono </label></div>
                                        <div class="col-lg-7"><span>${postulant.numero_telefono}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Datos de Ubicación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Departamento </label></div>
                                        <div class="col-lg-7"><span>${self.nameDepartamnt}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Provincia </label></div>
                                        <div class="col-lg-7"><span>${self.nameProvince}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Distrito </label></div>
                                        <div class="col-lg-7"><span>${self.nameDistrict}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Vía </label></div>
                                        <div class="col-lg-7"><span>${postulant.via}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Nombre de la Vía </label></div>
                                        <div class="col-lg-7"><span>${postulant.nombre_via}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Nombre de la Zona </label></div>
                                        <div class="col-lg-7"><span>${postulant.zona}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Dirección </label></div>
                                        <div class="col-lg-7"><span>${postulant.direccion}</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Formación Académica</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Nivel Educativo</th>
                                                    <th>Grado Académico</th>
                                                    <th>Universidad</th>
                                                    <th>Carrera Profesional</th>
                                                    <th>N° de Registro de Título</th>
                                                    <th>RD de Título N°</th>
                                                    <th>Obtención del Grado</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                                            if (self.academicTrainings.length == 0) {
                                                html += `<tr><td colspan="7" class="text-center">No hay registros para mostrar</td></tr>`;
                                            } else {
                                                self.academicTrainings.forEach(item => {
                                                    html += `<tr>
                                                                <td>${item.nivel_educativo}</td>
                                                                <td>${item.grado_academico}</td>
                                                                <td>${item.universidad}</td>
                                                                <td>${item.carrera_profesional}</td>
                                                                <td>${item.registro_titulo}</td>
                                                                <td>${item.rd_titulo}</td>
                                                                <td>${item.obtencion_grado}</td>
                                                            </tr>`;
                                                });
                                            }
                                    html += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Experiencia laboral</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Institución educativa</th>
                                                    <th>Sector</th>
                                                    <th>Puesto</th>
                                                    <th>N° RD</th>
                                                    <th>N° Contrato</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                                            if (self.workExperiences.length == 0) {
                                                html += `<tr><td colspan="5" class="text-center">No hay registros para mostrar</td></tr>`;
                                            } else {
                                                self.workExperiences.forEach(item => {
                                                    html += `<tr>
                                                                <td>${item.institucion_educativa}</td>
                                                                <td>${item.sector}</td>
                                                                <td>${item.puesto}</td>
                                                                <td>${item.numero_rd}</td>
                                                                <td>${item.numero_contrato}</td>
                                                            </tr>`;
                                                }); 
                                            }
                                    html += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Especialización</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Tipo de especialización</th>
                                                    <th>Tema</th>
                                                    <th>Nombre de la entidad</th>
                                                    <th>Fecha de inicio</th>
                                                    <th>Fecha de termino</th>
                                                    <th>Número de horas</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                                            if (self.specializations.length == 0) {
                                                html += `<tr><td colspan="6" class="text-center">No hay registros para mostrar</td></tr>`;
                                            } else {
                                                self.specializations.forEach(item => {
                                                    html += `<tr>
                                                                <td>${item.tipo_especializacion}</td>
                                                                <td>${item.tema_especializacion}</td>
                                                                <td>${item.nombre_entidad}</td>
                                                                <td>${item.fecha_inicio}</td>
                                                                <td>${item.fecha_termino}</td>
                                                                <td>${item.numero_horas}</td>
                                                            </tr>`;
                                                });
                                            }
                                    html += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>`;
                if (toString) {
                    return html;
                } else {
                    return dom.querySelector('#' + el).innerHTML = html;
                }
            },
            renderCompletedPostulant: () => {
                dom.innerHTML = `<div class="card card-custom">
                                    <div class="card-header">
                                        <div class="card-title mx-auto">
                                            <h3 class="card-label">SE REGISTRO COMPLETAMENTE</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                    Estimado ${ self.postulant.nombre }, se ha enviado un correo electrónico a ${ self.postulant.correo } con la información registrada.
                                                </div>
                                            </div>
                                            ${ self.renderPreviewPostulant({postulant: self.postulant, toString: true}) }
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-primary btn-print">Inprimir</button>
                                    </div>
                                </div>`;

                self.eventClick('btn-print', () => {
                    var html = self.renderPreviewPostulant({postulant: self.postulant, toString: true});
                    var newWin = window.open('','Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">' + html + '</body></html>');
                    newWin.document.close();
                    setTimeout(function(){newWin.close();},5);
                });
            }
        },
        utilities: {
            modal: (el) => {
                return new bootstrap.Modal(dom.querySelector('#' + el));
            },
            formSubmit: (el, name, _callback) => {
                const forms = dom.querySelectorAll('.' + el);
                forms.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        const item = helper.formSerialize(e.target);
                        if (self.index === -1) {
                            self[name].push(item);
                        } else {
                            self[specializations][self.index] = item;
                        }
                        e.target.reset();
                        _callback();
                    });
                });
            },
            tableCrudRender: ({el, name, columns, actions = {}}) => {
                const tables = dom.querySelectorAll('.' + el);
                tables.forEach(table => {
                    const tbody = table.querySelector('tbody');
                    if (self[name].length > 0) {
                        tbody.innerHTML = ``;
                        self[name].forEach((item, index) => {
                            const tr = document.createElement("tr");
                            let html = ``;
                            columns.forEach(col => {
                                html += `<td>${item[col]}</td>`; 
                            });
                            html += `<td class="text-center">
                                        <button class="btn btn-danger mb-1 btn-delete">Eliminar</button>
                                        <button class="btn btn-warning mb-1 btn-edit">Editar</button>
                                    </td>`;
                            tr.innerHTML = html;
                            tr.querySelectorAll('.btn-delete').forEach(btn => {
                                btn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    sweet2.show({
                                        type: 'question',
                                        html: '¿Estás seguro de eliminar este elemento?',
                                        showCancelButton: true,
                                        onOk: () => {
                                            self[name].splice(index, 1);
                                            if (actions.edit) {
                                                actions.edit();
                                            }
                                        }
                                    });
                                });
                            });
                            tr.querySelectorAll('.btn-edit').forEach(btn => {
                                btn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    self.index = index;
                                    if (actions.delete) {
                                        actions.delete();
                                    }
                                });
                            });
                            tbody.appendChild(tr);                            
                        });
                    } else {
                        tbody.innerHTML = `<tr><td colspan="${columns.length + 2}" class="text-center">No hay registros para mostrar</td></tr>`;
                    }
                });
            },
            eventClick: (el, _callback) => {
                const btns = dom.querySelectorAll('.' + el);
                btns.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        _callback(e);
                    });
                });
            }
        }
    };
    const self = {
        ...data(),
        ...methods,
        ...utilities
    }, dom = document.getElementById(el);
    return mounted();
}
document.addEventListener('DOMContentLoaded', AppConvovatoriaWeb());