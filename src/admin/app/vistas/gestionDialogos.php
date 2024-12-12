<!-- Javier Arias Carroza -->

<?php include ASSETS_PATH . 'header.php'; ?>

<main class="contenedor-principal">
    <div class="titulo">
        <h1>Gestión de Diálogos</h1>
        <p>Decisiones de Vida</p>
    </div>
    <a href="index.php?c=escenario&m=formularioObtenerEscenario">
        <button class="boton-agregar">
            <i class="fa fa-plus"></i> Añadir
        </button>
    </a>
    <section class="contenedor-personajes">
        <?php
            if(count($datos) == 0) {
                echo "<p>No hay diálogos disponibles</p>";
            }
            foreach ($datos as $dialogo) {
                echo "<div class='fila-personaje'>";
                    echo "<div class='icono-personaje' style='display:flex; align-items:center; justify-content:center; height:100%; padding: 0.5%;'><i class='fa-solid fa-comment' style='font-size:2.5rem;'></i></div>";

                    echo "<p>" . $dialogo['nombreDiálogo'] . " [" . $dialogo['idDialogo'] . "]</p>";
                    echo "<div class='acciones'>";
                        echo "<a class='boton-modificar' href='index.php?c=dialogo&m=modificarDialogo&id=" . $dialogo['idDialogo'] . "'>Modificar</a>";
                        // Cambiar el enlace de "Eliminar" para que use la función de JavaScript
                        echo "<a class='boton-eliminar' onclick='eliminarDialogo(" . $dialogo['idDialogo'] . ")'>Eliminar</a>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </section>
</main><script src="js/vistas/eliminarDialogo.js"></script>
<!-- <a href="index.php?c=panelAdmin&m=inicio">
    <button class="boton-volver"><i class="fa fa-arrow-left"></i> Volver al Panel de Administración</button>
</a> -->

<?php include ASSETS_PATH . 'footer.php'; ?>
