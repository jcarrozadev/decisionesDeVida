document.addEventListener("DOMContentLoaded", () => {
    alert("AAA");
    const form = document.getElementById('formModEscenario');
    const celdas = document.querySelectorAll('.celdaMovimiento');
    const inputCasilla = document.getElementById('casillaInput');
    const celdasSeleccionadas = [];

    // Selección de celdas para colisiones
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

    // Función para validar el formulario
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

    // Función para convertir las casillas seleccionadas
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

    // Envío del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío por defecto

        if (validarFormulario()) {
            convertirArray(); // Asegúrate de convertir las casillas antes de enviar

            var formData = new FormData(form); // Recoge todos los datos del formulario

            // Enviar los datos al servidor
            fetch('index.php?c=escenario&m=mEscenario', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Muestra la respuesta del servidor
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al modificar el escenario');
            });
        }
    });
});
