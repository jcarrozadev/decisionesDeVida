<?php include 'assets/includes/header.php'; ?>
<a href="">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
<form class="form" enctype="multipart/form-data">
    <h2 style="text-align:center;">Alta de NPC</h2>
    <hr>
    <div class="form-group">
        <label for="nombre" class="form-label">Nombre del NPC:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
        <label for="npcSprite" class="form-label">Sprite del NPC:</label>
        <input type="file" class="form-control" id="npcSprite" name="npcSprite" accept="image/*">
    </div>
    <button type="submit" class="btn-submit">Enviar</button>
</form>
<?php include 'assets/includes/footer.php'; ?>