<?php include_once 'php/vistas/includes/header.php'; ?>
<main class="contenedor-principal">
    <div class="titulo">
        <h1>Gestión de Personajes</h1>
        <p>Decisiones de Vida</p>
    </div>
    <section class="contenedor-personajes">
        <?php

            foreach($datos as $personaje) {

                echo "<div class='fila-personaje'>";
                    echo "<div class='icono-personaje'>";
                        echo "<img src='data:image/png;base64," . base64_encode($personaje['spriteFront']) . "' />";
                    echo "</div>";
                    echo "<p>" . $personaje['nombrePersonaje'] . "</p>";
                    echo "<div class='acciones'>";
                        echo "<a class='boton-modificar' href='index.php?c=personaje&m=modificarPersonaje&id=" . $personaje['idPersonaje'] . "'>Modificar</a>";
                        echo "<a class='boton-eliminar' href='index.php?c=personaje&m=eliminarPersonaje&id=" . $personaje['idPersonaje'] . "'>Eliminar</a>";
                    echo "</div>";
                echo "</div>";

            }

        ?>
    </section>
</main>
<?php include_once 'php/vistas/includes/footer.php'; ?>