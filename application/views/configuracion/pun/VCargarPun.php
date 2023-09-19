
<div class="row">
	<div class="col-md-2 mb-2 mt-1"><b>Periodo:</b></div>
	<div class="col-md-3 mb-2">
		<select class="form-select form-select-sm" name="opt_periodoModal" id="opt_periodoModal" > 
			<option value="">Elegir...</option>             
			<?php foreach ($periodos as $periodo) { ?>
				<option value="<?= $periodo['per_id'] ?>" <?= $periodo['per_default']==1 ? "Selected" : "" ?> ><?= $periodo['per_anio'] ?></option>
			<?php } ?>               
		</select>
	</div>
    <div class="col-md-2 mb-2 mt-1"><b>Tipo de proceso:</b></div>
	<div class="col-md-3 mb-2">
		<select class="form-select form-select-sm" name="opt_tipoProcesoModal" id="opt_tipoProcesoModal" > 
			<option value="">Elegir...</option>             
			<?php foreach ($procesos as $proceso) { ?>
				<option value="<?= $proceso['pro_id'] ?>" <?= $proceso['pro_default']==1 ? "Selected" : "" ?> ><?= $proceso['pro_descripcion'] ?></option>
			<?php } ?>                
		</select>
	</div>
</div>

<div class="row mt-3">
	<div class="col-sm-12">
		<form id="frmAddDocumentos">	    
	        <div class="form-group row">
				<div class="col-xs-12 col-md-12">			       
					<div class="dropzone text-center " id="Dz_documento" name="Dz_documento" >
						<div class="dz-message">
							<div class="icon">							
								<i class="fas fa-cloud-upload-alt fa-3x"></i>					
							</div>
							<h2>Suelta tu archivo aquí</h2>
							<span class="note">Recuerde subir máximo 50MB.</span>
							
						</div>
					  	<div class="fallback">
					    	<input type="file" name="file" readonly="">
					  	</div>	
					  	<div id="view_botonArchivo">

					  	</div>
					</div>
					<input type="hidden" id="txt_nombrearchivo" name="txt_nombrearchivo" class="form-control input-sm" readonly="true" />	
					<input type="hidden" id="txt_nombreoriginal" name="txt_nombreoriginal" class="form-control input-sm" readonly="true" />
				</div>
	         </div>
         </form>                                 
    </div>
</div>

<style>
	.dropzone {
		background: #fff;
		border: 2px dashed #007bff;
		border-radius: 5px;
		padding: 10px 0px 0px 0px;		
	}

	.dz-message {
		color: #999;
	}

	.dz-message:hover {
		color: #464646;
	}

	.dz-message h3 {
		font-size: 200%;
		margin-bottom: 15px;
	}
</style>

	<script>
		//var cadena = document.getElementById("txt_cadena").value;
        var cadena = 1;
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("#Dz_documento", {
			url: "CUploadDocumento",
			acceptedFiles: ".xlsx",
			maxFilesize: 50, //MB
			maxFiles: 1,
			timeout: 3000000,			
			dictRemoveFile: 'Eliminar Archivo',
			dictFileTooBig: 'Tamaño de archivo ({{filesize}}MiB). Máximo Permitido: {{maxFilesize}}MiB.',
			dictCancelUpload : "Cancelar subida",
			dictInvalidFileType: "No puedes cargar este tipo de archivo",
         	dictResponseError: '¡Error al cargar el archivo!',           
			params: {	           
	            cadena  : cadena
			},
			maxfilesexceeded: function(file) {
		        this.removeAllFiles();
		        this.addFile(file);
		    },
			addRemoveLinks: true,
			success : function(file, response){
	        	var obj = jQuery.parseJSON(response);
            	if(obj.estado == true) {            		
            		$(".dz-success-mark").html('<i class="far fa-check-circle fa-5x text-success"></i>');
  					$(".dz-error-mark").css("display", "none");
            		$("#txt_nombrearchivo").val(obj.nombre);
            		$("#txt_nombreoriginal").val(file.name);
				    this.defaultOptions.success(file);
				   //	$("#view_botonArchivo").html('<a type="button" class="badge bg-success text-white btn_modalVerPdf" title="Ver Archivo"><i class="far fa-file-pdf fa-lg"></i> Ver Archivo</a>');

			    }else{
			    	$(file.previewElement).addClass("dz-error").find('.dz-error-message').text(obj.error);
	            	$(".dz-error-mark").html('<i class="far fa-times-circle fa-5x text-danger"></i>');
	  				$(".dz-success-mark").css("display", "none");
			       // this.defaultOptions.error(file, 'Ocurrió un error al cargar archivo');  
			    }
	    	},
	    	error: function (file, response) {	    	 
	    		$(file.previewElement).addClass("dz-error").find('.dz-error-message').text(response);
            	$(".dz-error-mark").html('<i class="far fa-times-circle fa-5x text-danger"></i>');
  				$(".dz-success-mark").css("display", "none");
        	},	    	
			removedfile: function(file) {
				var nameOriginal = file.name;
				var nameArchivo=$("#txt_nombrearchivo").val();
				if(nameOriginal==$("#txt_nombreoriginal").val()){
					$.ajax({
						type: "post",			
						url: "CRemoveDocumento",
						data: { file: nameArchivo, cadena: cadena },
						dataType: 'json',
						success: function (data) { 						
							if(data.estado==true){
								$("#txt_nombrearchivo").val("");
								//$("#view_botonArchivo").html('');
								$("#txt_nombreoriginal").val('');
							}else{
								$("#txt_nombrearchivo").val("");
								//$("#view_botonArchivo").html('');
								$("#txt_nombreoriginal").val('');
							}	
							
						}
					});	
				}			
				// remove the thumbnail
				var previewElement;
				return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
			},
			init: function() {
				/*this.on("success", function(file, response) {
                	var obj = jQuery.parseJSON(response)
                	console.log(obj);
            	})*/				
			}
		});

	
	</script>
