<?php include ASSETS_PATH . 'header.php'; ?>
<main>
    <a href="index.php?c=dialogo&m=listarDialogos">
        <button class="boton_volver">Volver</button> <!-- Botón para volver a la página anterior -->
    </a>
    <?php
        echo '<div style="display: flex; justify-content: center; align-items: center; height: 45vh;">'; //Utilizamos un poco de display flex para centrar el cotenido en el centro
        echo '<div style="text-align: center;">'; //Para centrar el texto dentro del contenedor
        echo '<b style="font-size: 18px;">'.$resultado1.'</b><br>'; //Utilizamos las variables que retornan el mensaje para informar al usuario*/
        echo '<b style="font-size: 18px;">'.$resultado2.'</b><br>';
        echo '</div>';
        echo '</div>';
    ?>
</main>
<?php include ASSETS_PATH . 'footer.php'; ?>