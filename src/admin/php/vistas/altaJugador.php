<!-- NO ES UN MOCKUP, ESTE FORMULARIO ES PARA PROBAR EL ALTA DEL JUGADOR -->

<?php include 'php/vistas/assets/includes/header.php'; ?>
<main><!-- Contenido principal del documento -->
    <a href="index.php">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_form">
        <h1 class="title">Alta de Jugador</h1><!--Titulo de la página-->
        <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form class="form" action="index.php?c=jugador&m=altaJugador" method="POST">
            <label for="nombre">Nombre del jugador</label>
            <input type="text" id="nombre" placeholder="Introduzca el nombre" name="nombre">

            <label for="dinero">Dinero</label>
            <input type="number" id="dinero" placeholder="Introduzca el dinero" name="dinero">

            <label for="tiempo">Tiempo</label>
            <input type="number" id="tiempo" placeholder="Introduzca el tiempo" name="tiempo">

            <label for="idPersonaje">Personaje</label>
            <select id="idPersonaje" name="idPersonaje">
                <?php
                    foreach ($datos as $personaje) {
                        echo "<option value=\"{$personaje['idPersonaje']}\">{$personaje['nombrePersonaje']}</option>";
                    }
                ?>
            </select>

            <input type="submit" value="Dar de alta">
        </form>
    </div>
</main>
<?php include 'php/vistas/assets/includes/footer.php'; ?>