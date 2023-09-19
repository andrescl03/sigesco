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

	act.pag('configuracion/grupoinscripcion', function(){		
		parametros={
            tipoCarga 	: 0,
			idPer		: null,
			idPro 		: null,
        }
		VListarGrupoInscripcion(parametros);
        opt_periodo();
		opt_tipoProceso();
	});

	act.lan(); 	
});

var VListarGrupoInscripcion=function(parametros){	
	$.ajax({
		url: 'VListarGrupoInscripcion',
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
				$("#view_listarGrupoInscripcion").html(data);			
				tabla=$('#tb_listarGrupoInscripcion').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,        
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>>',	        	
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

var opt_periodo=function(){
	$('body').off('change','#opt_periodo');	
	$('body').on('change','#opt_periodo', function(event){	
		idPer 	= $("#opt_periodo").val();	
		idPro	= $("#opt_tipoProceso").val();	
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarGrupoInscripcion(parametros);
	});
}

var opt_tipoProceso=function(){
	$('body').off('change','#opt_tipoProceso');	
	$('body').on('change','#opt_tipoProceso', function(event){	
		idPer 	= $("#opt_periodo").val();	
		idPro	= $("#opt_tipoProceso").val();	
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarGrupoInscripcion(parametros);
	});
}



