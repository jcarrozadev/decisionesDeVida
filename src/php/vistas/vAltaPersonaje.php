<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        </style>
    </head>
    <body>
        <form action="index.php?c=Personaje&m=altaPersonaje" method="POST" enctype="multipart/form-data">
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