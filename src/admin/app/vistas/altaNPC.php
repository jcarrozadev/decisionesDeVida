<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>
<main>
        <a href="index.php">
            <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
        </a>
        <div class="div_form">
            <h1 class="title">Alta de NPC</h1><!--Titulo de la página-->
            <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->
    
            <form class="form" name="form" action="" method="">
                <label for="nombre">Nombre del NPC</label>
                <input type="text" name="nombre" id="nombre" placeholder="Introduzca el nombre">
    
                <label for="frontal">Diseño Frontal</label>
                <input type="file" name="npcSprite" id="npcSprite"><!--Campo para insertar archivos-->
                
                <button type="submit" class="formAltaNPC-btn-submit">Enviar</button><!--Botón para enviar el formulario y dar de alta un personaje-->
            </form>
        </div>
    </main>
<script>
document.getElementById('npcForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    confirm('¿Estás seguro de que deseas dar de alta el NPC?');

    if (validarFormulario()) {

        var formData = new FormData(this);

        fetch('index.php?c=npc&m=altaNPC', {
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
            alert('Hubo un error al dar de alta al NPC');
        });

    }
    
});

// Función para validar los datos del formulario
function validarFormulario() {
    // Obtener el valor del campo de texto del nombre
    const nombre = document.getElementById('nombre').value.trim();

    // Obtener los archivos seleccionados en cada campo
    const npcSprite = document.getElementById('npcSprite').files;

    const tamanioMaximo = 10240; // Tamaño máximo de archivo en bytes (10KB)

    // Validar que el campo de nombre no esté vacío
    if (!nombre) {
        alert('Por favor, rellena el nombre del NPC.');
        return false; // Detener el envío
    }

    // Validar que se hayan seleccionado todas las imágenes requeridas
    if (npcSprite.length === 0) {
        alert('Por favor, sube la imagen del NPC.');
        return false; // Detener el envío
    }

    // Validar el tamaño de cada archivo de imagen
    if (!validarTamañoArchivo(npcSprite[0], 'frontal', tamanioMaximo)) return false;

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
</script>

<?php include ASSETS_PATH . 'footer.php'; ?>