<?php include ASSETS_PATH . 'header.php'; ?> 
<!-- -------- BORRAR DE AQUI PARA ARRIBA Y SUSTITUIR POR EL INCLUDE DEL HEADER -------- -->
    <main class="contenedor-principal">
        <!-- ESTE MOCKUP ES UNA COPIA DE OTRO MOCKUP, ESTE MOCKUP NO ES TAREA DE NADIE
         SE USA PARA LLEGAR AL FORMULARIO DE MODIFICACION NADA MÁS -->
        <div class="titulo">
            <h1>Gestión de Escenarios</h1>
            <p>Decisiones de Vida</p>
        </div>
        <section class="contenedor-personajes">
        <?php
            if (count($datos) == 0) {
                echo "<p>No hay escenarios disponibles</p>";
            } else {
                foreach ($datos as $escenario) {
                    echo "<div class='fila-personaje'>";
                        echo "<div class='icono-personaje' style='display:flex; align-items:center; justify-content:center; height:100%; padding: 0.5%;'>";
                            echo "<i class='fa-solid fa-location-dot' style='font-size:2.5rem'></i>";
                        echo "</div>";
                        echo "<p>" . htmlspecialchars($escenario['nombreEscenario']) . "</p>";
                        echo "<div class='acciones'>";
                            // Construcción del enlace para el botón de modificar
                            echo "<a class='boton-modificar' href='index.php?c=escenario&m=modificarEscenario&id=" . htmlspecialchars($escenario['idEscenario']) . "'>Modificar</a>";
                        echo "</div>";
                    echo "</div>";
                }
                
            }
        ?>
    </section>
    </main>
    <a href="index.php?c=panelAdmin&m=inicio">
        <button class="boton-volver"><i class="fa fa-arrow-left"></i> Volver al Panel de Administración</button>
    </a>
<?php include_once ASSETS_PATH . 'footer.php'; ?>
