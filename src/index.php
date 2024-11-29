<?php
    
    require_once 'php/config/config.php';

    // Si no le pasamos controlador ni metodo, le asignamos al $_GET un valor por defecto del config
    if(!isset($_GET['c'])) $_GET['c'] = CONTROLADOR_DEFECTO;
    if(!isset($_GET['m'])) $_GET['m'] = METODO_DEFECTO;

    $rutaControlador = 'php/controladores/' . $_GET['c'] . '.php';

    require_once $rutaControlador;
    $nombreControlador = 'C' . $_GET['c'];
    $controlador = new $nombreControlador();
    
    $datos = array();

    /**
     * SI NO LE PASAMOS LOS ARGUMENTOS DE LOS METODOS NECESARIOS POR URL O POR POST,
     * LO ASIGNAMOS A NULL PARA QUE NO DE ERROR
     */

    // PARAMETROS DEL METODO DEL CONSTRUCTOR
    if(!isset($_FILES) || empty($_FILES)) $_FILES = null;
    if(!isset($_POST) || empty($_POST)) $_POST = null;
    if(!isset($_GET['v']) || empty($_GET['v'])) $_GET['v'] = null;
    
    if(method_exists($controlador, $_GET['m'])) $datos = $controlador->{$_GET['m']}($_FILES, $_POST, $_GET['v']); // PREGUNTAR ISA POR PASO DE PARAMETROS

    require_once 'php/vistas/' . $controlador->vista . '.php';

?>