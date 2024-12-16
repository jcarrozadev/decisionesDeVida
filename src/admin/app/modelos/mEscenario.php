<?php

class mEscenario {

    private $conexion;

    public readonly string $mensaje;

    public function __construct() {
        require_once CONFIG_PATH . 'configdb.php';
    }

    private function conexionBBDD() {
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->conexion->set_charset("utf8");
    }

    /**
     * Método que se encarga de listar los escenarios de la base de datos, en la vista de gestión de escenarios
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
     * Método que se encarga de obtener los datos de un escenario
     */
    public function obtenerDatosEscenario($id) {
        $this->conexionBBDD();
        $sql = "SELECT * FROM Escenario WHERE idEscenario = $id";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $escenario = $resultado->fetch_assoc(); 
        } else {
            $escenario = null;
        }

        $this->conexion->close();
        $this->conexionBBDD();

        $sql = "SELECT casilla FROM Colision WHERE idEscenario = $id;";
        $colisiones=[];
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $colisiones[] = $fila['casilla']; // Agrega cada casilla al array
            }
        } else {
            $colisiones = null;
        }

        $escenario['colisiones'] = $colisiones;

        $this->conexion->close();
        return $escenario;
    }

    /**
     * Método que se encarga de actualizar los datos de un escenario, excepto la imagen
     */
    public function actualizarEscenario($id, $nombre, $mensaje, $casillaInicio) {
        $this->conexionBBDD();
        $sql = "UPDATE Escenario SET nombreEscenario = ?, mensajeNarrativo = ?, casillaInicio = ? WHERE idEscenario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $mensaje, $casillaInicio, $id);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function actualizarImagenEscenario($id, $nombreImagen) {
        $this->conexionBBDD();
        $sql = "UPDATE Escenario SET nombreImagen = ? WHERE idEscenario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $nombreImagen, $id);
    
        if (!$stmt->execute()) {
            error_log("Error al actualizar la imagen en la base de datos: " . $stmt->error);
        }
    
        $stmt->close();
        $this->conexion->close();
    }
    

    /**
     * Método que se encarga de guardar las colisiones de un escenario en la base de datos
     */
    public function guardarColisiones($casillas, $id) {
        $this->conexionBBDD();
        $sql="DELETE FROM Colision WHERE idEscenario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $this->conexion->close();
        $this->conexionBBDD();

        $sql = "INSERT INTO Colision (casilla, idEscenario) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);

        foreach ($casillas as $casilla) {
            $stmt->bind_param("si", $casilla, $id);
            $stmt->execute();
        }

        $stmt->close();
        $this->conexion->close();
    }
}
