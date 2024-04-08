$(document).ready(function () {
  $(".table").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
    },
    order: [
      [0, "desc"]
    ],
  });

  $("#postularModal").on("show.bs.modal", function (event) {
    let obj = $(event.relatedTarget);
    let conId = obj.data("conid");
    let conTitle = obj.data("contitle");
    $(".modal-title").text("DETALLE DE LA CONVOCATORIA: " + conTitle);
    const formData = new FormData();
    formData.append("idConv", conId);
    $.ajax({
        url: window.AppMain.url +
          "web/convocatorias/detailConvocatoriaGrupoInscripcion",
        method: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
      })
      .done(function (result) {
        if (!result) {
          // sweet2.show({type:'error', html: message});
          return;
        } else {

          let data = result[0];
          let unixDate = result[1];
   
           let modalBody = $(".modal-body");
          modalBody.empty();
          let table = $('<table class="table"></table>');
          let tableHeader =
            "<thead><tr><th>Modalidad</th><th>Nivel</th><th>Especialidad</th><th>CONVOCATORIA</th><th>RECLAMO</th></tr></thead>";
          table.append(tableHeader);
           
          let fecha = new Date(unixDate * 1000);
          let year = fecha.getFullYear();
          let month = String(fecha.getMonth() + 1).padStart(2, '0');
          let day = String(fecha.getDate()).padStart(2, '0');
          let hours = String(fecha.getHours()).padStart(2, '0');
          let minutes = String(fecha.getMinutes()).padStart(2, '0');
          let fechaFormateada = `${year}-${month}-${day} ${hours}:${minutes}`;

          data.data.forEach(function (grupo) {

            let validateFechaConvocatoria;
            let validateFechaReclamo;

            validateFechaConvocatoria =  grupo['con_fechainicio'] + ' ' + grupo['con_horainicio'].slice(0, 5)  <=   fechaFormateada   && fechaFormateada <= grupo['con_fechafin'] + ' ' + grupo['con_horafin'].slice(0, 5) ;

            if (grupo['con_fechafin_reclamo']) {
              validateFechaReclamo = grupo['con_fechainicio_reclamo'] + ' ' + grupo['con_horainicio_reclamo'].slice(0, 5) <= fechaFormateada && fechaFormateada <= grupo['con_fechafin_reclamo'] + ' ' + grupo['con_horafin_reclamo'].slice(0, 5);
            }
            let row =
              "<tr><td>" +
              grupo.mod_nombre +
              "</td><td>" +
              grupo.niv_descripcion +
              "</td><td>" +
              grupo.esp_descripcion +
              '</td><td><a target="_blank" class="btn btn-sm btn-danger ' + (!validateFechaConvocatoria ? 'disabled' : '') + '" href="' +
              window.AppMain.url +
              "web/convocatorias/" +
              grupo.con_id +
              "/inscripciones/" +
              grupo.grupo_inscripcion_gin_id +
              '">POSTULAR</a></td><td><a target="_blank" class="btn btn-sm btn-danger ' + (!validateFechaReclamo ? 'disabled' : '') + '" href="' +
              window.AppMain.url +
              "web/convocatorias/" +
              grupo.con_id +
              "/reclamo/" +
              grupo.grupo_inscripcion_gin_id +
              '">POSTULAR</a></td></tr>';
            table.append(row);
          });

          let tableContainer = $('<div class="table-responsive"></div>');
          tableContainer.append(table);

          modalBody.append(tableContainer);
        }
      })
      .fail(function (xhr, status, error) {
        swal2.show({
          icon: "error",
          text: error
        });
      });
  });
});
