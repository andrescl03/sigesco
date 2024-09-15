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
            self.modalidadDescripcion = dom.getAttribute('data-nombre-modalidad');
            dom.removeAttribute('data-nombre-modalidad');
            self.nivelDescripcion = dom.getAttribute('data-nombre-nivel');
            dom.removeAttribute('data-nombre-nivel');
            self.especialidadDescripcion = dom.getAttribute('data-nombre-especialidad');
            dom.removeAttribute('data-nombre-especialidad');
            self.modalPreviewPostulant = self.modal('modalPreviewPostulant');
            self.modalViewerAttachedFile = self.modal('modalViewerAttachedFile');
            self.dateAdult = self.onDateAdut();
            self.initialize();
        },
        data: () => { 
            return {
                numberDocument: 0,
                typeDocument: 1,
                convocatoriaId: 0,
                inscripcionId: 0,
                convocatoriaType: 1, // 2 Expediente - 1 PUN
                convocatoria: {},
                academicTrainings: [],
                specializations: [],
                attachedFiles: [],
                modalPreviewPostulant: {},
                modalViewerAttachedFile: {},
                index: -1,
                formPostulant: {},
                postulant: {},
                formData: {},
                formSpecialties: [],
                formLevels: [],
                formModalities: [],
                departments: [],
                formAttachedFiles: [],
                attachedFileTypes: [],
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
                })
                .catch(error => {
                    sweet2.show({type:'error', html: error});
                });
            },
            renders: () => {
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

                            self.postulant.modalidad = self.isPUN() ? self.formPostulant.modalidad_descripcion : self.modalidadDescripcion;
                            self.postulant.nivel = self.isPUN() ? self.formPostulant.nivel_descripcion : self.nivelDescripcion;
                            self.postulant.especialidad = self.isPUN() ? self.formPostulant.especialidad_descripcion : self.especialidadDescripcion;

 
                            self.listAttachedFile();
                            self.renderPreviewPostulant({el: 'previewPostulant', postulant: self.postulant, toString: false});
                            self.modalPreviewPostulant.show();
                        }
                        
                    });
                });

                self.eventTag('btn-save', () => {

                    console.log(self.convocatoriaId);
                    console.log(self.inscripcionId);
                    console.log(self.typeDocument);
                    console.log(self.attachedFiles);

                    self.formData.append('convocatoria_id', self.convocatoriaId);
                    self.formData.append('inscripcion_id', self.inscripcionId);
                    self.formData.append('tipo_documento', self.typeDocument);
                    self.formData.append('archivos_adjuntos', self.attachedFiles);
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de enviar sus datos?',
                        showCancelButton: true,
                        onOk: () => {
                            sweet2.loading();
                            self.modalPreviewPostulant.hide();
                            $.ajax({
                                url: window.AppMain.url + 'web/reclamo/store',
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
                                sweet2.loading(false);
                                let uid = self.response['postulante'].uid;
                                dom.querySelector('#formPostulant').reset();
                                $('.btn-print-reporte-ficha-postulacion').attr('href', window.AppMain.url + 'reportes/registro/' + uid + '/reclamo');
                                $('#documentos_unificados').attr('href', window.AppMain.url + 'public' + self.response['archivos'][0]['url']);
                                $('#uidExpediente').val(uid);
                                $('#div-step-2').removeClass('d-none');
                                $('#div-step-3').removeClass('d-none');
                                var myModal = new bootstrap.Modal(document.getElementById('showInformacionPostulacion_paso_dos'), {
                                    keyboard: false
                                });
                                myModal.show();
                                self.renderCompletedPostulant();
                            })
                            .fail(function (xhr, status, error) {
                                sweet2.show({type:'error', text:error});
                            });
                        }
                    });
                });

                $('.btn-registrar-numero-expediente').on('click', function () {
                    const numberExpediente = $('input[name="numeroExpediente"]').val();
                    const uidExpediente = $('input[name="uidExpediente"]').val();

                    if (!numberExpediente) {
                        sweet2.show({ type: 'error', html: 'Por favor, completa todos los campos requeridos.' });
                        return;
                    }
                    const formData = new FormData();
                    formData.append('numberExpediente', numberExpediente);
                    formData.append('uid', uidExpediente);
                    sweet2.loading();

                    $.ajax({
                        url: window.AppMain.url + 'web/postulaciones/expediente_reclamo/store',
                        method: 'POST',
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                    }).done(function ({ success, data, message }) {
                        sweet2.loading(false);
                        if (success) {
                            sweet2.show({
                                type: 'success',
                                icon: 'success',
                                html: message
                            });

                            $('.btn-showInformacionPostulacion-paso-dos').remove();

                            setTimeout(() => {
                                var myModal = bootstrap.Modal.getInstance(document.getElementById('showInformacionPostulacion_paso_dos'));
                                myModal.hide();
                            }, 2000);
                            
                        } else {
                            sweet2.show({ type: 'error', html: message || 'Ocurrió un error inesperado.' });
                        }
                    }).fail(function (xhr, status, error) {
                        sweet2.show({ type: 'error', html: error });
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
                    const inputCorreo = dom.querySelector('#correo');
                    const inputFechaNacimiento = dom.querySelector('#fechanacimiento');


                    if (input && inputCorreo && inputFechaNacimiento) {
                        const value = input.value.trim();
                        const valueCorreo = inputCorreo.value.trim();
                        const valueFechaNacimiento = inputFechaNacimiento.value.trim();

                        if (value == 0) {
                            sweet2.show({
                                type: 'info',
                                html: 'Por favor ingrese el número de documento'
                            });
                            return;
                        }

                        if(valueCorreo == 0){
                            sweet2.show({
                                type: 'info',
                                html: 'Por favor ingrese su correo electrónico'
                            });
                            return;
                        }

                        if(valueFechaNacimiento == 0){
                            sweet2.show({
                                type: 'info',
                                html: 'Por favor ingrese su fecha de nacimiento'
                            });
                            return;
                        }

                        sweet2.loading();
                        const formData = new FormData();
                        formData.append('documento', value);
                        formData.append('correo', valueCorreo);
                        formData.append('fechaNacimiento', valueFechaNacimiento);
                        formData.append('convocatoria_id', self.convocatoriaId);
                        formData.append('inscripcion_id', self.inscripcionId);
                        $.ajax({
                            url: window.AppMain.url + 'web/postulaciones/reclamo/find',
                            method: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false,
                            contentType: false,
                        })
                        .done(function ({success, data, message,status}) {

                            if (success) {
                                self.numberDocument = dom.querySelector('input[name="numero_documento"]').value;
                                self.typeDocument = dom.querySelector('input[name="tipo_documento"]').value;
                                self.formPostulant = data.postulacion;
                                dom.querySelector('input[name="nombre"]').value = self.formPostulant.nombre + ' ' + self.formPostulant.apellido_paterno + ' ' +  self.formPostulant.apellido_materno;
                                dom.querySelector('input[name="fecha_postulacion"]').value = self.formPostulant.fecha_registro;
                                dom.querySelector('input[name="numero_celular"]').value = self.formPostulant.numero_celular;

                                formPostulants.forEach(form => {
                                    form.classList.add('was-validated');
                                });

                                if (self.isPUN()) {
                                    sweet2.show({
                                        type: 'info',
                                        html: 'Bienvenido a la etapa de reclamo para el proceso de Contratación por resultados de la Prueba Única Nacional (PUN). </br> <b>Por favor, ingrese su documento de reclamo en un único archivo PDF.'
                                    });
                                }
                                else{
                                    sweet2.show({
                                        type: 'info',
                                        html: 'Bienvenido a la etapa de reclamo para el proceso de Contratación por Evaluación de Expediente. </br> <b>Por favor, ingrese su documento de reclamo en un único archivo PDF.'
                                    });
                                }
                                //sweet2.loading(false);
                                self.renderAlertPostulant(success);
                                self.formInputEvent(!success);
                                self.formInputDocument(!success);
                            } else {

                                if (status == 500) {
                                    sweet2.show({
                                        type: 'error',
                                        html: message
                                    });
                                    return;
                                }

                                self.numberDocument = 0;

                                const { uid,  numero_expediente_reclamo } = data.postulacion;
                                const { url } = data.postulacionReclamo;

                                const ruta_imagen = numero_expediente_reclamo  ? 'assets/image/escala_paso_tres.png'  : 'assets/image/escala_paso_dos.png';

                                Swal.fire({
                                    title: 'POSTULACIÓN',
                                    html: `<p style="font-size: 16px; color: #333;">${message}</p>`,
                                    imageUrl: `${window.AppMain.url}${ruta_imagen}`,
                                    imageWidth: 100,
                                    imageHeight: 100,
                                    confirmButtonText: 'Continuar', 
                                    confirmButtonColor: '#3085d6', 
                                    background: '#f9f9f9', 
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#div-step-2').removeClass('d-none');
                                        $('#div-step-3').removeClass('d-none');

                                        if (numero_expediente_reclamo) {
                                            $('#div-step-2').addClass('d-none');
                                            $('#div-step-3').addClass('d-none');
                                        }
                                        else {
                                            $('.btn-print-reporte-ficha-postulacion').attr('href', `${window.AppMain.url}reportes/registro/${uid}/reclamo`);
                                            $('#documentos_unificados').attr('href',`${window.AppMain.url}public/${url}`);
                                            $('#uidExpediente').val(uid);
                                            const myModal = new bootstrap.Modal(document.getElementById('showInformacionPostulacion_paso_dos'), {
                                                keyboard: false
                                            });
                                            myModal.show();
                                        }
                                    }
                                });
                            }
                               
                        })
                        .fail(function (xhr, status, error) {
                            sweet2.show({type:'error', html: error});
                        });
                    }
                });

                self.formInputEvent(true);

            },
            detail: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + 'web/convocatorias/reclamo/detail',
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
                    input.readOnly = true;
               
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
                    const existingTr = tbody.querySelector('tr');

                    if (!existingTr){
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
                    }
                
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
            renderPreviewPostulant: ({el, postulant, toString = false}) => {
                let html = `${ 
                    Object.keys(self.response).length > 0 ? 
                                `<div class="text-center mb-3">
                                    <img src="${window.AppMain.url + 'public/images/banner-ugel05.png'}" style="height: 90px;max-width: 100%;">
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                         <div class="row mb-1">
                                            <div class="col-lg-5"><label class="label">Código</label></div>
                                            <div class="col-lg-7"><span>${self.response.postulante.uid}</span></div>
                                        </div> 
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
                                        <div class="col-lg-5"><label class="label">Nombres y apellidos</label></div>
                                        <div class="col-lg-7"><span>${postulant.nombre}</span></div>
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
                                </div>
                            </div>`;
                        html += `
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
                                            <h3 class="card-label">SE REGISTRÓ CORRECTAMENTE SU RECLAMO</h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>
                                                    Estimado <b>${self.postulant.nombre}</b>, no olvide descargar su <b>reporte de reclamo</b> y <b>consolidado de documentos cargados</b>.
                                                </div>
                                            </div>
                                            ${ self.renderPreviewPostulant({postulant: self.postulant, toString: true}) }
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-dark btn-showInformacionPostulacion-paso-dos">Click aquí para continuar con el paso 2 - registro en MINEDU EN LÍNEA</button>
                                    </div>
                                </div>`;
            self.eventTag('btn-showInformacionPostulacion-paso-dos', () => {
                                    sweet2.loading(false);
                                   var myModal = new bootstrap.Modal(document.getElementById('showInformacionPostulacion_paso_dos'), {
                                        keyboard: false
                                    });
                                    myModal.show();
                                });
            },
            renderAlertPostulant: (valid = false) => {
                const alerts = dom.querySelectorAll('.alert-postulant');
                alerts.forEach(alert => {
                    let html = `<div class="alert alert-primary d-flex align-items-center mb-0" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                                    <div>El número de su documento de identidad es importante para validar si existe una postulación con sus datos</div>
                                </div>`; 
                    if (valid) {
                        html = `<div class="alert alert-success d-flex align-items-center  mb-0" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="check-circle:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                                Bienvenido al proceso de registro de reclamo de su postulación en está convocatoría
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