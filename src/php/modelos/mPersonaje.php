<?php
    
    class MPersonaje {

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }
        
        public function altaPersonaje($datos) {

            $datos['spriteF'] = file_get_contents($datos['spriteF']['tmp_name']);
            $datos['spriteB'] = file_get_contents($datos['spriteB']['tmp_name']);
            $datos['spriteL'] = file_get_contents($datos['spriteL']['tmp_name']);
            $datos['spriteR'] = file_get_contents($datos['spriteR']['tmp_name']);

            $sql = "INSERT INTO personajes (nombrePersonaje, spriteFront, spriteBack, spriteLeft, spriteRight)
            VALUES ('".$datos['nombre']."', '".$datos['spriteF']."', '".$datos['spriteB']."', '".$datos['spriteL']."', '".$datos['spriteR']."')";

            echo $sql;

            // echo $sql;
            // $conexion = new Conexion();
            // $conexion->query($sql);

            // $conexion->cerrar();
        }

    }
    
?>