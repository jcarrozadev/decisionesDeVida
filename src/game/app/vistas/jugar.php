<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $controlador->tituloPag ?></title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Press+Start+2P&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/juego.css">
    </head>
    <body id="bodyJuego">
        <main>
            <div id="leyenda-usuario" class="leyendas">
                <div>
                    <strong>Nombre Usuario</strong>
                    <p id="nombreUsuario"><?php echo $datos['nombreUsuario'] ?></p>
                </div>
                <div>
                    <strong>Personaje</strong>
                    <div>
                        <img id="spritePersonaje" src="<?php echo $datos['spriteFront'] ?>" alt="Nombre Personaje">
                        <p id="nombrePersonaje"><?php echo $datos['nombrePersonaje'] ?></p>
                    </div>
                </div>
                <div>
                    <strong>Tiempo</strong>
                    <p id="tiempo"><?php echo '0'; ?>h</p>
                </div>
                <div>
                    <strong>Dinero</strong>
                    <p id="dinero"><?php echo '0'; ?>€</p>
                </div>                
            </div>
            <div id="escenarioJuego">
                <h1>Decisiones de Vida</h1>
                <p><?php echo $datos['nombreEscenario']; ?></p>
                <table class="tablaEscenario" style="background-image: url('<?php echo ESCENARIO_PATH . $datos['nombreImagen']; ?>');">
                    <tbody>
                        <?php
                            for ($row = 1; $row <= 9; $row++) {
                                echo "<tr>";
                                for ($col = 1; $col <= 12; $col++) {
                                    echo "<td class='celdaMovimiento' data-row='$row' data-col='$col'></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="leyenda-controles" class="leyendas">
                <div>
                    <strong>Controles</strong>
                    <p>Movimiento</p>
                    <p>W A S D</p>
                </div>
                <div id="objetivos">
                    <strong>Objetivos</strong>
                    <div>
                        <input id="1" type="checkbox" checked disabled> <!-- checked -->
                        <label for="1">Consigue trabajo</label>
                    </div>
                    <div>
                        <input id="2" type="checkbox" disabled> <!-- checked -->
                        <label for="2">Ayuda a una familia</label>
                    </div>
                    <div>
                        <input id="3" type="checkbox" checked disabled> <!-- checked -->
                        <label for="3">Escribe un libro</label>
                    </div>
                    <div>
                        <input id="4" type="checkbox" checked disabled> <!-- checked -->
                        <label for="4">Compra una casa</label>
                    </div>
                </div>
            </div>
            <div id="cruceta">
                <div class="empty"></div>
                <button onclick="moverTablet('w')">▲</button>
                <div class="empty"></div>
        
                <button onclick="moverTablet('a')">◀</button>
                <div class="empty"></div>
                <button onclick="moverTablet('d')">▶</button>
        
                <div class="empty"></div>
                <button onclick="moverTablet('s')">▼</button>
                <div class="empty"></div>
            </div>
        </main>

        <script>
            const sprites = {
                front: "<?php echo $datos['spriteFront']; ?>",
                back: "<?php echo $datos['spriteBack']; ?>",
                left: "<?php echo $datos['spriteLeft']; ?>",
                right: "<?php echo $datos['spriteRight']; ?>"
            };

            const filaLetraToNumero = {
                'A': 1,
                'B': 2,
                'C': 3,
                'D': 4,
                'E': 5,
                'F': 6,
                'G': 7,
                'H': 8,
                'I': 9
            };

            const casillaInicio = "<?php echo $datos['casillaInicio']; ?>";
            let columna = parseInt(casillaInicio.substring(1));
            const filaLetra = casillaInicio.charAt(0);
            let filaNumero = filaLetraToNumero[filaLetra];

            // PONEMOS EL PERSONAJE EN LA CASILLA DE INICIO CORRESPONDIENTE
            document.querySelector(`td[data-row='${filaNumero}'][data-col='${columna}']`).innerHTML = `<img src="${sprites.front}" class="personaje" style="width: 42px;">`;

            // PASAMOS LA FILA Y LA COLUMNA AL OTRO SCRIPT
            window.fila = filaNumero;
            window.columnaInicio = columna;

            window.colisiones = <?php echo json_encode($datos['colisiones']); ?>;
            window.dialogos = <?php echo json_encode($datos['dialogos']); ?>;

            // document.querySelector('td[data-row="1"][data-col="1"]').innerHTML = `<img src="${dialogosArray[0]['npc']['sprite']}" class="personaje" style="width: 42px;">`
        </script>


        <?php
            echo '<script type="module" src="' . VIEW_JS_PATH . 'jugar.js"></script>';
        ?>
    </body>
</html>
