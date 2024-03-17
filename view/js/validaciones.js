document.getElementById("btnIniciarSesion").addEventListener("click", function(event) {
    var usuario = document.getElementById("inputUsuario").value;
    var contrasena = document.getElementById("inputContrasena").value;

    if (usuario === "" || contrasena === "") {
        alert("Ambos campos deben estar llenos.");
        event.preventDefault(); // Detiene la acción predeterminada del botón
    } else {
        // Si los campos no están vacíos, envía el formulario
        document.querySelector('.formularioInicioSesion').submit();
    }
});
