
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

	act.pag('administracion/permisos', function(){
		permisos_ajax();
		//modulos_ajax();
		//btn_agregarModulos();			
	});

	act.lan(); 	
});

var permisos_ajax=function(){	
	var valor="ok";
	html="";		
	$.ajax({
		url: 'permisos_ajax',
		method: 'POST',
		data: {'valor':valor},
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {			
		},
		success: function (data) { 
			$("#mostrarPermisos").html(data);	
			cargar_permisos();
		},
		error: function (jqXHR, textStatus, error) {
		    alert(error);
		}
	});	
}


var cargar_permisos=function(){
	$('body').off('change','#opt_tusuario');	
	$('body').on('change','#opt_tusuario', function(event){	
		tus_id=$('#opt_tusuario').val();
		$('#tus_id').val(tus_id);
		$.ajax({
			url: 'cargar_permisos',
			method: 'POST',
			data: {'tus_id':tus_id},
			cache: 'false',
			// dataType: 'json',
			beforeSend: function () {			
			},
			success: function (data) { 
				$("#verPermisos").html(data);	
				$('#tb_listadoPermisos').DataTable({
	                "destroy": true,
	                "ordering": false,
	                "bAutoWidth": false,        
	                "oLanguage": dt_Idioma,
	                "lengthMenu": [[-1], ["All"]],
	                "dom": '<<t>>',	        	
           		}); 
           		ver_check(tus_id);
			},
			error: function (jqXHR, textStatus, error) {
			    alert(error);
			}
		});			
	});
}

var ver_check=function(tus_id){
	$('.chk_permisos input[type=checkbox]').on('change', function() {
    	if($(this).is(':checked') ) {
        	per_estado=1;
        	mdl_id= $(this).val();
    	}else{
        	per_estado=0;
        	mdl_id= $(this).val();
    	}
		var parametros = {	        
	        'tus_id': tus_id,
	        'mdl_id': mdl_id,
	        'per_estado':per_estado  
	    };
    	$.ajax({
			url: 'cambiar_estadoPermiso',
			method: 'POST',
			data: parametros,
			cache: 'false',
			dataType: 'json',
			beforeSend: function () {			
			},
			success: function (data) { 
				if(data.estado==true){
					if(data.success!=null){
						alertify.success('<b style="color:#fff;">'+data.success+'</b>');
					}else{
						alertify.warning('<b style="color:#000;">'+data.error+'</b>');
					}	
				}else{
					alertify.error('<b style="color:#fff;">'+data.error+'</b>');
				}
			},
			error: function (jqXHR, textStatus, error) {
			    alert(error);
			}
		});
	});
}