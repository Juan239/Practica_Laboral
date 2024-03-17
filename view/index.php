<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="fondoLogin">


<?php
session_start();

// Verifica si hay un mensaje de error de sesión
if (isset($_SESSION["error_login"])) {
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error_login"] . '</div>';
    unset($_SESSION["error_login"]); // Limpia el mensaje de error de sesión
}
?>

    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <!--Falta colocar el action-->
            <form method="post" action="../controller/usuarioController.php" class="formularioInicioSesion">     
                <h2 class="text-center">Bienvenido</h2><br>
                <br>
                <!-- Imagen municipalidad-->
                <div class="form-group d-flex justify-content-center">
                    <img src="images/logoMunicipalidad.webp" alt="Imagen de usuario" style="height: 300px;"> <!-- Ajusta la ruta y el tamaño según necesites -->
                </div>
                
                <!--Input del nombre de usuario-->
                <div class="form-group">
                    <label for="inputUsuario">Nombre de usuario</label>
                    <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Ingrese su nombre de usuario">
                </div>
                
                <!--Input de la contraseña-->
                <div class="form-group">
                    <label for="inputContrasena">Contraseña</label>
                    <input type="password" class="form-control" id="inputContrasena" name="contrasena" placeholder="Ingrese su contraseña">
                </div>
                <br>
                <!--Boton iniciar sesión-->
                <div class="text-center">
                    <button type="button" class="btn btn-primary" id="btnIniciarSesion">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script src="js/validaciones.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
