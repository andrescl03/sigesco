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
                btn_nivelColegio();
                grupoArr = [];                
               // frm='#frmMantenimientoConvocatoria';
				//varlidarMantenimientoConvocatoria(frm);
              //  btn_agregarNuevaConvocatoria();
			}
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});
}


var btn_nivelColegio = function () {
	$('body').off('change', '#opt_ieModal');
	$('body').on('change', '#opt_ieModal', function (e) {
		idIE = $('#opt_ieModal option:selected').val();	
		if( idIE != "" ){
			if(grupoArr.indexOf(idIE) == -1){
				grupoArr.push(idIE);
				parametros = {
					grupoArr : grupoArr
				}
				VComboNivelIE(parametros);
			}else{
				ToastError.fire({title: 'La IE de inscripción ya existe.'});		
			}
			$("#opt_grupoInscripcion").val(null).trigger('change');			
		}else{
			ToastError.fire({title: 'Seleccionar grupo de inscripción.'});			
		}		
	});
}


var VComboNivelIE=function(parametros){	
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

 
  
