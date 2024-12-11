<?php include ASSETS_PATH . 'header.php'; ?>  
<main>
    <a href="index.php?c=escenario&m=mEscenario">
        <button class="boton_volver">Volver</button>
    </a>

    <div class="divForm">
        <h1>Modificación de Escenario</h1>
        <h3>Decisiones de Vida</h3>
        
        <form id="formModEscenario" method="POST" action="index.php?c=escenario&m=modificarEscenario&id=<?php echo intval($_GET['id']); ?>">
            <label for="escenario">Nombre Escenario:</label>
            <input type="text" name="nombreEscenario" placeholder="Nombre del Escenario" 
                    value="<?php echo htmlspecialchars($datos['nombreEscenario']); ?>" readonly>

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" name="mensajeNarrativo" placeholder="Mensaje Narrativo" 
                    value="<?php echo htmlspecialchars($datos['mensajeNarrativo']); ?>" readonly>

            <label for="imgEscenario">Imagen del Escenario:</label>
            <input type="file" id="imgEscenario" name="imgEscenario" disabled>

            <label for="colisiones" class="formAltaDialogo-label">Colisiones:</label>
            <table>
                <tbody>
                    <?php
                        for ($i = 0; $i < 10; $i++) { 
                            echo '<tr>'; 
                            for ($j = 0; $j < 12; $j++) { 
                                echo "<td class='celdaMovimiento' data-row='$i' data-col='$j'></td>";
                            }
                            echo '</tr>';
                        } 
                    ?>
                </tbody>
            </table>

            <label for="casilla">Casillas Seleccionadas:</label>
            <input type="text" name="casilla" id="casillaInput" readonly><br/><br/>
                        
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</main>

<script>
    const celdas = document.querySelectorAll('.celdaMovimiento');
    const inputCasilla = document.getElementById('casillaInput');
    const celdasSeleccionadas = [];

    celdas.forEach(celda => {
        celda.addEventListener('click', () => {
            const etiquetaCelda = `${celda.dataset.row},${celda.dataset.col}`;
            if (celda.classList.contains('seleccionada')) {
                celda.classList.remove('seleccionada');
                const indice = celdasSeleccionadas.indexOf(etiquetaCelda);
                if (indice !== -1) celdasSeleccionadas.splice(indice, 1);
            } else {
                celda.classList.add('seleccionada');
                celdasSeleccionadas.push(etiquetaCelda);
            }
            inputCasilla.value = celdasSeleccionadas.join('#');
        });
    });
</script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>
