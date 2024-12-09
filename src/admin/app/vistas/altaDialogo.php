<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>

<main><!-- Contenido por Pablo -->
    <a href="index.php?c=escenario&m=formularioObtenerEscenario">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_formAltaDialogo">
        <h1 class="title">Alta de Diálogo</h1>
        <h3 class="subtitle">Decisiones de Vida</h3>

        <form class="formAltaDialogo" name="form" action="" method="">

            <label for="escenario">Escenario Elegido:</label>
            <input type="text" placeholder="<?php echo $datos['escenarios'][1]; ?>" disabled>
            <input type="text" value="<?php echo $datos['escenarios'][0]; ?>" hidden>

            <label for="nombre" class="formAltaDialogo-label">Nombre del Diálogo:</label>
            <input type="text" placeholder="Nombre" name="nombre">

            <label for="colisiones" class="formAltaDialogo-label">Colisiones:</label>
            <table class="mapa">
                <tbody>
                    <script>
                        for (let i = 0; i < 10; i++) {
                            document.write('<tr>'); // Crear una nueva fila
                            for (let j = 0; j < 12; j++) {
                                let rowLabel = String.fromCharCode(65 + i); // Convertir el índice de fila a letra (A, B, C, ...)
                                let colLabel = j + 1; // Índice de columna (1, 2, 3, ...)
                                let cellLabel = rowLabel + colLabel; // Combinar fila y columna (A1, A2, B1, B2, ...)
                                // Crear una celda con atributos personalizados de fila y columna, y una función onclick
                                document.write(`<td data-row="${i}" data-col="${j}" class="celdas">${cellLabel}</td>`);
                            }
                            document.write('</tr>'); // Cerrar la fila
                        }
                    </script>
                </tbody>
            </table>
            <input type="text" name="colisionElegida" placeholder="A2">

            <label for="listaNPC" class="formAltaDialogo-label">Selecciona un NPC:</label>
            <select name="listaNPC" id="listaNPC" class="formAltaDialogo-control">
                <option hidden disabled selected>- Elige NPC -</option>
                <?php

                    // Recorremos la lista de NPCs y crear una opción para cada uno
                    for ($i = 0; $i < count($datos['npcs']); $i++) {
                        $npc = $datos['npcs'][$i];
                        echo "<option value='" . $npc['idNPC'] . "#" . $npc['nombreNPC'] . "'>" . $npc['nombreNPC'] . "</option>";
                    }
        
                ?>
            </select>

            <label for="mensaje" class="formAltaDialogo-label">Mensaje:</label>
            <input type="text" placeholder="Mensaje" name="mensaje">

            <label for="respuesta1" class="formAltaDialogo-label">Respuesta 1:</label>
            <input type="text" placeholder="Respuesta 1" name="respuesta1">

            <label for="respuesta2" class="formAltaDialogo-label">Respuesta 2:</label>
            <input type="text" placeholder="Respuesta 2" name="respuesta2"><br/>
            
            <button type="submit" class="btn-submit">Dar de alta</button><!--Botón para enviar el formulario y dar de alta un personaje-->
        </form>
    </div>
</main>

<?php include ASSETS_PATH . 'footer.php'; ?>
