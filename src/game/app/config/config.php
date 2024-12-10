<?php

    // ----------------------- CONTROLADOR Y METODO POR DEFECTO
    define('CONTROLADOR_DEFECTO', 'jugar'); // cambiarlo
    define('METODO_DEFECTO', 'index'); // cambiarlo

    // ----------------------- RUTAS
    define('SPRITE_PATH', 'img/spritesPersonajes/');
    define('MODEL_PATH', 'app/modelos/');
    define('VIEW_PATH', 'app/vistas/');
    define('CONTROLLER_PATH', 'app/controladores/');

    define('VIEW_JS_PATH', 'js/vistas/');

    // ----------------------- Tamaño máximo de SPRITES
    define('MAX_SPRITE_SIZE', 10000);

    // ----------------------- Caracteres no permitidos en campos de texto
    define('CARACTERES_NO_PERMITIDOS', '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/');

    // ----------------------- Tamaño máximo de dinero y tiempo
    define('DINERO_MAX', 100000);
    define('TIEMPO_MAX', 100000);
    
?>