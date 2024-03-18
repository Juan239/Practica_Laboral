<?php
    require_once "../database/verificarSesiones.php";
    require_once "../model/ordenTrabajoModel.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes</title>
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="js/scripts.js"></script>
</head>
<body class="fondo">
  <header>

    <!--Barra de navegacion-->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: rgb(77, 77, 77);">
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
  <br>

  <form  method="post" action="../controller/ordenTrabajoController.php" class="formulario">    
      <!--Titulo orden de trabajo-->
        <div class="text-center">
          <h2>Orden de trabajo</h2>
        </div>
        <br>
        
        <!--Input del numero de orden      Este quedaria eliminado porque se cambio a AUTO_INCREMENT en la base de datos
        <div class="form-group">
          <label for="inputNumeroOrden">Número de orden</label>
          <input type="text" class="form-control" id="inputNumeroOrden" name="numeroOrden" placeholder="Ingrese el número de orden">
        </div>-->
       
        <!--Input de la fecha-->
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input type="date" class="form-control" id="fecha" name="fecha">
        </div>
    
        <!--Input del establecimiento-->
        <!--Luego hay que cambiarlo a un dropdown con los establecimientos que esten en la base de datos-->
        <input type="hidden" name="id_establecimiento" id="id_establecimiento">
        <div class="dropdown">
            <label for="dropdownEstablecimiento">Seleccione el establecimiento</label>
            <button id="dropdownEstablecimiento" class="btn dropdown-toggle d-flex justify-content-between align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                <span id="nombre_establecimiento_seleccionado">Seleccione el establecimiento</span>
                <span class="ml-auto">
                    <i class="fas fa-chevron-down"></i>
                </span>
            </button>
            <div class="dropdown-menu" style="width: 100%;">
                <?php
                $ordentrabajo = new ordenTrabajo("","","","","","","");
                $result = $ordentrabajo->mostrarEscuelas();
                // Aquí colocamos el bucle while para iterar sobre los datos y generar las opciones del dropdown
                while ($row = $result->fetch_assoc()) {
                  //Recordar que si se cambia de BD hay que cambiar los valores de aca por como salen en la BD
                    echo '<button class="dropdown-item" type="button" value="' . $row["est_id"] . '" onclick="selectOption(\'' . $row["est_id"] . '\', \'' . $row["est_nombre"] . '\')">' . $row["est_nombre"] . '</button>';
                }
                ?>
            </div>
        </div>
          <br>
        <!--Input de la intervencion-->
        <div class="form-group">
          <label>Intervención</label>
          <br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="intervencion" id="opcionCorrectivo" value="1">
            <label class="form-check-label" for="opcionCorrectivo">
              Correctivo
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="intervencion" id="opcionPreventivo" value="2">
            <label class="form-check-label" for="opcionPreventivo">
              Preventivo
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="intervencion" id="opcionParcial" value="3">
            <label class="form-check-label" for="opcionParcial">
              Parcial
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="intervencion" id="opcionIntegral" value="4">
            <label class="form-check-label" for="opcionIntegral">
              Integral
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="intervencion" id="opcionCompleta" value="5">
            <label class="form-check-label" for="opcionCompleta">
              Completa
            </label>
          </div>
        </div>
    
        <!--Input de la descripcion-->
        <div class="form-group">
          <label for="inputDescripcionProblema">Descripción del problema</label>
          <textarea class="form-control" name="descripcion" id="inputDescripcionProblema" rows="3" oninput="actualizarTextArea(this)" placeholder="Describa el problema" style="resize: none; overflow-y: hidden;"></textarea>
        </div>
      
        <!--Input de las observaciones-->
        <div class="form-group">
          <label for="inputObservaciones">Observaciones</label>
          <textarea class="form-control" name="observaciones" id="inputObservaciones" rows="4" oninput="actualizarTextArea(this)" placeholder="Ingrese sus observaciones" style="resize: none; overflow-y: hidden;"></textarea>
        </div>
        <br>

        <!--Boton guardar informe-->
        <div class="d-flex justify-content-center">
        <button type="submit" name="btnGuardarInforme" class="btn btn-primary" style="width: 200px;">Guardar</button>
    </div>
  </form>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
