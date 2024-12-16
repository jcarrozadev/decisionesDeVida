<?php

    // ----------------------- CONTROLADOR Y METODO POR DEFECTO
    define('CONTROLADOR_DEFECTO', 'panelAdmin'); // cambiarlo
    define('METODO_DEFECTO', 'inicio'); // cambiarlo

    // ----------------------- RUTAS
    define('SPRITE_PATH', 'img/spritesPersonajes/');
    define('SPRITE_PATH_NPC', 'img/spritesNPC/');
    define('MODEL_PATH', 'app/modelos/');
    define('VIEW_PATH', 'app/vistas/');
    define('CONTROLLER_PATH', 'app/controladores/');
    define('ASSETS_PATH', 'app/vistas/assets/includes/');
    define('ESCENARIO_PATH', '../game/img/escenarios/');

    // ----------------------- Tamaño máximo de SPRITES
    define('MAX_SPRITE_SIZE', 10000);

    // ----------------------- Caracteres no permitidos en campos de texto
    define('CARACTERES_NO_PERMITIDOS', '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/');

    // ----------------------- Tamaño máximo de dinero y tiempo
    define('DINERO_MAX', 100000);
    define('TIEMPO_MAX', 100000);

    // ----------------------- Rutas del CONFIG DB
    define('CONFIG_PATH', 'app/config/');

?>