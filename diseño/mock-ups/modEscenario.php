

<main><!-- Contenido por Pablo -->
    <a href="index.php?c=escenario&m=formularioObtenerEscenario">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_formAltaDialogo">
        <h1 class="title">Modificación de Escenario</h1>
        <h3 class="subtitle">Decisiones de Vida</h3>

        <form id="formularioAltaDialogo" class="formAltaDialogo">

            <label for="escenario">Nombre Escenario:</label>
            <input type="text" placeholder="nombreEscenario" disabled><br/>
            <input type="text" name="nombreEscenario" value="<?php echo $datos['escenarios'][0]; ?>" hidden><br/>

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" placeholder="mensaje" name="mensajeNarrativo"><br/><br/>

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
            <input type="text" name="casilla" placeholder="A2"><br/><br/>
            
            <input type="submit" value="Modificar Escenario"></input>
        </form>
    </div>
</main>
<script type="module" src="js/vistas/altaDialogo.js"></script>

