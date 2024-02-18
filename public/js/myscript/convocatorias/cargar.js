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
	
	act.pag('convocatorias/cargarexpedientes', function(){		
		opt_tipoEvaluacion();
	});
	
	act.lan(); 	
});

var opt_tipoEvaluacion = function(){
	$('body').off('change','#opt_tipoEvaluacion');	
	$('body').on('change','#opt_tipoEvaluacion', function(event){		
        tipoEval    = $("#opt_tipoEvaluacion").val();// 1: PUN, 2 : EXP
		idGin    = $("#txt_idGin").val();
        if(tipoEval == ""){
            $("#view_listarCargarExpedienteControles").html("");
			$("#view_listarCargarExpediente").html("");		
        }else{
            parametros  = {
                tipoEval  	: tipoEval,
				idGin		: idGin,
				estado		: 1 // SIN EVALUACION
            }		
			if(tipoEval== 1){
				VListarCargarExpedientesControlesPun(parametros);
			}
			if(tipoEval== 2){				
				VListarCargarExpedientesControlesExp(parametros);
			}
			VListarCargarExpedientesPunExp(parametros);			
        }
	});
}

var VListarCargarExpedientesControlesPun = function(parametros){	
	$.ajax({
		url: '../VListarCargarExpedientesControlesPun',
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
				$("#view_listarCargarExpedienteControles").html(data);
				btn_modalBuscarExpedientes();
				btn_enviarEvaluacion();
				chk_tipoRegistro();	
				btn_quitarAsignacion();			
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var VListarCargarExpedientesControlesExp = function(parametros){	
	$.ajax({
		url: '../VListarCargarExpedientesControlesExp',
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
				$("#view_listarCargarExpedienteControles").html(data);
				btn_modalBuscarExpedientesExp();
				chk_tipoRegistroExp();
				btn_enviarEvaluacion();				
				btn_quitarAsignacion();
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var VListarCargarExpedientesPunExp = function(parametros){	
	$.ajax({
		url: '../VListarCargarExpedientesPunExp',
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
				$("#view_listarCargarExpediente").html(data);
				tabla=$('#tb_listarEvaluacionPun').DataTable({
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
				//chk_asignarEval();	
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var modal_buscarExpedientes = function(){ // nueva forma en bootstrap 5.0
	$('#modal_buscarExpedientes').modal('show');
}

var btn_modalBuscarExpedientes= function () {
    $('body').off('click', '.btn_modalBuscarExpedientes');
    $('body').on('click', '.btn_modalBuscarExpedientes', function (e) {
    	modal_buscarExpedientes();
		VBuscarExpedientes();
    });
}

var rangoFecha=function(){
	$('#dp_fechasBusqueda').datepicker({
		format: "dd-mm-yyyy",
        clearBtn: true,
        language: "es",
        orientation: "bottom auto",
        daysOfWeekHighlighted: "0,6",
        todayHighlight: true,
        showYearNavigation:false			
       // startDate: $inicio,
        //endDate: $fin		
	});
}

var VBuscarExpedientes = function(parametros){	
	$.ajax({
		url: '../VBuscarExpedientes',
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
				$("#view_buscarExpedientes").html(data);				
				$('#opt_grupoTramite').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					allowClear: true,
					dropdownParent: "#modal_buscarExpedientes" 
				} );
				$('#opt_tramite').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					allowClear: true,
					dropdownParent: "#modal_buscarExpedientes" 
				} );
				tabla=$('#tb_listarExpedientes').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,			
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>i>',	        	
				});
				rangoFecha();
				opt_grupoTramite();
				btn_buscarExpedientes();
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var opt_grupoTramite = function () {
    $('body').off('change', '#opt_grupoTramite');
    $('body').on('change', '#opt_grupoTramite', function (e) {
		grupo	=	$(this).val();  
		parametros = {
			grupo	: grupo
		}
    	VComboTramites(parametros);	
    });
}

var VComboTramites = function(parametros){	
	$.ajax({
		url: '../VComboTramites',
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
				$("#view_tramites").html(data);				
				$('#opt_tramite').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					allowClear: true,
					dropdownParent: "#modal_buscarExpedientes" 
				} );
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var btn_buscarExpedientes= function () {
    $('body').off('click', '.btn_buscarExpedientes');
    $('body').on('click', '.btn_buscarExpedientes', function (e) {
		FechaDesde          = $("#fecha_inicio").val();
		FechaHasta          = $("#fecha_fin").val();
		TramiteId      		= $("#opt_tramite").val();
		idGin      			= $("#txt_idGin").val();
		
		if(FechaDesde == "" || FechaHasta == "" || TramiteId =="") {
			ToastError.fire({title: "Completar opciones de busqueda."});
			return;			
		}
		
		parametros={
			FechaDesde      : FechaDesde,
			FechaHasta      : FechaHasta,
			TramiteId  		: TramiteId,
			idGin			: idGin
		}
	   	DTExpedientes(parametros);
    });
}

var DTExpedientes = function(parametros){	
	$.ajax({
		url: '../DTExpedientes',
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
				$("#view_tablaExpedientes").html(data);
				tabla=$('#tb_listarExpedientes').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,
					"scrollY": "500px",
        			"scrollCollapse": true,        
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>i>',	        	
				});
				$('#txt_buscadorExp').keyup(function () {
					tabla.search($(this).val()).draw();     
				});	
				btn_agregarExpedientes();
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}


var btn_agregarExpedientes = function () {
    $('body').off('click', '#btn_agregarExpedientes');
    $('body').on('click', '#btn_agregarExpedientes', function (e) {     	
		idGin	= $("#txt_idGin").val();
		var expedientes = [];
		$(".chk_asignarExp input:checkbox:checked").each(function () {
			expedientes.push($(this).val());
		});
		if(expedientes.length>0){
			var parametros={					
				expedientes : expedientes,
				idGin		: idGin
			}
			SwalConfirmacionCenter.fire({
				html: "¿Seguro(a) que desea <b class='text-primary h4'>agregar</b> los expedientes seleccionados?"
			}).then((result) => {
				if (result.isConfirmed) {						
					CAsisgnarExpedientes(parametros);
				}
			})
		}else{
			ToastError.fire({title: 'No se ha seleccionado ningún expediente.'});			
		}     	  
    });
}

var CAsisgnarExpedientes=function(parametros){	
	$.ajax({
		url: '../CAsisgnarExpedientes',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje); 
			$(".swal2-confirm").prop('disabled', true);	
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){	
				ToastSuccess.fire({title: data.success});
				$('#modal_buscarExpedientes').modal('hide');
				tipoEval    = $("#opt_tipoEvaluacion").val();
				idGin    	= $("#txt_idGin").val();
				estado     = $("input[name=chk_tipoRegistro]:checked").val()
				param  = {
					tipoEval  	: tipoEval,
					idGin		: idGin,
					estado		: estado
				}
				VListarCargarExpedientesPunExp(param);
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

var btn_enviarEvaluacion= function () {
    $('body').off('click', '.btn_enviarEvaluacion');
    $('body').on('click', '.btn_enviarEvaluacion', function (e) {
    	var cuadroPun = [];
		$(".chk_asignarEval input:checkbox:checked").each(function () {
			cuadroPun.push($(this).val());
		});
		if(cuadroPun.length>0){
			var parametros={
				cuadroPun : cuadroPun
			}
			SwalConfirmacionCenter.fire({
				html: "¿Seguro(a) que desea <b class='text-primary h4'>enviar a evaluar</b> los expedientes seleccionados?"
			}).then((result) => {
				if (result.isConfirmed) {						
					CEnviarEvaluar(parametros);
				}
			})
		}else{
			ToastError.fire({title: 'No se ha seleccionado ningún docente.'});			
		} 
    });
}

var CEnviarEvaluar=function(parametros){	
	$.ajax({
		url: '../CEnviarEvaluar',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje); 
			$(".swal2-confirm").prop('disabled', true);	
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){	
				ToastSuccess.fire({title: data.success});
				tipoEval    = $("#opt_tipoEvaluacion").val();
				idGin    	= $("#txt_idGin").val();
				estado      = $("input[name=chk_tipoRegistro]:checked").val()
				param  = {
					tipoEval  	: tipoEval,
					idGin		: idGin,
					estado		: estado
				}
				VListarCargarExpedientesPunExp(param);
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

var chk_tipoRegistro=function(){
	$('input[name=chk_tipoRegistro]').on('change', function() { 
		tipoEval    = $("#opt_tipoEvaluacion").val();
		idGin    	= $("#txt_idGin").val();
		estado     = $("input[name=chk_tipoRegistro]:checked").val()
		parametros  = {
			tipoEval  	: tipoEval,
			idGin		: idGin,
			estado		: estado
		}
		VListarCargarExpedientesPunExp(parametros);
        
    });  
}

var rango = [];
var chk_asignarEval=function(){
	$('.chk_asignarEval input[type=checkbox]').on('change', function() {
		correlativo = parseInt($(this).attr("correlativo"));
    	if($(this).is(':checked') ) {			
			if(rango.length<2){
				rango.push(correlativo);			
				rango.sort(function(a, b){return a - b});	//ordenar numeros			
			}else{
				if(rango.length==2){
					if(correlativo >= rango[0]){
						if(correlativo <= rango[1]){
							rango.shift(); // elimnar el primer elemento
						}else{
							rango.pop(); // elimnar el ultimo elemento
						}
					}else{
						rango.shift(); // elimnar el primer elemento
					}					
					rango.push(correlativo);
					rango.sort(function(a, b){return a - b});					
				}
			}			
    	}else{
			rango.pop(); // elimnar el ultimo elemento
			if(correlativo-1 != rango[0] ){
				rango.push(correlativo-1);
				rango.sort(function(a, b){return a - b});
			}
			
    	}
		
		if(rango[0]==0 && rango[1]==0){
			rango = [];	
		}
		if(rango.length==2){
			$(".chk_asignarEval input:checkbox").each(function(){
				correlativo = $(this).attr("correlativo")
				
				if( correlativo >= parseInt(rango[0]) && correlativo <= parseInt(rango[1])){
					//alert(correlativo+"_"+rango[0]+"_"+rango[1]);
					$(this).prop("checked",true);
				}else{
					$(this).prop("checked",false);
				}			
				
			});
		}		
		console.log(rango);
	});
}

var btn_quitarAsignacion = function () {
    $('body').off('click', '.btn_quitarAsignacion');
    $('body').on('click', '.btn_quitarAsignacion', function (e) { 
		var cuadroPun = [];
		k = 0;
		$(".chk_asignarEval input:checkbox:checked").each(function () {			
			cadena 	= $(this).val();
			valores	= cadena.split('||');
			if(parseInt(valores[1]) == 0){ // sin expediente
				k = 1;				
				return;
			}
			if(parseInt(valores[1]) == 1){ // con 1 expediente
				cuadroPun.push(cadena);
			}
			
			if(parseInt(valores[1]) >= 2){ // con mas de 1 expediente
				cuadroPun.push(cadena);
				k = 2;								
			}			
		});
		
		if(k == 0){
			if(cuadroPun.length>0){
				var parametros={					
					cuadroPun : cuadroPun
				}
				SwalConfirmacionCenter.fire({
					html: "¿Seguro(a) que desea <b class='text-primary h4'>quitar la asignación</b> de los expedientes seleccionados?"
				}).then((result) => {
					if (result.isConfirmed) {						
						CQuitarAsisgnacionExpedientes(parametros);
					}
				})
			}else{
				ToastError.fire({title: 'No se ha seleccionado ningún docente.'});			
			} 
		}

		if(k == 1){			
			ToastError.fire({title: 'Se ha seleccionado docente sin expediente.'});			
		}

		if(k == 2){			
			if(cuadroPun.length == 1){ // 
				alert("cargar modal");
				
			}else{
				ToastError.fire({title: 'Los docentes con más de un expediente asignado, se gestionan de manera individual.'});			
			} 			
		} 	  
    });
}

var CQuitarAsisgnacionExpedientes=function(parametros){	
	$.ajax({
		url: '../CQuitarAsisgnacionExpedientes',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje); 
			$(".swal2-confirm").prop('disabled', true);	
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){	
				ToastSuccess.fire({title: data.success});
				tipoEval    = $("#opt_tipoEvaluacion").val();
				idGin    	= $("#txt_idGin").val();
				estado      = $("input[name=chk_tipoRegistro]:checked").val()
				param  = {
					tipoEval  	: tipoEval,
					idGin		: idGin,
					estado		: estado
				}
				VListarCargarExpedientesPunExp(param);
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





var btn_modalBuscarExpedientesExp= function () {
    $('body').off('click', '.btn_modalBuscarExpedientesExp');
    $('body').on('click', '.btn_modalBuscarExpedientesExp', function (e) {
    	modal_buscarExpedientes();
		VBuscarExpedientesExp();
    });
}

var VBuscarExpedientesExp = function(parametros){	
	$.ajax({
		url: '../VBuscarExpedientesExp',
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
				$("#view_buscarExpedientes").html(data);				
				$('#opt_grupoTramite').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					allowClear: true,
					dropdownParent: "#modal_buscarExpedientes" 
				} );
				$('#opt_tramite').select2( {
					theme: "bootstrap-5",
					width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
					placeholder: $( this ).data( 'placeholder' ),
					allowClear: true,
					dropdownParent: "#modal_buscarExpedientes" 
				} );
				tabla=$('#tb_listarExpedientes').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,			
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>i>',	        	
				});
				rangoFecha();
				opt_grupoTramite();
				btn_buscarExpedientesExp();
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var btn_buscarExpedientesExp= function () {
    $('body').off('click', '.btn_buscarExpedientesExp');
    $('body').on('click', '.btn_buscarExpedientesExp', function (e) {
		FechaDesde          = $("#fecha_inicio").val();
		FechaHasta          = $("#fecha_fin").val();
		TramiteId      		= $("#opt_tramite").val();
		idGin      			= $("#txt_idGin").val();
		
		if(FechaDesde == "" || FechaHasta == "" || TramiteId =="") {
			ToastError.fire({title: "Completar opciones de busqueda."});
			return;			
		}
		
		parametros={
			FechaDesde      : FechaDesde,
			FechaHasta      : FechaHasta,
			TramiteId  		: TramiteId,
			idGin			: idGin
		}
	   	DTExpedientesExp(parametros);
    });
}

var DTExpedientesExp = function(parametros){	
	$.ajax({
		url: '../DTExpedientesExp',
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
				$("#view_tablaExpedientes").html(data);
				tabla=$('#tb_listarExpedientes').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,
					"scrollY": "500px",
        			"scrollCollapse": true,        
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>i>',	        	
				});
				$('#txt_buscadorExp').keyup(function () {
					tabla.search($(this).val()).draw();     
				});	
				btn_agregarExpedientesExp();
			}			
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}


var btn_agregarExpedientesExp = function () {
    $('body').off('click', '#btn_agregarExpedientes');
    $('body').on('click', '#btn_agregarExpedientes', function (e) {     	
		idGin	= $("#txt_idGin").val();
		anio	= $("#txt_anio").val();
		var expedientes = [];
		$(".chk_asignarExp input:checkbox:checked").each(function () {
			expedientes.push($(this).val());
		});
		if(expedientes.length>0){
			var parametros={					
				expedientes : expedientes,
				idGin		: idGin,
				anio		: anio
			}
			SwalConfirmacionCenter.fire({
				html: "¿Seguro(a) que desea <b class='text-primary h4'>agregar</b> los expedientes seleccionados?"
			}).then((result) => {
				if (result.isConfirmed) {						
					CAsisgnarExpedientesExp(parametros);
				}
			})
		}else{
			ToastError.fire({title: 'No se ha seleccionado ningún expediente.'});			
		}     	  
    });
}

var CAsisgnarExpedientesExp=function(parametros){	
	$.ajax({
		url: '../CAsisgnarExpedientesExp',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje); 
			$(".swal2-confirm").prop('disabled', true);	
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){	
				ToastSuccess.fire({title: data.success});
				$('#modal_buscarExpedientes').modal('hide');
				tipoEval    = $("#opt_tipoEvaluacion").val();
				idGin    	= $("#txt_idGin").val();
				estado     = $("input[name=chk_tipoRegistro]:checked").val()
				param = {
					tipoEval  	: tipoEval,
					idGin		: idGin,
					estado		: estado
				}						
				VListarCargarExpedientesPunExp(param);				
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

var chk_tipoRegistroExp=function(){
	$('input[name=chk_tipoRegistro]').on('change', function() { 
		tipoEval    = $("#opt_tipoEvaluacion").val();
		idGin    	= $("#txt_idGin").val();
		estado     = $("input[name=chk_tipoRegistro]:checked").val()
		parametros  = {
			tipoEval  	: tipoEval,
			idGin		: idGin,
			estado		: estado
		}
		VListarCargarExpedientesPunExp(parametros);
        
    });  
}




