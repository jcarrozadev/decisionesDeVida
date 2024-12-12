<?php include ASSETS_PATH . 'header.php'; ?>  
<main>
    <a href="index.php?c=escenario&m=mEscenario">
        <button class="boton_volver">Volver</button>
    </a>

    <div class="divForm">
        <h1>Modificación de Escenario</h1>
        <h3>Decisiones de Vida</h3>
        
        <form id="formModEscenario" action="index.php?c=escenario&m=modificarEscenario&id=<?php echo $datos['idEscenario']; ?>" method="POST" enctype="multipart/form-data">
            <label for="nombreEscenario">Nombre Escenario:</label>
            <input type="hidden" name="idEscenario" value="<?php echo $datos['idEscenario']; ?>">

            <input type="text" name="nombreEscenario" id="nombreEscenario" placeholder="Nombre del Escenario" 
                value="<?php echo htmlspecialchars($datos['nombreEscenario']); ?>" required>

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" name="mensajeNarrativo" id="mensajeNarrativo" placeholder="Mensaje Narrativo" 
                value="<?php echo htmlspecialchars($datos['mensajeNarrativo']); ?>" required>

            <label for="imgEscenario">Imagen del Escenario:</label>
            <input type="file" id="imgEscenario" name="imgEscenario">

            <label for="casillaInicio">Casilla de Inicio:</label>
            <input type="text" name="casillaInicio" id="casillaInicio" required
            value="<?php echo htmlspecialchars($datos['casillaInicio']); ?>">

            <label for="colisiones" class="formAltaDialogo-label">Colisiones:</label>
            <table>
                <tbody>
                    <?php
                        // Cargar casillas seleccionadas desde los datos
                        $casillasSeleccionadas = explode('#', $datos['casilla'] ?? '');
                        $casillasSeleccionadasMap = array_flip($casillasSeleccionadas); // Para búsqueda rápida

                        for ($i = 1; $i <= 10; $i++) { 
                            echo '<tr>'; 
                            for ($j = 1; $j <= 12; $j++) {
                                $columna = chr(64 + $j);
                                $fila = $i;
                                $coordenada = $columna . $fila;

                                $class = isset($casillasSeleccionadasMap[$coordenada]) ? 'seleccionada' : '';
                                echo "<td class='celdaMovimiento $class' data-coordenada='$coordenada'>$coordenada</td>";
                            }
                            echo '</tr>';
                        } 
                    ?>
                </tbody>
            </table>

            <label for="casillaInput">Casillas Seleccionadas:</label>
            <input type="text" name="casilla" id="casillaInput" value="<?php echo htmlspecialchars($datos['casilla'] ?? ''); ?>" readonly><br/><br/>
                        
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

<script>
    const celdas = document.querySelectorAll('.celdaMovimiento');
    const inputCasilla = document.getElementById('casillaInput');
    const celdasSeleccionadas = new Set(inputCasilla.value.split('#')); // Conjunto de casillas seleccionadas

    celdas.forEach(celda => {
        celda.addEventListener('click', () => {
            const coordenada = celda.dataset.coordenada;
            if (celda.classList.contains('seleccionada')) {
                celda.classList.remove('seleccionada');
                celdasSeleccionadas.delete(coordenada);
            } else {
                celda.classList.add('seleccionada');
                celdasSeleccionadas.add(coordenada);
            }
            inputCasilla.value = Array.from(celdasSeleccionadas).join('#');
        });
    });
</script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>
