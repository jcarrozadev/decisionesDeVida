<?php
    
    class Cpersonaje {

        public readonly string $vista;
        public readonly string $mensaje;

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }

        public function formularioAlta() {

            $this->vista = 'vAltaPersonaje';

        }
        
        public function altaPersonaje($files, $datos) {
            require_once 'php/modelos/mPersonaje.php';
            require_once 'php/config/config.php';

            $datos += $files;

            if(!$this->validarDatosAlta($datos)) {
                $this->vista = 'vMensaje';
                return false;
            }

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
            $this->mensaje = 'Personaje dado de alta correctamente';
            return true;
        }

        private function validarDatosAlta($datos) {
            
            // Comprobamos que los datos vengan rellenos
            if(empty($datos['nombre']) || empty($datos['spriteF']['tmp_name']) || empty($datos['spriteB']['tmp_name'])
                || empty($datos['spriteL']['tmp_name']) || empty($datos['spriteR']['tmp_name'])) {

                $this->mensaje = 'Faltan datos';
                return false;
            }

            // Comprobamos que el nombre no tenga más de 50 caracteres
            if(strlen($datos['nombre']) > 50) {
                $this->mensaje = 'El nombre no puede tener más de 50 caracteres';
                return false;
            }

            // Comprobamos que el nombre no tenga caracteres especiales para evitar inyecciones SQL etc...
            if(preg_match(CARACTERES_NO_PERMITIDOS, $datos['nombre'])) {
                $this->mensaje = 'El nombre no puede contener caracteres especiales';
                return false;
            }

            // Comprobamos que las imagenes sean PNG y no ejecutables etc...
            if($datos['spriteF']['type'] != 'image/png' || $datos['spriteB']['type'] != 'image/png'
                || $datos['spriteL']['type'] != 'image/png' || $datos['spriteR']['type'] != 'image/png') {

                $this->mensaje = 'Los sprites deben ser de tipo PNG';
                return false;
            }

            // Comprobamos el tamaño de las imagenes entre 1 byte y 10 KB
            if(($datos['spriteF']['size'] < 1 || $datos['spriteF']['size'] > MAX_SPRITE_SIZE)
                || ($datos['spriteB']['size'] < 1 || $datos['spriteB']['size'] > MAX_SPRITE_SIZE)
                || ($datos['spriteL']['size'] < 1 || $datos['spriteL']['size'] > MAX_SPRITE_SIZE)
                || ($datos['spriteR']['size'] < 1 || $datos['spriteR']['size'] > MAX_SPRITE_SIZE)) {

                $this->mensaje = 'Los sprites deben tener un tamaño entre 1 byte y 10 KB';
                return false;
            }

            return true;
        }

        public function listarPersonajes() {
            require_once 'php/modelos/mPersonaje.php';

            $personaje = new mPersonaje();
            $personajes = $personaje->listarPersonajes();

            $this->vista = 'vListarPersonajes';
            return $personajes;
        }

        public function modificarPersonaje($files, $datos, $id) {

            if($id == null) {
                $this->vista = 'vMensaje';
                $this->mensaje = 'No se ha seleccionado ningún personaje';
                return false;
            }

            require_once 'php/modelos/mPersonaje.php';

            $personaje = new mPersonaje();
            $personaje = $personaje->obtenerDatosPersonaje($id);

            $this->vista = 'vModificarPersonaje';
            return $personaje;

        }

        public function modificarPersonajeGuardar($files, $datos) {

            require_once 'php/modelos/mPersonaje.php';

                // validamos el nombre
            if(!$this->validarDatosModificar($datos)) {
                print_r($datos);
                $this->vista = 'vMensaje';
                return false;
            }

            if(empty($files['spriteF']['tmp_name'])) {
                $datos['spriteF'] = null;
            } else {
                move_uploaded_file($files['spriteF']['tmp_name'], SPRITE_PATH . $files['spriteF']['name']);
                $datos['spriteF'] = file_get_contents(SPRITE_PATH . $files['spriteF']['name']);
            }

            if(empty($files['spriteB']['tmp_name'])) {
                $datos['spriteB'] = null;
            } else {
                move_uploaded_file($files['spriteB']['tmp_name'], SPRITE_PATH . $files['spriteB']['name']);
                $datos['spriteB'] = file_get_contents(SPRITE_PATH . $files['spriteB']['name']);
            }

            if(empty($files['spriteL']['tmp_name'])) {
                $datos['spriteL'] = null;
            } else {
                move_uploaded_file($files['spriteL']['tmp_name'], SPRITE_PATH . $files['spriteL']['name']);
                $datos['spriteL'] = file_get_contents(SPRITE_PATH . $files['spriteL']['name']);
            }

            if(empty($files['spriteR']['tmp_name'])) {
                $datos['spriteR'] = null;
            } else {
                move_uploaded_file($files['spriteR']['tmp_name'], SPRITE_PATH . $files['spriteR']['name']);
                $datos['spriteR'] = file_get_contents(SPRITE_PATH . $files['spriteR']['name']);
            }

            $personaje = new mPersonaje();
            $personaje->modificarPersonaje($datos);
            
            $this->vista = 'vMensaje';
            $this->mensaje = 'Personaje modificado correctamente';
            return true;

        }

        private function validarDatosModificar($datos) {

            // Comprobamos que los datos vengan rellenos
            if(empty($datos['nombre'])) {

                $this->mensaje = 'Faltan datos';
                return false;
            }

            // Comprobamos que el nombre no tenga más de 50 caracteres
            if(strlen($datos['nombre']) > 50) {
                $this->mensaje = 'El nombre no puede tener más de 50 caracteres';
                return false;
            }

            // Comprobamos que el nombre no tenga caracteres especiales para evitar inyecciones SQL etc...
            if(preg_match(CARACTERES_NO_PERMITIDOS, $datos['nombre'])) {
                $this->mensaje = 'El nombre no puede contener caracteres especiales';
                return false;
            }

            return true;

        }
        
        public function eliminarPersonaje($files, $datos, $id) {

            require_once 'php/modelos/mPersonaje.php';

            $personaje = new mPersonaje();
            $personaje->eliminarPersonaje($id);

            $this->vista = 'vMensaje';
            $this->mensaje = 'Personaje eliminado correctamente';

            return true;

        }
    }
    
?>