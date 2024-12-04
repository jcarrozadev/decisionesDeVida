<?php

    // ----------------------- CONTROLADOR Y METODO POR DEFECTO
    define('CONTROLADOR_DEFECTO', 'panelAdmin'); // cambiarlo
    define('METODO_DEFECTO', 'inicio'); // cambiarlo

    // ----------------------- RUTAS
    define('SPRITE_PATH', 'img/spritesPersonajes/');
    define('MODEL_PATH', 'php/modelos/');
    define('VIEW_PATH', 'php/vistas/');
    define('CONTROLLER_PATH', 'php/controladores/');

    // ----------------------- Tamaño máximo de SPRITES
    define('MAX_SPRITE_SIZE', 10000);

    // ----------------------- Caracteres no permitidos en campos de texto
    define('CARACTERES_NO_PERMITIDOS', '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/');

    // ----------------------- Tamaño máximo de dinero y tiempo
    define('DINERO_MAX', 100000);
    define('TIEMPO_MAX', 100000);
    
?>