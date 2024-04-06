$(document).ready(function () {
  $('.table').DataTable(
    {
      "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" // Ruta al archivo de traducción
      },
      "order": [[0, 'desc']]
    }
  );

  $('#postularModal').on('show.bs.modal', function (event) {
    let obj = $(event.relatedTarget);
    let conId = obj.data('conid');
    let conTitle = obj.data('contitle');
    $('.modal-title').text("DETALLE DE LA CONVOCATORIA: " + conTitle);
    const formData = new FormData();
    formData.append('idConv', conId);
    $.ajax({
      url: window.AppMain.url + 'web/convocatorias/detailConvocatoriaGrupoInscripcion',
      method: 'POST',
      dataType: 'json',
      data: formData,
      processData: false,
      contentType: false,
    })
      .done(function (data) {
        if (!data) {
          // sweet2.show({type:'error', html: message});
          return;
        }
        else {

          let modalBody = $('.modal-body');
          modalBody.empty();
          let table = $('<table class="table"></table>');
          let tableHeader = '<thead><tr><th>Modalidad</th><th>Nivel</th><th>Especialidad</th><th>CONVOCATORIA</th><th>RECLAMO</th></tr></thead>';
          table.append(tableHeader);
          console.log(data);
          data.data.forEach(function (grupo) {
            let row = '<tr><td>' + grupo.mod_nombre + '</td><td>' + grupo.niv_descripcion + '</td><td>' + grupo.esp_descripcion + '</td><td><a target="_blank" class="btn btn-sm btn-danger" href="' + window.AppMain.url + 'web/convocatorias/' + grupo.con_id + '/inscripciones/' + grupo.grupo_inscripcion_gin_id + '">POSTULAR</a></td><td><a target="_blank" class="btn btn-sm btn-danger" href="' + window.AppMain.url + 'web/convocatorias/' + grupo.con_id + '/reclamo/' + grupo.grupo_inscripcion_gin_id + '">POSTULAR</a></td></tr>';
            table.append(row);
          });

          let tableContainer = $('<div class="table-responsive"></div>');
          tableContainer.append(table);

          modalBody.append(tableContainer);
        }
      })
      .fail(function (xhr, status, error) {
        swal2.show({ icon: 'error', text: error });
      })


  });

});
