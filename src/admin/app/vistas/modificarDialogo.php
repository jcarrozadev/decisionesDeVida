<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>

<main><!-- Contenido por Pablo -->
    <a href="index.php?c=dialogo&m=listarDialogos">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_formAltaDialogo">
        <h1 class="title">Modificar Diálogo</h1>
        <h3 class="subtitle">Decisiones de Vida</h3>

        <form class="formAltaDialogo" id="formModDialogo">

            <input type="text" name="idDialogo" value="<?php echo $datos['dgIdDialogo']?>" hidden>

            <label for="nombreDialogo" class="formAltaDialogo-label">Nombre del Diálogo:</label>
            <input type="text" id="nombre" value="<?php echo $datos['dgNombreDialogo']; ?>" name="nombreDialogo">

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
            <input type="text" id="casilla" name="casilla" value="<?php echo $datos['dgCasilla']; ?>">

            <label for="mensaje" class="formAltaDialogo-label">Mensaje:</label>
            <input type="text" id="mensaje" value="<?php echo $datos['dgMensaje']; ?>" name="mensaje">

            <label for="respuesta1" class="formAltaDialogo-label">Respuesta 1:</label>
            <input type="text" id="respuesta1" value="<?php echo $datos['rp1Mensaje']; ?>" name="respuesta1">
            <input type="text" name="idResp1" value="<?php echo $datos['rp1idRespuesta'] ?>" hidden>

            <label for="respuesta2" class="formAltaDialogo-label">Respuesta 2:</label>
            <input type="text" id="respuesta2" value="<?php echo $datos['rp2Mensaje'] ?>" name="respuesta2"><br/>
            <input type="text" name="idResp2" value="<?php echo $datos['rp2idRespuesta'] ?>" hidden>
            
            <input type="submit" class="btn-submit" value="Modificar Diálogo"></input>
        </form>
    </div>
</main>

<?php include ASSETS_PATH . 'modal.php'; ?>

<script src="js/vistas/modificarDialogo.js"></script>
<script src="js/vistas/modal.js"></script>

<?php include ASSETS_PATH . 'footer.php'; ?>
