<?php
    
    class CPersonaje {

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }
        
        public function altaPersonaje($datos, $files) {
            require_once 'php/modelos/mPersonaje.php';

            $datos = $datos + $files;

            $personaje = new mPersonaje();
            $personaje->altaPersonaje($datos);
        }

        public function listarPersonajes() {
            require_once 'php/modelos/mPersonaje.php';

            $personaje = new mPersonaje();
            $personajes = $personaje->listarPersonajes();

            return $personajes;
        }
        
    }
    
?>