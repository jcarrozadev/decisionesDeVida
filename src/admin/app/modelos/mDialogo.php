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

        /**
         * Lista todos los dialogos de la base de datos
         * @return array $dialogos Array de dialogos con todos los datos
         */
        public function listarDialogos() {

            $this->conexionBBDD();

            $sql = "SELECT * FROM Dialogos";
            
            $resultado = $this->conexion->query($sql);
            $dialogos = array();
            while ($fila = $resultado->fetch_assoc()) {
                $dialogos[] = $fila;
            }
            $this->conexion->close();

            return $dialogos;
        }

        /**
         * Obtiene los datos de un dialogo de la base de datos
         * @param int $idDialogo
         * @return array|false
         */
        public function obtenerDatosDialogo($idDialogo) {
            $this->conexionBBDD();

            $sql = "SELECT * FROM Dialogos WHERE idDialogo = $idDialogo";
            $resultado = $this->conexion->query($sql);
            $dialogo = $resultado->fetch_assoc();
            $this->conexion->close();

            return $dialogo;
        }

        /**
         * Modifica los datos de un diálogo en la base de datos
         * @param int $idDialogo
         * @param array $datos
         * @return bool
         */
        public function modificarDialogo($idDialogo, $datos) {
            $this->conexionBBDD();

            $sql = "UPDATE Dialogos SET 
                nombreDiálogo = '" . $this->conexion->real_escape_string($datos['nombreDialogo']) . "',
                mensaje = '" . $this->conexion->real_escape_string($datos['mensaje']) . "',
                casilla = '" . $this->conexion->real_escape_string($datos['casilla']) . "'
                WHERE idDialogo = $idDialogo";

            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();
                $this->mensaje = "Error al modificar el diálogo: " . $e->getMessage();
            return false;
            }

            $this->conexion->close();
            return true;
        }

        

    }