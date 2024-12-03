<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Personaje</title>

        <style>
            /* Estilos básicos para el formulario */
            form {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <!-- Formulario para cargar los datos de un personaje -->
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

        <script src="src\js\vistas\validarAlta.js"></script>
    </body>
</html>
