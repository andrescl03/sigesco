
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

	act.pag('administracion/modulos', function(){
		modulos_ajax();
		btn_agregarModulos();	
	});

	act.lan(); 	
});


var modulos_ajax=function(){	
	var valor="ok";
	html="";		
	$.ajax({
		url: 'modulos_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#mostrarModulos").html(data);			
			$('#tb_listadoModulos').DataTable({
                "destroy": true,
                "ordering": false,
                "bAutoWidth": false,
                "lengthMenu": [[-1], ["All"]],        
                "oLanguage": dt_Idioma,
                //"dom": '<<t>lip>',
                "dom": '<<t>i>',		        	
            }); 
          	// btn_editarFirma();
          	btn_editarModulos();
          	btn_eliminarModulos();	
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}


var modal_agregarModulos = function(){
    $('#modal_agregarModulos').modal('show');
}

var btn_agregarModulos= function () {
    $('body').off('click', '.btn_agregarModulos');
    $('body').on('click', '.btn_agregarModulos', function (e) { 
    	$("#frm_editarModulo").remove();			
 		agregarMod_ajax();
 		modal_agregarModulos();
    });
}

var agregarMod_ajax =function(){
	var valor="ok";
	$.ajax({
		url: 'agregarMod_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#contentAgregarModulo").html(data);
			fmr="#frm_agregarModulo";
			validar_nuevoModulo(fmr);
			opt_hijode();
			btn_agregarMod();
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}

var modal_confirAgregarMod = function(){
	$('#modal_confirAgregarMod').modal('show');
}

var validar_nuevoModulo = function (frm) {
    //https://jqueryvalidation.org/required-method/       
    $(frm).validate({
        rules: {
            txt_nombre: {
                required: true                      
            },
            txt_icono: {
                required: true
            },            
            opt_hijode: {
                required: true,
            },
            /*txt_ruta: {
                required: true,
            },*/
            opt_estado:{
            	required: true,
            }
        },
        messages: {
            txt_nombre: "Campo obligatorio.",
            txt_icono: "Campo obligatorio.",
            opt_hijode: "Campo obligatorio.",
            // txt_ruta: "Campo obligatorio.",
            opt_estado: "Campo obligatorio."                    
        }
    });
}

/*var btn_agregarMod = function () {
    $('body').off('click', '#btn_agregarMod');
    $('body').on('click', '#btn_agregarMod', function (e) { 	
	    if ($("#frm_agregarModulo").valid()) {
			modal_confirAgregarMod();
			btn_confirAgregarMod();
	    }		
    });
}*/


var btn_agregarMod = function () {
    $('body').off('click', '#btn_agregarMod');
    $('body').on('click', '#btn_agregarMod', function (e) { 
    	if ($("#frm_agregarModulo").valid()) {
	    	alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar el registro?',
			function(){				
				agregarModulo_ajax();
			},
			function(){
				$('#modal_agregarModulos').modal('hide');
			  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
			});	
    	}else{
    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
    	}
    });
}


var agregarModulo_ajax=function(){		
	var parametros = {	        
        'mdl_nombre': $('#txt_nombre').val(),
        'mdl_ruta': $('#txt_ruta').val(),
        'mdl_icono': $('#txt_icono').val(),
        'mdl_hijode': $('#opt_hijode').val(),	   	        
        'mdl_estado':$('input[name=opt_estado]:checked').val()
    };

	$.ajax({
		url: 'agregarModulo_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) {
			if(data.estado==true){
				$('#modal_agregarModulos').modal('hide');
				modulos_ajax();			             				            				   			
				alertify.success('<b style="color:#fff;">'+data.success+'</b>');				
			}else{
				alertify.error('<b style="color:#fff;">'+data.error+'</b>');
			}				
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});
}

var opt_hijode=function(){
	$('body').off('change','#opt_hijode');	
	$('body').on('change','#opt_hijode', function(event){		
		valor=$("#opt_hijode").val();
		if(valor==0){
			$("#txt_ruta").val("");
			$('#txt_ruta').prop('disabled', true);		
		}else{
			$('#txt_ruta').prop('disabled', false);			
		}		
	});
}


var modal_editarModulos = function(){   
    $('#modal_editarModulos').modal('show');
}

var btn_editarModulos= function () {
    $('body').off('click', '.btn_editarModulos');
    $('body').on('click', '.btn_editarModulos', function (e) {
    	$("#frm_agregarModulo").remove();	
    	mdl_id=$(this).attr("id");
 		modal_editarModulos();
 		editarMod_ajax(mdl_id);
    });
}

var editarMod_ajax =function(mdl_id){
	var parametros = {	        
        'mdl_id': mdl_id  
    };
	$.ajax({
		url: 'editarMod_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#view_editarModulo").html(data);
			fmr="#frm_editarModulo";
			validar_nuevoModulo(fmr);
			opt_hijode();
			btn_editarModulo();
			//validar_nuevoModulo();
			//opt_hijode();
			//btn_agregarMod();
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}

var btn_editarModulo = function () {
    $('body').off('click', '#btn_editarModulo');
    $('body').on('click', '#btn_editarModulo', function (e) {     	
    	if ($("#frm_editarModulo").valid()) {
    		cad_antes=$("#cad_antes").val();
			cad_ahora=$("#txt_nombre").val()+'_'+$("#opt_hijode").val()+'_'+$("#txt_ruta").val()+'_'+$("#txt_icono").val()+'_'+$('input[name=opt_estado]:checked').val();	
			//alert(cad_ahora);
    		if(cad_antes==cad_ahora){
					alertify.error('<b style="color:#fff;">NO REGISTRA NINGÚN CAMBIO.</b>');
			}else{
				alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar la modificación del registro?',
				function(){	
					UpdateModulos_ajax();												
				},
				function(){
					$('#modal_editarModulos').modal('hide');
				  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
				});	
			}	 		  	
    	}else{
    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
    	}
    });
}

var UpdateModulos_ajax=function(){	
	var parametros = {	
		'mldID': $("#txt_mldID").val(),
		'nombre':$("#txt_nombre").val(),
        'hijode': $("#opt_hijode").val(),
        'ruta': $("#txt_ruta").val(),
        'icono': $("#txt_icono").val(),
        'estado': $('input[name=opt_estado]:checked').val()        
    };	
	$.ajax({
		url: 'UpdateModulos_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){
				$('#modal_editarModulos').modal('hide');
				modulos_ajax();				             				            				   			
				alertify.success('<b style="color:#fff;">'+data.success+'</b>');				
			}else{
				alertify.error('<b style="color:#fff;">'+data.error+'</b>');
			}
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}


var btn_eliminarModulos = function () {
    $('body').off('click', '.btn_eliminarModulos');
    $('body').on('click', '.btn_eliminarModulos', function (e) {     	
    	var mdlID=$(this).attr("id");    
		alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea eliminar el registro?',
		function(){	
			eliminarModulos_ajax(mdlID);												
		},
		function(){				
		  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
		});			
    });
}


var eliminarModulos_ajax=function(mdlID){	
	var parametros = {	
		'mdlID': mdlID		   
    };	
	$.ajax({
		url: 'eliminarModulos_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){				
				modulos_ajax();				             				            				   			
				alertify.success('<b style="color:#fff;">'+data.success+'</b>');				
			}else{
				alertify.error('<b style="color:#fff;">'+data.error+'</b>');
			}
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}
