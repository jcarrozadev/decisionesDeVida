<!-- Javier Arias Carroza -->

<?php include 'app/vistas/assets/includes/header.php'; ?>
<style>
    #npcForm {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: var(--color-azul);
        margin-top: 10vh;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    .form-group {
        margin: 4% 1%;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--formulario);
        border-radius: 5px;
    }

    .btn-submit {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: var(--color-amarillo);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: var(--color-amarillo-oscuro);
    }
</style>
<form id="npcForm" enctype="multipart/form-data">
    <h2 style="text-align:center;">Alta de NPC</h2>
    <hr>
    <div class="form-group">
        <label for="nombre" class="form-label">Nombre del NPC:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
        <label for="npcSprite" class="form-label">Sprite del NPC:</label>
        <input type="file" class="form-control" id="npcSprite" name="npcSprite" accept="image/*">
    </div>
    <button type="submit" class="btn-submit">Enviar</button>
</form>
<div style="text-align:center; margin-top: 20px; max-width: 600px; margin: 20px auto; width: 25%;">
    <a href="index.php" class="btn-submit" style="background-color: var(--color-amarillo); text-decoration:none;">Volver</a>
</div>
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

<?php include 'app/vistas/assets/includes/footer.php'; ?>