$(document).ready(function () {
  $("#searchInput").keyup(function () {
    var query = $(this).val();

    //console.log('Realizando búsqueda con la consulta:', query);

    if (query != "") {
      $.ajax({
        url: "../buscar.php",
        method: "POST",
        data: { query: query },
        dataType: "json",
        success: function (data) {
          //console.log('Resultados de búsqueda recibidos:', data);
          mostrarResultados(data);
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", error);
          console.log("JSON:", data);
        },
      });
    } else {
      $("#dropdownMenu").empty().hide();
      //console.log('La consulta está vacía, ocultando el dropdown.');
    }
  });

  function mostrarResultados(resultados) {
    var dropdown = $("#dropdownMenu");
    dropdown.empty().show();
    if (resultados && resultados.length > 0) {
      // Construir la tabla de resultados
      var tableHtml = '<div class="table-responsive"><table class="table">';
      tableHtml += "<thead>";
      tableHtml += "<tr>";
      tableHtml += '<th scope="col" style="width: 15%">Número de orden</th>';
      tableHtml += '<th scope="col" style="width: 15%">Fecha</th>';
      tableHtml += '<th scope="col" style="width: 35%">Descripción</th>';
      tableHtml += '<th scope="col" style="width: 15%">Responsable</th>';
      tableHtml += '<th scope="col" style="width: 35%">Establecimiento</th>';
      tableHtml += "</tr>";
      tableHtml += "</thead>";
      tableHtml += "<tbody>";
      $.each(resultados, function (i, resultado) {
        tableHtml +=
          '<tr class="fila-orden" data-numero="' + resultado.ot_id + '">';
        tableHtml += "<td>" + resultado.ot_id + "</td>";
        tableHtml += "<td>" + resultado.Fecha + "</td>";
        tableHtml += "<td>" + resultado.Descripcion + "</td>";
        tableHtml += "<td>" + resultado.Responsable + "</td>";
        tableHtml += "<td>" + resultado.Establecimiento + "</td>";
        tableHtml += "</tr>";
      });
      tableHtml += "</tbody>";
      tableHtml += "</table></div>";
      dropdown.append(tableHtml);

      // Agregar evento de clic a las filas de la tabla
      $(".fila-orden").click(function () {
        var numeroOrden = $(this).data("numero");
        $("#searchInput").val(numeroOrden);
        dropdown.hide();
      });
    } else {
      dropdown.append(
        '<a class="dropdown-item" href="#">No se encontraron resultados</a>'
      );
    }
  }
});
