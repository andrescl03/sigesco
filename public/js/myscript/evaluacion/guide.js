
const viewfichaDetail = (pageActive = 1) => {

	const dom = document.querySelector('#containerFicha');
	dom.innerHTML = ``;
	const postulant_id = dom.getAttribute('data-id');
	//dom.removeAttribute('data-id');
	const revaluar = dom.getAttribute('data-revaluar');
	//dom.removeAttribute('data-revaluar');
	const domHeader = document.createElement('div');
	domHeader.classList.add('mb-3', 'text-center');
	domHeader.style.display = 'flex';
	domHeader.style.overflowX = 'auto';
	dom.appendChild(domHeader);
	const domBody = document.createElement('div');
	dom.appendChild(domBody);

	let currentActive = pageActive;
	const textWraps = [];

	function getStatusName (id) {
		const options = [
			'NO CUMPLE',
			'CUMPLE',
			'OBSERVADO',
		];
		return options[id];
	}

	// Function to create a cell with specified attributes and text
	function createCell(tag, text, attributes = {}, style = {}) {
		const cell = document.createElement(tag);
		if (text !== undefined) {
			if (typeof text == 'object') {
				cell.appendChild(text);
			} else {
				cell.textContent = text;
			}
		}	
		for (const key in attributes) {
			cell.setAttribute(key, attributes[key]);
		}
		for (const key in style) {
			if (cell.style.hasOwnProperty(key)) {
				cell.style[key] = style[key];
			}
		}
		return cell;
	}

	// Function to create a row with specified cells
	function createRow(cells) {
		const row = document.createElement('tr');
		cells.forEach(cell => {
			row.appendChild(cell);
		});
		return row;
	}

	// Function to create a textarea with specified attributes
	function createTextarea(attributes = {},  events = {}, value = '') {
		const textarea = document.createElement('textarea');
		for (const key in attributes) {
			textarea.setAttribute(key, attributes[key]);
		}
		for (const key in events) {
			textarea.addEventListener(key, events[key]);
		}
		textarea.value = value;
		return textarea;
	}
	
	// Function to create a select element with specified options
	function createSelect(options = [], attributes = {}, events = {}, selected = null) {
		const select = document.createElement('select');
		for (const key in attributes) {
			select.setAttribute(key, attributes[key]);
		}
		const option = document.createElement('option');
		option.text = '[SELECCIONE]';
		option.value = '';
		option.setAttribute('hidden', true);
		option.setAttribute('selected', true);
		select.add(option);
		// Create option elements and append them to the select element
		options.forEach(optionText => {
			const option = document.createElement('option');
			option.text = optionText.text;
			option.value = optionText.value;
			if (selected == optionText.value) {
				option.selected = true;
			}
			select.add(option);
		});
		for (const key in events) {
			select.addEventListener(key, events[key]);
		}
		return select;
	}
	
	// Function to create a checkbox input element
	function createCheckbox(attributes = {}, events = {}) {
		const checkbox = document.createElement('input');
		checkbox.type = 'checkbox';
		for (const key in attributes) {
			checkbox.setAttribute(key, attributes[key]);
		}
		for (const key in events) {
			checkbox.addEventListener(key, events[key]);
		}
		return checkbox;
	}

	// Function to create a number input element
	function createNumberInput(attributes = {}, events = {}) {
		const numberInput = document.createElement('input');
		numberInput.type = 'number';
		numberInput.min = 0;
		for (const key in attributes) {
			numberInput.setAttribute(key, attributes[key]);
		}
		for (const key in events) {
			numberInput.addEventListener(key, events[key]);
		}
		return numberInput;
	}

	// Function to create a text input element
	function createTextInput(attributes = {}, events = {}) {
		const textInput = document.createElement('input');
		textInput.type = 'text';
		for (const key in attributes) {
			textInput.setAttribute(key, attributes[key]);
		}
		for (const key in events) {
			textInput.addEventListener(key, events[key]);
		}
		return textInput;
	}

	// Function to create and display a Bootstrap alert
	function showAlert(message, alertType) {
		// Create a div element with Bootstrap alert classes
		let alertDiv = document.createElement('div');
		alertDiv.className = 'alert alert-' + alertType + ' alert-dismissible fade show';
	
		// Create the close button for the alert
		let closeButton = document.createElement('button');
		closeButton.type = 'button';
		closeButton.className = 'btn-close';
		closeButton.setAttribute('data-bs-dismiss', 'alert');
		closeButton.setAttribute('aria-label', 'Close');
	
		// Create a paragraph element for the alert message
		let messageParagraph = document.createElement('p');
		messageParagraph.innerHTML = message;
	
		// Append elements to the alert div
		alertDiv.appendChild(messageParagraph);
		alertDiv.appendChild(closeButton);
		return alertDiv;
	}

	function showAlertModal({title, message, type, button, id = null}) {
		// Crear el div de la alerta con JavaScript
		var alertDiv = document.createElement("div");
		alertDiv.className = "alert alert-" + type;
		alertDiv.setAttribute("role", "alert");
		if (id) {
			alertDiv.setAttribute("id", id);			
		}
	
		// Crear elementos internos de la alerta
		var heading = document.createElement("h4");
		heading.className = "alert-heading";
		heading.textContent = title;
	
		var paragraph = document.createElement("p");
		paragraph.textContent = message;		   
		
		var hr = document.createElement("hr");

		// Agregar los elementos internos al div de la alerta
		alertDiv.appendChild(heading);
		alertDiv.appendChild(paragraph);
		alertDiv.appendChild(hr);
		alertDiv.appendChild(button);
	
		// Agregar la alerta al cuerpo del documento
		return alertDiv;
	}

	function hiddenNextAnexo(value) {
		const alertNextAnexo = document.querySelector('#alertNextAnexo');
		if (alertNextAnexo) {
			alertNextAnexo.style.display = Number(value) == 0 ? 'none' : 'block';
		}
	}
	
	function getDetail() {
		return new Promise(function (resolve, reject) {
			$.ajax({
				url: window.AppMain.url + `postulaciones/${postulant_id}/fichas`,
				method: 'POST',
				dataType: 'json',
				cache: 'false'
			})
			.done(function ({success, data, message}) {
				if (success) {
					resolve(data);
				} else {
					reject(message);
				}
			})
			.fail(function (xhr, status, error) {
				reject(message);
			});
	
		});
	}

	function setFicha(formData) {
		return new Promise(function (resolve, reject) {
			$.ajax({
				url: window.AppMain.url + `postulaciones/${postulant_id}/ficha`,
				method: 'POST',
				dataType: 'json',
				processData: false,
				contentType: false,
				data: formData
			})
			.done(function ({success, data, message}) {
				if (success) {
					resolve({success, data, message});
				} else {
					reject(message);
				}
			})
			.fail(function (xhr, status, error) {
				reject(message);
			});
	
		});
	}

	function init(data) {

		let self = {
			postulante: data.postulante,
			ficha_id: 0,
			fichas: data.fichas,
			sections: [],
			ficha: {},
			total_section: 0,
			total_question: 0,
			total: 0,
			especialidad_prelaciones: data.especialidad_prelaciones,
			especialidad_id: data.especialidad_id,
			tipo_id: data.convocatoria.con_tipo,
			revisado: 0,
			modalPrerequisito: new bootstrap.Modal(document.querySelector('#modalPrerequisito'))
		};

		const isPUN = () => {
			return self.tipo_id == 1;
		}

		const isPrerequisito = () => {
			return Number(self.ficha.promedio) == 0;
		}

		const isAnexo = () => {
			return Number(self.ficha.promedio) == 1;
		}

		const setFormModule = (id) => {
			self.ficha_id = id;
			return new Promise((resolve, reject) => {
				try {
					domBody.innerHTML = ``;
					self.ficha = self.fichas.find((o)=>{return o.id == id});
					// self.ficha.evaluacion_estado = Number(self.ficha.evaluacion_estado);
					self.sections = [];
					if (self.ficha.plantilla) {						
						if (self.ficha.plantilla.sections) {
							self.sections = self.ficha.plantilla.sections;
							if (self.ficha.evaluacion_estado == 1) {
								if (self.postulante.estado == 'revisado' && revaluar == 0) {
									formFichaDetail();
								} else if (self.postulante.estado == 'finalizado' && revaluar == 1) {
									viewFicha();
								} else if (self.postulante.estado == 'finalizado' && revaluar == 0) {
									viewFicha();
								} else {
									formFichaDetail();
								}
							} else {
								formFichaDetail();
							}
						}
					}
					resolve();
				} catch (error) {
					reject(error);
				}
			});
		};

		const isValidFichaRequisito = () => {
			let brand = false;
			const select = dom.querySelector('#estadoFichaRequisito');
			if (select) {
				const value = select.value;
				if (value.length == 0) {
					brand = true;
				}
			}
			if (brand) {
				sweet2.show({type: 'error', text: 'Debe de seleccionar el estado de la ficha'});
			}
			return brand;
		}

		const formFichaDetail = () => {
			// Create the outer div with the 'table-responsive' class
			const tableResponsiveDiv = document.createElement('div');
			tableResponsiveDiv.classList.add('table-responsive', 'mb-3');

			// Create the table with the 'table' and 'table-bordered' classes
			const table = document.createElement('table');
			table.classList.add('table', 'table-bordered', 'mb-0');

			// Create the table header
			const thead = document.createElement('thead');
			const headerCells = [
				createCell('th', 'RUBRO', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'CRITERIOS', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'SUBCRITERIOS', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'EVALUACIÓN', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
			];
			if (self.ficha && self.ficha.promedio == 1) {
				headerCells.push(createCell('th', 'Puntaje máximo por subcriterio', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }));
				headerCells.push(createCell('th', 'Puntaje máximo por rubro', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }));
			}
			const headerRow = createRow(headerCells);

			thead.appendChild(headerRow);
			table.appendChild(thead);

			// Create the table body
			const tbody = document.createElement('tbody');

			// Your rows and cells creation goes here...
			// For brevity, I'm only creating a single row with some data
			const rows = [];
			let total = 0;
			let ls = 0;
			let lg = 0;

			self.sections.forEach((section, index1) => {
				total = total + Number(section.score);
				ls = 0; 
				self.total_section = self.total_section + Number(section.score);  
				section.groups.forEach((group, index2) => {                          
					group.questions.forEach((question, index3) => {
						ls = ls + 1;
						self.total_question = self.total_question + Number(question.score);
					});
				});
				if (section.groups.length == 0) {
					const cells = [
						createCell('td', section.name, {class: 'colvert bg-light'}),
						createCell('td', ''),
						createCell('td', ''),
						createCell('td', '', {class: 'text-center'})
					];
					if (self.ficha && self.ficha.promedio == 1) {
						cells.push(createCell('td', '', {class: 'text-center'}));
						cells.push(createCell('td', '', {class: 'text-center'}));
					}
					rows.push(createRow(cells));
				} else {
					section.groups.forEach((group, index2) => {
						lg = 0;
						group.questions.forEach((question, index3) => {
							lg = lg + 1;
						});
						if (group.questions.length == 0) {
							const div = document.createElement('div');
							div.innerText = section.name;
							div.style.writingMode = 'vertical-lr';
							div.style.transform = 'rotate(180deg)';
							div.style.textAlign = 'center';
							div.style.verticalAlign = 'middle';
							const cells = [
								createCell('td', div, {class: 'colvert bg-light'}, {
									verticalAlign: 'middle',
									textAlign: '-webkit-center'
								}),
								createCell('td', group.name),
								createCell('td', ''),
								createCell('td', '', {class: 'text-center'})
							];
							if (self.ficha && self.ficha.promedio == 1) {
								cells.push(createCell('td', '', {class: 'text-center'}));
								cells.push(createCell('td', '', {class: 'text-center'}));
							}
							rows.push(createRow(cells));
						} else {
							group.questions.forEach((question, index3) => {
								const cells = [];
								if (index3 == 0 && index2 == 0) {
									const div = document.createElement('div');
									div.innerText = section.name;
									div.style.writingMode = 'vertical-lr';
									div.style.transform = 'rotate(180deg)';
									div.style.textAlign = 'center';
									div.style.verticalAlign = 'middle';
									cells.push(createCell('td', div, { class: 'colvert bg-light', rowspan: ls }, {
										verticalAlign: 'middle',
										textAlign: '-webkit-center'
									}));
								}
								if (index3 == 0) {
									cells.push(createCell('td', group.name, { rowspan: lg }));
								}
								const div = document.createElement('div');
								const span = document.createElement('span');
								span.innerText = question.name;
								div.appendChild(span);
								if (question.observation_status == 1) {
									// Create the textarea with some attributes
									const textarea = createTextarea({
										class: 'form-control mt-3',
										placeholder: 'Ingrese su observación',
										rows: '2'
									}, {
										keyup: (e) => {
											question.observation = e.target.value;
										},
									},
									question.observation
									);
									div.appendChild(textarea);											
								}
								cells.push(createCell('td', div));
								cells.push(createCell('td', viewActionOption(question), {class: 'text-center'}));
								if (self.ficha && Number(self.ficha.promedio) == 1) {
									cells.push(createCell('td', question.score, {class: 'text-center'}));
									if (index3 == 0 && index2 == 0) {
										cells.push(createCell('td', section.score, { class: 'text-center', rowspan: ls }));
									}
								}
								rows.push(createRow(cells));
							});    
						}
					});
				}
			});
			if (self.ficha && Number(self.ficha.promedio) == 1) {
				rows.push(createRow([
					createCell('td', 'TOTAL', { class: 'text-center colvert bg-light fw-bold', colspan: 3 }),
					createCell('td', self.total, { class: 'text-center fw-bold', id: 'total' }),
					createCell('td', self.total_question, { class: 'text-center fw-bold'}),
					createCell('td', self.total_section, { class: 'text-center fw-bold'})
				]));
			}
			rows.forEach(row => {
				tbody.appendChild(row);						
			});
			// End of creating a single row

			// Append the table body to the table
			table.appendChild(tbody);

			// Append the table to the 'table-responsive' div
			tableResponsiveDiv.appendChild(table);

			// Append the 'table-responsive' div to the body of the HTML document
			domBody.appendChild(tableResponsiveDiv);

			if (Number(self.ficha.promedio) == 0) {
				const options = [
					{ value: 0, text: 'NO CUMPLE' },
					{ value: 1, text: 'CUMPLE' },
					{ value: 2, text: 'OBSERVADO' }
				];
				element = createSelect(
					options,
					{ class: 'form-control text-center', id: 'estadoFichaRequisito' },
					{
						change: (e) => {
							self.ficha.evaluacion_estado = e.target.value;
							hiddenNextAnexo(self.ficha.evaluacion_estado);
						}
					},
					self.ficha.evaluacion_estado
				);

				const colr1 = document.createElement('div');
				colr1.classList.add('row');

					const cols0 = document.createElement('div');
					cols0.classList.add('col-md-7');

					const cols1 = document.createElement('div');
					cols1.classList.add('col-md-5', 'float-end');

						const divgroup = document.createElement('div');
						divgroup.classList.add('input-group');

							const span1 = document.createElement('span');
							span1.classList.add('input-group-text');
							span1.innerText = 'Estado';
							span1.style.minWidth = '100px';

						divgroup.appendChild(span1);
						divgroup.appendChild(element);

					cols1.appendChild(divgroup);

				colr1.appendChild(cols0);
				colr1.appendChild(cols1);
				domBody.appendChild(colr1);

			}

			if (Number(self.ficha.promedio) == 1) {
				const options = [];
				self.especialidad_prelaciones.forEach(o => {
					options.push({ value: o.id, text: o.prelacion });
				});
				element = createSelect(
					options,
					{ class: 'form-control text-center', id: 'prelacionFicha' },
					{
						change: (e) => {
							self.ficha.evaluacion_prelacion_id = e.target.value;
						}
					},
					self.ficha.evaluacion_prelacion_id
				);

				const colr1 = document.createElement('div');
				colr1.classList.add('row');

					const cols0 = document.createElement('div');
					cols0.classList.add('col-md-7');

					const cols1 = document.createElement('div');
					cols1.classList.add('col-md-5', 'float-end');

						const divgroup = document.createElement('div');
						divgroup.classList.add('input-group');

							const span1 = document.createElement('span');
							span1.classList.add('input-group-text');
							span1.innerText = 'Prelación';
							span1.style.minWidth = '100px';

						divgroup.appendChild(span1);
						divgroup.appendChild(element);

					cols1.appendChild(divgroup);

				colr1.appendChild(cols0);
				colr1.appendChild(cols1);
				domBody.appendChild(colr1);
			}

			const alertDiv = document.createElement('div');
			alertDiv.id = 'divAlert';
			domBody.appendChild(alertDiv);

			const footer = document.createElement('div');
			footer.classList.add('mt-3', 'text-end');
			
			const btnSave = document.createElement('button');
			btnSave.classList.add('btn', 'btn-primary');
			btnSave.innerText = 'Guardar';
			btnSave.addEventListener('click', (e) => {
				if (isPrerequisito()) { // Prerequisito
					if (isValidFichaRequisito()) {
						return;
					}
					self.revisado = 0;
				} else {
					self.revisado = 1;
				}
				saveAll(false, isPrerequisito() ? 1 : 2);
			});

			const btnModalSave = document.createElement('button');
			btnModalSave.type = "button";
			btnModalSave.className = "btn btn-dark me-2";
			btnModalSave.textContent = "Procesar Información";
			btnModalSave.setAttribute("data-bs-toggle", "modal");
			btnModalSave.setAttribute("data-bs-target", "#modalPrerequisito");

			if (self.postulante.estado != 'finalizado' && isPrerequisito()) {
				footer.appendChild(btnModalSave);
			}

			const btnSaveAll1 = document.createElement('button');
			btnSaveAll1.classList.add('btn', 'btn-danger', 'ms-2');
			btnSaveAll1.innerText = 'Guardar y finalizar';
			btnSaveAll1.addEventListener('click', (e) => {
				self.revisado = 1;
				saveAll(true, isPrerequisito() ? 1 : 2);
			});

			const btnSaveNext = document.createElement('button');
			btnSaveNext.classList.add('btn', 'btn-success', 'ms-2');
			btnSaveNext.innerText = 'Guardar y siguiente';
			btnSaveNext.addEventListener('click', (e) => {
				saveAll(false, 2);
			});

			const btnSave2 = document.createElement('button');
			btnSave2.classList.add('btn', 'btn-info', 'ms-2');
			btnSave2.innerText = 'Guardar y dar por revisado';
			btnSave2.addEventListener('click', (e) => {
				if (isValidFichaRequisito()) {
					return;
				}
				saveAll(false);
			});
			if (self.postulante.estado != 'finalizado') {
				if (isAnexo()) {
					if (revaluar == 0 && self.postulante.estado == 'enviado') {
						footer.appendChild(btnSave);
					} else if (revaluar == 1) { // --
						footer.appendChild(btnSave);
					}			
				}
			}
			if (self.postulante.estado != 'finalizado') {
				if (currentActive == textWraps.length && self.postulante.estado == 'revisado') { // Annexo
					if (revaluar == 0 && self.postulante.estado == 'enviado') {
						footer.appendChild(btnSaveAll1);
					} else if (revaluar == 1) {
						footer.appendChild(btnSaveAll1);
					}
				} else {
					if (isPUN()) { // prerequisito
						self.revisado = 1;
						if (isAnexo()) {
							if (revaluar == 0 && self.postulante.estado == 'enviado' && Number(self.ficha.promedio) == 0) {
								footer.appendChild(btnSave2);
							}
						}
					}
					if (revaluar == 1) {
						if (isAnexo()) {
							if (revaluar == 0 && self.postulante.estado == 'enviado') {
								footer.appendChild(btnSaveAll1);
							} else if (revaluar == 1) {
								footer.appendChild(btnSaveAll1);
							} else if (revaluar == 0 && isPUN() && self.postulante.estado == 'revisado') {
								footer.appendChild(btnSaveAll1);
							}
						}
					}
				}
			}

			const modalBodyPrerequisitos = document.querySelectorAll('.modal-body-prerequisito');
			modalBodyPrerequisitos.forEach(modalBody => {
				modalBody.innerHTML = ``;
				if (isPrerequisito()) {
					modalBody.appendChild(showAlertModal({
						title: 'Guardar!',
						message: 'El sistema guardará los datos de la ficha temporalmente para que pueda seguir editando y relizando las correcciones necesarias.',
						type: 'primary',
						button: btnSave
					}));

					modalBody.appendChild(showAlertModal({
						title: 'Revisar Anexo!',
						message: 'El sistema guardará los datos de la ficha y podrá acceder a la ficha de anexo para continuar con el proceso de evaluación.',
						type: 'success',
						button: btnSaveNext,
						id: 'alertNextAnexo'
					}));

					if (revaluar == 0) {
						modalBody.appendChild(showAlertModal({
							title: 'Dar por Revisado!',
							message: 'Si esta seguro de que los datos de la ficha está correctamente evaluada y no requiere de un anexo.',
							type: 'info',
							button: btnSave2
						}));
					}
					if (revaluar == 1) {
						modalBody.appendChild(showAlertModal({
							title: 'Finalizar Evaluación!',
							message: 'Si esta seguro de que los datos de la ficha está correctamente evaluada se procederá a guardar y finalizar el proceso de evaluación.',
							type: 'danger',
							button: btnSaveAll1
						}));
					}
				}
			});
			hiddenNextAnexo(self.ficha.evaluacion_estado);
			domBody.appendChild(footer);
		}

		const saveAll = (any, page = 1) => {
			if (calculation()) {
				sweet2.show({
					type: 'question',
					html: `¿Estás seguro de guardar cambios? ${ self.ficha.promedio == 1 ? `<h5>Puntaje Total</h5> <h3>${self.total}</h3>` : `` }`,
					showCancelButton: true,
					onOk: () => {
						const plantilla = {
							sections: self.sections
						};
						const formData = new FormData();
						formData.append('ficha_id', self.ficha_id);
						formData.append('plantilla', JSON.stringify(plantilla));
						formData.append('puntaje', self.total);
						formData.append('promedio', self.ficha.promedio);
						formData.append('estado', (any ? 'finalizado': 'revisado'));
						if (Number(self.ficha.promedio) == 1) {
							self.revisado = 1;
						}
						formData.append('revisado', self.revisado);
						if (Number(self.ficha.promedio) == 1) {
							formData.append('evaluacion_estado', 1);			
							formData.append('evaluacion_prelacion_id', self.ficha.evaluacion_prelacion_id);
						} else {
							formData.append('evaluacion_estado', self.ficha.evaluacion_estado);
							formData.append('evaluacion_prelacion_id', 0);
						}
						sweet2.loading();
						setFicha(formData)
						.then(({success, data, message})=>{
							if (!success) {
								throw message;
							}
							if (Number(self.ficha.promedio) == 1) {
								currentActive = textWraps.length;
							} else {
								currentActive = 1;
							}
							self.modalPrerequisito.hide();
							sweet2.show({
								type: 'success', 
								text: message,
								onOk: () => {
									viewfichaDetail(page);
									// window.location.reload();
									// sweet2.loading({text: 'Actualizando información'});
								}
							});
						})
						.catch(error => {
							sweet2.show({type: 'error', text: error});								
						})
					}
				});
			}
		}

		const viewActionOption = (question) => {
			let element = ``;
			if (question.type == 'selectiva') {
				const options = [];
				question?.options.forEach(o => {
					options.push({
						text: o.name,
						value: o.name
					});
				});
				element = createSelect(
					options,
					{ class: 'form-control text-center' },
					{
						change: (e) => {
							question.value = e.target.value;
							validValue(question, e);
						}
					},
					question.value
				);					
			} else if (question.type == 'marcado') {
				const attributes = { 
					class: 'form-check-input text-center', 
					value: Number(self.ficha.promedio) == 1 ? question.score : 1
				};
				if (Number(question.value) > 0) {
					attributes.checked = true;
				}
				element = createCheckbox(attributes,
				{
					change: (e) => {
						question.value = e.target.checked ? e.target.value : 0;
						validValue(question, e);
					}
				});
			} else if (question.type == 'texto') {
				element = createTextInput({ class: 'form-control text-center', placeholder: 'Ingresar texto...', value: question.value ?? '' }, {
					keyup: (e) => {
						question.value = e.target.value;
					}
				});	
			} else if (question.type == 'numerico') {
				element = createNumberInput({ class: 'form-control text-center', value: '', placeholder: '0', value: question.value }, {
					keyup: (e) => {
						question.value = e.target.value;
						validValue(question, e);
					},
					change: (e) => {
						question.value = e.target.value;
						validValue(question, e);
					},
				});
			}
			return element;
		}

		const validValue = (question, e) => {
			if (Number(question.value) > Number(question.score)) {
				e.target.style.borderColor = 'red';
			} else {
				e.target.style.borderColor = '#ced4da';
			}
			calculation();
		}

		const calculation = () => {
			let brand = true, total = 0;
			const divAlert = domBody.querySelector('#divAlert');
			if (divAlert) {
				divAlert.innerHTML = ``;
				try {
					if (Number(self.ficha.promedio) == 1) {
						self.sections.forEach(section => {
							section.groups.forEach(group => {
								group.questions.forEach(question => {
									let value = 0;
									if (question.hasOwnProperty('value')) {
										value = Number(question.value);
										if (value > question.score) {
											throw `El puntaje asignado excede al puntaje máximo en el subcriterio: ${question.name}`;
										}
									} else {
										question.value = 0;
									}
									total = total + value;
								});
							});
						});
						if (total > self.total_section) {
							throw `El puntaje acumulado excede el puntaje total`;
						}
						self.total = total;
						const divTotal = domBody.querySelector('#total');
						if (divTotal) {
							divTotal.innerText = self.total;						
						}	
					}
				} catch (error) {
					divAlert.appendChild(showAlert(error, 'danger'));
					brand = false;				
				}
			}
			return brand;
		}

		const currentProgress = () => {

			const progressContainer = document.createElement('div');
			progressContainer.classList.add('progress-container', 'mx-auto');
			progressContainer.style.display = self.fichas.length == 1 ? 'block' : 'flex';
			const progressLine = document.createElement('div');
			progressLine.classList.add('progress-line');
			progressLine.id = 'progress';

			const progressBackButton = createButton('progressBack', 'Regresar', true);
			const progressNextButton = createButton('progressNext', 'Siguiente');
	
			progressContainer.appendChild(progressLine);

			self.fichas.forEach((ficha, fichaIndex) => {
				const wrap = createTextWrap(fichaIndex + 1, ficha.nombre, fichaIndex == 0, ficha.id);
				progressContainer.appendChild(wrap);
				textWraps.push(wrap);
			});
	
			progressNextButton.addEventListener('click', () => {
				currentActive++
				if(currentActive > textWraps.length) {
					currentActive = textWraps.length
				}
				update()
			})
	
			progressBackButton.addEventListener('click', () => {
				currentActive--
				if(currentActive < 1) {
					currentActive = 1
				}
				update()
			})

			domHeader.appendChild(progressBackButton);
			domHeader.appendChild(progressContainer);

			domHeader.appendChild(progressNextButton);
	
			function createTextWrap(circleNumber, labelText, isActive = false, id = 0) {
				const textWrap = document.createElement('div');
				textWrap.classList.add('progress-text-wrap');
				textWrap.setAttribute('data-id', id);
				if (isActive) {
					textWrap.classList.add('active');
				}
	
				const circle = document.createElement('div');
				circle.classList.add('circle');
				circle.textContent = circleNumber;
	
				const text = document.createElement('p');
				text.classList.add('text');
				text.textContent = labelText;
	
				textWrap.appendChild(circle);
				textWrap.appendChild(text);
	
				return textWrap;
			}
	
			function createButton(id, text, isDisabled = false) {
				const button = document.createElement('button');
				button.classList.add('btn', 'progress-btn');
				button.id = id;
				button.textContent = text;
				if (isDisabled) {
					button.setAttribute('disabled', true);
				}
	
				return button;
			}
	
			function update() {
				const currentWrap = textWraps[currentActive - 1];
				if (!currentWrap) {
					return;
				}
				const id = currentWrap.getAttribute('data-id');
				if (id > 0) {
					setFormModule(id)
					.then(() => {
						textWraps.forEach((wrap, index) => {
							if(index < currentActive) {
								wrap.classList.add('active')
							} else {
								wrap.classList.remove('active')
							}
						})
						const actives = progressContainer.querySelectorAll('.active')
						progressLine.style.width = (actives.length - 1) / (textWraps.length - 1)* 80 + '%'
		
						if(currentActive === 1) {
							progressBackButton.disabled = true
							progressNextButton.disabled = self.postulante.estado == 'finalizado' ? false : true // false
							if(currentActive === textWraps.length) {
								progressNextButton.disabled = true
							}
						} else if(currentActive === textWraps.length) {
							progressBackButton.disabled = false
							progressNextButton.disabled = true
						} else {
							progressBackButton.disabled = false
							progressNextButton.disabled = true
						}
						if (Number(self.ficha.promedio) == 0 && ([0]).includes(Number(self.ficha.evaluacion_estado))) {
							progressNextButton.disabled = true
						}
					})
					.catch(error => {
						sweet2.show({type: 'error', text: error});
					});
					calculation();
				}
			}

			update();
		}

		const viewFicha = () => {
			let prelacion = 'No Disponible';
			self.especialidad_prelaciones.forEach(o => {
				if (o.id == self.ficha.evaluacion_prelacion_id) {
					prelacion = o.prelacion;
				}
			});
			let total = 0;
			let ls = 0;
			let lg = 0;
			let html = `<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="text-center bg-light" style="vertical-align: middle;">RUBRO</th>
										<th class="text-center bg-light" style="vertical-align: middle;">CRITERIOS</th>
										<th class="text-center bg-light" style="vertical-align: middle;">SUBCRITERIOS</th>
										<th class="text-center bg-light" style="vertical-align: middle;">EVALUACIÓN</th>
										${
											(self.ficha && self.ficha.promedio == 1) ? 
											`<th class="text-center bg-light" style="vertical-align: middle;">Puntaje máximo por subcriterio</th>
											 <th class="text-center bg-light" style="vertical-align: middle;">Puntaje máximo por rubro</th>` : ``
										}
									</tr>
								</thead>
								<tbody>`;
			self.sections.forEach((section, index1) => {
				ls = 0; 
				section.groups.forEach((group, index2) => {                             
					group.questions.forEach((question, index3) => {
						ls = ls + 1;
					});
				});
				if (section.groups.length == 0) {
					html += 
					`<tr class=""> 
						<td class="colvert bg-light" style="vertical-align: middle; text-align: -webkit-center;">
							<div style="writing-mode: vertical-lr; transform: rotate(180deg); text-align: center; vertical-align: middle;">
								${section.name}
							</div>
						</td>
						<td></td>
						<td></td>
						<td class="text-center"></td>
						${
							(self.ficha && self.ficha.promedio == 1) ? 
							`<td class="text-center"></td>
							 <td class="text-center"></td>` : ``
						}
					</tr>`;
				} else {
					section.groups.forEach((group, index2) => {
						lg = 0;
						group.questions.forEach((question, index3) => {
							lg = lg + 1;
						});
						if (group.questions.length == 0) {
							html += 
							`<tr class=""> 
								<td class="colvert bg-light" style="vertical-align: middle; text-align: -webkit-center;">
									<div style="writing-mode: vertical-lr; transform: rotate(180deg); text-align: center; vertical-align: middle;">
										${section.name}
									</div>
								</td>
								<td>${group.name}</td>
								<td></td>
								<td class="text-center"></td>
								${
									(self.ficha && self.ficha.promedio == 1) ? 
									`<td class="text-center"></td>
									<td class="text-center"></td>` : ``
								}
							</tr>`;
						} else {
							group.questions.forEach((question, index3) => {
								html += 
								`<tr class="">
									${ 
										index3 == 0 && index2 == 0 ? `<td class="colvert bg-light" rowspan="${ls}" style="vertical-align: middle; text-align: -webkit-center;">
																			<div style="writing-mode: vertical-lr; transform: rotate(180deg); text-align: center; vertical-align: middle;">
																				${section.name}
																			</div>
																	  </td>` : ``
									}
									${ 
										index3 == 0 ? `<td rowspan="${lg}">${group.name}</td>` : ``
									}
									<td>
										${question.name}
										${
											question.observation_status == 1 ? 
											`<br><strong>Observacion: </strong> ${question.observation ?? `-`}` : ``
										}
									</td>
									<td class="text-center">${question.value ?? ''}</td>
									${
										(self.ficha && self.ficha.promedio == 1) ?
										`<td class="text-center">${question.score}</td>
											${ 
												index3 == 0 && index2 == 0 ? `<td class="text-center" rowspan="${ls}">${section.score}</td>` : ``
											}
										` : ``
									}
								</tr>`;
								let value = 0;
								if (question.hasOwnProperty('value')) {
									value = Number(question.value);
								}
								if (question.type == 'selectiva' ||
								    question.type == 'marcado' ||
									question.type == 'numerico') {
									total = total + value;
								}
							});   
						}
					});
				}
			});
			html += 
				`
				${
					(self.ficha && self.ficha.promedio == 1) ?
						`<tr class="">
							<td colspan="3" class="text-center colvert bg-light fw-bold">PUNTAJE OBTENIDO</td>
							<td class="text-center fw-bold">${total.toFixed(2)}</td>
							<td colspan="2"></td>
						</tr>` : ``
				}
				</tbody>
                </table>
				${
					Number(self.ficha.promedio) == 0 ? `<div class="col-md-12"><h5>Estado: ${getStatusName(Number(self.ficha.evaluacion_estado))}</h5></div>` : ``
				}
				${
					Number(self.ficha.promedio) == 1 ? `<div class="col-md-12"><h5>Prelación: ${prelacion}</h5></div>` : ``
				}
			</div>`;
			domBody.innerHTML = html;
		};
	
		currentProgress();
	}

	const build = () => {
		sweet2.loading();
		domHeader.innerHTML = ``;
		domBody.innerHTML = ``;
		getDetail()
		.then((data) => {
			init(data);
			sweet2.loading(false);
		})
		.catch((error) => {
			sweet2.show({type: 'error', text: error});
		});
	}

	build();
	
};

document.addEventListener('DOMContentLoaded', viewfichaDetail());