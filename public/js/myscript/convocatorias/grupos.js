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

	act.pag('convocatorias/cargarexpedientes', function(){		
		tabla=$('#tb_listarConvocatorias').DataTable({
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
	});

	act.lan(); 	
});