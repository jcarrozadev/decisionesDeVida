<?php
    
    class MPersonaje {

        private $conexion;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index, este mensaje
         * se debe cargar en el atributo mensaje del controlador
         * ya que es el que se muestra realmente en la vista
         * @var string
         */
        public readonly string $mensaje;

        public function __construct() {
<<<<<<< HEAD
            require_once 'app/config/configdb.php';
=======
            require_once CONFIG_PATH . 'configdb.php';
>>>>>>> 313f3f4a389334a2fc12cab0baef4aa96b8a727a
        }

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }
<<<<<<< HEAD

=======
        
>>>>>>> 313f3f4a389334a2fc12cab0baef4aa96b8a727a
        /**
         * Lista todos los personajes de la base de datos
         * @return array $personajes Array de personajes con todos los datos
         */
        public function listarPersonajes() {

            $this->conexionBaseDatos();

            $sql = "SELECT * FROM Personaje";
            
            $resultado = $this->conexion->query($sql);
            $personajes = array();
            while ($fila = $resultado->fetch_assoc()) {
                $personajes[] = $fila;
            }
            $this->conexion->close();

            return $personajes;
        }

        /**
         * Obtiene los datos de un personaje en base a su id
         * @param int $id
         * @return array $personaje Array con los datos del personaje
         */
        public function obtenerDatosPersonaje($id) {

            $this->conexionBaseDatos();

            $sql = "SELECT * FROM Personaje WHERE idPersonaje = $id";

            $resultado = $this->conexion->query($sql);
            $personaje = $resultado->fetch_assoc();
            $this->conexion->close();

            return $personaje;
        }

    }
    
?>