<?php
    
    class MEscenario {

        // atributos
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
            require_once CONFIG_PATH . 'configdb.php';
        }

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        /**
         * ESTE METODO HAY QUE MEJORARLO ES DEL CHATY, HAY QUE COMPROBAR ERRORES Y RESTO
         */
        public function cargarEscenario($idEscenario) {
            $this->conexionBaseDatos();
            $sql = "SELECT idEscenario, nombreEscenario, nombreImagen, mensajeNarrativo, casillaInicio FROM Escenario WHERE idEscenario = $idEscenario";
            $result = $this->conexion->query($sql);
            $escenario = $result->fetch_assoc();

            $sql = "SELECT casilla FROM Colision WHERE idEscenario = $idEscenario;";
            $result = $this->conexion->query($sql);
            $colisiones = $result->fetch_all(MYSQLI_ASSOC);

            $escenario['colisiones'] = $colisiones;

            $this->conexion->close();
            return $escenario;
        }
    
    }
?>