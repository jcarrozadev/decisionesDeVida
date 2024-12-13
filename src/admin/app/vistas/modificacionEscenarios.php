<?php include ASSETS_PATH . 'header.php'; ?>  
<main>
    <a href="index.php?c=escenario&m=mEscenario">
        <button class="boton_volver">Volver</button>
    </a>

    <div class="divForm">
        <h1>Modificación de Escenario</h1>
        <h3>Decisiones de Vida</h3>
        
        <!-- <form id="formModEscenario" action="index.php?c=escenario&m=modificarEscenario&id=<?php echo $datos['idEscenario']; ?>" method="POST" enctype="multipart/form-data"> -->
        <form id="formModEscenario" enctype="multipart/form-data">
            <label for="nombreEscenario">Nombre Escenario:</label>
            <input type="hidden" name="idEscenario" value="<?php echo $datos['idEscenario']; ?>">

            <input type="text" name="nombreEscenario" id="nombreEscenario" placeholder="Nombre del Escenario" 
                value="<?php echo htmlspecialchars($datos['nombreEscenario']); ?>" >

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" name="mensajeNarrativo" id="mensajeNarrativo" placeholder="Mensaje Narrativo" 
                value="<?php echo htmlspecialchars($datos['mensajeNarrativo']); ?>" >

            <label for="imgEscenario">Imagen del Escenario:</label>
            <input type="file" id="imgEscenario" name="imgEscenario">

            <label for="casillaInicio">Casilla de Inicio:</label>
            <input type="text" name="casillaInicio" id="casillaInicio" 
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
            <input type="text" name="casilla" id="casillaInput" value="<?php echo htmlspecialchars(isset($datos['colisiones']) ? implode('#', $datos['colisiones']) : ''); ?>" ><br/>
                                   
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</main>
<script>
    window.idEscenario = <?php echo $datos['idEscenario']; ?>;
</script>
<script type="module" src="js/vistas/modificacionEscenarios.js"></script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>
