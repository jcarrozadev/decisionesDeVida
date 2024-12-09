<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Charmander</title>
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
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            #controles {
                font-family: 'Press Start 2P', cursive;
                background-color: #ffcc00;
                padding: 10px;
                border-radius: 5px;
                margin-bottom: 20px;
                text-align: center;
            }

            table {
                border-collapse: collapse;
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

            .muerte {
                width: 100%;
                height: auto;
            }

            .muerte-celda {
                background-color: #ff0000;
            }
        </style>
    </head>
    <body>

        <!-- Contenedor que muestra las instrucciones para el usuario -->
        <div id="controles">
            Controles:<br/>
            Mover a Charmander mediante clics
        </div>

        <!-- Tabla que representa el mapa donde se mueve Charmander -->
        <table>
            <tbody>
                <?php
                    for ($i = 0; $i < 10; $i++) { 

                        echo '<tr>'; // Crear una nueva fila

                        for ($j = 0; $j < 12; $j++) { 
                            // Crear una celda con atributos personalizados de fila y columna, y una función onclick
                            //echo "<td data-row='$i' data-col='$j' onclick='colocarCharmander(this)'></td>";
                            echo "<td class='celdaMovimiento' data-row='$i' data-col='$j'></td>";
                        }

                        echo '</tr>'; // Cerrar la fila
                    } 
                ?>
            </tbody>
        </table>

    <?php
        
        echo '<script src="'. VIEW_JS_PATH .'jugar.js"></script>';
        
    ?>

    </body>
</html>
