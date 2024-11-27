<?php
    
    require_once 'php/controladores/cPersonaje.php';

    $personaje = new cPersonaje();
    $personajes = $personaje->listarPersonajes();

    require_once 'php/vistas/vListarPersonajes.php';
    
?>