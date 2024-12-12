<?php

    class MEscenario {

        private $conexion;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index, este mensaje
         * se debe cargar en el atributo mensaje del controlador
         * ya que es el que se muestra realmente en la vista
         * @var string
         */
        public readonly string $mensaje;

        /**
         * Constructor de la clase
         */
        public function __construct() {
            require_once CONFIG_PATH . 'configdb.php';
        }

        /**
         * Conexión de la base de datos
         * @return void
         */
        private function conexionBBDD() {
            $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conexion->set_charset("utf8");
        }

        /**
         * Obtiene los escenarios de la base de datos
         * @return array
         */
        public function listarEscenarios() {
            $this->conexionBBDD();
        
            $sql = "SELECT * FROM Escenario";
        
            $resultado = $this->conexion->query($sql);
        
            if ($resultado->num_rows == 0) { 
                $this->mensaje = "No hay escenarios disponibles.";
                return [];
            }
        
            $escenarios = [];
        
            while ($escenario = $resultado->fetch_assoc()) {
                $escenarios[] = $escenario;
            }
        
            $this->conexion->close();
        
            return $escenarios;
        }


        /**
         * Obtiene los datos de un personaje en base a su id
         * @param int $id
         * @return array $escenarios Array con los datos del personaje
         */
        public function obtenerDatosEscenario($id) {
            // Establecer la conexión a la base de datos
            $this->conexionBBDD();
        
            $sql = "SELECT * FROM Escenario WHERE idEscenario = $id";
            $resultado = $this->conexion->query($sql);
        
            // Verificar si la consulta devolvió algún resultado
            if ($resultado->num_rows > 0) {
                $escenario = $resultado->fetch_assoc(); 
            } else {
                $escenario = null;
            }
    
            $this->conexion->close();
        
            return $escenario;
        }

        /**
         * Actualiza los datos de un escenario en la base de datos
         */
        public function actualizarEscenario($id, $nombre, $mensaje) {
            $this->conexionBBDD();
            
            // Preparar la consulta para actualizar el escenario
            $sql = "UPDATE Escenario SET nombreEscenario = ?, mensajeNarrativo = ? WHERE idEscenario = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssi", $nombre, $mensaje, $id);
            $stmt->execute();
        
            $stmt->close();
            $this->conexion->close();
        }
        
        
        /**
         * Guarda las colisiones de un escenario en la tabla Colision
         */
        public function guardarColisiones($casillas, $id) {
            $this->conexionBBDD();
    
            // Preparar la consulta para insertar las colisiones
            $sql = "INSERT INTO Colision (casilla, idEscenario) VALUES (?, ?)";
            $stmt = $this->conexion->prepare($sql);
    
            // Insertar cada casilla en la base de datos
            foreach ($casillas as $casilla) {
                $stmt->bind_param("si", $casilla, $id);
                $stmt->execute();
            }
    
            // Cerrar la conexión
            $stmt->close();
            $this->conexion->close();
        }

    }