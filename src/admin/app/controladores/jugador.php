<?php
    
    class Cjugador {

        // atributos

        /**
         * Se carga un string con el nombre de la vista que se
         * va a cargar en el index para mostrar la información
         * esta vista va sin extension ya que todas son php
         * @var string
         */
        public readonly string $vista;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index
         * @var string
         */
        public readonly string $mensaje;

        // constructor
        public function __construct() {}

        // metodos

        /**
         * Metodo (temporal) para mostrar el
         * formulario de alta de un jugador
         * @return array Devuelve los personajes a disponibles
         */
        public function formularioAlta() {

            require_once MODEL_PATH . 'mPersonaje.php';

            $objPersonaje = new MPersonaje();
            $personajes = $objPersonaje->listarPersonajes();

            $this->vista = 'altaJugador';
            return $personajes;
        }

        /**
         * Método para dar de alta a un jugador con
         * todos sus datos al final de la partida
         * @return bool
         */
        public function altaJugador() {

            /*
                Este metodo tendria un problema, ya que todo la parte del cliente es modificable
                por lo que un usuario malintencionado podria modificar los valores del juego y enviar
                datos incorrectos o puntuaciones más altas de las que realmente ha obtenido.
            */

<<<<<<< HEAD
            require_once 'app/config/config.php';
=======
            require_once CONFIG_PATH . 'config.php';
>>>>>>> 313f3f4a389334a2fc12cab0baef4aa96b8a727a
            require_once MODEL_PATH . 'mJugador.php';

            $datos = $_POST;

            if(!$this->validarDatosAlta($datos)) {
                $this->vista = 'vMensaje';
                return false;
            }

            $jugador = new MJugador();
            $estado = $jugador->altaJugador($datos);

            if(!$estado) {
                $this->vista = 'vMensaje';
                $this->mensaje = $jugador->mensaje;
                return false;
            }

            $this->vista = 'vMensaje';
            $this->mensaje = 'Jugador dado de alta correctamente';
            return true;
        }

        /**
         * Método para validar los datos de alta de un jugador
         * @param array $datos Datos del jugador
         * @return bool
         */
        public function validarDatosAlta($datos) {

            // Comprobamos que los datos vengan rellenos
            if(empty($datos['nombre']) || empty($datos['dinero']) || empty($datos['tiempo']) || empty($datos['idPersonaje'])) {
                $this->mensaje = 'Faltan datos';
                return false;
            }

            if(strlen($datos['nombre']) > 50) {
                $this->mensaje = 'El nombre no puede tener más de 50 caracteres';
                return false;
            }

            if(preg_match(CARACTERES_NO_PERMITIDOS, $datos['nombre'])) {
                $this->mensaje = 'El nombre no puede contener caracteres especiales';
                return false;
            }

            if(!is_numeric($datos['dinero']) || !is_numeric($datos['tiempo'])) {
                $this->mensaje = 'El dinero y el tiempo deben ser numéricos';
                return false;
            }

            if($datos['dinero'] > DINERO_MAX || $datos['tiempo'] > TIEMPO_MAX) {
                $this->mensaje = 'El dinero y/o el tiempo no pueden ser mayores de ' . DINERO_MAX . '€ y ' . TIEMPO_MAX . 'h respectivamente';
                return false;
            }

            return true;

        }
    }
    
?>