<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IASHJ</title>
        <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        </style>
    </head>
    <body>
        <form id="personajeForm" enctype="multipart/form-data">
            <label for="nombre">Nombre Personaje</label>
            <input type="text" id="nombre" name="nombre">
            <label for="spriteF">Diseño Frontal</label>
            <input type="file" id="spriteF" name="spriteF">
            <label for="spriteB">Diseño Trasero</label>
            <input type="file" id="spriteB" name="spriteB">
            <label for="spriteL">Diseño Izquierda</label>
            <input type="file" id="spriteL" name="spriteL">
            <label for="spriteR">Diseño Derecha</label>
            <input type="file" id="spriteR" name="spriteR">
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        let isValid = true;
        const nombre = document.getElementById('nombre').value.trim();
        const spriteF = document.getElementById('spriteF').files[0];
        const spriteB = document.getElementById('spriteB').files[0];
        const spriteL = document.getElementById('spriteL').files[0];
        const spriteR = document.getElementById('spriteR').files[0];

        if (nombre === '') {
            alert('El nombre del personaje es obligatorio.');
            isValid = false;
        }

        const sprites = [
            { file: spriteF, name: 'frontal' },
            { file: spriteB, name: 'trasero' },
            { file: spriteL, name: 'izquierdo' },
            { file: spriteR, name: 'derecho' }
        ];

        sprites.forEach(sprite => {
            if (!sprite.file || !isValidImage(sprite.file)) {
                alert(`El diseño ${sprite.name} es obligatorio y debe ser una imagen menor a 10KB.`);
                isValid = false;
            }
        });

        if (isValid) {
            const formData = new FormData(document.getElementById('personajeForm'));
            fetch('index.php?c=Personaje&m=altaPersonaje', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                alert('Personaje creado correctamente.');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al crear el personaje.');
            });
        }
    });

    function isValidImage(file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const maxSize = 10240; // 10KB in bytes
        return validTypes.includes(file.type) && file.size <= maxSize;
    }
</script>