const AppEditarPeriodoAdmin = () => { // JS Pure
    const { data, methods, mounted, computed, utilities, el, renders } = {
        el: 'AppEditarPeriodoAdmin',
        mounted: () => {
            self.periodo_id = dom.getAttribute('data-id');
            dom.removeAttribute('data-id');
            self.modalViewerAnexo = self.modal('modalViewerAnexo');
            self.initialize();
        },
        data: () => { 
            return {
                modalViewerAnexo: {},
                periodo_id: 0,
                sections: [],
                periodo: {},
                anexo_id: 0,
                anexos: [],
                anexo: {},
                items: []
            }
        },
        methods: {
            initialize: () => {
                sweet2.loading();
                self.getDetail()
                .then(data => {
                    console.log(data);
                    self.periodo = data.periodo;
                    self.anexos = data.anexos;
                    self.events();
                    self.setFormPeriodo();
                    sweet2.loading(false);
                })
                .catch(error => {
                    sweet2.show({type: 'error', text: error});
                });
            },
            events: () => {

                self.eventTag('btn-save-module', (e) => {
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: () => {
                            const formData = new FormData();
                            formData.append('any', 'anexos');
                            formData.append('anexo_id', self.anexo_id);
                            formData.append('sections', JSON.stringify(self.sections));
                            self.setDetail(formData);
                        }
                    });
                });

                self.eventTag('btn-viewer-module', (e) => {
                    self.viewAnexoDetail();
                    self.modalViewerAnexo.show();
                });

                self.eventTag('select-anexo', (e) => {
                    self.anexo_id = Number(e.target.value);
                    self.setFormModule();
                    dom.querySelector('#panel-actions').style.display = 'block';
                }, 'change');

                self.eventTag('form-periodo', (e) => {
                    e.preventDefault();
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de guardar cambios?',
                        showCancelButton: true,
                        onOk: () => {
                            const formData = new FormData(e.target);
                            formData.append('any', 'edicion');
                            self.setDetail(formData);
                        }
                    });
                }, 'submit');

            },
            setFormModule: () => {
                self.anexo = self.anexos.find((o)=>{return o.id == self.anexo_id});
                self.sections = [];
                if (self.anexo.plantilla) {
                    if (self.anexo.plantilla.sections) {
                        self.sections = self.anexo.plantilla.sections;
                    }
                }
                self.viewModule();
            },
            setFormPeriodo: () => {
                dom.querySelector('input[name="name"]').value = self.periodo.per_nombre;
                dom.querySelector('input[name="anio"]').value = self.periodo.per_anio;
            },
            setDetail: (formData) => {
                sweet2.loading();
                $.ajax({
                    url: window.AppMain.url + `configuracion/periodos/${self.periodo_id}/update`,
                    method: 'POST',
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                })
                .done(function ({success, data, message}) {
                    sweet2.show({type: success ? 'success' : 'error', html: message});
                })
                .fail(function (xhr, status, error) {
                    sweet2.show({type:'error', text:error});
                });
            },
            getDetail: () => {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: window.AppMain.url + `configuracion/periodos/${self.periodo_id}/detail`,
                        method: 'POST',
                        dataType: 'json',
                        cache: 'false'
                    })
                    .done(function ({success, data, message}) {
                        if (success) {
                            resolve(data);
                        } else {
                            reject(error);
                        }
                    })
                    .fail(function (xhr, status, error) {
                        reject(error);
                    });

                });
            }
        },
        renders: {
            viewModule: () => {
                const containers = dom.querySelectorAll('.container-section');
                containers.forEach(container => {
                    container.innerHTML = ``;
                    const accordion = document.createElement('div');
                    accordion.classList.add('accordion');

                    self.sections?.forEach((section, index) => {
                        accordion.appendChild(self.viewSection(section, ()=>{
                            self.sections.splice(index, 1);
                        }));
                    });
                    container.appendChild(accordion);

                    const row = document.createElement('div');
                    row.classList.add('row', 'ms-2', 'mt-4');

                    const btnAdd = document.createElement('a');
                    btnAdd.classList.add('link-dark');
                    btnAdd.href = `javascript: void(0)`;
                    btnAdd.innerHTML = `<svg class="svg-inline--fa fa-plus me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"></path></svg>Agregar Rubro`;
                    btnAdd.addEventListener('click', (e) => {
                        const section = {
                            id: self.uniqid(),
                            name: '',
                            position: 0,
                            score: 0,
                            groups: []
                        };
                        self.sections.push(section);
                        accordion.appendChild(self.viewSection(section, () => {
                            self.sections.splice(self.sections.length - 1, 1);
                        }));
                    });
                    row.appendChild(btnAdd);
                    container.appendChild(row);
                });
            },
            viewSection: (section, remove) => {
         
                const accordionItem = document.createElement('div');
                accordionItem.classList.add('accordion-item');

                const accordionHeader = document.createElement('div');
                accordionHeader.classList.add('accordion-header', 'row');
                accordionHeader.id = `panelsStayOpen-header-section-${section.id}`;
                accordionHeader.style.padding = `1.75rem 1rem`;

                const div1 = document.createElement('div');
                div1.classList.add('col-lg-10', 'd-flex');
                div1.innerHTML = `<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse-section-${section.id}" aria-expanded="false" aria-controls="panelsStayOpen-collapse-section-${section.id}"></button>`;
                const input = document.createElement('input');
                input.type = 'text';
                input.classList.add('form-control');
                input.value = section.name;
                input.addEventListener('keyup', (e) => {
                    section.name = e.target.value;
                });
                div1.appendChild(input);

                const divgroup = document.createElement('div');
                divgroup.classList.add('input-group', 'ms-3');
                divgroup.style.maxWidth = '200px';
                divgroup.innerHTML = `<span id="basic-addon1" class="input-group-text">Puntaje</span>`;
                
                const inputgroup = document.createElement('input');
                inputgroup.type = 'number';
                inputgroup.classList.add('form-control');
                inputgroup.value = section.score;
                inputgroup.addEventListener('change', (e)=>{
                    section.score = e.target.value;
                });
                divgroup.appendChild(inputgroup);

                div1.appendChild(divgroup);

                accordionHeader.appendChild(div1);

                const div2 = document.createElement('div');
                div2.classList.add('col-lg-2', 'text-end', 'mt-2');

                const btnRemove = document.createElement('a');
                btnRemove.classList.add('link-dark');
                btnRemove.href = `javascript: void(0)`;
                btnRemove.innerHTML = `<svg class="svg-inline--fa fa-trash-can me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"></path></svg>Eliminar`;
                btnRemove.addEventListener('click', (e) => {
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de eliminar este elemento?',
                        showCancelButton: true,
                        onOk: () => {
                            remove();
                            accordionItem.remove();        
                        }
                    });
                });

                div2.appendChild(btnRemove);

                accordionHeader.appendChild(div2);

                accordionItem.appendChild(accordionHeader);

                const accordionCollapse = document.createElement('div');
                accordionCollapse.classList.add('accordion-collapse','collapse');
                accordionCollapse.id = `panelsStayOpen-collapse-section-${section.id}`;
                accordionCollapse.setAttribute(`aria-labelledby`, `panelsStayOpen-header-section-${section.id}`);

                const accordionBody = document.createElement('div');
                accordionBody.classList.add('accordion-body', 'pt-0');
                section.groups?.forEach((group, index) => {
                    accordionBody.appendChild(self.viewGroup(group, ()=>{
                        section.groups.splice(index, 1);
                    }));
                })
                

                accordionCollapse.appendChild(accordionBody);

                const div3 = document.createElement('div');
                div3.classList.add('col-lg-12', 'ps-4', 'pb-4');

                const btnAdd = document.createElement('a');
                btnAdd.classList.add('link-dark');
                btnAdd.href = `javascript: void(0)`;
                btnAdd.innerHTML = `<svg class="svg-inline--fa fa-plus me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"></path></svg>Agregar Criterio`;
                btnAdd.addEventListener('click', (e) => {
                    const group = {
                        id: self.uniqid(),
                        name: '',
                        position: 0,
                        score: 0,
                        questions: []
                    };
                    section.groups.push(group);
                    accordionBody.appendChild(self.viewGroup(group, ()=>{
                        section.groups.splice(section.groups.length - 1, 1);
                    }));
                });
                div3.appendChild(btnAdd);
                accordionCollapse.appendChild(div3);

                accordionItem.appendChild(accordionCollapse);
                return accordionItem;
                    
            },
            viewGroup: (group, remove) => {
                
                const panel = document.createElement('div');
                panel.classList.add('mb-3','p-4','border');

                const row1 = document.createElement('div');
                row1.classList.add('row', 'mb-3');

                const col1 = document.createElement('div');
                col1.classList.add('col-lg-10','mb-3');

                const textarea = document.createElement('textarea');
                textarea.placeholder = 'Escribe aquí';
                textarea.classList.add('form-control');
                textarea.value = group.name;
                textarea.rows = 1;
                textarea.addEventListener('keyup', (e) => {
                    group.name = e.target.value;
                });
                col1.appendChild(textarea);

                row1.appendChild(col1);

                const col2 = document.createElement('div');
                col2.classList.add('col-lg-2', 'text-end', 'my-auto', 'mb-3');

                const btnRemove = document.createElement('a');
                btnRemove.classList.add('link-dark');
                btnRemove.href = `javascript: void(0)`;
                btnRemove.innerHTML = `<svg class="svg-inline--fa fa-trash-can me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"></path></svg>Eliminar`;
                btnRemove.addEventListener('click', (e) => {
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de eliminar este elemento?',
                        showCancelButton: true,
                        onOk: () => {
                            remove();
                            panel.remove();        
                        }
                    });
                });
                col2.appendChild(btnRemove);
                row1.appendChild(col2);

                panel.appendChild(row1);

                const row2 = document.createElement('div');
                row2.classList.add('row', 'ms-2');
                group.questions?.forEach((question, index) => {
                    row2.appendChild(self.viewQuestion(question, ()=>{
                        group.questions.splice(index, 1);
                    }));
                });
                panel.appendChild(row2);

                const row3 = document.createElement('div');
                row3.classList.add('row', 'ms-2');

                const btnAddQuestion = document.createElement('a');
                btnAddQuestion.classList.add('link-dark');
                btnAddQuestion.href = `javascript: void(0)`;
                btnAddQuestion.innerHTML = `<svg class="svg-inline--fa fa-plus me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"></path></svg>Agregar Subcriterio`;
                btnAddQuestion.addEventListener('click', (e) => {
                    const question = {
                        id: self.uniqid(),
                        name: '',
                        position: 0,
                        score: 0,
                        answers: []
                    };
                    group.questions.push(question);
                    row2.appendChild(self.viewQuestion(question, ()=>{
                        group.questions.splice(group.questions.length - 1, 1);
                    }));
                });
                row3.appendChild(btnAddQuestion);
                panel.appendChild(row3);

                return panel;
            },
            viewQuestion: (question, remove) => {

                const panel = document.createElement('div');
                panel.classList.add('col-lg-12');

                const row1 = document.createElement('div');
                row1.classList.add('row', 'mb-2');

                const col1 = document.createElement('div');
                col1.classList.add('col-lg-10', 'mb-2', 'd-flex', 'my-auto');

                const textarea = document.createElement('textarea');
                textarea.placeholder = 'Escribe aquí';
                textarea.classList.add('form-control');
                textarea.value = question.name;
                textarea.rows = 1;
                textarea.addEventListener('keyup', (e) => {
                    question.name = e.target.value;
                });
                col1.appendChild(textarea);

                const input = document.createElement('input');
                input.type = 'number';
                input.classList.add('form-control', 'ms-3');
                input.style.maxWidth = '75px';
                input.value = question.score;
                input.addEventListener('change', (e)=>{
                    question.score = e.target.value;
                });
                col1.appendChild(input);

                row1.appendChild(col1);

                const col2 = document.createElement('div');
                col2.classList.add('col-lg-2', 'my-auto', 'text-end', 'mb-2');

                const btnRemove = document.createElement('a');
                btnRemove.classList.add('link-dark');
                btnRemove.href = `javascript: void(0)`;
                btnRemove.innerHTML = `<svg class="svg-inline--fa fa-trash-can me-2 text-dark" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-can" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM31.1 128H416V448C416 483.3 387.3 512 352 512H95.1C60.65 512 31.1 483.3 31.1 448V128zM111.1 208V432C111.1 440.8 119.2 448 127.1 448C136.8 448 143.1 440.8 143.1 432V208C143.1 199.2 136.8 192 127.1 192C119.2 192 111.1 199.2 111.1 208zM207.1 208V432C207.1 440.8 215.2 448 223.1 448C232.8 448 240 440.8 240 432V208C240 199.2 232.8 192 223.1 192C215.2 192 207.1 199.2 207.1 208zM304 208V432C304 440.8 311.2 448 320 448C328.8 448 336 440.8 336 432V208C336 199.2 328.8 192 320 192C311.2 192 304 199.2 304 208z"></path></svg>Eliminar`;
                btnRemove.addEventListener('click', (e) => {
                    sweet2.show({
                        type: 'question',
                        text: '¿Estás seguro de eliminar este elemento?',
                        showCancelButton: true,
                        onOk: () => {
                            remove();
                            panel.remove();        
                        }
                    });
                });
                col2.appendChild(btnRemove);

                row1.appendChild(col2);
                panel.appendChild(row1);
                return panel;
            },
            viewAnexoDetail: () => {
                let html = ``;
                let total = 0;
                let ls = 0;
                let lg = 0;
                self.sections.forEach((section, index1) => {
                    total = total + Number(section.score);
                    ls = 0; 
                    section.groups.forEach((group, index2) => {                             
                        group.questions.forEach((question, index3) => {
                            ls = ls + 1;
                        });
                    });
                    section.groups.forEach((group, index2) => {
                        lg = 0;
                        group.questions.forEach((question, index3) => {
                            lg = lg + 1;
                        });
                        group.questions.forEach((question, index3) => {
                            html += 
                            `<tr class="">
                                ${ 
                                    index3 == 0 && index2 == 0 ? `<td class="colvert bg-light" rowspan="${ls}">${section.name}</td>` : ``
                                }
                                ${ 
                                    index3 == 0 ? `<td scope="row" rowspan="${lg}">${group.name}</td>` : ``
                                }
                                <td>${question.name}</td>
                                <td class="text-center">${question.score}</td>
                                ${ 
                                    index3 == 0 && index2 == 0 ? `<td class="text-center" rowspan="${ls}">${section.score}</td>` : ``
                                }
                            </tr>`;

                        });
                    });
                });
                html += 
                    `<tr class="">
                        <td colspan="4" class="text-center fw-bold">PUNTAJE TOTAL</td>
                        <td class="text-center fw-bold">${total}</td>
                    </tr>`;
                const tbodies = dom.querySelectorAll('.tbody-anexo');
                tbodies.forEach(tbody => {
                    tbody.innerHTML = html;
                });
            }
        },
        utilities: {
            modal: (el) => {
                return new bootstrap.Modal(dom.querySelector('#' + el));
            },
            uniqid: () => {
                return Math.floor(Math.random() * (new Date).getTime());
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
        }
    };
    const self = {
        ...data(),
        ...methods,
        ...computed,
        ...renders,
        ...utilities
    }, dom = document.getElementById(el);
    return mounted();
}
document.addEventListener('DOMContentLoaded', AppEditarPeriodoAdmin());