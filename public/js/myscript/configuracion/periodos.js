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

	act.pag('configuracion/periodos', function(){		
		createPeriodo();
		VListarPeriodos();
        
	});

	act.lan(); 	
});

var createPeriodo = function () {
	const modal = new bootstrap.Modal(document.querySelector('#modal_agregarPeriodos'));
	const btns = document.querySelectorAll('.btn_agregarPeriodo');
	if (btns) {
		btns.forEach(btn => {
			console.log(btn);
			btn.addEventListener('click', (e) => {
				e.preventDefault();
				modal.show();
			});
		});
	}
	const forms = document.querySelectorAll('.formCreatePeriodo');
	if (forms) {
		forms.forEach(form => {
			form.addEventListener('submit', (e) => {
				e.preventDefault();
				const formData = new FormData(e.target);
				store(formData)
				.then(({success, data, message}) => {
					if (!success) {
						throw message;
					}
					e.target.reset();
					modal.hide();
					sweet2.show({
						type: 'success', 
						text: message,
						onOk: () => {
							sweet2.loading({text: 'Redireccionando...'});
							window.location.href = window.AppMain.url + `/configuracion/periodos/${data.id}`;
						}
					});
				})
				.catch(error => {
					sweet2.show({type:'error', text:error});
				});
			});
		});
	}
	const store = (formData) => {
		return new Promise((resolve, reject)=>{
			sweet2.loading();
			$.ajax({
				url: window.AppMain.url + `configuracion/periodos/store`,
				method: 'POST',
				dataType: 'json',
				data: formData,
				processData: false,
				contentType: false,
			})
			.done(function (response) {
				resolve(response);
			})
			.fail(function (xhr, status, error) {
				sweet2.show({type:'error', text:error});
			});
		});
	};
}

var VListarPeriodos=function(){	
	$.ajax({
		url: 'VListarPeriodos',
		method: 'POST',
		data: {'v': 1},
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
				$("#view_listarPeriodos").html(data);			
				tabla=$('#tb_listarPeriodos').DataTable({
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