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
            require_once 'app/config/configdb.php';
        }

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }
        
        /**
         * Da de alta un personaje en la base de datos
         * Carga en el atributo mensaje el "mensaje resultado" de la operación
         * @param array $datos
         * @return bool
         */
        public function altaPersonaje($datos) {

            $this->conexionBaseDatos();

            
            $sql = "INSERT INTO Personaje (nombrePersonaje, spriteFront, spriteBack, spriteLeft, spriteRight)
            VALUES ('" . $this->conexion->real_escape_string($datos['nombre']) . "', '" . $this->conexion->real_escape_string($datos['spriteF']) . "', '" . $this->conexion->real_escape_string($datos['spriteB']) . "', '" . $this->conexion->real_escape_string($datos['spriteL']) . "', '" . $this->conexion->real_escape_string($datos['spriteR']) . "')";
            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();

                $this->mensaje = "Error al crear el personaje: " . $e->getMessage();
                return false;
            }

            $this->conexion->close();

            $this->mensaje = "Personaje dado de alta exitosamente.";
            return true;
        }

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

        /**
         * Modifica los datos de un personaje en la base de datos
         * Carga en el atributo mensaje el "mensaje resultado" de la operación
         * @param array $datos
         * @return bool
         */
        public function modificarPersonaje($datos) {

            $this->conexionBaseDatos();

            $sql = "UPDATE Personaje SET nombrePersonaje = '" . $this->conexion->real_escape_string($datos['nombre']) . "'";
            if($datos['spriteF'] != null) $sql .= ", spriteFront = '" . $this->conexion->real_escape_string($datos['spriteF']) . "'";
            if($datos['spriteB'] != null) $sql .= ", spriteBack = '" . $this->conexion->real_escape_string($datos['spriteB']) . "'";
            if($datos['spriteL'] != null) $sql .= ", spriteLeft = '" . $this->conexion->real_escape_string($datos['spriteL']) . "'";
            if($datos['spriteR'] != null) $sql .= ", spriteRight = '" . $this->conexion->real_escape_string($datos['spriteR']) . "'";
            $sql .= " WHERE idPersonaje = " . $this->conexion->real_escape_string($datos['id']);

            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();

                $this->mensaje = "Error al modificar el personaje: " . $e->getMessage();
                return false;
            }
            
            $this->conexion->close();

            $this->mensaje = "Personaje modificado exitosamente.";
            return true;

        }

        /**
         * Elimina un personaje de la base de datos
         * Carga en el atributo mensaje el "mensaje resultado" de la operación
         * @param int $id
         * @return bool
         */
        public function eliminarPersonaje($id) {

            $this->conexionBaseDatos();

            $sql = "DELETE FROM Personaje WHERE idPersonaje = $id";

            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                $this->conexion->close();

                if ($e->getCode() == 1451) { // Error code for foreign key constraint failure
                    $this->mensaje = "Error al eliminar el personaje: No se puede borrar el personaje ya que hay algún jugador guardado con este personaje.";
                } else {
                    $this->mensaje = "Error al eliminar el personaje: " . $e->getMessage();
                }
                return false;
            }

            $this->conexion->close();

            $this->mensaje = "Personaje eliminado exitosamente.";
            return true;

        }

    }
    
?>