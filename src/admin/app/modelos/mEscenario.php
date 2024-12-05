<?php

    class MEscenario {

        private $conexion;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index, este mensaje
         * se debe cargar en el atributo mensaje del controlador
         * ya que es el que se muestra realmente en la vista
         * @var string
         */
        public readonly string $mensaje;

        /**
         * Constructor de la clase
         */
        public function __construct() {
            require_once 'php/config/configdb.php';
        }

        /**
         * Conexión de la base de datos
         * @return void
         */
        private function conexionBBDD() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        /**
         * Obtiene los escenarios de la base de datos
         * @return array
         */
        public function listarEscenarios() {

            $this->conexionBBDD();

            $sql = "SELECT * FROM Escenario";

            $resultado = $this->conexion->query($sql);

            if ($resultado->num_rows == 0) { 
                return false;
            }

            $escenarios = [];

            while ($escenario = $resultado->fetch_assoc()) {
                $escenarios[] = $escenario;
            }

            $this->conexion->close();

            return $escenarios;
        }

    }