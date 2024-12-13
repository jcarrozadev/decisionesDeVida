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
            <table style="background-image: url('<?php echo ESCENARIO_PATH . $datos['nombreImagen']; ?>');">
                <tbody>
                <?php
                    $colisionesGuardadas = $datos['colisiones'] ?? [];
                    $colisionesGuardadasMap = array_flip($colisionesGuardadas); // Map para búsqueda rápida

                    for ($j = 1; $j <= 10; $j++) { 
                        echo '<tr>'; 
                        $columna = chr(64 + $j);
                        for ($i = 1; $i <= 12; $i++) {
                            $fila = $i;
                            $coordenada = $columna . $fila;

                            $class = '';
                            if (isset($colisionesGuardadasMap[$coordenada])) {
                                $class .= ' seleccionada guardada'; // Casilla guardada y seleccionada
                            }

                            echo "<td class='celdaMovimiento $class' data-coordenada='$coordenada'>$coordenada</td>";
                        }
                        echo '</tr>';
                    } 
                    ?>

                </tbody>
            </table>


            <!-- <label for="casillaInput">Casillas Seleccionadas:</label> -->
            <input type="hidden" name="casilla" id="casillaInput" value="<?php echo htmlspecialchars(isset($datos['colisiones']) ? implode('#', $datos['colisiones']) : ''); ?>"  readonly><br/>
                                   
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
                // Deseleccionar
                celda.classList.remove('seleccionada');
                celdasSeleccionadas.delete(coordenada);

                if (celda.classList.contains('guardada')) {
                    // Si estaba guardada, eliminar su marca visualmente
                    celda.classList.remove('guardada');
                }
            } else {
                // Seleccionar
                celda.classList.add('seleccionada');
                celdasSeleccionadas.add(coordenada);
            }

            // Actualizar el input con las casillas seleccionadas
            inputCasilla.value = Array.from(celdasSeleccionadas).join('#');
        });
    });

</script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>
