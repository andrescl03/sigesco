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

	act.pag('convocatorias/listar', function(){		
		parametros={
            tipoCarga 	: 0,
			idPer		: null,
			idPro 		: null,
        }
		VListarConvocatorias(parametros);
        opt_tipoProceso();
        opt_periodo();
        btn_modalNuevaConvocatoria();
	});

	act.lan(); 	
});

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

var VListarConvocatorias = function(parametros){	
	$.ajax({
		url: 'VListarConvocatorias',
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
				$("#view_listarConvocatorias").html(data);			
				tabla=$('#tb_listarConvocatorias').DataTable({
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

var opt_tipoProceso = function(){
	$('body').off('change','#opt_tipoProceso');	
	$('body').on('change','#opt_tipoProceso', function(event){		
        idPer    = $("#opt_periodo").val();
		idPro   = $("#opt_tipoProceso").val();
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarConvocatorias(parametros);				
	});
}

var opt_periodo = function(){
	$('body').off('change','#opt_periodo');	
	$('body').on('change','#opt_periodo', function(event){		
        idPer    = $("#opt_periodo").val();
		idPro   = $("#opt_tipoProceso").val();
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarConvocatorias(parametros);				
	});
}

var modal_nuevaConvocatoria = function(){ // nueva forma en bootstrap 5.0
	$('#modal_nuevaConvocatoria').modal('show');
}
 
var btn_modalNuevaConvocatoria = function () {
	$('body').off('click', '.btn_modalNuevaConvocatoria');
	$('body').on('click', '.btn_modalNuevaConvocatoria', function (e) {
        parametros={
            valor : "ok"
        }
        VNuevaConvocatoria(parametros);
        modal_nuevaConvocatoria();
	});
}
 
var VNuevaConvocatoria = function(parametros){	
	$.ajax({
		url: 'VNuevaConvocatoria',		
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
				$("#view_nuevaConvocatoria").html(data);
                tabla=$('#tb_listarGrupoInscripcion').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>>',
				});
				opt_periodoModal();
                opt_tipoProcesoModal();
                rangoFecha();
                btn_asignarGrupoInscripcion();
                grupoArr = [];                
                frm='#frmMantenimientoConvocatoria';
				varlidarMantenimientoConvocatoria(frm);
                btn_agregarNuevaConvocatoria();
			}
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});
}

var opt_periodoModal=function(){
	$('body').off('change','#opt_periodoModal');	
	$('body').on('change','#opt_periodoModal', function(event){		
		idPer=$("#opt_periodoModal").val();
		idPro=$("#opt_tipoProcesoModal").val();
		parametros={           
			idPer		: idPer,
			idPro 		: idPro,
        }
		VSelectGrupoInscripcion(parametros);
	});
}

var opt_tipoProcesoModal=function(){
	$('body').off('change','#opt_tipoProcesoModal');	
	$('body').on('change','#opt_tipoProcesoModal', function(event){		
		idPer=$("#opt_periodoModal").val();
		idPro=$("#opt_tipoProcesoModal").val();
		parametros={           
			idPer		: idPer,
			idPro 		: idPro,
        }
		VSelectGrupoInscripcion(parametros);
	});
}

var VSelectGrupoInscripcion = function(parametros){	
	$.ajax({
		url: 'VSelectGrupoInscripcion',		
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
				$("#view_selectGrupoInscripcion").html(data);                
			}
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});
}

var  grupoArr = [];

var btn_asignarGrupoInscripcion = function () {
	$('body').off('click', '.btn_asignarGrupoInscripcion');
	$('body').on('click', '.btn_asignarGrupoInscripcion', function (e) {
		idGin = $('#opt_grupoInscripcion option:selected').val();	
		if( idGin != "" ){
			if(grupoArr.indexOf(idGin) == -1){
				grupoArr.push(idGin);
				parametros = {
					grupoArr : grupoArr
				}
				VTablaGrupoInscripcion(parametros);
			}else{
				ToastError.fire({title: 'El grupo de inscripción ya existe.'});		
			}
			$("#opt_grupoInscripcion").val(null).trigger('change');			
		}else{
			ToastError.fire({title: 'Seleccionar grupo de inscripción.'});			
		}		
	});
}

var VTablaGrupoInscripcion=function(parametros){	
	$.ajax({
		url: 'VTablaGrupoInscripcion',
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
				$("#view_tablaGrupoInscripcion").html(data);
                tabla=$('#tb_listarGrupoInscripcion').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>>',
				});               
                if(parametros.grupoArr.length > 0 ){                   
                    $('#opt_periodoModal').prop('disabled', true);
					$('#opt_tipoProcesoModal').prop('disabled', true);
                }else{ 
					$('#opt_periodoModal').prop('disabled', false);                   
                    $('#opt_tipoProcesoModal').prop('disabled', false);
                }
				btn_eliminarAccion();
			}	
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});	
}

var btn_eliminarAccion = function () {
	$('body').off('click', '.btn_eliminarAccion');
	$('body').on('click', '.btn_eliminarAccion', function (e) { 	
		idGin  = $(this).attr("idGin");
        indice = grupoArr.indexOf(idGin);
		grupoArr.splice(indice, 1);
		if(grupoArr.length == 0){
            grupoArr = [];
			parametros = {
				grupoArr : grupoArr
			}
		}else{
			parametros = {
				grupoArr : grupoArr
			}
		}		
		VTablaGrupoInscripcion(parametros)		  
	});
}

var varlidarMantenimientoConvocatoria = function (frm) {
    //https://jqueryvalidation.org/required-method/
    $(frm).validate({
		ignore: [],
		rules: {
            opt_periodoModal: {
                required: true
            },
            opt_estado: {
                required: true
            },
			opt_tipoProcesoModal: {
                required: true
            },
			fecha_inicio:{
				required: true
			},
			fecha_fin: {
                required: true
            }
        }
    });
}

var btn_agregarNuevaConvocatoria = function () {
	$('body').off('click', '#btn_agregarNuevaConvocatoria');
	$('body').on('click', '#btn_agregarNuevaConvocatoria', function (e) {
        if ($("#frmMantenimientoConvocatoria").valid()) {
            idPer           = $("#opt_periodoModal").val();
			anio           =  $("#opt_periodoModal option:selected").text();
            estado          = $("#opt_estado").val();
            idPro           = $("#opt_tipoProcesoModal").val();
            fechaDesde      = $("#fecha_inicio").val();
            fechaHasta      = $("#fecha_fin").val();
			idTipo           = $("#opt_tipoConvocatoriaModal").val();

            if(grupoArr.length == 0) {
                ToastError.fire({title: 'Agregar al menos un grupo de inscripción.'});
            }else{
                parametros = {
                    idPer		: idPer,
					anio		: anio,
                    estado  	: estado,
                    idPro   	: idPro,
                    fechaDesde  : fechaDesde,
                    fechaHasta  : fechaHasta,
                    grupoArr    : grupoArr,
					idTipo      : idTipo
                }
                SwalConfirmacionCenter.fire({
                    html: "¿Seguro(a) que desea <b class='text-primary h4'>registrar</b> esta información?"
                }).then((result) => {
                    if (result.isConfirmed) {						
                        CAgregarNuevaConvocatoria(parametros);
                    }
                })
            }    
        }else{
            ToastError.fire({title: 'Formulario incompleto.'});	
        }       
	});
}

var CAgregarNuevaConvocatoria=function(parametros){	
	$.ajax({
		url: 'CAgregarNuevaConvocatoria',
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
				$('#modal_nuevaConvocatoria').modal('hide');
				$("#opt_periodo option[value="+parametros.idPer+"]").attr("selected", true);
                $("#opt_tipoProceso option[value="+parametros.idPro+"]").attr("selected", true);
                param={
					tipoCarga 	: 1,	
                    idPer  : parametros.idPer,
                    idPro : parametros.idPro
                } 				                             
				VListarConvocatorias(param);		
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

