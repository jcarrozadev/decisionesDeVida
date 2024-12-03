document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    if (validarFormulario()) {
        var formData = new FormData(this);

        fetch('index.php?c=personaje&m=modificarPersonajeGuardar', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Muestra la respuesta del servidor en la consola
            alert(data);  // Mostrar mensaje devuelto por el servidor
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
    const maxCaracteres = 30;    // Máximo de caracteres permitidos en el nombre

    // Validar que el campo de nombre no esté vacío
    if (!nombre) {
        alert('Por favor, rellena el nombre del personaje.');
        return false; // Detener el envío
    }

    // Validar que el nombre no exceda el límite de caracteres
    if (nombre.length > maxCaracteres) {
        alert(`El nombre del personaje no debe exceder ${maxCaracteres} caracteres.`);
        return false; // Detener el envío
    }

    // Validar imágenes solo si se sube alguna
    if (spriteF.length > 0 && !validarImagen(spriteF[0], 'frontal', tamanioMaximo)) return false;
    if (spriteB.length > 0 && !validarImagen(spriteB[0], 'trasero', tamanioMaximo)) return false;
    if (spriteL.length > 0 && !validarImagen(spriteL[0], 'izquierda', tamanioMaximo)) return false;
    if (spriteR.length > 0 && !validarImagen(spriteR[0], 'derecha', tamanioMaximo)) return false;

    // Si todas las validaciones pasan, se permite el envío del formulario
    return true;
}

// Función para validar el tamaño y tipo de un archivo
function validarImagen(archivo, nombre, tamanioMaximo) {
    // Validar el tipo de archivo
    const tiposPermitidos = ['image/png', 'image/jpeg', 'image/jpg'];
    if (!tiposPermitidos.includes(archivo.type)) {
        alert(`La imagen ${nombre} debe ser de tipo PNG, JPG o JPEG.`);
        return false; // Detener la validación
    }

    // Validar el tamaño del archivo
    if (archivo.size > tamanioMaximo) {
        alert(`La imagen ${nombre} no debe pesar más de ${tamanioMaximo / 1024}KB.`);
        return false; // Detener la validación
    }

    return true; // El archivo cumple con el tipo y tamaño permitido
}
