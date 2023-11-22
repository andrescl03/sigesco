
const viewfichaDetail = () => {

	// Function to create a cell with specified attributes and text
	function createCell(tag, text, attributes = {}) {
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
				let self = {
					ficha_id: 1,
					fichas: data.fichas,
					sections: [],
					ficha: {}
				};


				let setFormModule = () => {
					self.ficha = self.fichas.find((o)=>{return o.id == self.ficha_id});
					self.sections = [];
					if (self.ficha.plantilla) {
						if (self.ficha.plantilla.sections) {
							self.sections = self.ficha.plantilla.sections;
						}
					}
					viewfichaDetail();
					// viewfichaDetail2();
				};

				const selects = document.querySelectorAll('.select-anexo');
                selects.forEach(select => {
					
                    select.addEventListener('change', (e) => {
						self.ficha_id = Number(e.target.value);
						setFormModule();
                    });
                });

				let viewfichaDetail = () => {

					// Create the outer div with the 'table-responsive' class
					const tableResponsiveDiv = document.createElement('div');
					tableResponsiveDiv.classList.add('table-responsive');

					// Create the table with the 'table' and 'table-bordered' classes
					const table = document.createElement('table');
					table.classList.add('table', 'table-bordered', 'mb-0');

					// Create the table header
					const thead = document.createElement('thead');
					const headerRow = createRow([
						createCell('th', 'RUBRO', { class: 'text-center bg-light' }),
						createCell('th', 'CRITERIOS', { class: 'text-center bg-light' }),
						createCell('th', 'SUBCRITERIOS', { class: 'text-center bg-light' }),
						createCell('th', 'EVALUACIÓN', { class: 'text-center bg-light' }),
						createCell('th', 'Puntaje máximo por subcriterio', { class: 'text-center bg-light' }),
						createCell('th', 'Puntaje máximo por rubro', { class: 'text-center bg-light' })
					]);

					thead.appendChild(headerRow);
					table.appendChild(thead);

					// Create the table body
					const tbody = document.createElement('tbody');

					// Your rows and cells creation goes here...
					// For brevity, I'm only creating a single row with some data
					const rows = [];
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
									rows.push(createRow([
										createCell('td', section.name, {class: 'colvert bg-light'}),
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
											cells.push(createCell('td', section.name, { class: 'colvert bg-light', rowspan: ls }));
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
					html += 
						`<tr class="">
							<td colspan="4" class="text-center fw-bold">PUNTAJE TOTAL</td>
							<td class="text-center fw-bold">${total}</td>
						</tr>`;
					rows.forEach(row => {
						tbody.appendChild(row);						
					});
					// End of creating a single row

					// Append the table body to the table
					table.appendChild(tbody);

					// Append the table to the 'table-responsive' div
					tableResponsiveDiv.appendChild(table);

					// Append the 'table-responsive' div to the body of the HTML document
					document.querySelector('#containerFicha').appendChild(tableResponsiveDiv);

					const footer = document.createElement('div');
					footer.classList.add('mt-3', 'text-end');
					const btnSave = document.createElement('button');
					btnSave.classList.add('btn', 'btn-primary');
					btnSave.innerText = 'Guardar';
					btnSave.addEventListener('click', (e) => {
						console.log(self.sections);
					});
					footer.appendChild(btnSave);
					document.querySelector('#containerFicha').appendChild(footer);
					
				}

				let viewfichaDetail2 = () => {

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
									<td>
										${question.name}
										${
											question.observation_status == 1 ? 
											`<textarea class="form-control mt-3" placeholder="Ingrese su obervación" rows="2"></textarea>` : ``
										}
									</td>
									<td class="text-center">${
										viewActionOption(question)
									}</td>
									<td class="text-center">${question.score}</td>
									${ 
										index3 == 0 && index2 == 0 ? `<td class="text-center" rowspan="${ls}">${section.score}</td>` : ``
									}
								</tr>`;

							});
						});
					});
					const tbodies = document.querySelectorAll('.tbody-anexo');
					tbodies.forEach(tbody => {
						tbody.innerHTML = html;
					});
				}

				let viewActionOption = (question) => {
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
							},
							change: (e) => {
								question.value = e.target.value;
							},
						});
					}
					return element;
				}

				let viewActionOption2 = (question) => {
					let html = ``;
					if (question?.caption) {
						html += `<span>${question.caption}</span>`;
					}
					if (question.type == 'selectiva') {
						html += `<select class="form-control  text-center">`;
						question?.options.forEach(option => {
							html += `<option value="${option.name}">${option.name}</option>`;
						});
						html += `</select>`;
					} else if (question.type == 'marcado') {
						html += `<input type="checkbox" class="form-check-input text-center" value="1">`;
					} else if (question.type == 'texto') {
						html += `<input type="text" class="form-control text-center" value="">`;
	
					} else if (question.type == 'numerico') {
						html += `<input type="number" class="form-control  text-center" value="">`;
					}
	
					return html;
				}

				setFormModule();

			} else {
				reject(error);
				sweet2.error({text: error});
			}
		})
		.fail(function (xhr, status, error) {
			sweet2.error({text: error});
		});

	});

	
};

document.addEventListener('DOMContentLoaded', viewfichaDetail());