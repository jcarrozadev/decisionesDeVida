<!-- HTML Include Plantilla - Javier Arias Carroza -->
<?php include ASSETS_PATH . 'header.php'; ?>
<main>
    <a href="index.php?c=dialogo&m=listarDialogos">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>

    <div class="divForm">
        <h1>Acción de respuesta</h1>
        <h3>Decisiones de Vida</h3>

        <form id="formAccionRespuesta" action="guardarRespuestas.php" method="post"> <!--El action lleva a la página que guarda en la bbdd las respuestas con su acción-->
   
            <label for="dialogo">Diálogo</label>
            <?php
                echo "<input type=text value='" . $datos[0]['nombreDiálogo'] . "' disabled>" 
            ?>                    <br/>

            <label for="mensajeDialogo">Mensaje Dialogo</label>           
            <?php
                echo "<input type=text value='" . $datos[0]['mensaje'] . "' disabled>"
            ?>                  <br/>

            <div class="formRespuestaDiv">
                <label for="mensajeDialogo">Mensaje Respuesta 1</label>
                <?php
                    echo "<input type=text value='" . $datos[0]['mensajeRespuesta1'] . "' disabled>"
                ?>                                              <br/>                         

                <label for="dialogoHijo">Acción a otro Diálogo - Respuesta 1</label>       
                <select name="resp1Dialogo" id="dialogoHijo">
                    <option disabled selected>- Seleccione una opción o deje vacio -</option>
                    <?php
                        foreach ($datosDialogos as $dialogo) {
                            echo "<option value='" . $dialogo['idDialogo'] . "'>" . $dialogo['nombreDiálogo'] . "</option>";
                        }
                    ?>
                </select>                <br/>

                <label for="escenarioHijo">Acción a otro Escenario - Respuesta 1</label>       
                <select name="resp1Escenario" id="escenarioHijo">
                    <option disabled selected>- Seleccione una opción o deje vacio- </option>
                    <?php

                        foreach ($datosEscenarios as $escenario) {
                            echo "<option value='" . $escenario['idEscenario'] . "'>" . $escenario['nombreEscenario'] . "</option>";
                        }

                    ?>
                </select>                           <br/>

                <?php                                   
                /*Añadimos un campo para el id de la respuesta 1 con atributo "hidden" para que NO se vea visualmente pero se enviarán al procesar el envío del formulario*/
                  echo "<input type= 'text' name= 'idResp1' value='" . $datos[0]['idRespuesta1'] . "' hidden>"         
                ?>
            </div>
            <div class="formRespuestaDiv">
                <label for="mensajeDialogo">Mensaje Respuesta 2</label>
                <?php
                    echo "<input type=text value='". $datos[0]['mensajeRespuesta2'] . "' disabled>"
                ?>                                  <br/>                                       

                <label for="dialogoHijo">Acción a otro Diálogo - Respuesta 2</label>        
                <select name="resp2Dialogo" id="dialogoHijo">
                    <option disabled selected>- Seleccione una opción o deje vacio -</option>
                    <?php
                        foreach ($datosDialogos as $dialogo) {
                            echo "<option value='" . $dialogo['idDialogo'] . "'>" . $dialogo['nombreDiálogo'] . "</option>";
                        }
                    ?>
                </select>                     <br/>

                <label for="escenarioHijo">Acción a otro Escenario - Respuesta 2</label>        
                <select name="resp2Escenario" id="escenarioHijo">

                    <option disabled selected>- Seleccione una opción o deje vacio -</option>
                    <?php
                        foreach ($datosEscenarios as $escenario) {
                            echo "<option value='" . $escenario['idEscenario'] . "'>" . $escenario['nombreEscenario'] . "</option>";
                        }
                    ?>

                </select>
                <?php
                /*Añadimos un campo para el id de la respuesta 2 con atributo "hidden" para que NO se vea visualmente pero se enviarán al procesar el envío del formulario*/
                  echo "<input type='text'  name= 'idResp2' value='" . $datos[0]['idRespuesta2'] . "' hidden>"
                ?>
                
            </div>
            
            <input type="submit" value="Aplicar Acciones">
        </form>
    </div>
</main>
<?php include ASSETS_PATH . 'footer.php'; ?>