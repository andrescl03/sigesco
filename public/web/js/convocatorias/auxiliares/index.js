$(document).ready(function () {

  // Mostrar el modal de información de postulación al cargar la página
  $('#showInformacionPostulacion').modal('show');

  // Inicializar DataTable con configuraciones de idioma y orden
  initializeDataTable();

  // Manejar la apertura del modal de postulación
  $('#postularModal').on('show.bs.modal', handlePostularModal);

  var groupsModal1 = document.getElementById('groupsModal');
  $('#groupsModal').on('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var groupsHtml = button.getAttribute('data-groups');
      var modalTitle = button.getAttribute('data-title');

      var modalTitleElement = groupsModal1.querySelector('.modal-title');
      var tableBodyElement = document.getElementById('groupsTableBody'); // Cambio de groupsModal.querySelector a document.getElementById

      if (modalTitleElement && tableBodyElement) {
          modalTitleElement.textContent = "Número de convocatoria: " + modalTitle;
          tableBodyElement.innerHTML = groupsHtml;
      } else {
          console.error("Elementos del modal no encontrados.");
      } 
  });
 
});
 
// Función para inicializar la tabla DataTable
function initializeDataTable() {
  $(".table").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    },
    order: [
      [0, "desc"]
    ],
  });
}

// Función para manejar la apertura del modal de postulación
function handlePostularModal(event) {
  var target = $(event.relatedTarget);
  var conId = target.data("conid");
  var conTitle = target.data("contitle");
  updateModalTitle(conTitle);

  fetchConvocatoriaDetails(conId)
    .done(processConvocatoriaDetails)
    .fail(handleAjaxError);
}

// Función para actualizar el título del modal
function updateModalTitle(conTitle) {
  $(".modal-title").text("DETALLE DE LA CONVOCATORIA: " + conTitle);
}

// Función para obtener los detalles de la convocatoria
function fetchConvocatoriaDetails(conId) {
  var formData = new FormData();
  formData.append("idConv", conId);

  return $.ajax({
    url: window.AppMain.url + "web/convocatorias/detailConvocatoriaGrupoInscripcion",
    method: "POST",
    dataType: "json",
    data: formData,
    processData: false,
    contentType: false,
  });
}

// Función para procesar los detalles de la convocatoria
function processConvocatoriaDetails(result) {
  if (!result) {
    return;
  }

  var data = result[0];
  var unixDate = result[1];
  var fechaFormateada = formatUnixDate(unixDate);
  var modalBody = $("#postularModal .modal-body");
  modalBody.empty();

  var table = createConvocatoriaTable(data, fechaFormateada);
  var tableContainer = $('<div class="table-responsive"></div>');
  tableContainer.append(table);
  modalBody.append(tableContainer);
}

// Función para formatear la fecha Unix
function formatUnixDate(unixDate) {
  var fecha = new Date(unixDate * 1000);
  var year = fecha.getFullYear();
  var month = String(fecha.getMonth() + 1).padStart(2, '0');
  var day = String(fecha.getDate()).padStart(2, '0');
  var hours = String(fecha.getHours()).padStart(2, '0');
  var minutes = String(fecha.getMinutes()).padStart(2, '0');
  return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes;
}

// Función para crear la tabla de convocatoria
function createConvocatoriaTable(data, fechaFormateada) {
  var table = $('<table class="table"></table>');
  var tableHeader = 
    '<thead>' +
      '<tr>' +
        '<th>Modalidad</th>' +
        '<th>Nivel</th>' +
        '<th>Especialidad</th>' +
        '<th>CONVOCATORIA</th>' +
        '<th>RECLAMO</th>' +
      '</tr>' +
    '</thead>';
  table.append(tableHeader);

  data.data.forEach(function (grupo) {
    var row = createTableRow(grupo, fechaFormateada);
    table.append(row);
  });

  return table;
}

// Función para crear una fila de la tabla
function createTableRow(grupo, fechaFormateada) {
  var validateFechaConvocatoria = isWithinDateRange(grupo['con_fechainicio'], grupo['con_horainicio'], grupo['con_fechafin'], grupo['con_horafin'], fechaFormateada);
  var validateFechaReclamo = grupo['con_fechafin_reclamo']
    ? isWithinDateRange(grupo['con_fechainicio_reclamo'], grupo['con_horainicio_reclamo'], grupo['con_fechafin_reclamo'], grupo['con_horafin_reclamo'], fechaFormateada)
    : false;

  return '<tr>' +
    '<td>' + grupo.mod_nombre + '</td>' +
    '<td>' + grupo.niv_descripcion + '</td>' +
    '<td>' + grupo.esp_descripcion + '</td>' +
    '<td>' +
      '<a target="_blank" class="btn btn-sm btn-danger ' + (!validateFechaConvocatoria ? 'disabled' : '') + '" href="' + window.AppMain.url + 'web/convocatorias/' + grupo.con_id + '/inscripciones/auxiliares/' + grupo.grupo_inscripcion_gin_id + '">' +
        'POSTULAR' +
      '</a>' +
    '</td>' +
    '<td>' +
      '<a target="_blank" class="btn btn-sm btn-danger ' + (!validateFechaReclamo ? 'disabled' : '') + '" href="' + window.AppMain.url + 'web/convocatorias/' + grupo.con_id + '/reclamo/' + grupo.grupo_inscripcion_gin_id + '">' +
        'POSTULAR' +
      '</a>' +
    '</td>' +
  '</tr>';
}

// Función para verificar si una fecha está dentro de un rango
function isWithinDateRange(fechaInicio, horaInicio, fechaFin, horaFin, fechaActual) {
  var fechaInicioCompleta = fechaInicio + ' ' + horaInicio.slice(0, 5);
  var fechaFinCompleta = fechaFin + ' ' + horaFin.slice(0, 5);
  return fechaInicioCompleta <= fechaActual && fechaActual <= fechaFinCompleta;
}

// Función para manejar errores de AJAX
function handleAjaxError(xhr, status, error) {
  swal2.show({
    icon: "error",
    text: error
  });
}
