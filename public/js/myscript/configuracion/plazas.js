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

	act.pag('plazas', function(){		
		parametros={
            tipoCarga 	: 0,
			idPer		: null,
			idPro 		: null,
        }
		VListarPlazas(parametros);
		btn_modalNuevaPlaza();
	});

	act.lan(); 	
});

var VListarPlazas = function(parametros){	
	$.ajax({
		url: 'VListarPlazas',
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


				$("#view_listarPlazas").html(data);			
				tabla=$('#tb_listarPlazas').DataTable({
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
			console.log(jqXHR);
		}
	});	
}

var modal_nuevaPlaza = function(){ // nueva forma en bootstrap 5.0
	$('#modal_nuevaPlaza').modal('show');
}


var btn_modalNuevaPlaza = function () {
	$('body').off('click', '.btn_modalNuevaPlaza');
	$('body').on('click', '.btn_modalNuevaPlaza', function (e) {
        parametros={
            valor : "ok"
        }
        VNuevaPlaza(parametros);
        modal_nuevaPlaza();
	});
}


var VNuevaPlaza = function(parametros){	
	$.ajax({
		url: 'VNuevaPlaza',		
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
				$("#view_nuevaPlaza").html(data);
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



 
  
