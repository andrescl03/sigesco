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

	act.pag('configuracion/periodos', function(){		
		createPeriodo();
		VListarPeriodos();
        graficoPostulantesAdjudicados();
	});

	act.lan(); 	
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
							window.location.href = window.AppMain.url + `configuracion/periodos/${data.id}`;
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
				url: window.AppMain.url + `configuracion/periodos/store`,
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
		url: 'VListarPeriodos',
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

var graficoPostulantesAdjudicados = function () {
	var chart = {};

	var getData = (formData) => {
		return new Promise((resolve, reject)=>{
			$.ajax({
				url: window.AppMain.url + `configuracion/periodos/graficos/postulantes`,
				method: 'POST',
				dataType: 'json',
				data: formData,
				processData: false,
				contentType: false,
			})
			.done(function ({success, data, message}) {
				if (success) {
					resolve({success, data, message});
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
		return am4core.color(`#${Math.floor(Math.random() * 16777215).toString(16)}`);
	};


	var buildData = (data = []) => {
		// Crear instancia del gráfico
		chart = am4core.create("chartdiv", am4charts.XYChart);
	
		// Agregar datos al gráfico
		chart.data = data;
	
		// Configurar el eje X (categorías)
		var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
		categoryAxis.dataFields.category = "label";
	
		// Configurar la orientación de las etiquetas
		categoryAxis.renderer.labels.template.rotation = 90; // Girar las etiquetas 90 grados
		categoryAxis.renderer.labels.template.horizontalCenter = "left";
		categoryAxis.renderer.labels.template.verticalCenter = "middle";
		categoryAxis.fontSize = "14px";
	
		categoryAxis.renderer.grid.template.location = 0;
		categoryAxis.title.text = "Especialidades";
	
		// Configurar truncado de texto
		categoryAxis.renderer.labels.template.adapter.add("textOutput", function(text) {
			const maxLength = 18; // Número máximo de caracteres permitidos
			if (text && text.length > maxLength) {
				return text.substring(0, maxLength) + "..."; // Truncar texto y agregar "..."
			}
			return text; // Devolver texto sin cambios si es corto
		});
	
		// Configurar el eje Y (valores)
		var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
		valueAxis.title.text = "Cantidad de adjudicados";
	
		// Configurar la serie de barras
		var series = chart.series.push(new am4charts.ColumnSeries());
		series.dataFields.valueY = "value";
		series.dataFields.categoryX = "label";
		series.columns.template.propertyFields.fill = "color"; // Asignar colores dinámicos
		series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
	
		// Cambiar el ancho de las barras
		series.columns.template.columnWidth = 0.3; // Ajustar el valor entre 0 (más delgadas) y 1 (más anchas)
		series.columns.template.minWidth = 10; // Establecer un ancho mínimo
		series.columns.template.maxWidth = 50; // Establecer un ancho máximo
	
		// Configuración para asegurar que las barras no se apilen demasiado
		categoryAxis.renderer.minGridDistance = 10; // Asegura que las barras no se superpongan
	
		// Configurar el Scrollbar
		chart.scrollbarX = new am4core.Scrollbar();
		chart.scrollbarX.parent = chart.topAxesContainer; // Coloca el scrollbar debajo del gráfico
	
		// Habilitar la exportación del gráfico
		chart.exporting.menu = new am4core.ExportMenu();
		chart.exporting.menu.align = "right"; // Alineación del menú de exportación
		chart.exporting.menu.verticalAlign = "bottom"; 
		chart.exporting.menu.items = [
			{
				"label": " Exportar ",
				"menu": [
					{ "type": "png", "label": "Guardar como Imagen" },
				]
			}
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
		const forms = document.querySelectorAll('.form-postulant-inscription');
		forms.forEach(form => {
			form.addEventListener('submit', event => {
                event.preventDefault();
				sweet2.loading();
                const formData = new FormData(form);
                getData(formData)
                .then(({success, data, message}) => {
                    if (success) {
								// Asignar colores aleatorios a cada entrada de datos
						data.grafico.forEach(item => {
							item.color = getRandomColor();
						});				
                        updateData(data.grafico);
                    } else {
                        console.log(message);
                    }
					sweet2.loading(false);
                })
				.catch(() => {
					sweet2.loading(false);
                    sweet2.show({type:'error', text:'Error al obtener los datos'});
				});
            });
		});
	}

	getData(null)
	.then(({data}) => {
		// Asignar colores aleatorios a cada entrada de datos
		data.grafico.forEach(item => {
			item.color = getRandomColor();
		});
		buildData(data.grafico);
		eventData();
	})
}