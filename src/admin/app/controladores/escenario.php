<?php

    class Cescenario {

        /**
         * Se carga un string con el nombre de la vista que se va a mostrar
         */
        public readonly string $vista;

        /**
         * Se carga un string con el título de la página
         */
        public readonly string $tituloPag;

        /**
         * Se carga un string con el mensaje que se mostrará en la vista
         */
        public readonly string $mensaje;

        /**
         * Constructor de la clase
         */
        public function __construct() {}

        /**
         * Carga la vista del formulario de alta de dialogo
         * @return void
         */
        public function formularioObtenerEscenario() {

            $datos = $this->listarEscenarios();

            $this->tituloPag = 'Alta Dialogo';
            $this->vista = 'obtenerEscenario';

            return $datos;

        }



        public function gestionEscenario() {
            require_once MODEL_PATH . 'mEscenario.php';
        
            $modeloEscenario = new mEscenario();
            $datos = $modeloEscenario->listarEscenarios();
        
            $this->tituloPag = 'Gestión de Escenarios';
            $this->vista = 'gestionEscenarios';
        
            return $datos;
        }



        /**´
         * Método que se encarga de obtener los escenarios de la base de datos
         * @return array
         */
        private function listarEscenarios() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mEscenario.php';

            $escenario = new mEscenario();
            $escenarios = $escenario->listarEscenarios();

            
            if(!$escenarios) { // Si no hay escenarios que se muestre por Javascript el mensaje
                $this->mensaje = 'No se han encontrado escenarios';
                return false;
            }
            

           // $this->tituloPag = 'Gestión de Escenarios';
            //$this->vista = 'gestionEscenarios';
            return $escenarios;

        }
        
        /**
         * Metodo que se encarga de modificar un escenario
         */
        public function modificarEscenario() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mEscenario.php';
        
            if (!isset($_GET['id'])) {
                $this->mensaje = 'No se ha seleccionado ningún escenario';
                echo $this->mensaje;
                return false;
            }
        
            $id = intval($_GET['id']);
            $modelo = new mEscenario();
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombreEscenario'], $_POST['mensajeNarrativo'], $_POST['casilla'], $_POST['casillaInicio'])) {
                // Validar y obtener los valores del formulario
                $nombreEscenario = htmlspecialchars(trim($_POST['nombreEscenario'] ?? ''));
                $mensajeNarrativo = htmlspecialchars(trim($_POST['mensajeNarrativo'] ?? ''));
                $casillaInicio = htmlspecialchars(trim($_POST['casillaInicio'] ?? '')); // Casilla de inicio
                $casillas = isset($_POST['casilla']) ? explode('#', $_POST['casilla']) : []; // Casillas seleccionadas
            
                // Validar que los campos obligatorios no estén vacíos
                if (empty($nombreEscenario)) {
                    $this->mensaje = 'El nombre del escenario no puede estar vacío.';
                    echo $this->mensaje;
                    return false;
                }
            
                if (empty($mensajeNarrativo)) {
                    $this->mensaje = 'El mensaje narrativo no puede estar vacío.';
                    echo $this->mensaje;
                    return false;
                }
            
                if (empty($casillaInicio)) {
                    $this->mensaje = 'La casilla de inicio no puede estar vacía.';
                    echo $this->mensaje;
                    return false;
                }
            
                // Procesar y guardar los datos
                $modelo->actualizarEscenario($id, $nombreEscenario, $mensajeNarrativo, $casillaInicio);
            
                // Guardar las colisiones si las casillas no están vacías
                if (!empty($casillas)) {
                    $modelo->guardarColisiones($casillas, $id);
                }
            
                // Mensaje de éxito
                $this->mensaje = 'Escenario actualizado correctamente';
                echo $this->mensaje;
                return true;
            }
            
                // Establecer el título y la vista en caso de que no sea un POST válido
                $this->tituloPag = 'Modificar Escenario';
                $this->vista = 'modificacionEscenarios';
                return $modelo->obtenerDatosEscenario($id);
            
            }
           

    }