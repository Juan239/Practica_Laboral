jQuery(document).ready(function(){
    jQuery(".dropdown-item").click(function(){
        var selectedOption = jQuery(this).val();
        console.log(selectedOption);
        jQuery.ajax({
            url: "../ajaxInforme.php",
            method: "POST",
            data: { option: selectedOption },
            success: function(response){
                jQuery("#formularioSeleccionado").html(response);
                obtenerFechaActual();
            }
        });
    });
});



function obtenerFechaActual() {
    var now = new Date();
    var fechaActual = now.toISOString().slice(0, 10);
    document.getElementById('fecha').value = fechaActual;
  }

  function selectTipoInforme(id, nombre) {
    document.getElementById("id_tipoInforme").value = id;
    document.getElementById("dropdownInforme").innerText = nombre;
}

