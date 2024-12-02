<!-- Miriam López Vega -->

<?php include 'php/vistas/assets/includes/header.php'; ?>
<main> <!-- Contenido principal del documento -->
    <a href="">
        <button class="boton_volver">Volver</button> <!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_form">
        <h1 class="title">Modificación de Personajes</h1> <!--Titulo de la página-->
        <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="form" action="index.php?c=personaje&m=modificarPersonajeGuardar" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $datos['idPersonaje']; ?>">

            <label for="nombre_persnj"><b>Nombre del Personaje</b></label><br/>
            <input type="text" placeholder="Nombre" name="nombre" value="<?php echo $datos['nombrePersonaje']; ?>"><br/>
                
            <label for="frontal"><b>Diseño Frontal</b></label><br/>
            <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteFront']); ?>" alt="Sprite Frontal"> <!-- Imagen de muestra del diseño frontal -->
            <input type="file" name="frontal"><br/><!-- Campo de archivo para subir el diseño frontal -->

            <label for="trasero"><b>Diseño Trasero</b></label><br/>
            <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteBack']); ?>" alt="Sprite Trasero"> <!-- Imagen de muestra del diseño trasero -->
            <input type="file" name="trasero"><br/><!-- Campo de archivo para subir el diseño trasero -->

            <label for="derecho"><b>Diseño Derecho</b></label><br/>
            <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteRight']); ?>" alt="Sprite Lateral Derecho"><!-- Imagen de muestra del diseño derecho -->
            <input type="file" name="derecho"><br/><!-- Campo de archivo para subir el diseño derecho -->

            <label for="izquierdo"><b>Diseño Izquierdo</b></label><br/>
            <img src="data:image/png;base64,<?php echo base64_encode($datos['spriteLeft']); ?>" alt="Sprite Lateral Izquierdo"> <!-- Imagen de muestra del diseño izquierdo -->
            <input type="file" name="izquierdo"><br/><!-- Campo de archivo para subir el diseño izquierdo -->

            <input type="submit" value="Modificar"><!-- Botón para enviar el formulario y realizar la modificación -->

        </form>
    </div>
</main>
<?php include 'php/vistas/assets/includes/footer.php'; ?>