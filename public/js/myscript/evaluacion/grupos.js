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

	act.pag('evaluacion/convocatoria', function () {
		procesarExpedientes();

		tabla = $('#tb_listarConvocatorias').DataTable({
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

var procesarExpedientes = function () {

	$('body').off('click', '.btn-procesar-expedientes');
	$('body').on('click', '.btn-procesar-expedientes', function (e) {

		let con_numero = e.target.getAttribute('data-id');

		sweet2.show({
			type: 'question',
			html: '¿Estás seguro que desea procesar los expedientes para esta convocatoria?',
			showCancelButton: true,
			onOk: () => {
				sweet2.loading();
				const formData = new FormData();
				formData.append('con_numero', con_numero);

				submitProcesarExpediente(formData);
			}
		});
	});

}

const submitProcesarExpediente = function (formData) {
	$.ajax({
		url: window.AppMain.url + 'api/mpv/procesar',
		method: 'POST',
		dataType: 'json',
		data: formData,
		processData: false,
		contentType: false,
	}).done(function ({ success, data, message }) {
		if (data.cantidad_procesados == 0) {
			sweet2.show({ type: 'error', html: "no se procesaron expedientes" });
			return;
		}
		sweet2.show({
			type: 'success',
			html: message,
			onOk: () => {
				sweet2.loading({ text: 'se procesaron' });
				window.location.reload();
			}
		});
	})
		.fail(function (xhr, status, error) {
			sweet2.show({ type: 'error', text: error });
		});


}