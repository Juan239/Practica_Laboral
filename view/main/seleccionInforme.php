<?php
    require_once "../../database/verificarSesiones.php";
    require_once "../../model/tipoInformeModel.php";
    
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes</title>
    <link href="../css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="fondo">
  <header>

    <!--Barra de navegacion-->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #169db2;">
    <div class="container-fluid">
        <span class="navbar-brand">DAEM</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="busqueda.php">Busqueda<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="seleccionInforme.php">Informes</a>
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
  <br>

  <input type="hidden" name="id_tipoInforme" id="id_tipoInforme">
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="dropdown">
        <button id="dropdownInforme" class="btn btn-info btn-lg dropdown-toggle d-flex justify-content-between align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 500px;">
          Seleccione el informe que quiere hacer
          <span>
            <i class="fas fa-chevron-down"></i>
          </span>
        </button>
        <div class="dropdown-menu" style="width: 100%;">
          <!-- Contenido del dropdown -->
          <?php
          $tipoInforme = new tipoInforme();
          $result = $tipoInforme->listarTipoInformes();
          // Aquí colocamos el bucle while para iterar sobre los datos y generar las opciones del dropdown
          while ($row = $result->fetch_assoc()) {
            //Recordar que si se cambia de BD hay que cambiar los valores de aca por como salen en la BD
            echo '<button class="dropdown-item" type="button" value="' . $row["inf_id"] . '" onclick="selectTipoInforme(\'' . $row["inf_id"] . '\', \'' . $row["inf_nombre"] . '\')">' . $row["inf_nombre"] . '</button>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>





<div id="formularioSeleccionado"></div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/scripts.js"></script>
<script src="../js/seleccionInforme.js"></script>
</body>
</html>
