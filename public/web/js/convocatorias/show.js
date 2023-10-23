const AppConvovatoriaWeb = () => {
    const { data, methods, mounted, computed, utilities, el } = {
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
                attachedFiles: [],
                modalWorkExperience: {},
                modalSpecialization: {},
                modalAcademicTraining: {},
                modalPreviewPostulant: {},
                index: -1,
                formPostulant: {},
                postulant: {},
                formData: {},
                nameDepartamnt: '',
                nameProvince: '',
                nameDistrict: '',
                formSpecialties: [],
                formLevels: [],
                formModalities: [],
                departments: [],
                formAttachedFiles: [],
                attachedFileTypes: [
                    { id: 1, nombre: 'Anexo 8' },
                    { id: 2, nombre: 'Anexo 9' },
                    { id: 3, nombre: 'Anexo 10' },
                    { id: 4, nombre: 'Anexo 11' },
                    { id: 5, nombre: 'Anexo 12' },
                    { id: 6, nombre: 'Anexo 19' } 
                ],
                response: {}
            }
        },
        methods: {
            initialize: () => {
                self.detail()
                .then(data => {
                    self.renders();
                    self.events();
                })
                .catch(error => {
                    sweet2.show({type:'error', html: error});
                });
            },
            renders: () => {
                self.renderModalities();
                self.renderDepartments();
                self.renderUbigeo();
                self.renderWorkExperiences();
                self.renderSpecialization();
                self.renderAcademicTraining();
                self.renderAlertPostulant();
            },
            events: () => {

                const formPostulants = dom.querySelectorAll('.form-postulant');
                formPostulants.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        if (!form.checkValidity()) {
                           
                            sweet2.show({
                                type: 'error',
                                title: 'IMPORTANTE',
                                html: 'Por favor ingrese todos los campos solicitados'
                            });

                            e.stopPropagation()
                        }
                        form.classList.add('was-validated');
                        if (form.checkValidity()) {
                            self.formData = new FormData(e.target);
                            self.postulant = helper.formSerialize(e.target);
                            self.postulant.modalidad = self.formModalities.find(o => o.mod_id === self.postulant.modalidad_id).mod_nombre;
                            self.postulant.nivel = self.formLevels.find(o => o.niv_id === self.postulant.nivel_id).niv_descripcion;
                            self.postulant.especialidad = self.formSpecialties.find(o => o.esp_id === self.postulant.especialidad_id).esp_descripcion;
                            self.listAttachedFile();
                            self.renderPreviewPostulant({el: 'previewPostulant', postulant: self.postulant, toString: false});
                            self.modalPreviewPostulant.show();
                        }
                        
                    });
                });

                self.eventTag('btn-save', () => {
                    self.formData.append('convocatoria_id', self.convocatoriaId);
                    self.formData.append('tipo_documento', self.typeDocument);
                    self.formData.append('archivos_adjuntos', self.attachedFiles);
                    self.formData.append('experiencias_laborales', JSON.stringify(self.workExperiences));
                    self.formData.append('formaciones_academicas', JSON.stringify(self.academicTrainings));
                    self.formData.append('especializaciones', JSON.stringify(self.specializations));
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de enviar sus datos?',
                        showCancelButton: true,
                        onOk: () => {
                            sweet2.loading();
                            self.modalPreviewPostulant.hide();
                            $.ajax({
                                url: window.AppMain.url + 'web/postulaciones/store',
                                method: 'POST',
                                dataType: 'json',
                                data: self.formData,
                                processData: false,
                                contentType: false,
                            })
                            .done(function ({success, data, message}) {
                                if (!success) {
                                    sweet2.show({type:'error', html: message});
                                    return;
                                }
                                self.response = data.postulante;
                                dom.querySelector('#formPostulant').reset();
                                self.renderCompletedPostulant();
                                sweet2.loading(false);
                            })
                            .fail(function (xhr, status, error) {
                                sweet2.show({type:'error', text:error});
                            });
                        }
                    });
                });

                self.eventTag('btn-documento-cancel', () => {
                    self.numberDocument = 0;
                    self.formInputDocument(true);
                    self.formInputEvent(true);
                });

                self.eventTag('btn-attached-file', () => {
                    self.renderFormAttachedFile();
                });

                self.eventTag('btn-work-experience', () => {
                    self.index = -1;
                    self.modalWorkExperience.show();
                });

                self.eventTag('btn-academic-training', () => {
                    self.index = -1;
                    self.modalAcademicTraining.show();
                });

                self.eventTag('btn-specialization', () => {
                    self.index = -1;
                    self.modalSpecialization.show();
                });

                self.eventTag('select-nivel', (e) => {
                    self.renderSpecialties(e.target.value);
                }, 'change');
                
                self.eventTag('select-modalidad', (e) => {
                    self.renderLevels(e.target.value);
                    self.renderSpecialties();
                }, 'change');

                self.eventTag('input-number', (e) => {
                    return self.onNumberOnly(e);
                }, 'keypress', false);

                self.eventTag('input-document', (e) => {
                    self.onValidateDocument(e);
                }, 'keypress', false);

                self.eventTag('form-radio-document', (e) => {
                    self.typeDocument = Number(e.target.value);
                }, 'change');

                self.eventTag('btn-documento', (e) => {
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
                        const formData = new FormData();
                        formData.append('documento', value);
                        formData.append('convocatoria_id', self.convocatoriaId);
                        $.ajax({
                            url: window.AppMain.url + 'web/postulaciones/find',
                            method: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                        .done(function ({success, data, message}) {
                            if (success) {
                                self.numberDocument = dom.querySelector('input[name="numero_documento"]').value;
                                self.typeDocument = dom.querySelector('input[name="tipo_documento"]').value;
                                self.formPostulant = data.postulante;
                                if (self.isPUN()) {
                                    dom.querySelector('input[name="nombre"]').value = self.formPostulant.cpe_nombres;
                                    dom.querySelector('input[name="apellido_paterno"]').value = self.formPostulant.cpe_apaterno;
                                    dom.querySelector('input[name="apellido_materno"]').value = self.formPostulant.cpe_amaterno;    
                                    dom.querySelector('select[name="modalidad_id"]').innerHTML = `<option value="${self.formPostulant.modalidad_id}">${self.formPostulant.modalidad_descripcion}</option>`;
                                    dom.querySelector('select[name="nivel_id"]').innerHTML = `<option value="${self.formPostulant.nivel_id}">${self.formPostulant.nivel_descripcion}</option>`;
                                    dom.querySelector('select[name="especialidad_id"]').innerHTML = `<option value="${self.formPostulant.especialidad_id}">${self.formPostulant.especialidad_descripcion}</option>`;
                                }
                                formPostulants.forEach(form => {
                                    form.classList.add('was-validated');
                                });

                                if (self.isPUN()) {
                                    sweet2.show({
                                        type: 'info',
                                        html: 'Bienvenido al proceso de Contratación por resultados de la Prueba Única Nacional (PUN). </br> <b>Por favor, ingrese todos los campos solicitados.'
                                    });
                                }
                                else{
                                    sweet2.show({
                                        type: 'info',
                                        html: 'Bienvenido al proceso de Contratación por Evaluación de Expediente. </br> <b>Por favor, ingrese todos los campos solicitados.'
                                    });
                                }
                                //sweet2.loading(false);
                            } else {
                                self.numberDocument = 0;
                                sweet2.show({type:'error', html: message});
                            }
                            self.renderAlertPostulant(success);
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

                self.formInputEvent(true);

            },
            detail: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + 'web/convocatorias/detail',
                        method: 'POST',
                        dataType: 'json',
                        cache: 'false'
                    })
                    .done(function ({success, data, message}) {
                        if (success) {
                            self.formSpecialties = data.especialidades;
                            self.formLevels = data.niveles;
                            self.formModalities = data.modalidades;
                            self.departments = data.departamentos;
                            resolve(data);
                        } else {
                            reject(error);
                        }
                    })
                    .fail(function (xhr, status, error) {
                        reject(error);
                    });

                });
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
                    if (!self.isPUN()) {
                        input.readOnly = false;
                    }
                });
            },
            listAttachedFile: () => {
                self.formAttachedFiles = [];
                const inputFiles = dom.querySelectorAll('.form-input-file');
                const inputFileTypes = dom.querySelectorAll('.form-input-file-type');
                inputFiles.forEach((inputFile, index) => {
                    const files = inputFile.files;
                    if (files) {
                        const ft = inputFileTypes[index];
                        const f = files[0];
                        self.formAttachedFiles.push({
                            tipo: self.attachedFileTypes.find(o => o.id === Number(ft.value)).nombre,
                            archivo: f.name
                        });
                    }
                });
            },
            formLoadAttachedFile: () => {
                // en desarrollo
                const inputFiles = dom.querySelectorAll('.form-input-file');
                inputFiles.forEach(inputFile => {

                    const files = inputFile.files;
                    if (files) {
                        const f = files[0];
                        console.log(f);
                        const reader = new FileReader();
                        reader.addEventListener(
                          "load",
                          () => {
                            image.title = f.name;
                            image.src = reader.result;
                            console.log(reader.result);
                          },
                          false,
                        );
                        reader.readAsDataURL(f);
                    }

                });
            },
            renderFormAttachedFile: () => {
                let html = `
                                <td>
                                    <select class="form-control form-control-solid form-input-file-type" name="tipo_archivos[]" required="">
                                        <option value="" hidden="">[SELECCIONE]</option>`;
                                    self.attachedFileTypes.forEach(item => {
                                        html += `<option value="${item.id}">${item.nombre}</option>`;
                                    });             
                          html += ` </select>
                                </td>
                                <td>
                                    <input class="form-control form-control-solid form-input-file" name="archivos[]" type="file" accept="application/pdf" required>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger btn-delete">Eliminar</button>
                                </td>
                            `;
                const tables = dom.querySelectorAll('.table-attached-file');
                tables.forEach(table => {
                    const tbody = table.querySelector('tbody');
                    const tr = document.createElement("tr");
                    tr.innerHTML = html;
                    tr.querySelectorAll('.btn-delete').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            sweet2.show({
                                type: 'question',
                                html: '¿Estás seguro de eliminar este elemento?',
                                showCancelButton: true,
                                onOk: () => {
                                    tr.remove();
                                }
                            });
                        });
                    });
                    tbody.appendChild(tr);
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
            renderSpecialties: (nivel_id = 0) => {
                const items = self.formSpecialties.filter(o => o.niveles_niv_id === nivel_id);
                const selects = dom.querySelectorAll('.select-especialidad');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    items.forEach(item => {
                        html += `<option value="${ item.esp_id }"> ${ item.esp_descripcion }</option>`;
                    });
                    select.innerHTML = html;
                });
            },
            renderLevels: (modalidad_id = 0) => {
                const items = self.formLevels.filter(o => o.modalidad_mod_id === modalidad_id);
                const selects = dom.querySelectorAll('.select-nivel');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    items.forEach(item => {
                        html += `<option value="${ item.niv_id }"> ${ item.niv_descripcion }</option>`;
                    });
                    select.innerHTML = html;
                });
            },
            renderModalities: () => {
                const selects = dom.querySelectorAll('.select-modalidad');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    self.formModalities.forEach(item => {
                        html += `<option value="${ item.mod_id }"> ${ item.mod_nombre }</option>`;
                    });
                    select.innerHTML = html;
                });
            },
            renderDepartments: () => {
                const selects = dom.querySelectorAll('.select-department');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    self.departments.forEach(department => {
                        html += `<option value="${ department.id }"> ${ department.name }</option>`;
                    });
                    select.innerHTML = html;
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
                let html = `${ 
                    Object.keys(self.response).length > 0 ? 
                                `<div class="text-center mb-3">
                                    <img src="https://www.ugel05.gob.pe/sites/default/files/inline-images/WhatsApp%20Image%202022-12-23%20at%208.52.58%20AM_1.jpeg" style="height: 90px;max-width: 100%;">
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">Código</label></div>
                                            <div class="col-lg-7"><span>${self.response.uid}</span></div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">Fecha </label></div>
                                            <div class="col-lg-7"><span>${self.response.fecha_registro}</span></div>
                                        </div>
                                        <!--div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">URL </label></div>
                                            <div class="col-lg-7">
                                                <a target="_blank" href="${ window.AppMain.url + 'web/postulaciones/' + self.response.uid}">${ window.AppMain.url + 'web/postulaciones/' + self.response.uid}</a>
                                                <small>Conserve esta URL si es necesario</small>
                                            </div>
                                        </div-->
                                    </div>
                                </div>` 
                                : `` 
                            } <div class="card mb-3">
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
                                                                <td class="text-center">${item.nivel_educativo}</td>
                                                                <td class="text-center">${item.grado_academico}</td>
                                                                <td class="text-center">${item.universidad}</td>
                                                                <td class="text-center">${item.carrera_profesional}</td>
                                                                <td class="text-center">${item.registro_titulo}</td>
                                                                <td class="text-center">${item.rd_titulo}</td>
                                                                <td class="text-center">${item.obtencion_grado}</td>
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
                                                                <td class="text-center">${item.institucion_educativa}</td>
                                                                <td class="text-center">${item.sector}</td>
                                                                <td class="text-center">${item.puesto}</td>
                                                                <td class="text-center">${item.numero_rd}</td>
                                                                <td class="text-center">${item.numero_contrato}</td>
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
                                                                <td class="text-center">${item.tipo_especializacion}</td>
                                                                <td class="text-center">${item.tema_especializacion}</td>
                                                                <td class="text-center">${item.nombre_entidad}</td>
                                                                <td class="text-center">${item.fecha_inicio}</td>
                                                                <td class="text-center">${item.fecha_termino}</td>
                                                                <td class="text-center">${item.numero_horas}</td>
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
                                    <h5 class="m-0">Archivos Adjuntos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Archivo</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;
                                            if (self.formAttachedFiles.length == 0) {
                                                html += `<tr><td colspan="2" class="text-center">No hay registros para mostrar</td></tr>`;
                                            } else {
                                                self.formAttachedFiles.forEach(item => {
                                                    html += `<tr>
                                                                <td class="text-center">${item.tipo}</td>
                                                                <td class="text-center">${item.archivo}</td>
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
                                            <h3 class="card-label">SE REGISTRO CORRECTAMENTE PARA EL PROCESO DE CONTRATACIÓN DOCENTE</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                    Estimado <b>${ self.postulant.nombre }</b>, se ha enviado un correo electrónico a <b>${ self.postulant.correo }</b> con la información registrada.
                                                </div>
                                            </div>
                                            ${ self.renderPreviewPostulant({postulant: self.postulant, toString: true}) }
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="${window.AppMain.url + 'web/convocatorias'}" type="button" class="btn btn-primary me-3">Inicio</a>
                                        <button type="button" class="btn btn-dark btn-print">Imprimir</button>
                                    </div>
                                </div>`;

                self.eventTag('btn-print', () => {
                    var html = self.renderPreviewPostulant({postulant: self.postulant, toString: true});
                    var newWin = window.open('','Print-Window');
                    newWin.document.open();
                    newWin.document.write(`
                        <html>
                            <header>
                                <link rel="stylesheet" type="text/css" href="${window.AppMain.url}/public/css/bootstrapv5.0.2/bootstrap.css">
                                <style>
                                    .col-lg-5 {
                                        flex: 0 0 auto;
                                        width: 41.66666667%;
                                    }
                                    .col-lg-7 {
                                        flex: 0 0 auto;
                                        width: 58.33333333%;
                                    }
                                </style>
                            </header>
                            <body onload="window.print()" style="padding: 60px;">
                                ${html}
                            </body>
                        </html>`);
                    newWin.document.close();
                    setTimeout(function(){newWin.close();}, 5);
                });
            },
            renderAlertPostulant: (valid = false) => {
                const alerts = dom.querySelectorAll('.alert-postulant');
                alerts.forEach(alert => {
                    let html = `<div class="alert alert-primary d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    <div>
                                        ${
                                            self.isPUN() ? 
                                            'El número de su documento debe de estar registrado en el examen de la Prueba Única Nacional (PUN) para continuar con la postulación' : 
                                            'Ingresar su número de documento para continuar el registro.'
                                        }
                                    </div>
                                </div>`; 
                    if (valid) {
                        html = `<div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="check-circle:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                Bienvenido al proceso de registro de su postulación en está convocatoría
                            </div>
                        </div>`; 
                    }
                    alert.innerHTML = html;
                });
            },
            onValidateDocument: (e) => {
                if (self.typeDocument == 1) {
                    if (self.onNumberOnly(e)) {
                        if (e.target.value.length == 8) {
                            e.preventDefault();
                        }
                    }        
                } else if (self.typeDocument == 2) {
                    if (e.target.value.length == 12) {
                        e.preventDefault();
                    }
                } else {
                    return false;
                }
            },
        },
        computed: {
            isPUN: () => {
                return self.convocatoriaType == 2;
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
                        if (!form.checkValidity()) {
                            e.stopPropagation()
                        }
                        form.classList.add('was-validated');
                        if (form.checkValidity()) {
                            const item = helper.formSerialize(e.target);
                            if (self.index === -1) {
                                self[name].push(item);
                            } else {
                                self[specializations][self.index] = item;
                            }
                            e.target.reset();
                            _callback();
                        }
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
                                html += `<td class="text-center">${item[col]}</td>`; 
                            });
                            html += `<td class="text-center">
                                        <button class="btn btn-sm btn-danger mb-1 btn-delete">Eliminar</button>
                                        <!--button class="btn btn-warning mb-1 btn-edit">Editar</button-->
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
                                            if (actions.delete) {
                                                actions.delete();
                                            }
                                        }
                                    });
                                });
                            });
                            tr.querySelectorAll('.btn-edit').forEach(btn => {
                                btn.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    self.index = index;
                                    if (actions.edit) {
                                        actions.edit();
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
            eventTag: (el, _callback, evt = 'click', prevent = true) => {
                const btns = dom.querySelectorAll('.' + el);
                btns.forEach(btn => {
                    btn.addEventListener(evt, (e) => {
                        if (prevent) {
                            e.preventDefault();
                        }
                        _callback(e);
                    });
                });
            },
            onNumberOnly: (evt) => {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                  evt.preventDefault();
                } else {
                  return true;
                }
            },
            onLetterOnly: (e) => {
                const regEx1 = /[^a-zA-Z\s]+/;
                const value = regEx1.test(e.target.value);
                console.log(value);
            }
        }
    };
    const self = {
        ...data(),
        ...methods,
        ...computed,
        ...utilities
    }, dom = document.getElementById(el);
    return mounted();
}
document.addEventListener('DOMContentLoaded', AppConvovatoriaWeb());