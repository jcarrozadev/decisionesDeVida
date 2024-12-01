<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Personaje</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>

<form id="formPersonaje" enctype="multipart/form-data">
    <label for="nombre">Nombre Personaje</label>
    <input type="text" id="nombre" name="nombre">

    <label for="spriteF">Diseño Frontal</label>
    <input type="file" id="spriteF" name="spriteF" accept="image/*">

    <label for="spriteB">Diseño Trasero</label>
    <input type="file" id="spriteB" name="spriteB" accept="image/*">

    <label for="spriteL">Diseño Izquierda</label>
    <input type="file" id="spriteL" name="spriteL" accept="image/*">

    <label for="spriteR">Diseño Derecha</label>
    <input type="file" id="spriteR" name="spriteR" accept="image/*">

    <input type="submit" value="Enviar">
</form>

<script>
    document.getElementById('formPersonaje').onsubmit = function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
        }
    };

    function validateForm() {
        const nombre = document.getElementById('nombre').value.trim();
        const spriteF = document.getElementById('spriteF').files;
        const spriteB = document.getElementById('spriteB').files;
        const spriteL = document.getElementById('spriteL').files;
        const spriteR = document.getElementById('spriteR').files;
        const maxFileSize = 10240; // 10KB

        // Validar campo de nombre
        if (!nombre) {
            alert('Por favor, rellena el nombre del personaje.');
            return false;
        }

        // Validar que todos los archivos estén seleccionados
        if (spriteF.length === 0 || spriteB.length === 0 || spriteL.length === 0 || spriteR.length === 0) {
            alert('Por favor, sube todas las imágenes.');
            return false;
        }

        // Validar tamaño de cada archivo y formato (opcional)
        if (!validateFileSize(spriteF[0], 'frontal', maxFileSize)) return false;
        if (!validateFileSize(spriteB[0], 'trasero', maxFileSize)) return false;
        if (!validateFileSize(spriteL[0], 'izquierda', maxFileSize)) return false;
        if (!validateFileSize(spriteR[0], 'derecha', maxFileSize)) return false;

        return true; // Si todo está bien, el formulario se enviará
    }

    function validateFileSize(file, nombre, maxSize) {
        if (file.size > maxSize) {
            alert(`La imagen ${nombre} no debe pesar más de ${maxSize / 1024}KB.`);
            return false;
        }
        return true;
    }
</script>

</body>
</html>
