document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    // confirm('¿Estás seguro de que deseas dar de alta el personaje?'); ELIMINAR DESPUES

    if (validarFormulario()) {

        var formData = new FormData(this);

        fetch('index.php?c=personaje&m=modificarPersonajeGuardar', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Muestra la respuesta del servidor en la consola
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al modificar el personaje');
        });

    }
    
});

// Función para validar los datos del formulario
function validarFormulario() {
    // Obtener el valor del campo de texto del nombre
    const nombre = document.getElementById('nombre').value.trim();

    // Obtener los archivos seleccionados en cada campo
    const spriteF = document.getElementById('spriteF').files;
    const spriteB = document.getElementById('spriteB').files;
    const spriteL = document.getElementById('spriteL').files;
    const spriteR = document.getElementById('spriteR').files;

    const tamanioMaximo = 10240; // Tamaño máximo de archivo en bytes (10KB)

    // Validar que el campo de nombre no esté vacío
    if (!nombre) {
        alert('Por favor, rellena el nombre del personaje.');
        return false; // Detener el envío
    }

    // Validar que se hayan seleccionado todas las imágenes requeridas
    if (spriteF.length === 0 || spriteB.length === 0 || spriteL.length === 0 || spriteR.length === 0) {
        alert('Por favor, sube todas las imágenes.');
        return false; // Detener el envío
    }

    // Validar el tamaño de cada archivo de imagen
    if (!validarTamañoArchivo(spriteF[0], 'frontal', tamanioMaximo)) return false;
    if (!validarTamañoArchivo(spriteB[0], 'trasero', tamanioMaximo)) return false;
    if (!validarTamañoArchivo(spriteL[0], 'izquierda', tamanioMaximo)) return false;
    if (!validarTamañoArchivo(spriteR[0], 'derecha', tamanioMaximo)) return false;

    // Si todas las validaciones pasan, se permite el envío del formulario
    return true;
}

// Función para validar el tamaño de un archivo
function validarTamañoArchivo(archivo, nombre, tamanioMaximo) {
    
    // Comprobar si el tamaño del archivo excede el límite permitido
    if (archivo.size > tamanioMaximo) {
        alert(`La imagen ${nombre} no debe pesar más de ${tamanioMaximo / 1024}KB.`);
        return false; // Detener la validación
    }
    return true; // El archivo cumple con el tamaño permitido
}