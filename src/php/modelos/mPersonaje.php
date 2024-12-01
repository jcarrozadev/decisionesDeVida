<?php
    
    class MPersonaje {

        public function __construct() {
            require_once 'php/config/configdb.php';
        }
        
        public function altaPersonaje($datos) {

            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conexion->set_charset("utf8");

            $sql = "INSERT INTO Personaje (nombrePersonaje, spriteFront, spriteBack, spriteLeft, spriteRight)
            VALUES ('" . $conexion->real_escape_string($datos['nombre']) . "', '" . $conexion->real_escape_string($datos['spriteF']) . "', '" . $conexion->real_escape_string($datos['spriteB']) . "', '" . $conexion->real_escape_string($datos['spriteL']) . "', '" . $conexion->real_escape_string($datos['spriteR']) . "')";
            $conexion->query($sql);

            $conexion->close();
        }

        public function listarPersonajes() {

            $sql = "SELECT * FROM Personaje";
            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conexion->set_charset("utf8");
            
            $resultado = $conexion->query($sql);
            $personajes = array();
            while ($fila = $resultado->fetch_assoc()) {
                $personajes[] = $fila;
            }
            $conexion->close();

            return $personajes;
        }

        public function obtenerDatosPersonaje($id) {

            $sql = "SELECT * FROM Personaje WHERE idPersonaje = $id";
            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conexion->set_charset("utf8");

            $resultado = $conexion->query($sql);
            $personaje = $resultado->fetch_assoc();
            $conexion->close();

            return $personaje;
        }

        public function modificarPersonaje($datos) {

            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conexion->set_charset("utf8");

            $sql = "UPDATE Personaje SET nombrePersonaje = '" . $conexion->real_escape_string($datos['nombre']) . "'";
            if($datos['spriteF'] != null) $sql .= ", spriteFront = '" . $conexion->real_escape_string($datos['spriteF']) . "'";
            if($datos['spriteB'] != null) $sql .= ", spriteBack = '" . $conexion->real_escape_string($datos['spriteB']) . "'";
            if($datos['spriteL'] != null) $sql .= ", spriteLeft = '" . $conexion->real_escape_string($datos['spriteL']) . "'";
            if($datos['spriteR'] != null) $sql .= ", spriteRight = '" . $conexion->real_escape_string($datos['spriteR']) . "'";
            $sql .= " WHERE idPersonaje = " . $conexion->real_escape_string($datos['id']);

            $conexion->query($sql);
            $conexion->close();

        }

        public function eliminarPersonaje($id) {

            $sql = "DELETE FROM Personaje WHERE idPersonaje = $id";
            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $conexion->set_charset("utf8");

            $conexion->query($sql);
            $conexion->close();

        }

    }
    
?>