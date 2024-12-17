let modal = document.getElementById('modal');

document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById('formModEscenario');

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

    // Función para validar el formulario
    function validarFormulario() {
        const nombreEscenario = document.getElementById('nombreEscenario').value.trim();
        const mensajeNarrativo = document.getElementById('mensajeNarrativo').value.trim();
        const casillaInicio = document.getElementById('casillaInicio').value.trim();

        if (!nombreEscenario || !mensajeNarrativo || !casillaInicio) {
            modal.style.display = 'block';
            document.getElementById('tituloModal').innerHTML = 'Error';
            document.getElementById('mensajeModal').innerHTML = 'Todos los campos son obligatorios.';
            return false;
        }
        return true;
    }

    // Envío del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        pantallaCarga(); // Muestra la pantalla de carga // Evita el envío por defecto

        if (validarFormulario()) {

            var formData = new FormData(form); // Recoge todos los datos del formulario
            // Enviar los datos al servidor
            fetch('index.php?c=escenario&m=modificarEscenario&id=' + idEscenario, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                desactivarCarga();
                //alert(data); // Muestra la respuesta del servidor
                location.href = 'index.php?c=escenario&m=gestionEscenario';
            })
            .catch(error => {
                console.error('Error:', error);
                modal.style.display = 'block';
                document.getElementById('tituloModal').innerHTML = 'Error';
                document.getElementById('mensajeModal').innerHTML = 'Hubo un error al modificar el escenario';
            });
        }
    });
});

function pantallaCarga(){
    document.getElementById("cargaFormulario").style.display = "grid";
}

function desactivarCarga(){
    document.getElementById("cargaFormulario").style.display = "none";
}