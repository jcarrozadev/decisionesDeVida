<!--Miriam López Vega-->

<?php include 'php/vistas/assets/includes/header.php'; ?>
<main><!-- Contenido principal del documento -->
    <a href="index.php?c=personaje&m=listarPersonajes">
        <button class="boton_volver">Volver</button><!-- Botón para volver a la página anterior -->
    </a>
    <div class="div_form">
        <h1 class="title">Alta de Personajes</h1><!--Titulo de la página-->
        <h3 class="subtitle">Decisiones de Vida</h3><!--Subtítulo de la página-->

        <form id="formulario" class="form" enctype="multipart/form-data">
            <label for="nombre">Nombre del personaje</label>
            <input type="text" id="nombre" placeholder="Introduzca el nombre" name="nombre">

            <label for="frontal">Diseño Frontal</label>
            <input type="file" id="frontal" name="spriteF"><!--Campo para insertar archivos-->

            <label for="trasero">Diseño Trasero</label>
            <input type="file" id="trasero" name="spriteB"><!--Campo para insertar archivos-->

            <label for="derecho">Diseño Derecho</label>
            <input type="file" id="derecho" name="spriteR"><!--Campo para insertar archivos-->

            <label for="izquierdo">Diseño Izquierdo</label>
            <input type="file" id="izquierdo" name="spriteL"><!--Campo para insertar archivos-->

            <input type="submit" value="Dar de Alta"><!--Botón para enviar el formulario y dar de alta un personaje-->
        </form>
    </div>
</main>

<script>
    document.getElementById('formulario').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        var formData = new FormData(this);

        fetch('index.php?c=personaje&m=altaPersonaje', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Muestra la respuesta del servidor en la consola
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al dar de alta el personaje');
        });
    });
</script>

<?php include 'php/vistas/assets/includes/footer.php'; ?>