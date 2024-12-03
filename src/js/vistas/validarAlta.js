// Al enviar el formulario, se valida antes de proceder
document.getElementById('formPersonaje').onsubmit = function(event) {
    if (!validarFormulario()) { // Si la validación falla
        event.preventDefault(); // Evita que el formulario se envíe
    }
};

// Función para validar los datos del formulario
function validarFormulario() {
    // Obtener el valor del campo de texto del nombre
    const nombre = document.getElementById('nombre').value.trim();

    // Obtener los archivos seleccionados en cada campo
    const spriteF = document.getElementById('spriteF').files;
    const spriteB = document.getElementById('spriteB').files;
    const spriteL = document.getElementById('spriteL').files;
    const spriteR = document.getElementById('spriteR').files;

    const maxFileSize = 10240; // Tamaño máximo de archivo en bytes (10KB)

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
    if (!validarTamañoArchivo(spriteF[0], 'frontal', tamañoMaximo)) return false;
    if (!validarTamañoArchivo(spriteB[0], 'trasero', tamañoMaximo)) return false;
    if (!validarTamañoArchivo(spriteL[0], 'izquierda', tamañoMaximo)) return false;
    if (!validarTamañoArchivo(spriteR[0], 'derecha', tamañoMaximo)) return false;

    // Si todas las validaciones pasan, se permite el envío del formulario
    return true;
}

// Función para validar el tamaño de un archivo
function validarTamañoArchivo(archivo, nombre, tamañoMaximo) {
    // Comprobar si el tamaño del archivo excede el límite permitido
    if (archivo.size > tamañoMaximo) {
        alert(`La imagen ${nombre} no debe pesar más de ${tamañoMaximo / 1024}KB.`);
        return false; // Detener la validación
    }
    return true; // El archivo cumple con el tamaño permitido
}