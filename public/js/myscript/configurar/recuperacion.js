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

	act.pag('configurar/recuperacion', function(){		
		
		frm = "#frm_recupacion"; 
		validarUsuario(frm);
		btn_login();
	});

	act.lan(); 	
});

var validarUsuario = function (frm) {
    //https://jqueryvalidation.org/required-method/       
    $(frm).validate({
        rules: {
            txt_correo: {
                required: true,
                email : true                     
            },
            txt_numDocumento: {
                required: true            
            }
        }
    });
}


var btn_login = function () {
    $('body').off('click', '#btn_login');
    $('body').on('click', '#btn_login', function (e) { 
 		if ($("#frm_recupacion").valid()) {
	    		alertify.confirm('<b style="font-size:22px;" class="text-danger"><i class="fas fa-angle-double-right"></i> Confirmar</b>','<b style="font-size:17px;">¿Seguro de continuar?</b>',	
				function(){
					correo  		= $("#txt_correo").val(); 
					numDocumento 	= $("#txt_numDocumento").val(); 
					var parametros = {	
						'correo'		: correo,
						'numDocumento'	: numDocumento														
					};
					recuperaPassword_ajax(parametros);					
				},
				function(){				
				  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
				});     			    	
	    	}else{
	    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
	    	}

    });
}

var recuperaPassword_ajax=function(parametros){				
	$.ajax({
		url: 'recuperaPassword_ajax',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$("#btn_login").prop('disabled', true);			
			$.blockUI({ 
	        	message: '<h4><b><i class="fas fa-spinner fa-spin fa-2x"></i></br> Procesando, espere por favor...</b></h4>',
	        	css: {
	    		   	border: 'none', 
		            padding: '15px', 
		            backgroundColor: '#DE1F29', 
		            '-webkit-border-radius': '10px', 
		            '-moz-border-radius': '10px', 
		            opacity: .5, 
		            color: '#fff'  								
	        	}		              
	    	}); 	
		},
		success: function (data) {
			$.unblockUI(); 									
			if(data.estado==true){
				swal({
					title: data.success,
				  	//text: "ok",
				  	icon: "success",
				  	button: "ACEPTAR",
				  	closeOnClickOutside: false,
				  	closeOnEsc: false,     
				}).then((value) => {
		 			$("#frm_recupacion").removeData('validator')
					$("#frm_recupacion")[0].reset();
					$("input.error").removeClass("error");
					$("select.error").removeClass("error");
					$("textarea.error").removeClass("error");	
					//setTimeout(function() {				    	
			    		window.location.href = data.link;			    		
			    	//},1000);
				});									
				
			}else{				
				swal({
					title: data.error,
				  	//text: "ok",
				  	icon: "error",
				  	button: "ACEPTAR",
				  	closeOnClickOutside: false,
				  	closeOnEsc: false,     
				}).then((value) => {
		 			$("#btn_login").prop('disabled', false);
				});				
			}
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
		    swal({
				title: "Error de Servidor, si el error persiste comunicarse con el administrador del sistema.",
			  	//text: "ok",
			  	icon: "error",
			  	button: "ACEPTAR",
			  	closeOnClickOutside: false,
			  	closeOnEsc: false,     
			}).then((value) => {
		 			$("#btn_login").prop('disabled', false);	
			});	
		}
	});	
}