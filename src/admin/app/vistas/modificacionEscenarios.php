<?php include ASSETS_PATH . 'header.php'; ?>  
<main>
    <a>
        <button class="boton_volver">Volver</button>
    </a>

    <div class="divForm">
        <h1>Modificación de Escenario</h1>
        <h3>Decisiones de Vida</h3>

        <form id="formModEscenario">
            <label for="escenario">Nombre Escenario:</label>
            <input type="text" placeholder="Nombre del Escenario">

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" placeholder="Mensaje Narrativo" name="mensajeNarrativo">

            <label for="imgEscenario">Imagen del Escenario:</label>
            <input type="file" id="imgEscenario" name="imgEscenario">                                

            <label for="colisiones" class="formAltaDialogo-label">Colisiones:</label>
            <table style="background-image: url('img/escenario.png'); background-size: cover;">
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
            <input type="hidden" name="casilla"> <!-- Se rellena con JS marcando en la tabla -->
                    
            <input type="submit" value="Modificar Escenario">
        </form>
    </div>
</main>

<script>
    // Seleccionar todas las celdas de la tabla
    const celdas = document.querySelectorAll('.celdas');
    const inputCasilla = document.querySelector('input[name="casilla"]');

    // Crear un array para almacenar las celdas seleccionadas
    const celdasSeleccionadas = [];

    // Añadir un evento de clic a cada celda
    celdas.forEach(celda => {
        celda.addEventListener('click', () => {
            const etiquetaCelda = celda.textContent; // Obtener el identificador de la celda

            // Alternar selección de la celda, un clic selecciona, otro clic deselecciona
            if (celda.classList.contains('seleccionada')) {
                celda.classList.remove('seleccionada');
                // Eliminar la celda del array de seleccionadas
                const indice = celdasSeleccionadas.indexOf(etiquetaCelda);
                if (indice !== -1) celdasSeleccionadas.splice(indice, 1);
            } else {
                celda.classList.add('seleccionada');
                // Agregar la celda al array de seleccionadas
                celdasSeleccionadas.push(etiquetaCelda);
            }

            // Actualizar el valor del input con las celdas seleccionadas
            inputCasilla.value = celdasSeleccionadas.join('#'); //añade entre medias un # para usarlo despues en php
        });
    });
</script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>