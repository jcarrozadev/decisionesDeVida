<!--Miriam López Vega-->

<?php include '../assets/includes/header.php'; ?>
<main> <!-- Contenido principal del documento -->
    <a href="">
        <button class="boton_volver">Volver</button> <!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_form">
        <h1 class="title">Modificación de Personajes</h1> <!--Titulo de la página-->
        <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="form" name="form" action="" method="">

            <label for="nombre_persnj"><b>Nombre del Personaje</b></label><br/>
            <input type="text" placeholder="Nombre" name="nombre_persnj"><br/>
                
            <label for="frontal"><b>Diseño Frontal</b></label><br/>
            <img src="img\Chino_F.png" alt="Frontal"> <!-- Imagen de muestra del diseño frontal -->
            <input type="file" name="frontal"><br/><!-- Campo de archivo para subir el diseño frontal -->

            <label for="trasero"><b>Diseño Trasero</b></label><br/>
            <img src="img\Chino_B.png" alt="Trasero"> <!-- Imagen de muestra del diseño trasero -->
            <input type="file" name="trasero"><br/><!-- Campo de archivo para subir el diseño trasero -->

            <label for="derecho"><b>Diseño Derecho</b></label><br/>
            <img src="img\Chino_R.png" alt="Derecho"><!-- Imagen de muestra del diseño derecho -->
            <input type="file" name="derecho"><br/><!-- Campo de archivo para subir el diseño derecho -->

            <label for="izquierdo"><b>Diseño Izquierdo</b></label><br/>
            <img src="img\Chino_L.png" alt="Izquierdo"> <!-- Imagen de muestra del diseño izquierdo -->
            <input type="file" name="izquierdo"><br/><!-- Campo de archivo para subir el diseño izquierdo -->

            <input type="submit" value="Modificar"><!-- Botón para enviar el formulario y realizar la modificación -->

        </form>
    </div>
</main>
<?php include '../assets/includes/footer.php'; ?>