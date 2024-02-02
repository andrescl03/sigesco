const AppConvovatoriaWeb = () => {
    const { data, methods, mounted, computed, utilities, el } = {
        el: 'AppConvocatoriaWeb',
        mounted: () => {
            self.convocatoriaId = dom.getAttribute('data-id');
            dom.removeAttribute('data-id');
            self.inscripcionId = dom.getAttribute('data-inscripcion-id');
            dom.removeAttribute('data-inscripcion-id');
            self.convocatoriaType = dom.getAttribute('data-type');
            dom.removeAttribute('data-type');
            self.modalWorkExperience = self.modal('modalWorkExperience');
            self.modalSpecialization = self.modal('modalSpecialization');
            self.modalAcademicTraining = self.modal('modalAcademicTraining');
            self.modalPreviewPostulant = self.modal('modalPreviewPostulant');
            self.modalViewerAttachedFile = self.modal('modalViewerAttachedFile');
            self.dateAdult = self.onDateAdut();
            self.initialize();
        },
        data: () => { 
            return {
                formVias: [],
                formZonas: [],
                formDepartamentos: [],
                formProvincias: [],
                formDistritos: [],
                numberDocument: 0,
                typeDocument: 1,
                convocatoriaId: 0,
                inscripcionId: 0,
                convocatoriaType: 1, // 2 Expediente - 1 PUN
                convocatoria: {},
                workExperiences: [],
                academicTrainings: [],
                specializations: [],
                attachedFiles: [],
                modalWorkExperience: {},
                modalSpecialization: {},
                modalAcademicTraining: {},
                modalPreviewPostulant: {},
                modalViewerAttachedFile: {},
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
                attachedFileTypes: [],
                /*[
                    { id: 1, nombre: 'Anexo 1' },
                    { id: 2, nombre: 'Anexo 8' },
                    { id: 3, nombre: 'Anexo 9' },
                    { id: 4, nombre: 'Anexo 10' },
                    { id: 5, nombre: 'Anexo 11' },
                    { id: 6, nombre: 'Anexo 12' },
                    { id: 7, nombre: 'Anexo 19' },
                    { id: 8, nombre: 'CV documentado' },
                    { id: 9, nombre: 'Titulo profesional' } 

                ],*/
                response: {},
                dateAdult: ''
            }
        },
        methods: {
            initialize: () => {
                self.detail()
                .then(data => {
                    self.attachedFileTypes = data.tipo_archivos
                    self.renders();
                    self.events();
                    self.externs();
                })
                .catch(error => {
                    sweet2.show({type:'error', html: error});
                });
            },
            renders: () => {
                self.renderModalities();
                // self.renderDepartments();
                self.renderUbigeo();
                self.renderWorkExperiences();
                self.renderSpecialization();
                self.renderAcademicTraining();
                self.renderAlertPostulant();
            },
            vias: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + 'api/mpv/vias',
                        method: 'POST',
                        dataType: 'json',
                        cache: 'false'
                    })
                    .done(function (response) {
                        resolve(response);
                    })
                    .fail(function (xhr, status, error) {
                        reject(error);
                    });

                });
            },
            departamentos: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + 'api/mpv/departamentos',
                        method: 'POST',
                        dataType: 'json',
                        cache: 'false'
                    })
                    .done(function (response) {
                        resolve(response);
                    })
                    .fail(function (xhr, status, error) {
                        reject(error);
                    });

                });
            },
            zonas: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + 'api/mpv/zonas',
                        method: 'POST',
                        dataType: 'json',
                        cache: 'false'
                    })
                    .done(function (response) {
                        resolve(response);
                    })
                    .fail(function (xhr, status, error) {
                        reject(error);
                    });

                });
            },
            externs: () => {
                self.vias()
                .then(({status, response, message}) => {
                    if (status == 200) {
                        self.formVias = response;
                    }
                    self.renderVias();
                    console.log('formVias', self.formVias);
                })
                .catch((error) => {
                    console.log(error);
                });

                self.zonas()
                .then(({status, response, message}) => {
                    if (status == 200) {
                        self.formZonas = response;
                    }
                    self.renderZonas();
                    console.log('formZonas', self.formZonas);
                })
                .catch((error) => {
                    console.log(error);
                })

                self.departamentos()
                .then(({status, response, message}) => {
                    if (status == 200) {
                        self.formDepartamentos = response;
                    }
                    self.renderDepartments();
                    console.log('formDepartamentos', self.formDepartamentos);
                })
                .catch((error) => {
                    console.log(error);
                })
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

                        const inputFiles = dom.querySelectorAll('.form-input-file');
                        let validFile = false;
                        if(inputFiles.length == 0) {
                            validFile = true;
                        }
                        inputFiles.forEach((inputFile, index) => {
                            const files = inputFile.files;
                            if (!files) {
                                validFile = true;
                            }
                        });
                        if (validFile) {
                            sweet2.show({
                                type: 'error',
                                title: 'IMPORTANTE',
                                html: 'Por favor ingrese al menos un documento adjunto'
                            });
                            e.stopPropagation()
                            return false;
                        }

                        form.classList.add('was-validated');
                        if (form.checkValidity()) {
                            self.formData = new FormData(e.target);
                            self.postulant = helper.formSerialize(e.target);
                            self.postulant.modalidad = self.formPostulant.modalidad_descripcion;
                            self.postulant.nivel = self.formPostulant.nivel_descripcion;
                            self.postulant.especialidad = self.formPostulant.especialidad_descripcion;

                            const via_id = self.formData.get('via_id');
                            console.log('via_id',via_id);
                            console.log('formVias',self.formVias);
                            const viaObj = self.formVias.find((o) => {return o.TipoViaID == via_id});
                            console.log('viaObj',viaObj);
                            self.postulant.via = viaObj.DesTipoVia;
                            self.formData.append('via', self.postulant.via);

                            const zona_id = self.formData.get('zona_id');
                            const zonaObj = self.formZonas.find((o) => {return o.TipoZonaID == zona_id});
                            self.postulant.zona = zonaObj.DesTipoZona;
                            self.formData.append('zona', self.postulant.zona);

                            self.listAttachedFile();
                            self.renderPreviewPostulant({el: 'previewPostulant', postulant: self.postulant, toString: false});
                            self.modalPreviewPostulant.show();
                        }
                        
                    });
                });

                self.eventTag('btn-save', () => {
                    self.formData.append('convocatoria_id', self.convocatoriaId);
                    self.formData.append('inscripcion_id', self.inscripcionId);
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
                                self.response = data;
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

                self.eventTag('input-number', (e) => {
                    return self.onNumberOnly(e);
                }, 'keypress', false);

                self.eventTag('input-document', (e) => {
                    self.onValidateDocument(e);
                }, 'keypress', false);

                self.eventTag('form-radio-document', (e) => {
                    self.typeDocument = Number(e.target.value);
                }, 'change');

                self.eventTag('form-input-email', ({target}) => {
                    const {valid} = target.validity;
                    const value = target.value;
                    const inputs = dom.querySelectorAll('.form-input-confirm-email');
                    inputs.forEach(input => {
                        input.setAttribute('pattern', (valid ? value : ''));
                    });
                }, 'keyup', false);
                
                self.eventTag('form-control-validate', (e) => {
                    const nextElementSibling = e.target.nextElementSibling;
                    if (nextElementSibling) {
                        nextElementSibling.innerHTML = e.target.validationMessage;
                    }
                }, 'keyup', false);

                self.eventTag('form-control-validate', (e) => {
                    const nextElementSibling = e.target.nextElementSibling;
                    if (nextElementSibling) {
                        nextElementSibling.innerHTML = e.target.validationMessage;
                    }
                }, 'change', false);

                const dateAdults = dom.querySelectorAll('.form-input-age');
                dateAdults.forEach(element => {
                    element.setAttribute('max', self.dateAdult);
                });

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
                        formData.append('inscripcion_id', self.inscripcionId);
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
                                    dom.querySelector('input[name="cuss"]').value = self.formPostulant.cuss ?? '';    
                                    dom.querySelector('select[name="afiliacion"]').value = self.formPostulant.afiliacion ?? '';    

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
                            tipo: self.attachedFileTypes.find(o => Number(o.id) === Number(ft.value)).nombre,
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
                const uniq = Date.now();
                let html = `
                                <td>
                                    <select class="form-control form-control-solid form-input-file-type" name="tipo_archivos[]" required="">
                                        <option value="" hidden="">[SELECCIONE]</option>`;
                                    self.attachedFileTypes.forEach(item => {
                                        html += `<option value="${item.id}">${item.nombre}${item.requerido == 1 ? '*' : ''}</option>`;
                                    });             
                          html += ` </select>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input id="input-${uniq}" class="form-control form-control-solid form-input-file" name="archivos[]" type="file" accept="application/pdf" required>
                                        <!--div class="my-auto">
                                            <button id="button-${uniq}" class="btn btn-viewer btn-info ms-2">Visualizar</button>
                                        </div-->
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-delete mt-1">Eliminar</button>
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
                    tr.querySelectorAll('.btn-viewer').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            const inputFile = dom.querySelector('#input-'+uniq);
                            const files = inputFile.files;
                            if (files.length > 0) {
                                const f = files[0];
                                const reader = new FileReader();
                                reader.addEventListener(
                                "load",
                                () => {
                                    const base64 = reader.result;
                                    self.pdf(base64);
                                    self.modalViewerAttachedFile.show();
                                },
                                false,
                                );
                                reader.readAsDataURL(f);
                            } else {
                                dom.querySelector('#iframeAttachedFile').setAttribute('src', '');
                                sweet2.show({type:'info', text: 'Debe cargar un archivo para poder visualizarlo'});
                            }
                        });
                    });
                    tbody.appendChild(tr);
                });
            },
            pdf: (base64) => {
                base64 = base64.replace('data:application/pdf;base64,', '');
                /*
                https://github.com/mozilla/pdf.js/blob/master/examples/learning/helloworld64.html
                */
                var pdfData = atob(base64);
            
                //
                // The workerSrc property shall be specified.
                //
                pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.4.456/build/pdf.worker.min.js';
            
                // Opening PDF by passing its binary data as a string. It is still preferable
                // to 

                // Opening PDF by passing its binary data as a string. It is still preferable
                // to use Uint8Array, but string or array-like structure will work too.
                var loadingTask = pdfjsLib.getDocument({
                    data: pdfData,
                });
                loadingTask.promise.then(function(pdf) {
                    // Fetch the first page.
                    pdf.getPage(1).then(function(page) {
                        
                        var scale = 1;
                        var viewport = page.getViewport({
                            scale: scale,
                        });

                        // Prepare canvas using PDF page dimensions.
                        var canvas = document.getElementById('the-canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context.
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                        };
                        page.render(renderContext);
                        
                    });
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
                        'numero_contrato',
                        'fechainicio_rd',
                        'fechatermino_rd',
                        'cantidad_mesesrd',
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
            renderVias: () => {
                const selects = dom.querySelectorAll('.select-via');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    self.formVias.forEach(item => {
                        html += `<option value="${ item.TipoViaID }"> ${ item.DesTipoVia }</option>`;
                    });
                    select.innerHTML = html;
                });
            },
            renderZonas: () => {
                const selects = dom.querySelectorAll('.select-zona');
                selects.forEach(select => {
                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                    self.formZonas.forEach(item => {
                        html += `<option value="${ item.TipoZonaID }"> ${ item.DesTipoZona }</option>`;
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
                    self.formDepartamentos.forEach(department => {
                        html += `<option value="${ department.Departamento }"> ${ department.Departamento }</option>`;
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
                            url: window.AppMain.url + 'api/mpv/provincias',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                Departamento: departmentId
                            },
                            cache: 'false'
                        })
                        .done(function ({status, response, message}) {
                            if (status == 200) {
                                self.formProvincias = response;
                                const selectProvinces = dom.querySelectorAll('.select-province'); 
                                selectProvinces.forEach(select => {
                                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                                    self.formProvincias.forEach(provincia => {
                                        html += `<option value="${ provincia.Provincia }"> ${ provincia.Provincia }</option>`;
                                    });
                                    select.innerHTML = html;
                                });
                                const selectDistricts = dom.querySelectorAll('.select-district');
                                selectDistricts.forEach(select => {
                                    select.innerHTML = `<option value="" hidden>[SELECCIONE]</option>`;
                                });
                            }
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
                            url: window.AppMain.url + 'api/mpv/distritos',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                Provincia: provinceId
                            },
                            cache: 'false'
                        })
                        .done(function ({status, response, message}) {
                            if (status == 200) {
                                self.formDistritos = response;
                                const selectDistricts = dom.querySelectorAll('.select-district');
                                selectDistricts.forEach(select => {
                                    let html = `<option value="" hidden>[SELECCIONE]</option>`;
                                    self.formDistritos.forEach(distrito => {
                                        html += `<option value="${ distrito.Distrito }"> ${ distrito.Distrito }</option>`;
                                    });
                                    select.innerHTML = html;
                                });
                            }
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
                                    <img src="${window.AppMain.url + 'public/images/banner-ugel05.png'}" style="height: 90px;max-width: 100%;">
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                      /*   <div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">Código</label></div>
                                            <div class="col-lg-7"><span>${self.response.postulante.uid}</span></div>
                                        </div> */
                                        <div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">Fecha de registro</label></div>
                                            <div class="col-lg-7"><span>${self.response.postulante.fecha_registro}</span></div>
                                        </div>
                                        <!--div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">URL </label></div>
                                            <div class="col-lg-7">
                                                <a target="_blank" href="${ window.AppMain.url + 'web/postulaciones/' + self.response.postulante.uid}">${ window.AppMain.url + 'web/postulaciones/' + self.response.postulante.uid}</a>
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
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">Afiliación</label></div>
                                        <div class="col-lg-7"><span>${postulant.afiliacion}</span></div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-5"><label class="label">CUSS</label></div>
                                        <div class="col-lg-7"><span>${postulant.cuss}</span></div>
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
                                <div class="card-body">`;
                                    if (self.academicTrainings.length == 0) {
                                        html += `<div class="row">
                                                    <div class="col-md-12"> No hay registros para mostrar</div>
                                                </div>`;
                                    } else {
                                        self.academicTrainings.forEach(item => {
                                            html += `<div class="mb-4">
                                                        <div class="row">
                                                            <div class="col-lg-5">Nivel Educativo</div>
                                                            <div class="col-lg-7">${item.nivel_educativo}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Grado Académico</div>
                                                            <div class="col-lg-7">${item.grado_academico}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Universidad</div>
                                                            <div class="col-lg-7">${item.universidad}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Carrera Profesional</div>
                                                            <div class="col-lg-7">${item.carrera_profesional}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">N° de Registro de Título</div>
                                                            <div class="col-lg-7">${item.registro_titulo}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">RD de Título N°</div>
                                                            <div class="col-lg-7">${item.rd_titulo}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Obtención del Grado</div>
                                                            <div class="col-lg-7">${item.obtencion_grado}</div>
                                                        </div>
                                                    </div>`;
                                        });
                                    } 
                        html += `</div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Experiencia laboral</h5>
                                </div>
                                <div class="card-body">`;
                                    if (self.workExperiences.length == 0) {
                                        html += `<div class="row">
                                                    <div class="col-md-12"> No hay registros para mostrar</div>
                                                </div>`;
                                    } else {
                                        self.workExperiences.forEach(item => {
                                            html += `<div class="mb-4">
                                                <div class="row">
                                                    <div class="col-lg-5">Institución educativa</div>
                                                    <div class="col-lg-7">${item.institucion_educativa}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">Sector</div>
                                                    <div class="col-lg-7">${item.sector}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">Puesto</div>
                                                    <div class="col-lg-7">${item.puesto}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">N° RD</div>
                                                    <div class="col-lg-7">${item.numero_rd}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">N° Contrato</div>
                                                    <div class="col-lg-7">${item.numero_contrato}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">Fecha de inicio</div>
                                                    <div class="col-lg-7">${item.fechainicio_rd}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">Fecha de termino</div>
                                                    <div class="col-lg-7">${item.fechatermino_rd}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">Fecha de termino</div>
                                                    <div class="col-lg-7">${item.cantidad_mesesrd}</div>
                                                </div>
                                            </div>`;
                                        }); 
                                    }
                        html += `</div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Especialización</h5>
                                </div>
                                <div class="card-body">`;
                                    if (self.specializations.length == 0) {
                                        html += `<div class="row">
                                                    <div class="col-md-12"> No hay registros para mostrar</div>
                                                </div>`;
                                    } else {
                                        self.specializations.forEach(item => {
                                            html += `<div class="mb-4">
                                                        <div class="row">
                                                            <div class="col-lg-5">Tipo de especialización</div>
                                                            <div class="col-lg-7">${item.tipo_especializacion}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Tema</div>
                                                            <div class="col-lg-7">${item.tema_especializacion}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Nombre de la entidad</div>
                                                            <div class="col-lg-7">${item.nombre_entidad}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Fecha de inicio</div>
                                                            <div class="col-lg-7">${item.fecha_inicio}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Fecha de termino</div>
                                                            <div class="col-lg-7">${item.fecha_termino}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Número de horas</div>
                                                            <div class="col-lg-7">${item.numero_horas}</div>
                                                        </div>
                                                    </div>`;
                                        });
                                    }
                        html += `</div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="m-0">Archivos Adjuntos</h5>
                                </div>
                                <div class="card-body">`;
                                    if (self.formAttachedFiles.length == 0) {
                                        html += `<div class="row">
                                                    <div class="col-md-12"> No hay registros para mostrar</div>
                                                </div>`;
                                    } else {
                                        Object.keys(self.response).length > 0 ? (
                                            self.response.archivos.forEach(item => {
                                            html += `<div class="mb-4">
                                                        <div class="row">
                                                            <div class="col-lg-5">Nombre</div>
                                                            <div class="col-lg-7">${item.nombre}</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-5">Archivo</div>
                                                            <div class="col-lg-7"><a href="${ window.AppMain.url + 'public'+ item.url}" download>${item.url}</a></div>
                                                        </div>
                                                    </div>`;
                                        })) : (
                                            self.formAttachedFiles.forEach(item => {
                                                html += `<div class="mb-4">
                                                            <div class="row">
                                                                <div class="col-lg-5">Tipo</div>
                                                                <div class="col-lg-7">${item.tipo}</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-5">Archivo</div>
                                                                <div class="col-lg-7">${item.archivo}</div>
                                                            </div>
                                                        </div>`;
                                            }) 
                                        )
                                    }
                        html += `</div>
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
                                            <h3 class="card-label">SE REGISTRÓ CORRECTAMENTE PARA EL PROCESO DE CONTRATACIÓN DOCENTE</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                    Estimado <b>${ self.postulant.nombre }</b>, se ha enviado un correo electrónico a <b>${ self.postulant.correo }</b>.
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
                    let html = `<div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    <div>
                                        ${
                                            self.isPUN() ? 
                                            'El número de su documento debe de estar registrado en el examen de la Prueba Única Nacional (PUN) y debe pertenecer a la misma modalidad/nivel/especialidad a la que postula' : 
                                            'Ingresar su número de documento para continuar el registro.'
                                        }
                                    </div>
                                </div>`; 
                    if (valid) {
                        html = `<div class="alert alert-success d-flex align-items-center  mb-0" role="alert">
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
                return self.convocatoriaType == 1;
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
            addZero: (num) => {
                if (Number(num) < 10) {
                    num = '0' + num;
                }
                return num;
            },
            onLetterOnly: (e) => {
                const regEx1 = /[^a-zA-Z\s]+/;
                const value = regEx1.test(e.target.value);
                console.log(value);
            },
            onDateAdut: () => {
                let dateNow = new Date();
                let resta = 1000 * 60 * 60 * 24 * 6570; // 18 years
                let timeOld = dateNow.getTime() - resta;
                let dateObj = new Date(timeOld);
                /*let dateObj = new Date();**/
                let month = dateObj.getUTCMonth() + 1; //months from 1-12
                let day = dateObj.getUTCDate();
                let year = dateObj.getUTCFullYear();
                return year + "-" + self.addZero(month) + "-" + self.addZero(day);
            },
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