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

	act.pag('evaluacion/convocatoria', function(){	
		Init();
		chk_especialistasTodos();
	});

	act.lan(); 	
});


var Init = function (){
	idGin   = $("#txt_idGin").val();
	evaluc  = $("#txt_eval").val();   
	tipo   	= $("#txt_tipo").val();
	convId  = $("#txt_idConv").val();
	todos	= Number($("#chk_especialistasTodos").is(':checked'));
	parametros  = {           
		idGin		: idGin,
		evaluc		: evaluc,
		tipo        : tipo,
		todos		: todos,
		convId  	: convId
	}  
	VListarCargarExpedientePunEvaluar(parametros);
}


var chk_especialistasTodos = function () {
    $('body').off('change','#chk_especialistasTodos');
    $('body').on('change','#chk_especialistasTodos', function(e){
		Init();
    });
}

var chk_expedientetotal = function () {
	var chkAsignarTodosEval1 = document.getElementById("chk_asignarTodosEval_1");
	if (chkAsignarTodosEval1) {
		chkAsignarTodosEval1.addEventListener("click", function (e) {
			if (chkAsignarTodosEval1.checked) {
				btn_modalAsignarExpedientes(chkAsignarTodosEval1);
			} else {
				var checkboxesSecundarios = document.querySelectorAll(".chk_asignarEval input");
				checkboxesSecundarios.forEach(function (checkbox) {
					checkbox.checked = chkAsignarTodosEval1.checked;
				});
			}
		});
	}
}

var VListarCargarExpedientePunEvaluar = function(parametros){	
	$.ajax({
		url: '../VListarCargarExpedientePunEvaluar',
		method: 'POST',
		data: parametros,
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
				$("#view_listarCargarExpedientePunEvaluar").html(data);
				tabla=$('#tb_listarEvaluacionPunEvaluar').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>i>',	        	
				});
				$('#txt_buscador').keyup(function () {
					tabla.search($(this).val()).draw();     
				});	
                btn_modalAsignarReasignar();
				chk_expedientetotal();

				//chk_asignarEval();	
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}



var btn_modalAsignarExpedientes = function (chkAsignarTodosEval1) {

	$('#modal-show-asignacion').modal('show');

	const radioIngresarValor = document.getElementById('ingresarValor');
	const radioTodos = document.getElementById('todos');

	const inputValor = document.getElementById('inputValor');


	radioIngresarValor.addEventListener('change', function () {
		inputValor.disabled = !this.checked;
		if (this.checked) {
			inputValor.focus();
		}
	});

	radioTodos.addEventListener('change', function () {
		inputValor.disabled = this.checked;
		if (this.checked) {
			inputValor.value = '';
		}
	});
 

	$('body').off('click', '.btn-seleccionar-asignacion-expedientes');
	$('body').on('click', '.btn-seleccionar-asignacion-expedientes', function (e) {

		var checkboxesSecundarios = document.querySelectorAll(".chk_asignarEval input");
		if (radioIngresarValor.checked) {
 			let cantidad = parseInt(inputValor.value, 10); // Obtener la cantidad ingresada

			checkboxesSecundarios.forEach(function (checkbox,index) {
				if (checkbox.value.split("||")[1] == 0) {
					checkbox.checked = chkAsignarTodosEval1.checked && index < cantidad;
				}
			});
		}
		if (radioTodos.checked) {
			// Actualiza el estado de cada checkbox secundario según el estado del checkbox principal
			checkboxesSecundarios.forEach(function (checkbox) {
				if (checkbox.value.split("||")[1] == 0)  {
					checkbox.checked = chkAsignarTodosEval1.checked;
				}

			});
		}

		$('#modal-show-asignacion').modal('hide');

	});
}


var modal_asignarReasignar = function(){ // nueva forma en bootstrap 5.0
	$('#modal_asignarReasignar').modal('show');
}

var btn_modalAsignarReasignar= function () {
    $('body').off('click', '.btn_modalAsignarReasignar');
    $('body').on('click', '.btn_modalAsignarReasignar', function (e) {
        var cadena = [];		
		$(".chk_asignarEval input:checkbox:checked").each(function () {
			cadena.push($(this).val());
		});
		if(cadena.length>0){
			modal_asignarReasignar();
            idConv    = $("#txt_idConv").val();
            parametros = {
                idConv : idConv,
                cadena  : cadena
            }
            VListarEspecialistas(parametros);
		}else{
            ToastError.fire({title: "Seleccionar al menos un registro."});			
		}    	
    });
}

var VListarEspecialistas = function(parametros){	
	$.ajax({
		url: '../VListarEspecialistas',
		method: 'POST',
		data: parametros,
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
				$("#view_asignarReasignar").html(data);				
				tabla=$('#tb_listarAsignarReasignar').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,			
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>>',	        	
				});
				cadena = parametros.cadena;
                btn_asignarReasignar(cadena);
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var btn_asignarReasignar= function(cadena){	
	$('body').off('click', '#btn_asignarReasignar');
    $('body').on('click', '#btn_asignarReasignar', function (e) {
    	usuarios= [];
		var convId = $('#txt_idConv').val();
     	$(".opt_usuario input:checkbox:checked").each(function () {
            usuarios.push($(this).val());
        });
     	if(usuarios!=0){
            SwalConfirmacionCenter.fire({				
				html: "¿Seguro(a) que desea <b class='text-primary h4'>Asignar o Reasignar</b> la evaluación?"				
			}).then((result) => {
				if (result.isConfirmed) {
					parametros = {
						cadena 	 : cadena,
						usuarios : usuarios,
						convId   : convId
					};
					CAsignarReasignar(parametros);
				}
			})
     	}else{
            ToastError.fire({title: "Seleccionar al menos un especialista."});	
     	}		
    });
}

var CAsignarReasignar=function(parametros){	
	$.ajax({
		url: '../CAsignarReasignar',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$(".swal2-confirm").prop('disabled', true);	
			$.blockUI(blockUIMensaje); 			
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){				
				Init();				
				$('#modal_asignarReasignar').modal('hide');
				ToastSuccess.fire({title: data.success});
			}else{	
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
			}						
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}



