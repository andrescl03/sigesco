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
	act.pag('configurar/usuarios', function(){		
		btn_cambiarPassModal();
		btn_cargarFirma();
	});

	act.lan(); 	
});


var modal_cambiarPass = function(){
	$('#modal_cambiarPass').modal('show');		
   
}

var btn_cambiarPassModal= function () {
    $('body').off('click', '.btn_cambiarPassModal');
    $('body').on('click', '.btn_cambiarPassModal', function (e) { 
    	frm="#frm_cambiarPass";
    	cambiarPassModal_ajax();
 		modal_cambiarPass();
    });
}

var cambiarPassModal_ajax =function(){
	var valor="ok";
	$.ajax({
		url: 'cambiarPassModal_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#view_cambiarPass").html(data);
			fmr="#frm_cambiarPass";
			validar_cambiarPass(fmr);
			btn_cambiarPass();		
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});		
}


var validar_cambiarPass = function (frm) {
    //https://jqueryvalidation.org/required-method/       
    $(frm).validate({
        rules: {
            txt_passOld: {
                required: true                      
            },
            txt_passNew_1: {
                required: true,
                 minlength: 6
            },            
            txt_passNew_2: {
                required: true,
                equalTo: "#txt_passNew_1",
                minlength: 6
            }
        },
        messages: {
            txt_passOld: "Campo obligatorio.",
            txt_passNew_1: "Campo obligatorio.",
            txt_passNew_2: "Campo obligatorio."                                
        }
    });
}

var btn_cambiarPass = function () {
    $('body').off('click', '#btn_cambiarPass');
    $('body').on('click', '#btn_cambiarPass', function (e) { 
    	if ($("#frm_cambiarPass").valid()) {
	    	alertify.confirm('<b style="font-size:18px;"><i class="fas fa-angle-double-right"></i> Confirmar</b>','¿Desea cambiar contraseña?',
			function(){					
				UpdateUsuario_ajax();
			},
			function(){
				$('#modal_cambiarPass').modal('hide');
			  	alertify.error('<b style="color:#fff;">CANCELAR.</b>');
			});	
    	}else{
    		alertify.error('<b style="color:#fff;">FORMULARIO INCOMPLETO.</b>');
    	}
    });
}

var UpdateUsuario_ajax=function(){	
	var parametros = {	
		'usuID': $("#txt_usuID").val(),
		'dni':$("#txt_dni").val(),
		'old':sha1($("#txt_passOld").val()),
		'new_1':sha1($("#txt_passNew_1").val()),
		'new_2':sha1($("#txt_passNew_2").val())      
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
				$('#modal_cambiarPass').modal('hide');							             				            				   			
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


var btn_cargarFirma = function () {

    $('body').off('click', '.btn_cargarFirma');
    $('body').on('click', '.btn_cargarFirma', function (e) { 
	 
		var fileInput = document.getElementById('archivo');
        var file = fileInput.files[0];
		if (file) {
            var formData = new FormData();
            formData.append('archivo', file);
            formData.append('a', "a");

            $.ajax({
                url: 'CargarFirmaUsuario', // Reemplaza con la URL de tu script de procesamiento
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    console.log(response);
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error(error);
                }
            });
        } else {
            alert('Seleccione un archivo de imagen.');
        }
    });

   
}
