<?php
    
    class MPersonaje {

        private $conexion;

        public function __construct() {
            require_once 'php/config/configdb.php';
        }

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }
        
        public function altaPersonaje($datos) {

            $this->conexionBaseDatos();

            $sql = "INSERT INTO Personaje (nombrePersonaje, spriteFront, spriteBack, spriteLeft, spriteRight)
            VALUES ('" . $this->conexion->real_escape_string($datos['nombre']) . "', '" . $this->conexion->real_escape_string($datos['spriteF']) . "', '" . $this->conexion->real_escape_string($datos['spriteB']) . "', '" . $this->conexion->real_escape_string($datos['spriteL']) . "', '" . $this->conexion->real_escape_string($datos['spriteR']) . "')";
            $this->conexion->query($sql);

            $this->conexion->close();
        }

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

        public function obtenerDatosPersonaje($id) {

            $this->conexionBaseDatos();

            $sql = "SELECT * FROM Personaje WHERE idPersonaje = $id";

            $resultado = $this->conexion->query($sql);
            $personaje = $resultado->fetch_assoc();
            $this->conexion->close();

            return $personaje;
        }

        public function modificarPersonaje($datos) {

            $this->conexionBaseDatos();

            $sql = "UPDATE Personaje SET nombrePersonaje = '" . $this->conexion->real_escape_string($datos['nombre']) . "'";
            if($datos['spriteF'] != null) $sql .= ", spriteFront = '" . $this->conexion->real_escape_string($datos['spriteF']) . "'";
            if($datos['spriteB'] != null) $sql .= ", spriteBack = '" . $this->conexion->real_escape_string($datos['spriteB']) . "'";
            if($datos['spriteL'] != null) $sql .= ", spriteLeft = '" . $this->conexion->real_escape_string($datos['spriteL']) . "'";
            if($datos['spriteR'] != null) $sql .= ", spriteRight = '" . $this->conexion->real_escape_string($datos['spriteR']) . "'";
            $sql .= " WHERE idPersonaje = " . $this->conexion->real_escape_string($datos['id']);

            $this->conexion->query($sql);
            $this->conexion->close();

        }

        public function eliminarPersonaje($id) {

            $this->conexionBaseDatos();

            $sql = "DELETE FROM Personaje WHERE idPersonaje = $id";

            $this->conexion->query($sql);
            $this->conexion->close();

        }

    }
    
?>