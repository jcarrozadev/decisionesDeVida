<!-- HTML Panel Administración - Javier Arias Carroza -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Javier Arias Carroza jariascarroza@gmail.com">
        <title>Panel de Administración</title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/import.css">
        <link rel="stylesheet" href="css/general.css">
        <link rel="stylesheet" href="css/footer.css">
        <!-- IMPORT -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <header id="headerPanelAdmin">
            <h1>Panel de Administración</h1>
            <p>Decisiones de Vida</p>
        </header>

        <main class="contenedor-grid">
            <div class="tarjeta">
                <div class="imagen-tarjeta"></div>
                <p>Gestión de Usuarios</p>
                <a href="#"><span style="color:red;">Locked</span></a>
            </div>
            <div class="tarjeta">
                <div class="imagen-tarjeta"> <i class="fa-solid fa-user-astronaut" style="font-size: 3.2rem;"></i> </div>
                <p>Gestión de Personajes</p>
                <a href="index.php?c=personaje&m=listarPersonajes">Acceder</a>
            </div>
            <div class="tarjeta">
                <div class="imagen-tarjeta"><img src="img/spritesDefault/Chino_F.png" alt="Foto NPC"></div>
                <p>Gestión de NPC</p>
                <a href="index.php?c=npc&m=formularioAltaNPC">Acceder</a>
            </div>
            <div class="tarjeta">
                <div class="imagen-tarjeta"><i class="fa-solid fa-comments" style="font-size: 3.2rem;"></i></div>
                <p>Gestión de Diálogos</p>
                <a href="index.php?c=dialogo&m=listarDialogos">Acceder</a>
            </div>
            <div class="tarjeta">
                <div class="imagen-tarjeta"></div>
                <p>Gestión de Ranking</p>
                <a href="#"><span style="color:red;">Locked</span></a>
            </div>
        </main>
<?php include_once ASSETS_PATH . 'footer.php'; ?>
