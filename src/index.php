<?php
    
    require_once 'php/config/config.php';

    // Si no le pasamos controlador ni metodo, le asignamos al $_GET un valor por defecto del config
    if(!isset($_GET['c'])) $_GET['c'] = CONTROLADOR_DEFECTO;
    if(!isset($_GET['m'])) $_GET['m'] = METODO_DEFECTO;

    $rutaControlador = 'php/controladores/' . $_GET['c'] . '.php';

    require_once $rutaControlador;
    $nombreControlador = 'C' . $_GET['c']; // cambiar a mayuscula la primera letra
    $controlador = new $nombreControlador();
    
    $datos = array();
    if(method_exists($controlador, $_GET['m'])) $datos = $controlador->{$_GET['m']}();

    require_once 'php/vistas/' . $controlador->vista . '.php';

    // esto es una prueba
?>