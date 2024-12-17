<!-- HTML Listar Personajes - Javier Arias Carroza -->
<?php include_once ASSETS_PATH . 'header.php'; ?>
<main class="contenedor-principal">
    <div class="titulo">
        <h1>Gestión de Personajes</h1>
        <p>Decisiones de Vida</p>
    </div>
    <a href="index.php?c=personaje&m=formularioAlta">
        <button class="boton-agregar">
            <i class="fa fa-plus"></i> Añadir
        </button>
    </a>
    <section class="contenedor-personajes">
        <?php
            if(count($datos) == 0) {
                echo "<p>No hay personajes disponibles</p>";
            }
            foreach ($datos as $personaje) {
                echo "<div class='fila-personaje'>";
                    echo "<div class='icono-personaje' style='background-image: url(data:image/png;base64," . base64_encode($personaje['spriteFront']) . ")'></div>";

                    echo "<p>" . $personaje['nombrePersonaje'] . "</p>";
                    echo "<div class='acciones'>";
                        echo "<a class='boton-modificar' href='index.php?c=personaje&m=modificarPersonaje&id=" . $personaje['idPersonaje'] . "'>Modificar</a>";
                        // Cambiar el enlace de "Eliminar" para que use la función de JavaScript
                        echo "<a class='boton-eliminar' href='javascript:void(0)' onclick='eliminarPersonaje(" . $personaje['idPersonaje'] . ")'>Eliminar</a>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </section>
</main>
<!-- <a href="index.php?c=panelAdmin&m=inicio">
    <button class="boton-volver"><i class="fa fa-arrow-left"></i> Volver al Panel de Administración</button>
</a> -->

<?php include_once ASSETS_PATH . 'modal.php'; ?>

<?php include_once ASSETS_PATH . 'footer.php'; ?>

<script src="js/vistas/eliminarPersonaje.js"></script>

<script src="js/vistas/modal.js"></script>
