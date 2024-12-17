<?php include ASSETS_PATH . 'header.php'; ?>
<main>
        <a href="index.php">
            <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
        </a>
        <div class="div_formAltaDialogo">
            <h1 class="title">Alta de NPC</h1><!--Titulo de la página-->
            <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->
    
            <form class="form" name="form" id="npcForm">
                <label for="nombre">Nombre del NPC</label>
                <input type="text" name="nombre" id="nombre" placeholder="Introduzca el nombre">
    
                <label for="frontal">Diseño Frontal</label>
                <input type="file" name="npcSprite" id="npcSprite"><!--Campo para insertar archivos-->

                <!--Botón para enviar el formulario y dar de alta un personaje-->
                <button type="submit" class="btn-submit">Crear NPC</button>
            </form>
        </div>
    </main>

<?php include ASSETS_PATH . 'modal.php'; ?>

<script src="js/vistas/altaNPC.js"></script>
<script src="js/vistas/modal.js"></script>

<?php include ASSETS_PATH . 'footer.php'; ?>