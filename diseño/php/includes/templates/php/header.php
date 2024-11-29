<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Javier Arias Carroza jariascarroza@gmail.com">
    <title>Gestión de Personajes</title>
    <!-- CSS -->
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        header {
            background-color: var(--color-azul);
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .barra-navegacion {
            display: flex;
            justify-content: space-between; /* Centra los enlaces, botón a la derecha */
            align-items: center;
            padding: 10px 5%;
        }

        .enlaces-centro {
            display: flex;
            justify-content: center; /* Centra los enlaces */
            flex: 1;
            gap: 20px;
        }

        .enlaces-centro a {
            color: var(--color-blanco);
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .enlaces-centro a:hover {
            background-color: var(--color-amarillo);
            color: var(--color-gris-oscuro);
        }

        .boton-perfil {
            background-color: var(--color-amarillo);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            color: var(--color-gris-oscuro);
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .boton-perfil:hover {
            background-color: var(--color-amarillo-oscuro);
        }

        .barra-navegacion a {
            color: var(--color-blanco);
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .barra-navegacion a:hover {
            background-color: var(--color-amarillo);
            color: var(--color-gris-oscuro);
        }
    </style>
    <!-- IMPORT -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="barra-navegacion">
            <div class="enlaces-centro">
                <a href="#gestionar-personajes">Gestión de Personajes</a>
                <a href="#gestionar-usuarios">Gestión de Usuarios</a>
                <a href="#gestionar-ranking">Gestión de Ranking</a>
            </div>
            <button class="boton-perfil"><i class="fas fa-user"></i></button>
        </nav>
    </header>