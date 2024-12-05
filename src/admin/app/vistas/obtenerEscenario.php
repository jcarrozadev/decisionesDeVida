<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>

<main> <!-- Contenido por Pablo -->
    <a href="index.php">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_formAltaDialogo">
        <h1>Alta de Diálogo</h1><!--Titulo de la página-->
        <h3>Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="formAltaDialogo" name="formAltaDialogo">

            <label for="listaEscenario" class="formAltaDialogo-label">Selecciona un Escenario:</label>
            <select name="listaEscenario" id="listaEscenario" class="formAltaDialogo-control">
                <option hidden disabled selected>- Elige Escenario -</option>
                <?php

                    $escenarios = $controlador->listarEscenarios();

                    foreach ($escenarios as $escenario) {
                        echo "<option value='" . $escenario['idEscenario'] . "'>" . $escenario['nombreEscenario'] . "</option>";
                    }

                ?>
            </select>
            
            <button type="submit">Siguiente</button><!--Botón para enviar el formulario y dar de alta un personaje-->
        </form>
    </div>
</main>

<?php include ASSETS_PATH . 'footer.php'; ?>
