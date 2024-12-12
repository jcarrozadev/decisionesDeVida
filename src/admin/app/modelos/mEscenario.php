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
        return $escenario;
    }

    public function actualizarEscenario($id, $nombre, $mensaje, $casillaInicio) {
        $this->conexionBBDD();
        $sql = "UPDATE Escenario SET nombreEscenario = ?, mensajeNarrativo = ?, casillaInicio = ? WHERE idEscenario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $mensaje, $casillaInicio, $id);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function guardarColisiones($casillas, $id) {
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
