<?php
    
    require_once 'php/controladores/cPersonaje.php';

    $personaje = new cPersonaje();
    $personaje->altaPersonaje($_POST, $_FILES);

    // require_once 'php/config/vistas/vAltaPersonaje.php';
    
?>