function selectOption(id, nombre) {
    document.getElementById("id_establecimiento").value = id;
    document.getElementById("nombre_establecimiento_seleccionado").innerText = nombre;
}


function actualizarTextArea(textarea) {
    textarea.style.height = 'auto'; 
    textarea.style.height = textarea.scrollHeight + 'px';
}

document.addEventListener('DOMContentLoaded', function () {
    var dropdownEstablecimiento = document.getElementById('dropdownEstablecimiento');
    var defaultOption = document.querySelector('.dropdown-item.default');

    if (defaultOption) {
        dropdownEstablecimiento.innerHTML = defaultOption.textContent + '<span class="ml-auto"><i class="fas fa-chevron-down"></i></span>';
    }

    dropdownEstablecimiento.addEventListener('show.bs.dropdown', function () {
        if (defaultOption) {
            selectOption(defaultOption.textContent.trim());
        }
    });
});


function obtenerFechaActual() {
    var now = new Date();

    var fechaActual = now.toISOString().slice(0, 10);

    document.getElementById('fecha').value = fechaActual;
  }
  window.onload = obtenerFechaActual;