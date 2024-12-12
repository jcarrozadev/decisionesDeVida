<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decisiones de Vida</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Press+Start+2P&display=swap" rel="stylesheet">
<style>
    :root {
        /* Paleta de Colores */
        --color-azul: #1D4E89;
        --color-amarillo: #E3B505;
        --color-amarillo-oscuro: #D19804;
        --color-verde: #3B7359;
        --color-verde-oscuro: #2F5C47;
        --color-gris-oscuro: #2F2F2F;
        --color-blanco: #F8F8F0;
        --color-rojo: #D22B2B;
        --color-rojo-oscuro: #A61C1C;
        --color-gris-claro: #DDD;
        --color-gris-medio: #9b7b7b;
        --color-blanco-sombra: rgba(255, 255, 255, 0.1);
        --formulario: #d3d3ce;
    }

    body {
        margin: 0;
        font-family: 'Press Start 2P';
        /* background: var(--color-gris-claro); */
        background-image: url('img/fondos/fondoElegirPersonaje.jpg');
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        max-width: 1000px;
        padding: 20px;
        background: var(--formulario);
        border-radius: 10px;
        box-shadow: 0px 4px 8px var(--color-gris-oscuro);
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Ajusta según el espacio */
        gap: 20px; /* Espaciado entre tarjetas */
        width: 100%;
        justify-content: center; /* Centra el contenido */
        padding: 10px;
    }

    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--color-azul);
        color: var(--color-blanco);
        border-radius: 8px;
        padding: 10px;
        height: 150px;
        cursor: pointer;
        transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .card:hover {
        background-color: var(--color-amarillo);
        transform: translateY(-5px);
    }

    .card input[type="radio"] {
        display: none; /* Oculta los botones radio */
    }

    .card input[type="radio"]:checked + img {
        border: 4px solid var(--color-verde);
        border-radius: 50%;
    }

    .card input[type="radio"]:checked ~ div {
        background-color: var(--color-verde);
        color: var(--color-blanco);
        padding: 5px;
        border-radius: 4px;
        box-shadow: 0 4px 12px var(--color-verde-oscuro);
        transform: scale(1.05);
    }

    input[type="submit"] {
        background-color: var(--color-rojo);
        color: var(--color-blanco);
        font-family: 'Press Start 2P', cursive;
        font-size: 1.2rem;
        padding: 15px 30px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
    }

    input[type="submit"]:hover {
        background-color: var(--color-rojo-oscuro);
        transform: translateY(-5px);
    }

    input[type="submit"]:active {
        transform: translateY(2px);
    }


</style>
</head>
<body>
    <div class="container">
        <form id="formularioJugar" method="post" action="index.php?c=jugar&m=juego">
            <div>
                <label for="nombreUsuario">Nombre de Usuario:</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario">
            </div>

            <div class="card-container">
                <?php
                    if (!empty($personajes) && is_array($personajes)) {
                        foreach ($personajes as $datos) {
                            echo '<label class="card">';
                            echo '<input type="radio" id="personajeElegido" name="personajeElegido" value='. htmlspecialchars($datos['idPersonaje']) .' required>';
                            echo '<img src="data:image/png;base64,' . base64_encode($datos['spriteFront']) . '" alt="Sprite Frontal">';
                            echo '<div>'. htmlspecialchars($datos['nombrePersonaje']) .'</div>';
                            echo '</label>';
                        }
                    } else {
                        echo '<p>No hay personajes disponibles.</p>';
                    }
                ?>
            </div>
            <input type="submit" value="Jugar">
        </form>
    </div>
    <?php
        //echo '<script src="' . VIEW_JS_PATH . 'formularioJugar.js"></script>';
    ?>
</body>