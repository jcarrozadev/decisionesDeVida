<?php include ASSETS_PATH . 'header.php'; ?>  
<main>
    <a href="index.php?c=escenario&m=mEscenario">
        <button class="boton_volver">Volver</button>
    </a>

    <div class="divForm">
        <h1>Modificación de Escenario</h1>
        <h3>Decisiones de Vida</h3>
        
        <form id="formModEscenario" enctype="multipart/form-data">
            <label for="nombreEscenario">Nombre Escenario:</label>
            <input type="text" name="nombreEscenario" id="nombreEscenario" placeholder="Nombre del Escenario" 
                value="<?php echo htmlspecialchars($datos['nombreEscenario']); ?>">

            <label for="mensajeNarrativo">Mensaje Narrativo:</label>
            <input type="text" name="mensajeNarrativo" id="mensajeNarrativo" placeholder="Mensaje Narrativo" 
                value="<?php echo htmlspecialchars($datos['mensajeNarrativo']); ?>">

            <label for="imgEscenario">Imagen del Escenario:</label>
            <input type="file" id="imgEscenario" name="imgEscenario">

            <label for="casillaInicio">Casilla de Inicio:</label>
            <input type="text" name="casillaInicio" id="casillaInicio" required
            value="<?php echo htmlspecialchars($datos['casillaInicio'])?>">

            <label for="colisiones" class="formAltaDialogo-label">Colisiones:</label>
            <table>
                <tbody>
                    <?php
                        for ($i = 1; $i <= 10; $i++) { 
                            echo '<tr>'; 
                            for ($j = 1; $j <= 12; $j++) {
                                $columna = chr(64 + $j);
                                $fila = $i;
                                $coordenada = $columna . $fila;

                                echo "<td class='celdaMovimiento' data-row='$i' data-col='$j'>$coordenada</td>";
                            }
                            echo '</tr>';
                        } 
                    ?>
                </tbody>
            </table>

            <label for="casillaInput">Casillas Seleccionadas:</label>
            <input type="text" name="casilla" id="casillaInput" readonly><br/><br/>
                        
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

<script>
    const celdas = document.querySelectorAll('.celdaMovimiento');
    const inputCasilla = document.getElementById('casillaInput');
    const inputCasillaInicio = document.getElementById('casillaInicio');
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

    document.getElementById('formModEscenario').addEventListener('submit', function(event) {
        event.preventDefault();

        if (validarFormulario()) {
            convertirArray();

            const formData = new FormData(this);

            fetch('index.php?c=escenario&m=mEscenario', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.text();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);
                if (data.trim() === 'success') {
                    alert('Formulario enviado correctamente');
                } else {
                    alert('Error al enviar el formulario');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema con la solicitud: ' + error.message);
            });
        }
    });

    function validarFormulario() {
        const nombreEscenario = document.getElementById('nombreEscenario').value.trim();
        const mensajeNarrativo = document.getElementById('mensajeNarrativo').value.trim();
        const casillaInicio = document.getElementById('casillaInicio').value.trim();

        if (!nombreEscenario || !mensajeNarrativo || !casillaInicio) {
            alert('Todos los campos son obligatorios.');
            return false;
        }
        return true;
    }

    function convertirArray() {
        const casillas = document.getElementById('casillaInput').value;
        let array = casillas.split('#');
        
        let arrayConvertido = array.map(casilla => {
            let [row, col] = casilla.split(',');
            let colLetter = String.fromCharCode(65 + parseInt(col) - 1); // Convierte columna numérica a letra
            return `${colLetter}${parseInt(row)}`; // Combina letra de columna y número de fila
        });

        document.getElementById('casillaInput').value = arrayConvertido.join('#');
    }
</script>

<?php include_once ASSETS_PATH . 'footer.php'; ?>
