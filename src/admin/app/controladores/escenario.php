<?php

class Cescenario {

    public readonly string $vista;
    public readonly string $tituloPag;
    public readonly string $mensaje;

    public function __construct() {}

    public function formularioObtenerEscenario() {
        $datos = $this->listarEscenarios();
        $this->tituloPag = 'Alta Dialogo';
        $this->vista = 'obtenerEscenario';
        return $datos;
    }

    public function mEscenario() {
        require_once MODEL_PATH . 'mEscenario.php';
        $modeloEscenario = new mEscenario();
        $datos = $modeloEscenario->listarEscenarios();
        $this->tituloPag = 'Gestión de Escenarios';
        $this->vista = 'gestionEscenarios';
        return $datos;
    }

    private function listarEscenarios() {
        require_once CONFIG_PATH . 'config.php';
        require_once MODEL_PATH . 'mEscenario.php';

        $escenario = new mEscenario();
        $escenarios = $escenario->listarEscenarios();

        if(!$escenarios) { 
            $this->mensaje = 'No se han encontrado escenarios';
            return false;
        }
        return $escenarios;
    }

    public function modificarEscenario() {
        require_once CONFIG_PATH . 'config.php';
        require_once MODEL_PATH . 'mEscenario.php';

        if (!isset($_GET['id'])) {
            $this->vista = 'vMensaje';
            $this->mensaje = 'No se ha seleccionado ningún escenario';
            return false;
        }

        $id = intval($_GET['id']);
        $modelo = new mEscenario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombreEscenario'], $_POST['mensajeNarrativo'], $_POST['casilla'], $_POST['casillaInicio'])) {
            // Obtener los valores del formulario
            $nombreEscenario = htmlspecialchars($_POST['nombreEscenario']);
            $mensajeNarrativo = htmlspecialchars($_POST['mensajeNarrativo']);
            $casillaInicio = htmlspecialchars($_POST['casillaInicio']); // Casilla de inicio
            $casillas = isset($_POST['casilla']) ? explode('#', $_POST['casilla']) : []; // Casillas seleccionadas

            // Guardar los cambios en el nombre y el mensaje
            $modelo->actualizarEscenario($id, $nombreEscenario, $mensajeNarrativo, $casillaInicio);

            // Guardar las colisiones si las casillas no están vacías
            if (!empty($casillas)) {
                $modelo->guardarColisiones($casillas, $id);
            }

            // Mensaje de éxito
            $this->mensaje = 'Escenario actualizado correctamente';
            header("Location: index.php?c=escenario&m=mEscenario");
            exit;
        }

        $this->tituloPag = 'Modificar Escenario';
        $this->vista = 'modificacionEscenarios';
        return $modelo->obtenerDatosEscenario($id);
    }
}
