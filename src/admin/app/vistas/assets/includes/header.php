<!-- HTML Include Plantilla - Javier Arias Carroza -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Javier Arias Carroza jariascarroza@gmail.com">
        <title><?php echo $controlador->tituloPag ?></title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/import.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/general.css">
        <!-- IMPORT -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="barra-navegacion">
                <a href="index.php?c=panelAdmin&m=inicio" class="icono-casa"><i class="fas fa-home"></i></a>
                <div class="enlaces-centro">
                    <a href="index.php?c=personaje&m=listarPersonajes">Gestión de Personajes</a>
                    <a href="#gestionar-usuarios">Gestión de Usuarios</a>
                    <a href="#gestionar-ranking">Gestión de Ranking</a>
                    <a href="index.php?c=npc&m=formularioAltaNPC">Gestión de NPC</a>
                    <a href="index.php?c=escenario&m=gestionEscenario">Gestión de Escenarios</a>
                </div>
                <button class="boton-perfil"><i class="fas fa-user"></i></button>
            </nav>
        </header>