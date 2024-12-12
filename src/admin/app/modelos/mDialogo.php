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

        /**
         * Comprueba si un diálogo ya existe en la base de datos
         * @param string $nombreDialogo
         * @return bool
         */
        public function comprobarDialogoExiste($nombreDialogo) {
            $this->conexionBBDD();

            $sql = "SELECT * FROM Dialogos WHERE nombreDiálogo = '$nombreDialogo'";
            $resultado = $this->conexion->query($sql);
            $this->conexion->close();

            if ($resultado->num_rows > 0) {
                return true;
            }

            return false;
        }

        /**
         * Da de alta un diálogo en la base de datos
         * @param array $datos
         * @return bool
         */
        public function altaDialogo($datos) {

            if ($this->comprobarDialogoExiste($datos['nombreDialogo'])) {
                $this->mensaje = "El diálogo ya existe. ";
                echo $this->mensaje;
                return false;
            } else {

                $this->conexionBBDD();

                $sql = "INSERT INTO Dialogos (nombreDiálogo, mensaje, casilla, idNPC, idEscenario)
                    VALUES ('" . $this->conexion->real_escape_string($datos['nombreDialogo']) . "', 
                            '" . $this->conexion->real_escape_string($datos['mensaje']) . "', 
                            '" . $this->conexion->real_escape_string($datos['casilla']) . "', 
                            '" . $this->conexion->real_escape_string($datos['listaNPC']) . "', 
                            '" . $this->conexion->real_escape_string($datos['idEscenario']) . "')";
        
                try {
                    $this->conexion->query($sql);
                    $idDialogo = $this->conexion->insert_id; // Obtener el id del diálogo insertado
                } catch (mysqli_sql_exception $e) {
                    $this->mensaje = "Error al crear el diálogo: " . $e->getMessage();
                    echo $this->mensaje;
                    return false;
                }
            
                if ($this->altaRespuestas($datos, $idDialogo)) {
                    return true;
                }
        
                return false;  

            }

            $this->conexion->close();
        
            
        }
        
        /**
         * Da de alta las respuestas de un diálogo en la base de datos
         * @param array $datos
         * @param int $idDialogo
         * @return bool
         */
        public function altaRespuestas($datos, $idDialogo) {
            $this->conexionBBDD();
            
            $sqlRespuesta1 = "INSERT INTO Respuestas (mensaje)
                    VALUES ('" . $this->conexion->real_escape_string($datos['respuesta1']) . "')";
            if (!$this->conexion->query($sqlRespuesta1)) {
                echo "Error en la inserción de respuesta1: " . $this->conexion->error;  // Mostrar el error
                return false;
            }
            $idRespuesta1 = $this->conexion->insert_id;
            
            $sqlRespuesta2 = "INSERT INTO Respuestas (mensaje)
                    VALUES ('" . $this->conexion->real_escape_string($datos['respuesta2']) . "')";
            if (!$this->conexion->query($sqlRespuesta2)) {
                echo "Error en la inserción de respuesta2: " . $this->conexion->error;  // Mostrar el error
                return false;
            }
            $idRespuesta2 = $this->conexion->insert_id;
        
            $this->actualizarRespuestasDialogos($idRespuesta1, $idRespuesta2, $idDialogo);
            
            return true;
            $this->conexion->close();
        }        

        /**
         * Actualiza las respuestas de un diálogo en la base de datos
         * @param int $idRespuesta1
         * @param int $idRespuesta2
         * @param int $idDialogo
         * @return bool
         */
        public function actualizarRespuestasDialogos($idRespuesta1, $idRespuesta2, $idDialogo) {
            $this->conexionBBDD();
    
            $sql = "UPDATE Dialogos SET idRespuesta1 = $idRespuesta1, idRespuesta2 = $idRespuesta2 WHERE idDialogo = $idDialogo";
    
            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();
                $this->mensaje = "Error al actualizar las respuestas de los diálogos: " . $e->getMessage();
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

        /**
         * Elimina un diálogo de la base de datos
         * @param int $idDialogo
         * @return bool
         */
        public function eliminarDialogo($idDialogo) {
            $this->conexionBBDD();

            $sql = "DELETE FROM Dialogos WHERE idDialogo = $idDialogo";

            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();
                $this->mensaje = "Error al eliminar el diálogo: " . $e->getMessage();
                return false;
            }

            $this->conexion->close();
            return true;
        }

    }