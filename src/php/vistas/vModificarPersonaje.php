<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            form {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #555;
            }

            input[type="text"],
            input[type="file"] {
                width: calc(100% - 22px);
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            input[type="submit"] {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #28a745;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            input[type="submit"]:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <h1>Modificar Personaje</h1>
        <form action="index.php?c=personaje&m=modificarPersonajeGuardar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $datos['idPersonaje']; ?>">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?php echo $datos['nombrePersonaje']; ?>">
            
            <label for="spriteF">Sprite Frontal</label>
            <div>
                <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteFront']); ?>" alt="Sprite Frontal" style="max-width: 100px; max-height: 100px;">
                <input type="file" name="spriteF">
            </div>
            
            <label for="spriteB">Sprite Trasero</label>
            <div>
                <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteBack']); ?>" alt="Sprite Trasero" style="max-width: 100px; max-height: 100px;">
                <input type="file" name="spriteB">
            </div>
            
            <label for="spriteL">Sprite Lateral Izquierdo</label>
            <div>
                <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteLeft']); ?>" alt="Sprite Lateral Izquierdo" style="max-width: 100px; max-height: 100px;">
                <input type="file" name="spriteL">
            </div>
            
            <label for="spriteR">Sprite Lateral Derecho</label>
            <div>
                <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteRight']); ?>" alt="Sprite Lateral Derecho" style="max-width: 100px; max-height: 100px;">
                <input type="file" name="spriteR">
            </div>
            
            <input type="submit" value="Modificar">
        </form>
    </body>
</html>