<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| G | Decisiones de Vida</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr auto 1fr; /* Tres columnas */
            grid-template-rows: auto; /* Ajuste automático de filas */
            gap: 20px;
            align-items: center;
            justify-items: center;
            width: 100%;
            max-width: 1200px;
        }

        #leyenda-izquierda, #leyenda-derecha {
            font-family: 'Press Start 2P', cursive;
            background-color: #ffcc00;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        #leyenda-izquierda {
            grid-column: 1;
            justify-self: start;
        }

        #leyenda-izquierda strong, #leyenda-izquierda strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
        }

        #leyenda-izquierda span, #leyenda-derecha span {
            display: block;
            margin-bottom: 10px;
            font-size: 1em;
            color: #ff0000;
        }

        #leyenda-derecha {
            grid-column: 3;
            justify-self: end;
        }

        #mapa {
            grid-column: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            background-image: url('<?php echo ESCENARIO_PATH ?>/escenario1.png');
            background-size: cover;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        td { 
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            text-align: center;
            vertical-align: middle;
        }

        .charmander {
            width: 100%;
            height: auto;
        }

        .muerte-celda {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Leyenda izquierda -->
        <div id="leyenda-izquierda">
            <strong>Nombre de Usuario:</strong>
            <span id="nombre-usuario"><?php echo $datos['nombreUsuario'] ?></span>
            <strong>ID Personaje</strong>
            <span><?php echo $datos['personajeElegido'] ?></span>
        </div>

        <!-- Tabla en el centro -->
        <div id="mapa">
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
        </div>

        <!-- Leyenda derecha -->
        <div id="leyenda-derecha">
            <strong>Controles:</strong>
            <span>Moverse - WASD</span>
        </div>
    </div>

    <script>
        const sprites = {
            front: "<?php echo $datos['spriteFront']; ?>",
            back: "<?php echo $datos['spriteBack']; ?>",
            left: "<?php echo $datos['spriteLeft']; ?>",
            right: "<?php echo $datos['spriteRight']; ?>"
        };
    </script>


    <?php
        echo '<script src="' . VIEW_JS_PATH . 'jugar.js"></script>';
    ?>
</body>
</html>
