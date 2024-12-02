<!-- HTML Panel Administración - Javier Arias Carroza -->
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Javier Arias Carroza jariascarroza@gmail.com">
        <title>Panel de Administración</title>
        <!-- CSS -->
        <link rel="stylesheet" href="panelAdministrador.css">
    </head>
    <body>
        <header>
            <h1>Panel de Administración</h1>
            <p>Decisiones de Vida</p>
        </header>

        <main class="contenedor-grid">
            <div class="tarjeta">
            <div class="imagen-tarjeta"></div>
            <p>Gestión de Usuarios</p>
            <a href="#">Acceder</a>
            </div>
            <div class="tarjeta">
            <div class="imagen-tarjeta"></div>
            <p>Gestión de Personajes</p>
            <a href="#">Acceder</a>
            </div>
            <div class="tarjeta">
            <div class="imagen-tarjeta"></div>
            <p>Gestión de Ranking</p>
            <a href="#">Acceder</a>
            </div>
        </main>
        <button class="boton-volver">Volver al Panel de Administración</button>
<?php include_once '.././includes/footer.php'; ?>
