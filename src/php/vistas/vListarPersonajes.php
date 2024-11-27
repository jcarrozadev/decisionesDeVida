<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        div {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        p {
            font-size: 24px;
            color: #333;
            margin-left: 20px;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <?php
        
        foreach ($personajes as $personaje) {
            echo "<div>";
                echo "<img src='data:image/png;base64," . base64_encode($personaje['spriteFront']) . "' />";
                echo "<p>" . $personaje['nombrePersonaje'] . "</p>";
            echo "</div>";
        }
        
    ?>
</body>
</html>