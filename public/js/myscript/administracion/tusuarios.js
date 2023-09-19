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

	act.pag('administracion/tusuarios', function(){		
		tusuarios_ajax();		
		btn_agregarTusuarios();
	});

	act.lan(); 	
});


var tusuarios_ajax=function(){	
	var valor="ok";
	html="";		
	$.ajax({
		url: 'tusuarios_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#mostrarTusuarios").html(data);			
			$('#tb_listadoTusuarios').DataTable({
                "destroy": true,
               // "ordering": false,
                "bAutoWidth": false,        
                "oLanguage": dt_Idioma,
                "lengthMenu": [[-1], ["All"]],
                "dom": '<<t>i>',	        	
            }); 
         	btn_editarTusuarios();
         	btn_eliminarTusuarios();
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}

var modal_agregarTusuarios = function(){   
   $('#modal_agregarTusuarios').modal('show');
}

var btn_agregarTusuarios = function () {
    $('body').off('click', '.btn_agregarTusuarios');
    $('body').on('click', '.btn_agregarTusuarios', function (e) { 
    	$("#frm_editarTusuario").remove();			
 		agregarTus_ajax();
 		modal_agregarTusuarios();
    });
}

var agregarTus_ajax =function(){
	var valor="ok";
	$.ajax({
		url: 'agregarTus_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#contentAgregarTusuario").html(data);
			frm="#frm_agregarTusuario";
			validar_nuevoTUsuario(frm);
			btn_agregarTus();			      
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}

/*var modal_confirAgregarTus = function(){
    $('#modal_confirAgregarTus').modal({
        show: true,
        backdrop: 'static'
    });
}*/

var validar_nuevoTUsuario = function (frm) {
    //https://jqueryvalidation.org/required-method/       
    $(frm).validate({
        rules: {
            txt_descripcion: {
                required: true              
            },
            opt_estado: {
                required: true
            }           
        },
        messages: {            
            txt_descripcion: "Campo obligatorio.",
            opt_estado: "Campo obligatorio."                   
        }
    });

}


var btn_agregarTus = function () {
    $('body').off('click', '#btn_agregarTus');
    $('body').on('click', '#btn_agregarTus', function (e) { 
    	if ($("#frm_agregarTusuario").valid()) {
	    	alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar el registro?',
			function(){				
				agregarTUsuario_ajax();
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


/*var btn_agregarTus = function () {
    $('body').off('click', '#btn_agregarTus');
    $('body').on('click', '#btn_agregarTus', function (e) {   
	    if ($("#frm_agregarTusuario").valid()){
			modal_confirAgregarTus();
			agregarTUsuario_ajax();
	    }		
    });
}*/

var agregarTUsuario_ajax=function(){			
	var parametros = {	        
        'tus_usuariodescrip': $('#txt_descripcion').val(),	      
        'tus_estado':$('input[name=opt_estado]:checked').val()
    };
	$.ajax({
		url: 'agregarTUsuario_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) {
			if(data.estado==true){
				$('#modal_agregarTusuarios').modal('hide');
				tusuarios_ajax();			             				            				   			
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

var btn_editarTusuarios = function(){
	$('body').off('click','.btn_editarTusuarios');	
	$('body').on('click','.btn_editarTusuarios', function(event){
		$("#frm_agregarTusuario").remove();	
		var tus_id=$(this).attr("id");
		modal_editarTusuarios();
		editarTusuario_ajax(tus_id);
	});
}

var modal_editarTusuarios = function(){   
    $('#modal_editarTusuarios').modal('show');
}

var editarTusuario_ajax =function(tus_id){	
	$.ajax({
		url: 'editarTusuario_ajax',
		method: 'POST',
		data: {'tus_id':tus_id},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#view_EditarTusuario").html(data);
			fmr="#frm_editarTusuario";
			validar_nuevoTUsuario(fmr);
			btn_editarTusuario();			      
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}


var btn_editarTusuario = function () {
    $('body').off('click', '#btn_editarTusuario');
    $('body').on('click', '#btn_editarTusuario', function (e) {     	
    	if ($("#frm_editarTusuario").valid()) {
    		cad_antes=$("#cad_antes").val();
			cad_ahora=$("#txt_descripcion").val()+'_'+$('input[name=opt_estado]:checked').val();	
			//alert(cad_ahora);
    		if(cad_antes==cad_ahora){
					alertify.error('<b style="color:#fff;">NO REGISTRA NINGÚN CAMBIO.</b>');
			}else{
				alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea confirmar la modificación del registro?',
				function(){	
					UpdateTusuarios_ajax();												
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


var UpdateTusuarios_ajax=function(){	
	var parametros = {	
		'tusID': $("#txt_tusID").val(),
		'descripcion':$("#txt_descripcion").val(),
        'estado': $('input[name=opt_estado]:checked').val()        
    };	
	$.ajax({
		url: 'UpdateTusuarios_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){
				$('#modal_editarTusuarios').modal('hide');
				tusuarios_ajax();				             				            				   			
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

var btn_eliminarTusuarios = function () {
    $('body').off('click', '.btn_eliminarTusuarios');
    $('body').on('click', '.btn_eliminarTusuarios', function (e) { 
    	var total=$(this).attr("total");
    	var tusID=$(this).attr("id");
    	if(total!=0){
			alertify.error('<b style="color:#fff;">Grupo tiene usuarios registrados.</b>');
		}else{
			alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea eliminar el registro?',
			function(){	
				eliminarTusuarios_ajax(total, tusID);												
			},
			function(){				
			  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
			});	
		}
    });
}


var eliminarTusuarios_ajax=function(total, tusID){	
	var parametros = {	
		'tusID': tusID,
		'total':total     
    };	
	$.ajax({
		url: 'eliminarTusuarios_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			if(data.estado==true){				
				tusuarios_ajax();				             				            				   			
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


