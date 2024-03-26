
<form  method="post" action="../../controller/ordenTrabajoController.php" class="formulario">    
      <!--Titulo orden de trabajo-->
        <div class="text-center">
          <h2>Orden de trabajo</h2>
        </div>
        <br>
        
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
                require_once "../model/ordenTrabajoModel.php";
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