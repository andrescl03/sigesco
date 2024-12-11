$(document).ready(function(){ 	
	//https://didesweb.com/jquery/ejecutar-funciones-jquery-url/
	var act = { 
		rut : {},
		pag : function(url, fun){ 
		this.rut[url] = fun;
		},
		lan : function(){ 
			jQuery.each(this.rut, function(par){ 
				if(location.href.match(par)){
					this(); 
				} 
			}); 
		}
	}

	act.pag('admin/auxiliares/periodos', function(){		
		createPeriodo();
		VListarPeriodos();
        
	});

	act.lan();
	setTimeout(() => {	
		graficoPostulantesAdjudicados();
		graficoReporteEvaluados();
		graficoReporteEstados();
		graficoPlazaDisponibles();
	}, 100); 	
});

var createPeriodo = function () {
	const modal = new bootstrap.Modal(document.querySelector('#modal_agregarPeriodos'));
	const btns = document.querySelectorAll('.btn_agregarPeriodo');
	if (btns) {
		btns.forEach(btn => {
			console.log(btn);
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				modal.show();
			});
		});
	}
	const forms = document.querySelectorAll('.formCreatePeriodo');
	if (forms) {
		forms.forEach(form => {
			form.addEventListener('submit', (e) => {
				e.preventDefault();
				const formData = new FormData(e.target);
				store(formData)
				.then(({success, data, message}) => {
					if (!success) {
						throw message;
					}
					e.target.reset();
					modal.hide();
					sweet2.show({
						type: 'success', 
						text: message,
						onOk: () => {
							sweet2.loading({text: 'Redireccionando...'});
							window.location.href = window.AppMain.url + `admin/auxiliares/periodos/${data.id}`;
						}
					});
				})
				.catch(error => {
					sweet2.show({type:'error', text:error});
				});
			});
		});
	}
	const store = (formData) => {
		return new Promise((resolve, reject)=>{
			sweet2.loading();
			$.ajax({
				// url: window.AppMain.url + `admin/auxiliares/periodos/store`,
				method: 'POST',
				dataType: 'json',
				data: formData,
				processData: false,
				contentType: false,
			})
			.done(function (response) {
				resolve(response);
			})
			.fail(function (xhr, status, error) {
				sweet2.show({type:'error', text:error});
			});
		});
	};
}

var VListarPeriodos=function(){	
	$.ajax({
		url: window.AppMain.url + '/admin/auxiliares/periodos/VListarPeriodos',
		method: 'POST',
		data: {'v': 1},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {	
            $.blockUI(blockUIMensaje); 			
		},
		success: function (data) { 
            $.unblockUI();
			try{
				var data = jQuery.parseJSON(data);
				if(data.link === undefined){					
					ToastError.fire({title: data.error});
				}else{
					SwalErrorCenter.fire({					
						html: "<b class='h4'>"+data.error+"</b>"				
					}).then((result) => {
						if (result.isConfirmed) {						
							window.location.href = data.link;
						}
					})
				}				
			}catch(err){		
				$("#view_listarPeriodos").html(data);			
				tabla=$('#tb_listarPeriodos').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,
					//"lengthMenu": [[-1], ["All"]],
					"dom": '<l<t>ip>',	        	
				});
				$('#txt_buscador').keyup(function () {
					tabla.search($(this).val()).draw();     
				});	
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var loadingPanelChart = (chart, loading) => {
	const loadingChartdiv1 = document.querySelector('#' + loading);
	if (loadingChartdiv1) {
		loadingChartdiv1.classList.add('d-none');
	}
	const chartdiv1 = document.querySelector('#' + chart);
	if (chartdiv1) {
		chartdiv1.classList.remove('d-none');
	}
}

var graficoPostulantesAdjudicados = function () {
  var chart = {};
  var title = "";
  var periodo_id = 0;
  var periodos = [];
  var getData = (formData) => {
    return new Promise((resolve, reject) => {
      $.ajax({
        url: window.AppMain.url + `admin/auxiliares/periodos/graficos/postulantes`,
        method: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
      })
        .done(function ({ success, data, message }) {
          if (success) {
            resolve({ success, data, message });
          }
        })
        .fail(function (xhr, status, error) {
          console.log(error);
          // sweet2.show({type:'error', text:error});
        });
    });
  };

  // Generar color aleatorio
  const getRandomColor = () => {
    return am4core.color(
      `#${Math.floor(Math.random() * 16777215).toString(16)}`
    );
  };

  var buildChart = (data = []) => {
	am4core.useTheme(am4themes_animated);
    // Crear instancia del gráfico
    chart = am4core.create("chartdiv1", am4charts.XYChart);

    // Agregar datos al gráfico
    chart.data = data;

	// Añadir título 
	title = chart.titles.create(); 
	title.text = "Reporte de docentes adjudicados"; 
	title.fontSize = 18; 
	title.marginBottom = 0;

    // Configurar el eje X (categorías)
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";

    // Configurar la orientación de las etiquetas
    categoryAxis.renderer.labels.template.rotation = 90; // Girar las etiquetas 90 grados
    categoryAxis.renderer.labels.template.horizontalCenter = "left";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.fontSize = "14px";

    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.title.text = "Especialidades";

    // Configurar truncado de texto
    categoryAxis.renderer.labels.template.adapter.add(
      "textOutput",
      function (text) {
        const maxLength = 25; // Número máximo de caracteres permitidos
        if (text && text.length > maxLength) {
          return text.substring(0, maxLength) + "..."; // Truncar texto y agregar "..."
        }
        return text; // Devolver texto sin cambios si es corto
      }
    );

    // Configurar el eje Y (valores)
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.title.text = "Cantidad de adjudicados";
	valueAxis.min = 0; // Asegúrate de que el eje comience en 0

    // Configurar la serie de barras
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "value";
    series.dataFields.categoryX = "category";
    series.columns.template.propertyFields.fill = "color"; // Asignar colores dinámicos
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";

    // Cambiar el ancho de las barras
    series.columns.template.columnWidth = 0.3; // Ajustar el valor entre 0 (más delgadas) y 1 (más anchas)
    series.columns.template.minWidth = 10; // Establecer un ancho mínimo
    series.columns.template.maxWidth = 50; // Establecer un ancho máximo

    // Asignar el mismo color al borde
    series.columns.template.adapter.add("stroke", function (stroke, target) {
      return target.dataItem.dataContext.color;
    });

    // Configuración para asegurar que las barras no se apilen demasiado
    categoryAxis.renderer.minGridDistance = 10; // Asegura que las barras no se superpongan

    // Configurar el Scrollbar
    chart.scrollbarX = new am4core.Scrollbar();
    chart.scrollbarX.parent = chart.topAxesContainer; // Coloca el scrollbar debajo del gráfico

	// Add cursor
	chart.cursor = new am4charts.XYCursor();

    // Habilitar la exportación del gráfico
    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "right"; // Alineación del menú de exportación
    chart.exporting.menu.verticalAlign = "bottom";
    chart.exporting.menu.items = [
      {
        label: " Exportar ",
        menu: [{ type: "png", label: "Guardar como Imagen" }],
      },
    ];

    if (chart.logo) {
      chart.logo.disabled = true; // Deshabilitar logo de amCharts
    }
  };

  // Función para actualizar los datos
  const updateData = (newData) => {
	console.log(newData);
    // Asignar los nuevos datos
    chart.data = newData.grafico;
	let ttitle = "Reporte de docentes adjudicados";
	if (newData.fecha_inicio) {
		ttitle += " del " + newData.fecha_inicio;
	}
	if (newData.fecha_final) {
		ttitle += " hasta " + newData.fecha_final;
	}
	if (newData.fecha_inicio && !newData.fecha_final) {
		ttitle += " hasta la actualidad";
	}
	title.text = ttitle;
    // Redibujar el gráfico con los nuevos datos
    chart.invalidateData();
  };

  var eventData = () => {
    const forms = document.querySelectorAll(".form-postulant-inscription");
    forms.forEach((form) => {
      form.addEventListener("submit", (event) => {
        event.preventDefault();
        sweet2.loading();
        const formData = new FormData(form);
        getData(formData)
          .then(({ success, data, message }) => {
            if (success) {
              // Asignar colores aleatorios a cada entrada de datos
              data.grafico.forEach((item) => {
                item.color = getRandomColor();
              });
              updateData(data);
            } else {
              console.log(message);
            }
            sweet2.loading(false);
          })
          .catch(() => {
            sweet2.loading(false);
            sweet2.show({ type: "error", text: "Error al obtener los datos" });
          });
      });
	  let phtml = ``;
	  const pselects = document.querySelectorAll(".select-periodo-adjudicado");
	  pselects.forEach((select) => {
		  periodos.forEach(periodo => {
			  phtml += `<option value="${periodo.per_id}" ${periodo.per_id == periodo_id ? 'selected' : ''}>${periodo.per_anio}</option>`;
		  });
		  select.innerHTML = phtml;	
	  });
    });
  };

  getData(null).then(({ data }) => {
	periodo_id = data.periodo_id;
	periodos = data.periodos;
    // Asignar colores aleatorios a cada entrada de datos
    data.grafico.forEach((item) => {
      item.color = getRandomColor();
    });
	loadingPanelChart('chartdiv1', 'loadingchartdiv1');
    buildChart(data.grafico);
    eventData();
  });
};

var graficoReporteEvaluados = function () {
  	var chart = {};
	var convocatorias = [];
	var periodo_id = 0;
	var periodos = [];
	var inscriptions = [];
	var getData = (formData) => {
		return new Promise((resolve, reject) => {
			$.ajax({
			url: window.AppMain.url + `admin/auxiliares/periodos/graficos/evaluados`,
			method: "POST",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			})
			.done(function ({ success, data, message }) {
				if (success) {
				resolve({ success, data, message });
				}
			})
			.fail(function (xhr, status, error) {
				console.log(error);
				// sweet2.show({type:'error', text:error});
			});
		});
	};
	var buildChart = (data = []) => {
		// Importar temas
		am4core.useTheme(am4themes_animated);
		// Crear instancia del gráfico var
		chart = am4core.create("chartdiv2", am4charts.XYChart);
		// Añadir datos
		data.forEach((d,i) => {
			data[i].color = am4core.color(d.color);
		});
		chart.data = data;
		// Crear ejes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "category";
		categoryAxis.title.text = "Módulos";
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Evaluados";
		valueAxis.min = 0; // Asegúrate de que el eje comience en 0

		// Crear serie
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.dataFields.valueY = "value";
		series.dataFields.categoryX = "category";
		series.name = "Valores";
		series.columns.template.tooltipText = "{category}: [bold]{valueY}[/]";
		series.columns.template.fillOpacity = 0.8;
		var columnTemplate = series.columns.template;
		columnTemplate.strokeWidth = 2;
		columnTemplate.strokeOpacity = 1;
		// Asignar el mismo color al borde
		series.columns.template.adapter.add("stroke", function (stroke, target) {
			return target.dataItem.dataContext.color;
		});
		// Asignar colores personalizados
		columnTemplate.adapter.add("fill", function (fill, target) {
			return target.dataItem.dataContext.color;
		});
		// Add cursor
		chart.cursor = new am4charts.XYCursor();

		// Habilitar la exportación del gráfico
		chart.exporting.menu = new am4core.ExportMenu();
		chart.exporting.menu.align = "right"; // Alineación del menú de exportación
		chart.exporting.menu.verticalAlign = "bottom";
		chart.exporting.menu.items = [
			{
			label: " Exportar ",
			menu: [{ type: "png", label: "Guardar como Imagen" }],
			},
		];
		if (chart.logo) {
			chart.logo.disabled = true; // Deshabilitar logo de amCharts
		}
	};
	// Función para actualizar los datos
	const updateData = (newData) => {
		// Asignar los nuevos datos
		chart.data = newData;
	
		// Redibujar el gráfico con los nuevos datos
		chart.invalidateData();
	};
	
	var eventData = () => {
		const forms = document.querySelectorAll(".form-evaluation");
		forms.forEach((form) => {
			form.addEventListener("submit", (event) => {
			event.preventDefault();
			sweet2.loading();
			const formData = new FormData(form);
			getData(formData)
				.then(({ success, data, message }) => {
				if (success) {
					// Asignar colores aleatorios a cada entrada de datos
					updateData(data.grafico);
				} else {
					console.log(message);
				}
				sweet2.loading(false);
				})
				.catch(() => {
				sweet2.loading(false);
				sweet2.show({ type: "error", text: "Error al obtener los datos" });
				});
			});
		});
		const ceselects = document.querySelectorAll(".select-convocatoria-evaluation");
		ceselects.forEach((select) => {
			select.addEventListener("change", (e) => {
				const convocatoria = convocatorias.find((convocatoria) => { return Number(convocatoria.con_id) === Number(e.target.value); });
				inscriptions = convocatoria ? convocatoria.con_modalidades : [];
				handleDataModalidades(inscriptions);
			});		
		});
		const ciselects = document.querySelectorAll(".select-inscription-evaluation");
		ciselects.forEach((select) => {
			select.addEventListener("change", (e) => {
				console.log(inscriptions);
				const inscription = inscriptions.find((inscription) => { return Number(inscription.esp_id) === Number(e.target.value); });
				handleDataEspecialistas(inscription ? inscription.especialistas : []);
			});		
		});

		let phtml = ``;
		const pselects = document.querySelectorAll(".select-periodo-evaluation");
		pselects.forEach((select) => {
			periodos.forEach(periodo => {
				phtml += `<option value="${periodo.per_id}" ${periodo.per_id == periodo_id ? 'selected' : ''}>${periodo.per_anio}</option>`;
			});
			select.innerHTML = phtml;	
		});
	};
	
	var handleDataConvocatorias = () => {
		let cehtml = `<option value="">TODOS</option>`;
		const ceselects = document.querySelectorAll(".select-convocatoria-evaluation");
		ceselects.forEach((select) => {
			convocatorias.forEach(convocatoria => {
				cehtml += `<option value="${convocatoria.con_id}">${convocatoria.con_name}</option>`;
			});
			select.innerHTML = cehtml;
		});
	};

	var handleDataModalidades = (modalidades) => {
		let cehtml = `<option value="">TODOS</option>`;
		const ieselects = document.querySelectorAll(".select-inscription-evaluation");
		ieselects.forEach((select) => {
			modalidades.forEach(modalidad => {
				cehtml += `<option value="${modalidad.gin_id}">${modalidad.gin_name}</option>`;
			});
			select.innerHTML = cehtml;
		});
	};

	var handleDataEspecialistas = (modalidades) => {
		let cehtml = `<option value="">TODOS</option>`;
		const ieselects = document.querySelectorAll(".select-especialista-evaluation");
		ieselects.forEach((select) => {
			modalidades.forEach(modalidad => {
				cehtml += `<option value="${modalidad.usu_dni}">${modalidad.usu_apellidos} ${modalidad.usu_nombre}</option>`;
			});
			select.innerHTML = cehtml;
		});
	};

	getData(null).then(({ data }) => {
		loadingPanelChart('chartdiv2', 'loadingchartdiv2');
		convocatorias = data.convocatorias;
		periodo_id = data.periodo_id;
		periodos = data.periodos;
		handleDataConvocatorias();
		buildChart(data.grafico);
		eventData();
	});
};

var graficoReporteEstados = function () {
	var chart = {};
	var convocatorias = [];
	var periodos = [];
	var periodo_id = 0;
	var getData = (formData) => {
		return new Promise((resolve, reject) => {
			$.ajax({
			url: window.AppMain.url + `admin/auxiliares/periodos/graficos/estados`,
			method: "POST",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			})
			.done(function ({ success, data, message }) {
				if (success) {
				resolve({ success, data, message });
				}
			})
			.fail(function (xhr, status, error) {
				console.log(error);
				// sweet2.show({type:'error', text:error});
			});
		});
	};
	var buildChart = (data = []) => {
		// Apply chart themes
		am4core.useTheme(am4themes_animated);

		// Create chart instance
		chart = am4core.create("chartdiv3", am4charts.XYChart);

		// Add data
		chart.data = data;
		// Añadir título 
		var title = chart.titles.create(); 
		title.text = "Reporte de estados de evaluaciones"; 
		title.fontSize = 18; 
		title.marginBottom = 0;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "category";
		categoryAxis.title.text = "Especialidades";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 20;

		// Configurar la orientación de las etiquetas
		categoryAxis.renderer.labels.template.rotation = 90; // Girar las etiquetas 90 grados
		categoryAxis.renderer.labels.template.horizontalCenter = "left";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.fontSize = "14px";

		// Configurar truncado de texto
		categoryAxis.renderer.labels.template.adapter.add(
			"textOutput",
			function (text) {
				const maxLength = 25; // Número máximo de caracteres permitidos
				if (text && text.length > maxLength) {
				return text.substring(0, maxLength) + "..."; // Truncar texto y agregar "..."
				}
				return text; // Devolver texto sin cambios si es corto
			});

		var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Cantidad de plazas";
		valueAxis.min = 0; // Asegúrate de que el eje comience en 0

		// Create series
		var series1 = chart.series.push(new am4charts.ColumnSeries());
		series1.dataFields.valueY = "comply";
		series1.dataFields.categoryX = "category";
		series1.name = "Cumple";
		series1.tooltipText = "{name}: [bold]{valueY}[/]";
		series1.stacked = true;
		series1.columns.template.fill = am4core.color("#64B5F6");
		series1.columns.template.stroke = am4core.color("#64B5F6");

		var series2 = chart.series.push(new am4charts.ColumnSeries());
		series2.dataFields.valueY = "notcomply";
		series2.dataFields.categoryX = "category";
		series2.name = "No Cumple";
		series2.tooltipText = "{name}: [bold]{valueY}[/]";
		series2.stacked = true;
		series2.columns.template.fill = am4core.color("#E57373");
		series2.columns.template.stroke = am4core.color("#E57373");

		var series3 = chart.series.push(new am4charts.ColumnSeries());
		series3.dataFields.valueY = "observed";
		series3.dataFields.categoryX = "category";
		series3.name = "Obsevados";
		series3.tooltipText = "{name}: [bold]{valueY}[/]";
		series3.stacked = true;
		series3.columns.template.fill = am4core.color("#FFD54F");
		series3.columns.template.stroke = am4core.color("#FFD54F");

		// Add cursor
		chart.cursor = new am4charts.XYCursor();

		// Configuración para asegurar que las barras no se apilen demasiado
		categoryAxis.renderer.minGridDistance = 10; // Asegura que las barras no se superpongan

		// Configurar el Scrollbar
		chart.scrollbarX = new am4core.Scrollbar();
		chart.scrollbarX.parent = chart.topAxesContainer; // Coloca el scrollbar debajo del gráfico

		// Add legend
		chart.legend = new am4charts.Legend();

		// Habilitar la exportación del gráfico
		chart.exporting.menu = new am4core.ExportMenu();
		chart.exporting.menu.align = "right"; // Alineación del menú de exportación
		chart.exporting.menu.verticalAlign = "bottom";
		chart.exporting.menu.items = [
			{
			label: " Exportar ",
			menu: [{ type: "png", label: "Guardar como Imagen" }],
			},
		];

		if (chart.logo) {
			chart.logo.disabled = true; // Deshabilitar logo de amCharts
		}
	};
	// Función para actualizar los datos
	const updateData = (newData) => {
		// Asignar los nuevos datos
		chart.data = newData;
	
		// Redibujar el gráfico con los nuevos datos
		chart.invalidateData();
	};
	
	var eventData = () => {
		const forms = document.querySelectorAll(".form-evaluation-estado");
		forms.forEach((form) => {
			form.addEventListener("submit", (event) => {
			event.preventDefault();
			sweet2.loading();
			const formData = new FormData(form);
			getData(formData)
				.then(({ success, data, message }) => {
				if (success) {
					// Asignar colores aleatorios a cada entrada de datos
					updateData(data.grafico);
				} else {
					console.log(message);
				}
				sweet2.loading(false);
				})
				.catch(() => {
				sweet2.loading(false);
				sweet2.show({ type: "error", text: "Error al obtener los datos" });
				});
			});
		});
		const ceselects = document.querySelectorAll(".select-evaluation-convocatoria-estado");
		ceselects.forEach((select) => {
			select.addEventListener("change", (e) => {
				const convocatoria = convocatorias.find((convocatoria) => { return Number(convocatoria.con_id) === Number(e.target.value); });
				handleDataModalidades(convocatoria ? convocatoria.especialistas : []);
			});		
		});

		let phtml = ``;
		const pselects = document.querySelectorAll(".select-periodo-evaluation-estado");
		pselects.forEach((select) => {
			periodos.forEach(periodo => {
				phtml += `<option value="${periodo.per_id}" ${periodo.per_id == periodo_id ? 'selected' : ''}>${periodo.per_anio}</option>`;
			});
			select.innerHTML = phtml;	
		});
	};
	
	var handleDataConvocatorias = () => {
		let cehtml = `<option value="">TODOS</option>`;
		const ceselects = document.querySelectorAll(".select-evaluation-convocatoria-estado");
		ceselects.forEach((select) => {
			convocatorias.forEach(convocatoria => {
				cehtml += `<option value="${convocatoria.con_id}">${convocatoria.con_name}</option>`;
			});
			select.innerHTML = cehtml;
		});
	};

	var handleDataModalidades = (especialistas) => {
		let cehtml = `<option value="">TODOS</option>`;
		const ieselects = document.querySelectorAll(".select-evaluation-especialista-estado");
		ieselects.forEach((select) => {
			especialistas.forEach(especialista => {
				cehtml += `<option value="${especialista.usu_dni}">${especialista.usu_nombre} ${especialista.usu_apellidos}</option>`;
			});
			select.innerHTML = cehtml;
		});
	};

	getData(null).then(({ data }) => {
		loadingPanelChart('chartdiv3', 'loadingchartdiv3');
		convocatorias = data.convocatorias;
		periodos = data.periodos;
		periodo_id = data.periodo_id;
		handleDataConvocatorias();
		buildChart(data.grafico);
		eventData();
	});
};

var graficoPlazaDisponibles = function () { 
	var chart = {};
	var periodo_id = 0;
	var periodos = [];
	var getData = (formData) => {
		return new Promise((resolve, reject) => {
			$.ajax({
			url: window.AppMain.url + `admin/auxiliares/periodos/graficos/plazas`,
			method: "POST",
			dataType: "json",
			data: formData,
			processData: false,
			contentType: false,
			})
			.done(function ({ success, data, message }) {
				if (success) {
				resolve({ success, data, message });
				}
			})
			.fail(function (xhr, status, error) {
				console.log(error);
				// sweet2.show({type:'error', text:error});
			});
		});
	};	
	var eventData = () => {
		const forms = document.querySelectorAll(".form-plaza");
		forms.forEach((form) => {
			form.addEventListener("submit", (event) => {
			event.preventDefault();
			sweet2.loading();
			const formData = new FormData(form);
			getData(formData)
				.then(({ success, data, message }) => {
				if (success) {
					// Asignar colores aleatorios a cada entrada de datos
					updateData(data.grafico);
				} else {
					console.log(message);
				}
				sweet2.loading(false);
				})
				.catch(() => {
				sweet2.loading(false);
				sweet2.show({ type: "error", text: "Error al obtener los datos" });
				});
			});
		});
		let phtml = ``;
		const pselects = document.querySelectorAll(".select-periodo-plaza");
		pselects.forEach((select) => {
			periodos.forEach(periodo => {
				phtml += `<option value="${periodo.per_id}" ${periodo.per_id == periodo_id ? 'selected' : ''}>${periodo.per_anio}</option>`;
			});
			select.innerHTML = phtml;	
		});
	};
	// Función para actualizar los datos
	const updateData = (newData) => {
		// Asignar los nuevos datos
		chart.data = newData;
	
		// Redibujar el gráfico con los nuevos datos
		chart.invalidateData();
	};
	var buildChart = (data = []) => {
	  	// Apply chart themes
		am4core.useTheme(am4themes_animated);

		// Create chart instance
		chart = am4core.create("chartdiv4", am4charts.XYChart);

		// Add data
		chart.data = data;
		// Añadir título 
		var title = chart.titles.create(); 
		title.text = "Reporte de plazas"; 
		title.fontSize = 18; 
		title.marginBottom = 0;

		// Create axes
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "category";
		categoryAxis.title.text = "Especialidades";
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.renderer.minGridDistance = 20;

		// Configurar la orientación de las etiquetas
		categoryAxis.renderer.labels.template.rotation = 90; // Girar las etiquetas 90 grados
		categoryAxis.renderer.labels.template.horizontalCenter = "left";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.fontSize = "14px";

		// Configurar truncado de texto
		categoryAxis.renderer.labels.template.adapter.add(
			"textOutput",
			function (text) {
				const maxLength = 25; // Número máximo de caracteres permitidos
				if (text && text.length > maxLength) {
				return text.substring(0, maxLength) + "..."; // Truncar texto y agregar "..."
				}
				return text; // Devolver texto sin cambios si es corto
			});

		var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Cantidad de plazas";
		valueAxis.min = 0; // Asegúrate de que el eje comience en 0

		// Create series
		var series2 = chart.series.push(new am4charts.ColumnSeries());
		series2.dataFields.valueY = "available";
		series2.dataFields.categoryX = "category";
		series2.name = "Plazas Disponibles";
		series2.tooltipText = "{name}: [bold]{valueY}[/]";
		series2.stacked = true;

		var series3 = chart.series.push(new am4charts.ColumnSeries());
		series3.dataFields.valueY = "notavailable";
		series3.dataFields.categoryX = "category";
		series3.name = "Plazas Ocupadas";
		series3.tooltipText = "{name}: [bold]{valueY}[/]";
		series3.stacked = true;

		// Add cursor
		chart.cursor = new am4charts.XYCursor();

		// Configuración para asegurar que las barras no se apilen demasiado
		categoryAxis.renderer.minGridDistance = 10; // Asegura que las barras no se superpongan

		// Configurar el Scrollbar
		chart.scrollbarX = new am4core.Scrollbar();
		chart.scrollbarX.parent = chart.topAxesContainer; // Coloca el scrollbar debajo del gráfico

		// Add legend
		chart.legend = new am4charts.Legend();

		// Habilitar la exportación del gráfico
		chart.exporting.menu = new am4core.ExportMenu();
		chart.exporting.menu.align = "right"; // Alineación del menú de exportación
		chart.exporting.menu.verticalAlign = "bottom";
		chart.exporting.menu.items = [
			{
			label: " Exportar ",
			menu: [{ type: "png", label: "Guardar como Imagen" }],
			},
		];

		if (chart.logo) {
			chart.logo.disabled = true; // Deshabilitar logo de amCharts
		}
	};
	getData(null).then(({ data }) => {
		periodo_id = data.periodo_id;
		periodos = data.periodos;
		loadingPanelChart('chartdiv4', 'loadingchartdiv4');
		buildChart(data.grafico);
		eventData();
	});
};