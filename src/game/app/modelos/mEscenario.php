<?php
    
    class MEscenario {

        // atributos
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

        private function conexionBaseDatos() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        /**
         * Carga TODOS LOS DATOS del escenario con el id pasado por parámetro
         */
        public function cargarEscenario($idEscenario) {
            $this->conexionBaseDatos();

            // OBTENEMOS LOS DATOS DEL ESCENARIO
            $sql = "SELECT idEscenario, nombreEscenario, nombreImagen, mensajeNarrativo, casillaInicio FROM Escenario WHERE idEscenario = $idEscenario";
            $result = $this->conexion->query($sql);
            $escenario = $result->fetch_assoc();

            // OBTENEMOS LAS COLISIONES DEL ESCENARIO
            $sql = "SELECT casilla FROM Colision WHERE idEscenario = $idEscenario;";
            $result = $this->conexion->query($sql);
            $colisiones = $result->fetch_all(MYSQLI_ASSOC);

            // LO AÑADIMOS AL ARRAY DE ESCENARIO
            $escenario['colisiones'] = $colisiones;

            // OBTENEMOS LOS DIÁLOGOS DEL ESCENARIO
                // NO SE PUEDE HACER AQUI EL INNER JOIN del DISEÑO DEL NPC
                // ya que si un npc tiene varios dialogos
                // nos volvemos a traer su imagen y es pesado de gestionar
            $sql = "SELECT * FROM Dialogos WHERE idEscenario = $idEscenario;";
            $result = $this->conexion->query($sql);
            $dialogos = $result->fetch_all(MYSQLI_ASSOC);

            // OBTENEMOS LOS NPC DE LOS DIALOGOS CON CASILLA
            for($i = 0; $i < count($dialogos); $i++) {
                if (!empty($dialogos[$i]['casilla'])) {
                    $sql = "SELECT * FROM NPC WHERE idNPC = " . $dialogos[$i]['idNPC'] . ";";
                    $result = $this->conexion->query($sql);
                    $npc = $result->fetch_assoc();
                    $dialogos[$i]['npc'] = $npc;
                }
            }
            // LO AÑADIMOS AL ARRAY DE ESCENARIO
            $escenario['dialogos'] = $dialogos;


            // OBTENEMOS LAS RESPUESTAS DE LOS DIALOGOS
            for ($i = 0; $i < count($escenario['dialogos']); $i++) {
                $dialogo = $escenario['dialogos'][$i];
                
                $sql =
                "SELECT rp1.idRespuesta as rp1idRespuesta,
                        rp1.mensaje as rp1Mensaje,
                        rp1.idDialogo as rp1Dialogo,
                        rp1.idEscenario as rp1Escenario,
                        rp2.idRespuesta as rp2idRespuesta,
                        rp2.mensaje as rp2Mensaje,
                        rp2.idDialogo as rp2Dialogo,
                        rp2.idEscenario as rp2Escenario
                    FROM Dialogos AS dg
                    INNER JOIN Respuestas AS rp1 ON idRespuesta1 = rp1.idRespuesta
                    INNER JOIN Respuestas AS rp2 ON idRespuesta2 = rp2.idRespuesta
                    WHERE dg.idDialogo = " . $dialogo['idDialogo'] . ";";

                $result = $this->conexion->query($sql);
                $respuestas = $result->fetch_assoc();

                $escenario['dialogos'][$i]['respuestas'] = $respuestas;
            }

            // foreach ($escenario['dialogos'] as $dialogo) {
                
            //     $sql =
            //     "SELECT rp1.idRespuesta as rp1idRespuesta,
            //             rp1.mensaje as rp1Mensaje,
            //             rp1.idDialogo as rps1Dialgo,
            //             rp1.idEscenario as rp1Escenario,
            //             rp2.idRespuesta as rp2idRespuesta,
            //             rp2.mensaje as rp1Mensaje,
            //             rp2.idDialogo as rp2Dialogo,
            //             rp2.idEscenario as rp2Escenario
            //         FROM Dialogos AS dg
            //         INNER JOIN Respuestas AS rp1 ON idRespuesta1 = rp1.idRespuesta
            //         INNER JOIN Respuestas AS rp2 ON idRespuesta2 = rp2.idRespuesta
            //         WHERE dg.idDialogo = " . $dialogo['idDialogo'] . ";";

            //         // echo $sql;

            //     $result = $this->conexion->query($sql);
            //     $respuestas = $result->fetch_all(MYSQLI_ASSOC);

            //     $dialogo['respuestas'] = $respuestas;
            // }

            $this->conexion->close();
            return $escenario;
        }
    
    }
?>