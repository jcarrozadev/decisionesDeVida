<?php
    
    class MJugador {

        // atributos
        private $conexion;
        public readonly string $mensaje;
    
        public function __construct() {
            require_once 'php/config/configdb.php';
        }

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        /**
         * Metodo para dar de alta a un jugador en la base de datos
         * @param array $datos
         * @return bool
         */
        public function altaJugador($datos) {
            
            $this->conexionBaseDatos();

            // concatenamos el $sql con los datos del jugador y su partida
            $sql = "INSERT INTO Jugador (nombre, dineroTotal, tiempoTotal, idPersonaje) VALUES ('"
            . $this->conexion->real_escape_string($datos['nombre']) . "', "
            . $this->conexion->real_escape_string($datos['dinero']) .", "
            . $this->conexion->real_escape_string($datos['tiempo']) .", "
            . $this->conexion->real_escape_string($datos['idPersonaje']) . ")";

            try {
                $this->conexion->query($sql);
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1452) {
                    $this->mensaje = 'Error al dar de alta al jugador, el personaje seleccionado no existe';
                    return false;
                }
                $this->mensaje = 'Error al dar de alta al jugador';
                return false;
            }

            return true;

        }
    
    }
?>