<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>

<main> <!-- Contenido por Pablo -->
    <a href="index.php">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_formAltaDialogo">
        <h1>Alta de Diálogo</h1><!--Titulo de la página-->
        <h3>Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="formAltaDialogo" name="formAltaDialogo" method="post" action="index.php?c=dialogo&m=formularioAltaDialogo">

            <label for="listaEscenario" class="formAltaDialogo-label">Selecciona un Escenario:</label>
            <select name="listaEscenario" id="listaEscenario" class="formAltaDialogo-control">
                <option hidden disabled selected>- Elige Escenario -</option>
                <?php

                    foreach ($datos as $escenario) {
                        echo "<option value='" . $escenario['idEscenario'] . "#" . $escenario['nombreEscenario'] . "'>" . $escenario['nombreEscenario'] . "</option>";
                    }

                ?>
            </select>
            
            <input type="submit" class="btn-submit" value="Siguiente">
        </form>
    </div>
</main>

<?php include ASSETS_PATH . 'footer.php'; ?>
