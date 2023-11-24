
const viewfichaDetail = () => {

	const dom = document.querySelector('#containerFicha');
	const domHeader = document.createElement('div');
	domHeader.classList.add('mb-3');
	domHeader.style.display = 'flex';
	domHeader.style.overflowX = 'auto';
	dom.appendChild(domHeader);
	const domBody = document.createElement('div');
	dom.appendChild(domBody);

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
	function createTextarea(attributes = {},  events = {}) {
		const textarea = document.createElement('textarea');
		for (const key in attributes) {
			textarea.setAttribute(key, attributes[key]);
		}
		for (const key in events) {
			textarea.addEventListener(key, events[key]);
		}
		return textarea;
	}
	
	// Function to create a select element with specified options
	function createSelect(options = [], attributes = {}, events = {}) {
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
		var alertDiv = document.createElement('div');
		alertDiv.className = 'alert alert-' + alertType + ' alert-dismissible fade show';
	
		// Create the close button for the alert
		var closeButton = document.createElement('button');
		closeButton.type = 'button';
		closeButton.className = 'btn-close';
		closeButton.setAttribute('data-bs-dismiss', 'alert');
		closeButton.setAttribute('aria-label', 'Close');
	
		// Create a paragraph element for the alert message
		var messageParagraph = document.createElement('p');
		messageParagraph.innerHTML = `<strong>Error: </strong>` + message;
	
		// Append elements to the alert div
		alertDiv.appendChild(messageParagraph);
		alertDiv.appendChild(closeButton);
		return alertDiv;
	}
	
	function getDetail() {
		return new Promise(function (resolve, reject) {
			let periodo_id = 1;
			$.ajax({
				url: window.AppMain.url + `configuracion/periodos/${periodo_id}/detail`,
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

	function init(data) {

		let self = {
			ficha_id: 1,
			fichas: data.fichas,
			sections: [],
			ficha: {},
			total_section: 0,
			total_question: 0,
			total: 0
		};

		const setFormModule = () => {
			self.ficha = self.fichas.find((o)=>{return o.id == self.ficha_id});
			self.sections = [];
			if (self.ficha.plantilla) {
				if (self.ficha.plantilla.sections) {
					self.sections = self.ficha.plantilla.sections;
				}
			}
			formFichaDetail();
		};

		const selects = document.querySelectorAll('.select-anexo');
		selects.forEach(select => {
			select.addEventListener('change', (e) => {
				self.ficha_id = Number(e.target.value);
				setFormModule();
			});
		});

		const formFichaDetail = () => {

			// Create the outer div with the 'table-responsive' class
			const tableResponsiveDiv = document.createElement('div');
			tableResponsiveDiv.classList.add('table-responsive', 'mb-3');

			// Create the table with the 'table' and 'table-bordered' classes
			const table = document.createElement('table');
			table.classList.add('table', 'table-bordered', 'mb-0');

			// Create the table header
			const thead = document.createElement('thead');
			const headerRow = createRow([
				createCell('th', 'RUBRO', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'CRITERIOS', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'SUBCRITERIOS', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'EVALUACIÓN', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'Puntaje máximo por subcriterio', { class: 'text-center bg-light' }, { verticalAlign: 'middle' }),
				createCell('th', 'Puntaje máximo por rubro', { class: 'text-center bg-light' }, { verticalAlign: 'middle' })
			]);

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
					rows.push(createRow([
						createCell('td', section.name, {class: 'colvert bg-light'}),
						createCell('td', ''),
						createCell('td', ''),
						createCell('td', '', {class: 'text-center'}),
						createCell('td', '', {class: 'text-center'}),
						createCell('td', '', {class: 'text-center'})
					]));
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
							rows.push(createRow([
								createCell('td', div, {class: 'colvert bg-light'}, {
									verticalAlign: 'middle',
									textAlign: '-webkit-center'
								}),
								createCell('td', group.name),
								createCell('td', ''),
								createCell('td', '', {class: 'text-center'}),
								createCell('td', '', {class: 'text-center'}),
								createCell('td', '', {class: 'text-center'})
							]));
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
									});
									div.appendChild(textarea);											
								}
								cells.push(createCell('td', div));
								cells.push(createCell('td', viewActionOption(question), {class: 'text-center'}));
								cells.push(createCell('td', question.score, {class: 'text-center'}));
								if (index3 == 0 && index2 == 0) {
									cells.push(createCell('td', section.score, { class: 'text-center', rowspan: ls }));
								}
								rows.push(createRow(cells));
							});    
						}
					});
				}
			});
			rows.push(createRow([
				createCell('td', 'TOTAL', { class: 'text-center colvert bg-light fw-bold', colspan: 3 }),
				createCell('td', self.total, { class: 'text-center fw-bold', id: 'total' }),
				createCell('td', self.total_question, { class: 'text-center fw-bold'}),
				createCell('td', self.total_section, { class: 'text-center fw-bold'})
			]));
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

			const alertDiv = document.createElement('div');
			alertDiv.id = 'divAlert';
			domBody.appendChild(alertDiv);

			const footer = document.createElement('div');
			footer.classList.add('mt-3', 'text-end');
			const btnSave = document.createElement('button');
			btnSave.classList.add('btn', 'btn-primary');
			btnSave.innerText = 'Guardar';
			btnSave.addEventListener('click', (e) => {
				if (calculation()) {
					sweet2.show({
						type: 'question',
						html: `¿Estás seguro de guardar cambios? <h5>Puntaje Total</h5> <h3>${self.total}</h3>`,
						showCancelButton: true,
						onOk: () => {
						}
					});
				}
			});
			footer.appendChild(btnSave);
			domBody.appendChild(footer);
		}

		const viewActionOption = (question) => {
			let element = ``;
			if (question.type == 'selectiva') {
				const options = [];
				question?.options.forEach(o => {
					options.push({
						text: o.name,
						value: o.score
					});
				});
				element = createSelect(
					options,
					{ class: 'form-control text-center' },
					{
						change: (e) => {
							question.value = e.target.value;
							calculation();
						}
					}
				);					
			} else if (question.type == 'marcado') {
				const attributes = { 
					class: 'form-check-input text-center', 
					value: question.score 
				};
				if (Number(question.value) > 0) {
					attributes.checked = true;
				}
				element = createCheckbox(attributes,
				{
					change: (e) => {
						question.value = e.target.checked ? e.target.value : 0;
						calculation();
					}
				});
			} else if (question.type == 'texto') {
				element = createTextInput({ class: 'form-control text-center', placeholder: 'Ingresar texto...', value: question.value }, {
					keyup: (e) => {
						question.value = e.target.value;
					}
				});	
			} else if (question.type == 'numerico') {
				element = createNumberInput({ class: 'form-control text-center', value: '', placeholder: '0', value: question.value }, {
					keyup: (e) => {
						question.value = e.target.value;
						calculation();
					},
					change: (e) => {
						question.value = e.target.value;
						calculation();
					},
				});
			}
			return element;
		}

		const calculation = () => {
			let brand = true;
			let total = 0;
			self.sections.forEach(section => {
				section.groups.forEach(group => {
					group.questions.forEach(question => {
						let value = 0;
						if (question.hasOwnProperty('value')) {
							value = Number(question.value);
						}
						total = total + value;
					});
				});
			});
			self.total = total;
			domBody.querySelector('#total').innerText = self.total;
			const divAlert = domBody.querySelector('#divAlert');
			divAlert.innerHTML = ``;
			if (self.total > self.total_section) {
				divAlert.appendChild(showAlert('El puntaje acumulado excede el puntaje total', 'danger'));
				brand = false;
			}
			return brand;
		}

		const currentProgress = () => {

			const progressContainer = document.createElement('div');
			progressContainer.classList.add('progress-container', 'mx-auto');
	
			const progressLine = document.createElement('div');
			progressLine.classList.add('progress-line');
			progressLine.id = 'progress';
			const textWraps = [];

			const progressBackButton = createButton('progressBack', 'Regresar', true);
			const progressNextButton = createButton('progressNext', 'Siguiente');
	
			progressContainer.appendChild(progressLine);

			self.fichas.forEach((ficha, fichaIndex) => {
				const wrap = createTextWrap(fichaIndex + 1, ficha.nombre, fichaIndex == 0);
				progressContainer.appendChild(wrap);
			});
	
			domHeader.classList.add('text-center');
			domHeader.appendChild(progressBackButton);
			domHeader.appendChild(progressContainer);

			domHeader.appendChild(progressNextButton);
	
			function createTextWrap(circleNumber, labelText, isActive = false) {
				const textWrap = document.createElement('div');
				textWrap.classList.add('progress-text-wrap');
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
			
			const wraps = document.querySelectorAll('.progress-text-wrap')
	
			let currentActive = 1
	
			progressNextButton.addEventListener('click', () => {
				currentActive++
				if(currentActive > wraps.length) {
					currentActive = wraps.length
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
	
			function update() {
				wraps.forEach((wrap, index) => {
					if(index < currentActive) {
						wrap.classList.add('active')
					} else {
						wrap.classList.remove('active')
					}
				})
	
				const actives = document.querySelectorAll('.active')
				progressLine.style.width = (actives.length - 1) / (wraps.length - 1)* 80 + '%'

				if(currentActive === 1) {
					progressBackButton.disabled = true
					progressNextButton.disabled = false
				} else if(currentActive === wraps.length) {
					progressBackButton.disabled = false
					progressNextButton.disabled = true
				} else {
					progressBackButton.disabled = false
					progressNextButton.disabled = false
				}
			}
		}
		
		setFormModule();
		currentProgress();
	}

	return getDetail()
	.then((data) => {
		init(data);
	})
	.catch((error) => {
		sweet2.show({type: 'error', text: error});
	});
	
};

document.addEventListener('DOMContentLoaded', viewfichaDetail());