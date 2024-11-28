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
            $resultado = $conexion->query($sql);
            $personajes = array();
            while ($fila = $resultado->fetch_assoc()) {
                $personajes[] = $fila;
            }
            $conexion->close();

            return $personajes;
        }

    }
    
?>