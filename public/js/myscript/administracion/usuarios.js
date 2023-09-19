
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

	act.pag('administracion/usuarios', function(){
		usuarios_ajax();
		btn_agregarUsuarios();			
	});

	act.lan(); 	
});


var usuarios_ajax=function(){	
	var valor="ok";
	html="";		
	$.ajax({
		url: 'usuarios_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#mostrarUsuarios").html(data);			
			$('#tb_listadoUsuarios').DataTable({
                "destroy": true,
                //"ordering": false,
                "bAutoWidth": false,        
                "oLanguage": dt_Idioma,
                "dom": '<<t>lip>',	        	
            }); 
          btn_editarUsuarios();
          btn_eliminarUsuarios();
          btn_resetPassword();	
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}


var modal_agregarUsuarios = function(){
	$('#modal_agregarUsuarios').modal('show');   
}

var btn_agregarUsuarios = function () {
    $('body').off('click', '.btn_agregarUsuarios');
    $('body').on('click', '.btn_agregarUsuarios', function (e) {
    	$("#frm_editarUsuario").remove();		 		
 		agregar_ajax();
 		modal_agregarUsuarios();
    });
}


var agregar_ajax =function(){
	var valor="ok";
	$.ajax({
		url: 'agregar_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#contentAgregarUsuario").html(data);
			frm="#frm_agregarUsuario";
			validar_nuevoUsuario(frm);
			btn_agregar();			      
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}

var modal_confirAgregar = function(){
	$('#modal_confirAgregar').modal('show'); 
}


var validar_nuevoUsuario = function (frm) {
    //https://jqueryvalidation.org/required-method/       
    $(frm).validate({
        rules: {
            txt_dni: {
                required: true,
                minlength: 6,
                maxlength: 8
            },
            txt_nombre: {
                required: true,
                minlength: 2
            },
            txt_apellidos: {
                required: true,
                minlength: 1
            },
            opt_tusuario: {
                required: true,
            },
            opt_estado:{
            	required: true,
            }
        },
        messages: {
            txt_dni: "Campo obligatorio.",
            txt_nombre: "Campo obligatorio.",
            txt_apellidos: "Campo obligatorio.",
            opt_tusuario: "Campo obligatorio.",
            opt_estado: "Campo obligatorio.",          
        }
    });

}

/*var btn_agregar = function () {
    $('body').off('click', '#btn_agregar');
    $('body').on('click', '#btn_agregar', function (e) { 	
	    if ($("#frm_agregarUsuario").valid()) {
			modal_confirAgregar();
			btn_agregar();
	    }		
    });
}*/


var btn_agregar = function () {
    $('body').off('click', '#btn_agregar');
    $('body').on('click', '#btn_agregar', function (e) { 
    	if ($("#frm_agregarUsuario").valid()) {
	    	alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar el registro?',
			function(){				
				agregarUsuario_ajax();
			},
			function(){
				$('#modal_agregarUsuarios').modal('hide');
			  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
			});	
    	}else{
    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
    	}
    });
}


var agregarUsuario_ajax=function(){					
	var parametros = {	        
        'usu_dni': $('#txt_dni').val(),
        'usu_nombre': $('#txt_nombre').val(),
        'usu_apellidos': $('#txt_apellidos').val(),
        'tus_id':$('#opt_tusuario').val(),
        'usu_estado':$('input[name=opt_estado]:checked').val()
    };
	$.ajax({
		url: 'agregarUsuario_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) {				
			if(data.estado==true){
				$('#modal_agregarUsuarios').modal('hide');
				usuarios_ajax();			             				            				   			
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


var modal_editarUsuarios = function(){
	$('#modal_editarUsuarios').modal('show');     
}

var btn_editarUsuarios=function(){
	$('body').off('click','.btn_editarUsuarios');	
	$('body').on('click','.btn_editarUsuarios', function(event){
		$("#frm_agregarUsuario").remove();
		var usu_id=$(this).attr("id");
		modal_editarUsuarios();
		editarUsuario_ajax(usu_id);
	});
}

var editarUsuario_ajax =function(usu_id){	
	$.ajax({
		url: 'editarUsuario_ajax',
		method: 'POST',
		data: {'usu_id':usu_id},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#contentEditarUsuario").html(data);			
			fmr="#frm_editarUsuario";
			validar_nuevoUsuario(fmr);
			btn_editar();			      
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}


var btn_editar = function () {
    $('body').off('click', '#btn_editar');
    $('body').on('click', '#btn_editar', function (e) {     	
    	if ($("#frm_editarUsuario").valid()) {
    		cad_antes=$("#cad_antes").val();
			cad_ahora=$("#txt_dni").val()+'_'+$("#txt_nombre").val()+'_'+$("#txt_apellidos").val()+'_'+$("#opt_tusuario").val()+'_'+$('input[name=opt_estado]:checked').val();	
			//alert(cad_ahora);
    		if(cad_antes==cad_ahora){
					alertify.error('<b style="color:#fff;">NO REGISTRA NINGÚN CAMBIO.</b>');
			}else{
				alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar la modificación del registro?',
				function(){	
					UpdateUsuario_ajax();												
				},
				function(){
					$('#modal_editarUsuarios').modal('hide');
				  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
				});	
			}	 		  	
    	}else{
    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
    	}
    });
}


var UpdateUsuario_ajax=function(){	
	var parametros = {	
		'usuID': $("#txt_usuID").val(),
		'dni':$("#txt_dni").val(),
		'nombres':$("#txt_nombre").val(),
		'apellidos':$("#txt_apellidos").val(),
		'tipoUsuario':$("#opt_tusuario").val(),
        'estado': $('input[name=opt_estado]:checked').val()        
    };	
	$.ajax({
		url: 'UpdateUsuario_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){
				$('#modal_editarUsuarios').modal('hide');
				usuarios_ajax();				             				            				   			
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


var btn_eliminarUsuarios = function () {
    $('body').off('click', '.btn_eliminarUsuarios');
    $('body').on('click', '.btn_eliminarUsuarios', function (e) {    
    	var usuID=$(this).attr("id");
		alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea eliminar el registro?',
		function(){	
			eliminarUsuarios_ajax(usuID);												
		},
		function(){				
		  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
		});	
    });
}

var eliminarUsuarios_ajax=function(usuID){	
	var parametros = {	
		'usuID': usuID  
    };	
	$.ajax({
		url: 'eliminarUsuarios_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){				
				usuarios_ajax();				             				            				   			
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


var btn_resetPassword = function () {
    $('body').off('click', '.btn_resetPassword');
    $('body').on('click', '.btn_resetPassword', function (e) {    
    	var usuID=$(this).attr("id");
    	var dni=$(this).attr("dni");
		alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea reiniciar la contraseña al valor por defecto (DNI) ?',
		function(){	
			resetPassowrd_ajax(usuID, dni);												
		},
		function(){				
		  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
		});	
    });
}

var resetPassowrd_ajax=function(usuID, dni){	
	var parametros = {	
		'usuID': usuID,		
		'dni':dni
	};	
	$.ajax({
		url: 'resetPassowrd_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){				
				usuarios_ajax();				             				            				   			
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
