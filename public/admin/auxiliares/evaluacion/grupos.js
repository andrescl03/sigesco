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

	act.pag('admin/auxiliares/evaluaciones/convocatorias/', function () {
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

		let con_id = e.target.getAttribute('data-id');
		sweet2.show({
			type: 'question',
			html: '¿Estás seguro que desea procesar los expedientes para esta convocatoria?',
			showCancelButton: true,
			onOk: () => {
				sweet2.loading();
				const formData = new FormData();
				formData.append('con_id', con_id);

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
	}).done(function (data) {
		sweet2.loading(false);
		if (data && data.status == 200) {
			sweet2.show({
				type: 'success',
				html: "SE PROCESARON: <b>" + data.response.cantidad_procesados + " EXPEDIENTES</b> </br> NO SE PROCESARON: <b>" + data.response.cantidad_no_procesados + " EXPEDIENTES</b>",
			});
		}
	}).fail(function (xhr, status, error) {
		sweet2.show({ type: 'error', text: error });
	});
}