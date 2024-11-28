<?php
    
    class CPersonaje {

        public readonly string $vista;

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }

        public function formularioAlta() {

            $this->vista = 'vAltaPersonaje';

        }
        
        public function altaPersonaje($datos, $files) {
            require_once 'php/modelos/mPersonaje.php';
            require_once 'php/config/config.php';

            $datos = $datos + $files;

            move_uploaded_file($datos['spriteF']['tmp_name'], SPRITE_PATH . $datos['spriteF']['name']);
            move_uploaded_file($datos['spriteB']['tmp_name'], SPRITE_PATH . $datos['spriteB']['name']);
            move_uploaded_file($datos['spriteL']['tmp_name'], SPRITE_PATH . $datos['spriteL']['name']);
            move_uploaded_file($datos['spriteR']['tmp_name'], SPRITE_PATH . $datos['spriteR']['name']);

            $datos['spriteF'] = file_get_contents(SPRITE_PATH . $datos['spriteF']['name']);
            $datos['spriteB'] = file_get_contents(SPRITE_PATH . $datos['spriteB']['name']);
            $datos['spriteL'] = file_get_contents(SPRITE_PATH . $datos['spriteL']['name']);
            $datos['spriteR'] = file_get_contents(SPRITE_PATH . $datos['spriteR']['name']);

            $personaje = new mPersonaje();
            $personaje->altaPersonaje($datos);

            $this->vista = 'vMensaje';
            return 'Personaje dado de alta correctamente';
        }

        public function listarPersonajes() {
            require_once 'php/modelos/mPersonaje.php';

            $personaje = new mPersonaje();
            $personajes = $personaje->listarPersonajes();

            $this->vista = 'vListarPersonajes';
            return $personajes;
        }
        
    }
    
?>