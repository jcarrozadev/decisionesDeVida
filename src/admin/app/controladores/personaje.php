<?php
    
    class Cpersonaje {

        /**
         * Se carga un string con el nombre de la vista que se
         * va a cargar en el index para mostrar la información
         * esta vista va sin extension ya que todas son php
         * @var string
         */
        public readonly string $vista;


        /**
         * Se carga un string para agregar el titulo de la vista
         * @var string
         */
        public readonly string $tituloPag;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index
         * @var string
         */
        public readonly string $mensaje;

        public function __construct() {}

        /**
         * Carga la vista del formulario de alta de personaje
         * @return void
         */
        public function formularioAlta() {

            $this->tituloPag = 'Alta personaje';
            $this->vista = 'altaPersonaje';

        }
        
        /**
         * Da de alta un personaje validando los datos de $_FILES y $_POST
         * y guardando las imagenes en la carpeta de sprites
         * @return bool
         */
        public function altaPersonaje() {
            
            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mPersonaje.php';

            $files = $_FILES;
            $datos = $_POST;

            $datos += $files;

            if(!$this->validarDatosAlta($datos)) {
                echo $this->mensaje;
                return false;
            }

            move_uploaded_file($datos['spriteF']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_F.png');
            move_uploaded_file($datos['spriteB']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_B.png');
            move_uploaded_file($datos['spriteL']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_L.png');
            move_uploaded_file($datos['spriteR']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_R.png');

            $datos['spriteF'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_F.png');
            $datos['spriteB'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_B.png');
            $datos['spriteL'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_L.png');
            $datos['spriteR'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_R.png');

            $personaje = new mPersonaje();
            $estado = $personaje->altaPersonaje($datos);

            // mandamos el mensaje a JavaScript
            echo $personaje->mensaje;

            // esto no es realmente necesario pero lo dejo por
            // si hubiese algun cambio en el index en deteccion de errores
            if(!$estado) {
                return false;
            }

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

        /**
         * Carga la vista de gestion de personajes y devuelve un array con los personajes
         * @return array
         */
        public function listarPersonajes() {

            /*
                Falta comprobar si se ha conseguido listar algun personaje
                si no, poner un comentario como que no hay personajes disponibles
            */
            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mPersonaje.php';

            $personaje = new mPersonaje();
            $personajes = $personaje->listarPersonajes();

            $this->tituloPag = 'Gestión de personajes';
            $this->vista = 'gestionPersonajes';
            return $personajes;
        }

        /**
         * Carga la vista de modificar personaje y devuelve un array con los datos del personaje
         * @return mixed array|false
         */
        public function modificarPersonaje() {

            require_once 'app/config/config.php';
            
            if(!isset($_GET['id'])) {
                $this->vista = 'vMensaje';
                $this->mensaje = 'No se ha seleccionado ningún personaje';
                return false;
            }

            $files = $_FILES;
            $datos = $_POST;
            $id = $_GET['id'];

            require_once MODEL_PATH . 'mPersonaje.php';

            $personaje = new mPersonaje();
            $personaje = $personaje->obtenerDatosPersonaje($id);

            $this->tituloPag = 'Modificar personaje';
            $this->vista = 'modificarPersonaje';
            return $personaje;

        }

        /**
         * Modifica un personaje validando los datos de $_FILES y $_POST
         * y guardando las imagenes en la carpeta de sprites
         * @return bool
         */
        public function modificarPersonajeGuardar() {

            /*
                Al modificar el nombre del personaje se debería modificar el nombre
                de los sprites de la copia de seguridad pero no me ha dado tiempo
            */

            $files = $_FILES;
            $datos = $_POST;

            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mPersonaje.php';

                // validamos el nombre
            if(!$this->validarDatosModificar($datos)) {
                // manda a JavaScript el mensaje
                echo $this->mensaje;
                return false; // detener la ejecucion del metodo
            }

            if(empty($files['spriteF']['tmp_name'])) {
                $datos['spriteF'] = null;
            } else {

                if(!$this->validarDatosImagen($files['spriteF'])) {
                    echo $this->mensaje;
                    return false;
                }

                move_uploaded_file($files['spriteF']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_F.png');
                $datos['spriteF'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_F.png');
            }

            if(empty($files['spriteB']['tmp_name'])) {
                $datos['spriteB'] = null;
            } else {

                if(!$this->validarDatosImagen($files['spriteB'])) {
                    echo $this->mensaje;
                    return false;
                }

                move_uploaded_file($files['spriteB']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_B.png');
                $datos['spriteB'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_B.png');
            }

            if(empty($files['spriteL']['tmp_name'])) {
                $datos['spriteL'] = null;
            } else {

                if(!$this->validarDatosImagen($files['spriteL'])) {
                    echo $this->mensaje;
                    return false;
                }

                move_uploaded_file($files['spriteL']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_L.png');
                $datos['spriteL'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_L.png');
            }

            if(empty($files['spriteR']['tmp_name'])) {
                $datos['spriteR'] = null;
            } else {

                if(!$this->validarDatosImagen($files['spriteR'])) {
                    echo $this->mensaje;
                    return false;
                }

                move_uploaded_file($files['spriteR']['tmp_name'], SPRITE_PATH . $datos['nombre'] . '_R.png');
                $datos['spriteR'] = file_get_contents(SPRITE_PATH . $datos['nombre'] . '_R.png');
            }

            $personaje = new mPersonaje();
            $estado = $personaje->modificarPersonaje($datos);
            
            $this->mensaje = $personaje->mensaje;

            // mandamos el mensaje a JavaScript
            echo $this->mensaje;

            if(!$estado) {
                return false;
            }
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

        private function validarDatosImagen($datosImagen) {

            // Comprobamos que las imagenes sean PNG y no ejecutables etc...
            if($datosImagen['type'] != 'image/png') {
                $this->mensaje = 'Los sprites deben ser de tipo PNG';
                return false;
            }

            // Comprobamos el tamaño de las imagenes entre 1 byte y 10 KB
            if($datosImagen['size'] < 1 || $datosImagen['size'] > MAX_SPRITE_SIZE) {
                $this->mensaje = 'Los sprites deben tener un tamaño entre 1 byte y 10 KB';
                return false;
            }

            return true;

        }
        
        /**
         * Elimina un personaje de la base de datos y de la carpeta de sprites
         * Carga la vista de mensaje con el mensaje correspondiente en sus atributos
         * @return bool
         */
        public function eliminarPersonaje() {

            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mPersonaje.php';

            $files = $_FILES;
            $datos = $_POST;
            $id = $_GET['id'];

            $personaje = new mPersonaje();
            $estado = $personaje->eliminarPersonaje($id);

            $this->mensaje = $personaje->mensaje;
            
            // mandamos el mensaje a JavaScript
            echo $this->mensaje;

            if(!$estado) {
                return false;
            }
            return true;

        }
    }
    
?>