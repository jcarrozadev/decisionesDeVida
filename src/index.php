<?php
    
    require_once 'php/controladores/cPersonaje.php';

    $controlador = isset($_GET['c']) ? $_GET['c'] : 'home';
    $metodo = isset($_GET['m']) ? $_GET['m'] : 'index';

    switch ($controlador) {
        case 'personaje':
            $controlador = new CPersonaje();
            break;
        default:
            // $controlador = new HomeController(); // Aqui podemos poner el inicio de sesion o lo que necesitemos, en este controlador tendremos que crear un metodo index()
            break;
    }

    // isset($_POST) ? $_POST : null, isset($_FILES) ? $_FILES : null
    $datos = $controlador->{$metodo}(isset($_POST) ? $_POST : null, isset($_FILES) ? $_FILES : null);

    require_once 'php/vistas/' . $controlador->vista .'.php';
    
?>