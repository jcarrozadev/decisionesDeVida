<?php

    class MNPC {

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
         * Da de alta un personaje en la base de datos
         * Carga en el atributo mensaje el "mensaje resultado" de la operación
         * @param array $datos
         * @return bool
         */
        public function altaNPC($datos) {

            $this->conexionBBDD();

            
            $sql = "INSERT INTO NPC (nombreNPC, sprite)
            VALUES ('" . $this->conexion->real_escape_string($datos['nombre']) . "', '" . $this->conexion->real_escape_string($datos['npcSprite']) . "')";

            try {

                $this->conexion->query($sql);

            } catch (mysqli_sql_exception $e) {

                $this->conexion->close();

                $this->mensaje = "Error al crear el personaje: " . $e->getMessage();

                return false;
            }

            $this->conexion->close();

            $this->mensaje = "NPC creado correctamente en la base de datos.";
            return true;
        }

    }