<!-- HTML Listar Personajes - Javier Arias Carroza -->
<?php include_once ASSETS_PATH . 'header.php'; ?>
<main class="contenedor-principal">
    <div class="titulo">
        <h1>Gestión de NPCs</h1>
        <p>Decisiones de Vida</p>
    </div>
    <a href="index.php?c=npc&m=formularioAltaNPC">
        <button class="boton-agregar">
            <i class="fa fa-plus"></i> Añadir
        </button>
    </a>
    <section class="contenedor-personajes">
        <?php
            if(count($datos) == 0) {
                echo "<p>No hay personajes disponibles</p>";
            }
            foreach ($datos as $npcs) {
                echo "<div class='fila-personaje'>";
                    echo "<div class='icono-personaje' style='background-image: url(data:image/png;base64," . base64_encode($npcs['sprite']) . ")'></div>";

                    echo "<p>" . $npcs['nombreNPC'] . "</p>";
                echo "</div>";
            }
        ?>
    </section>
</main>

<?php include_once ASSETS_PATH . 'footer.php'; ?>

<script src="js/vistas/eliminarPersonaje.js"></script>
