<!--Miriam López Vega-->

<?php include '../assets/includes/header.php'; ?>
<main><!-- Contenido principal del documento -->
    <a href="">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_form">
        <h1 class="title">Alta de Personajes</h1><!--Titulo de la página-->
        <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="form" name="form" action="" method="">
            <label for="nombre">Nombre del personaje</label>
            <input type="text" id="nombre" placeholder="Introduzca el nombre">

            <label for="frontal">Diseño Frontal</label>
            <input type="file" id="frontal"><!--Campo para insertar archivos-->

            <label for="trasero">Diseño Trasero</label>
            <input type="file" id="trasero"><!--Campo para insertar archivos-->

            <label for="derecho">Diseño Derecho</label>
            <input type="file" id="derecho"><!--Campo para insertar archivos-->

            <label for="izquierdo">Diseño Izquierdo</label>
            <input type="file" id="izquierdo"><!--Campo para insertar archivos-->

            <input type="submit" value="Dar de Alta"><!--Botón para enviar el formulario y dar de alta un personaje-->
        </form>
    </div>
</main>
<?php include '../assets/includes/footer.php'; ?>