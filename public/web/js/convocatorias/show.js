const AppConvovatoriaWeb = () => {
    const { data, methods, mounted, utilities, el } = {
        el: 'AppConvocatoriaWeb',
        mounted: () => {
            self.modalWorkExperience = self.modal('modalWorkExperience');
            self.modalSpecialization = self.modal('modalSpecialization');
            self.modalAcademicTraining = self.modal('modalAcademicTraining');
            self.initialize();
        },
        data: () => { 
            return {
                convocatoria: {},
                workExperiences: [],
                academicTrainings: [],
                specializations: [],
                modalWorkExperience: {},
                modalSpecialization: {},
                modalAcademicTraining: {},
                index: -1
            }
        },
        methods: {
            initialize: () => {
                self.events();
            },
            events: () => {

                self.eventClickCrudModal('btn-work-experience', () => {
                    self.modalWorkExperience.show();
                });

                self.eventClickCrudModal('btn-academic-training', () => {
                    self.modalAcademicTraining.show();
                });

                self.eventClickCrudModal('btn-specialization', () => {
                    self.modalSpecialization.show();
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

                self.renderUbigeo();
                self.renderWorkExperiences();
                self.renderSpecialization();
                self.renderAcademicTraining();
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
                        edit: () => { self.modalWorkExperience.show(); },
                        delete: () => { self.renderAcademicTraining(); }
                    }
                });
            },
            renderUbigeo: () => {
                const selectDepartments = dom.querySelectorAll('.select-department');
                selectDepartments.forEach(select => {
                    select.addEventListener('change', (e) => {
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
                                let html = `<option value="">[SELECCIONE]</option>`;
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
            eventClickCrudModal: (el, _callback) => {
                const btns = dom.querySelectorAll('.' + el);
                btns.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        self.index = -1;
                        _callback();
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