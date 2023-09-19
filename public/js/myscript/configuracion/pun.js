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

	act.pag('configuracion/pun', function(){		
		parametros={
            tipoCarga 	: 0,
			idPer		: null,
			idPro 		: null,
        }
		VListarPun(parametros);
        opt_tipoProceso();
        opt_periodo();
        btn_modalCargarPun();
	});

	act.lan(); 	
});

var VListarPun = function(parametros){	
	$.ajax({
		url: 'VListarPun',
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
				$("#view_listarPun").html(data);			
				tabla=$('#tb_listarPun').DataTable({
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
		}
	});	
}

var opt_tipoProceso = function(){
	$('body').off('change','#opt_tipoProceso');	
	$('body').on('change','#opt_tipoProceso', function(event){		
		idPer 	= $("#opt_periodo").val();	
		idPro	= $("#opt_tipoProceso").val();	
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarPun(parametros);				
	});
}

var opt_periodo = function(){
	$('body').off('change','#opt_periodo');	
	$('body').on('change','#opt_periodo', function(event){		
		idPer 	= $("#opt_periodo").val();	
		idPro	= $("#opt_tipoProceso").val();	
		parametros={
            tipoCarga 	: 1,
			idPer		: idPer,
			idPro 		: idPro,
        }
		VListarPun(parametros);				
	});
}

var modal_cargarPun = function(){ // nueva forma en bootstrap 5.0
	$('#modal_cargarPun').modal('show');
}
 
var btn_modalCargarPun = function () {
	$('body').off('click', '.btn_modalCargarPun');
	$('body').on('click', '.btn_modalCargarPun', function (e) {
        parametros={
            valor : "ok"
        }
        VCargarPun(parametros);
        modal_cargarPun();
	});
}
 
var VCargarPun = function(parametros){	
	$.ajax({
		url: 'VCargarPun',		
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
				$("#view_cargarPun").html(data);
                btn_procesarArchivoPun();				
			}
		},
		error: function (jqXHR, textStatus, error) {
		    $.unblockUI();
			SwalErrorServidor.fire();
		}
	});		
}

var btn_procesarArchivoPun = function () {
	$('body').off('click', '#btn_procesarArchivoPun');
	$('body').on('click', '#btn_procesarArchivoPun', function (e) {
        anio            = $("#opt_periodoModal option:selected").text();
		idPer           = $("#opt_periodoModal").val();
        idPro           = $("#opt_tipoProcesoModal").val();
        nombreArchivo   = $("#txt_nombrearchivo").val();
      
       	if(anio != "" && idPro != "" && nombreArchivo != "" ){
            parametros = {
					anio           	: anio,
					idPer			: idPer,	
					idPro          	: idPro,
					nombreArchivo 	: nombreArchivo
				}
				CProcesarArchivoPun(parametros);
		}else{
				ToastError.fire({title: "Información incompleta."});
		}
	});
}


var CProcesarArchivoPun=function(parametros){	
	$.ajax({
		url: 'CProcesarArchivoPun',
		method: 'POST',
		data: parametros,
		cache: 'false',
		dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje); 
			$(".swal2-confirm").prop('disabled', true);	
		},
		success: function (data) {
			$.unblockUI();
			$(".swal2-confirm").prop('disabled', false); 
			if(data.estado==true){	
				ToastSuccess.fire({title: data.success});
				$('#modal_cargarPun').modal('hide');
				$("#opt_periodo option[value="+parametros.anio+"]").attr("selected", true);
                $("#opt_tipoProceso option[value="+parametros.idPro+"]").attr("selected", true);
                param={
                    idPer  : parametros.idPer,
                    idPro : parametros.idPro
                }                
				VListarPun(param);		
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
 
