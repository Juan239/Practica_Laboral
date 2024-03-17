<?php
    require_once "../database/verificarSesiones.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica</title>
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="js/scripts.js"></script>
</head>
<body class="fondo">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: rgb(77, 77, 77);">
        <div class="container-fluid">
            <span class="navbar-brand">DAEM</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="busqueda.php">Busqueda<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="informes.php">Informes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes.php">Reportes</a>
                    </li>
                </ul>
                <div class="ml-auto d-flex">
                    <?php
                    //session_start();
                    if (isset($_SESSION["nombre_usuario"])) {
                        echo '<a class="nav-link text-light mr-3">Bienvenido, ' . $_SESSION["nombre_usuario"] . '</a>';
                        echo '<a class="btn btn-outline-light" href="../controller/logout.php">Cerrar sesión</a>';
                    } else {
                        echo '<a class="btn btn-outline-light" href="login.php">Iniciar sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

  </header>
  
    
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12"> <!-- Cambiado a col-md-12 para ocupar todo el ancho -->
            <h2 class="text-center">Buscar un informe específico</h2><br>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Ingresa el número de orden">
            </div>
        </div>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
