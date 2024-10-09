let dataModalidades;


$(document).ready(function () {

	//https://didesweb.com/jquery/ejecutar-funciones-jquery-url/
	var act = {
		rut: {},
		pag: function (url, fun) {
			this.rut[url] = fun;
		},
		lan: function () {
			jQuery.each(this.rut, function (par) {
				if (location.href.match(par)) {
					this();
				}
			});
		}
	}

	act.pag('admin/auxiliares/grupoinscripcion', function () {
		parametros = {
			tipoCarga: 0,
			idPer: null,
			idPro: null,
		}
		VListarGrupoInscripcion(parametros);
		opt_periodo();
		opt_tipoProceso();
		btn_modalNuevoGrupoInscripcion();
		opt_renderNivelModal();
		btn_agregarNuevoGrupoInscripcion();
		btn_eliminarAccion();
	});

	act.lan();
});


var VListarGrupoInscripcion = function (parametros) {
	$.ajax({
		url: window.AppMain.url + '/admin/auxiliares/grupoinscripcion/VListarGrupoInscripcion',
		method: 'POST',
		data: parametros,
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje);
		},
		success: function (data) {
			$.unblockUI();
			try {
				var data = jQuery.parseJSON(data);
				if (data.link === undefined) {
					ToastError.fire({ title: data.error });
				} else {
					SwalErrorCenter.fire({
						html: "<b class='h4'>" + data.error + "</b>"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = data.link;
						}
					})
				}
			} catch (err) {
				$("#view_listarGrupoInscripcion").html(data);
				tabla = $('#tb_listarGrupoInscripcion').DataTable({
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

var opt_periodo = function () {
	$('body').off('change', '#opt_periodo');
	$('body').on('change', '#opt_periodo', function (event) {
		idPer = $("#opt_periodo").val();
		idPro = $("#opt_tipoProceso").val();
		parametros = {
			tipoCarga: 1,
			idPer: idPer,
			idPro: idPro,
		}
		VListarGrupoInscripcion(parametros);
	});
}

var opt_tipoProceso = function () {
	$('body').off('change', '#opt_tipoProceso');
	$('body').on('change', '#opt_tipoProceso', function (event) {
		idPer = $("#opt_periodo").val();
		idPro = $("#opt_tipoProceso").val();
		parametros = {
			tipoCarga: 1,
			idPer: idPer,
			idPro: idPro,
		}
		VListarGrupoInscripcion(parametros);
	});
}

var opt_renderModalidadModal = function () {

	const items = dataModalidades;
	const select = document.querySelectorAll('#opt_ModalidadModal');

	console.log(select);
	select.forEach(select => {
		let html = `<option value="" hidden>[SELECCIONE]</option>`;
		items.forEach(item => {
			html += `<option value="${item.mod_id}"> ${item.mod_nombre}</option>`;
		});
		select.innerHTML = html;
	});
}

var opt_renderNivelModal = function () {
	$('body').off('change', '#opt_ModalidadModal');
	$('body').on('change', '#opt_ModalidadModal', function () {

		const modalidad_id = $(this).val();

		const items = dataNiveles.filter(o => o.modalidad_mod_id === modalidad_id);

		const select = document.querySelectorAll('#opt_NivelModal');

		select.forEach(select => {
			let html = `<option value="" hidden>[SELECCIONE]</option>`;
			items.forEach(item => {
				html += `<option value="${item.niv_id}"> ${item.niv_descripcion}</option>`;
			});
			select.innerHTML = html;
		});
	});

}

var VNuevoGrupoInscripcion = function (parametros) {
	$.ajax({
		url: 'VNuevoGrupoInscripcion',
		method: 'POST',
		data: parametros,
		cache: 'false',
		// dataType: 'json',
		beforeSend: function () {
			$.blockUI(blockUIMensaje);
		},
		success: function (data) {
			$.unblockUI();
			try {

				var data = jQuery.parseJSON(data);
				if (data.link === undefined) {
					ToastError.fire({ title: data.error });
				} else {
					SwalErrorCenter.fire({
						html: "<b class='h4'>" + data.error + "</b>"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = data.link;
						}
					})
				}
			} catch (err) {
				$("#view_nuevoGrupoInscripcion").html(data);
				tabla = $('#tb_listarGrupoInscripcion').DataTable({
					"destroy": true,
					"ordering": false,
					"bAutoWidth": false,
					"oLanguage": dt_Idioma,
					"lengthMenu": [[-1], ["All"]],
					"dom": '<<t>>',
				});
				grupoArr = [];
				frm = '#frmMantenimientoGrupoInscripcion';
				opt_renderModalidadModal();

			}
		},
		error: function (jqXHR, textStatus, error) {
			$.unblockUI();
			SwalErrorServidor.fire();
		}
	});
}


var modal_nuevaGrupoInscripcion = function () { // nueva forma en bootstrap 5.0
	$('#modal_nuevaGrupoInscripcion').modal('show');
}

var btn_modalNuevoGrupoInscripcion = function () {
	$('body').off('click', '.btn_modalNuevoGrupoInscripcion');
	$('body').on('click', '.btn_modalNuevoGrupoInscripcion', function (e) {

		parametros = {
			valor: "ok"
		}
		VNuevoGrupoInscripcion(parametros);
		modal_nuevaGrupoInscripcion();

	});
}


var btn_agregarNuevoGrupoInscripcion = function () {
	$('body').off('click', '#btn_agregarNuevoGrupoInscripcion');
	$('body').on('click', '#btn_agregarNuevoGrupoInscripcion', function (e) {
		if ($("#frmMantenimientoGrupoInscripcion").valid()) {
			idModalidad = $("#opt_ModalidadModal").val();
			idNivel = $("#opt_NivelModal").val();
			especialidad = $("#opt_especialidad").val();
			idPeriodo = $("#opt_periodoModal").val();
			idProceso = $("#opt_tipoProcesoModal").val();

			console.log(idModalidad);
			console.log(idNivel);
			console.log(especialidad);
			console.log(idPeriodo);
			console.log(idProceso);

			if (!especialidad) {
				ToastError.fire({ title: 'El periodo es obligatorio.' });
			}
			if (!idProceso) {
				ToastError.fire({ title: 'El tipo de proceso es obligatorio.' });
			}
			else if (!idModalidad) {
				ToastError.fire({ title: 'La modalidad es obligatorio.' });
			}
			else if (!idNivel) {
				ToastError.fire({ title: 'El nivel es obligatorio.' });
			}
			else if (!especialidad) {
				ToastError.fire({ title: 'La especialidad es obligatorio.' });
			}

			else {
				parametros = {
					idModalidad: idModalidad,
					idNivel: idNivel,
					especialidad: especialidad,
					idPer: idPeriodo,
					idPro: idProceso
				}
				SwalConfirmacionCenter.fire({
					html: "¿Seguro(a) que desea <b class='text-primary h4'>registrar</b> esta información?"
				}).then((result) => {
					if (result.isConfirmed) {
						CAgregarNuevoGrupoInscripcion(parametros);
					}
				})
			}
		} else {
			ToastError.fire({ title: 'Formulario incompleto.' });
		}
	});
}



var CAgregarNuevoGrupoInscripcion = function (parametros) {
	$.ajax({
		url: 'CAgregarNuevoGrupoInscripcion',
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
			if (data.estado == true) {
				ToastSuccess.fire({ title: data.success });
				$('#modal_nuevaGrupoInscripcion').modal('hide');
				idPer = $("#opt_periodo").val();
				idPro = $("#opt_tipoProceso").val();
				parametros = {
					tipoCarga: 1,
					idPer: idPer,
					idPro: idPro,
				}
				VListarGrupoInscripcion(parametros);
			} else {
				if (data.link === undefined) {
					ToastError.fire({ title: data.error });
				} else {
					SwalErrorCenter.fire({
						html: "<b class='h4'>" + data.error + "</b>"
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

var eliminarGrupoInscripcion = function (idGin) {
	// Validar antes de eliminar
	validarGrupoInscripcion(idGin, function (data) {
		if (data.estado == true) {
			if (data.data > 0) {
				alertify.error('<b style="color:#fff;"> Hay ' + data.data + ' postulante/s registrados</b>');
			} else {
				// Eliminar si la validación pasa
				eliminarGrupo(idGin);
			}
		} else {
			alertify.error('<b style="color:#fff;">' + data.data + '</b>');
		}
	});
}

var eliminarGrupo = function (idGin) {
	var parame = {
		'idGin': idGin
	};


	SwalConfirmacionCenter.fire({
		html: "¿Seguro(a) que desea <b class='text-danger h4'>eliminar</b> esta información?"
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: 'eliminarGrupoInscripcion',
				method: 'POST',
				data: parame,
				cache: false,
				dataType: 'json',
				beforeSend: function () {
				},
				success: function (data) {
					if (data.estado == true) {
						idPer = $("#opt_periodo").val();
						idPro = $("#opt_tipoProceso").val();
						parametros = {
							tipoCarga: 1,
							idPer: idPer,
							idPro: idPro,
						}
						VListarGrupoInscripcion(parametros);

						alertify.success('<b style="color:#fff;">' + data.success + '</b>');
					} else {
						alertify.error('<b style="color:#fff;">' + data.error + '</b>');
					}
				},
				error: function (jqXHR, textStatus, error) {
					alert(error);
				}
			});

		}
	})


}

var validarGrupoInscripcion = function (idGin, callback) {
	var parame = {
		'idGin': idGin
	};

	$.ajax({
		url: 'validarGrupoInscripcion',
		method: 'POST',
		data: parame,
		cache: false,
		dataType: 'json',
		beforeSend: function () {
		},
		success: function (data) {
			if (typeof callback === 'function') {
				callback(data);
			}
		},
		error: function (jqXHR, textStatus, error) {
			alert(error);
		}
	});
}

var btn_eliminarAccion = function () {
	$('body').off('click', '.btn_eliminarAccion');
	$('body').on('click', '.btn_eliminarAccion', function (e) {

		idGin = $(this).attr("idGin");

		eliminarGrupoInscripcion(idGin);

	});
}

