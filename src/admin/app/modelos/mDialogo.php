<?php

    class MDialogo {

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

        private function conexionBBDD() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        public function altaDialogo($datos) {
            $this->conexionBBDD();
    
            $sql = "INSERT INTO Dialogos (nombreDiálogo, mensaje, casilla, idNPC, idEscenario)
                    VALUES ('" . $this->conexion->real_escape_string($datos['nombreDialogo']) . "', 
                            '" . $this->conexion->real_escape_string($datos['mensaje']) . "', 
                            '" . $this->conexion->real_escape_string($datos['casilla']) . "', 
                            '" . $this->conexion->real_escape_string($datos['listaNPC']) . "', 
                            '" . $this->conexion->real_escape_string($datos['idEscenario']) . "')";
    
            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();
                $this->mensaje = "Error al crear el diálogo: " . $e->getMessage();
                return false;
            }
    
            $this->conexion->close();
            return true;    
        }

    }