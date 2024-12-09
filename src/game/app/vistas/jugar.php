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
            <script>
                // Crear una tabla de 10 filas y 12 columnas de forma dinámica
                for (let i = 0; i < 10; i++) {
                    document.write('<tr>'); // Crear una nueva fila
                    for (let j = 0; j < 12; j++) {
                        // Crear una celda con atributos personalizados de fila y columna, y una función onclick
                        document.write(`<td data-row="${i}" data-col="${j}" onclick="colocarCharmander(this)"></td>`);
                    }
                    document.write('</tr>'); // Cerrar la fila
                }

                // Función que selecciona aleatoriamente una celda y coloca una imagen de "muerte"
                function eventoMuerte() {
                    const filasTotales = 10; // Número total de filas
                    const columnasTotales = 12; // Número total de columnas

                    // Seleccionar una fila y una columna aleatoria
                    const filaRandom = Math.floor(Math.random() * filasTotales);
                    const columRandom = Math.floor(Math.random() * columnasTotales);

                    // Seleccionar la celda aleatoria y colocar la imagen 'muerte.png'
                    const celdaRandom = document.querySelector(`td[data-row='${filaRandom}'][data-col='${columRandom}']`);
                    celdaRandom.innerHTML = '<img src="/img/muerte.png" class="muerte">';
                    celdaRandom.classList.add("muerte-celda"); // Añadir una clase para identificar la celda

                    // Definir el comportamiento cuando el usuario hace clic en la celda de "muerte"
                    celdaRandom.onclick = function() {
                        celdaRandom.innerHTML = ""; // Eliminar la imagen de la celda
                        celdaRandom.classList.remove("muerte-celda"); // Eliminar la clase 'muerte-celda'
                        prompt("Dialogo de Justicia Social","Respuesta"); // Mostrar un cuadro de diálogo al usuario
                        location.reload(); // Recargar la página
                    };
                }

                // Llamar a la función para colocar la imagen de "muerte" en una celda aleatoria
                eventoMuerte();
            </script>
        </tbody>
    </table>

    <script>
        // Variables que rastrean la posición actual de Charmander
        let fila = 9; // Fila inicial de Charmander
        let columna = 6; // Columna inicial de Charmander

        // Inicializar Charmander en la celda (9,6), abajo en el centro del mapa
        document.querySelector(`td[data-row='${fila}'][data-col='${columna}']`).innerHTML = '<img src="/img/charmander.png" class="charmander">';

        // Función para mover a Charmander a una nueva celda
        function colocarCharmander(cell) {
            // Obtener la fila y columna de la celda en la que se hizo clic
            const row = parseInt(cell.getAttribute('data-row'));
            const col = parseInt(cell.getAttribute('data-col'));

            // Verificar si la celda clicada es adyacente a la posición actual
            if (celdaCercana(row, col)) {
                // Limpiar todas las celdas excepto las que tienen la clase 'muerte-celda'
                document.querySelectorAll("td").forEach(td => {
                    if (!td.classList.contains("muerte-celda")) {
                        td.innerHTML = ""; // Eliminar el contenido de la celda
                    }
                });

                // Colocar a Charmander en la nueva celda
                cell.innerHTML = '<img src="/img/charmander.png" class="charmander">';
                // Actualizar la posición actual de Charmander
                fila = row;
                columna = col;
            }
        }

        // Función que verifica si la celda clicada es adyacente a la actual
        function celdaCercana(row, col) {
            return (
                // Verificar si la celda está en la misma fila pero en una columna adyacente (izquierda/derecha)
                (row === fila && Math.abs(col - columna) === 1) ||
                // Verificar si la celda está en la misma columna pero en una fila adyacente (arriba/abajo)
                (col === columna && Math.abs(row - fila) === 1)
            );
        }
    </script>

</body>
</html>