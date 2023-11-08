
const viewAnexoDetail = () => {

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
					anexo_id: 1,
					anexos: data.anexos,
					sections: [],
					anexo: {}
				};


				let setFormModule = () => {
					self.anexo = self.anexos.find((o)=>{return o.id == self.anexo_id});
					self.sections = [];
					if (self.anexo.plantilla) {
						if (self.anexo.plantilla.sections) {
							self.sections = self.anexo.plantilla.sections;
						}
					}
					viewAnexoDetail();
				};

				const selects = document.querySelectorAll('.select-anexo');
                selects.forEach(select => {
					
                    select.addEventListener('change', (e) => {
						self.anexo_id = Number(e.target.value);
						setFormModule();
                    });
                });

				let viewAnexoDetail = () => {

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

document.addEventListener('DOMContentLoaded', viewAnexoDetail());