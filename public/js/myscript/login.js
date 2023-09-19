/* 
    Desarrollado por: 
    - Ing. Luis Alberto Arrascue Bazán 959817779
*/
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

    act.pag('login', function(){
        validar_login();
        btn_login();
    });

    act.lan();    

});

var validar_login = function () {
    //https://jqueryvalidation.org/required-method/       
    $("#frm_login").validate({
        rules: {
            inputUsuario: {
                required: true,          
            },
            inputPassword: {
                required: true,               
            }
        }
    });

}

var btn_login=function(){
    $('body').off('click','#btn_login');   
    $('body').on('click','#btn_login', function(event){  
        if ($("#frm_login").valid()) {
            usuario = $("#inputUsuario").val(); 
            password = sha1($("#inputPassword").val());      
            parametros = {          
                'usu_dni'   : usuario,         
                'usu_pass'  : password
            };                
            validarLogin_ajax(parametros);           
        }else{
            alertify.error('<b style="color:#fff;">Usuario y contraseña requerido.</b>');
        }
    });
}

var validarLogin_ajax=function(parametros){    
    $.ajax({
        url: 'validarLogin_ajax',
        method: 'POST',
        data: parametros,
        cache: 'false',
        dataType: 'json',
        beforeSend: function(){
            //$.blockUI(blockUIMensaje); 	        
            $("#btn_login").prop('disabled', true);
			$("#btn_login").html('<b><i class="fas fa-spinner fa-spin"></i> VALIDANDO...</b>');
        },
        success: function (data) {
            $("#btn_login").prop('disabled', false);
            $("#btn_login").html('<b><i class="fas fa-sign-in-alt"></i> INGRESAR</b>');			
            //$.unblockUI();
			if(data.estado==true){			
				/*SwalSuccessCenter.fire({				
					html: "<b class='h4'>"+data.success+"</b>"							
				}).then((result) => {
					if (result.isConfirmed) {														*/
						window.location.href = data.link;
				/*	}
				})*/
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

