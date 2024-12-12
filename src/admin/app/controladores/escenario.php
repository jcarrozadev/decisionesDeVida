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



        public function mEscenario() {
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
                $this->vista = 'vMensaje';
                $this->mensaje = 'No se ha seleccionado ningún escenario';
                return false;
            }
    
            $id = intval($_GET['id']); // Asegúrate de que sea un entero válido
            $modelo = new mEscenario();
            $escenario = $modelo->obtenerDatosEscenario($id);
    
            if (!$escenario) {
                $this->vista = 'vMensaje';
                $this->mensaje = 'El escenario no existe o no se pudo cargar';
                return false;
            }
    
            // Validacion del formulario, que se envíe por POST y que no esten vacios los campos nombre ni mensaje
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombreEscenario']) && isset($_POST['mensajeNarrativo']) && !empty($_POST['nombreEscenario']) && !empty($_POST['mensajeNarrativo'])) {
                $nombreEscenario = htmlspecialchars($_POST['nombreEscenario']);
                $mensajeNarrativo = htmlspecialchars($_POST['mensajeNarrativo']);
                $casillas = isset($_POST['casilla']) ? explode('#', $_POST['casilla']) : [];
            
                // Guardar los cambios en el nombre y el mensaje
                $modelo->actualizarEscenario($id, $nombreEscenario, $mensajeNarrativo);
            
                // Guardar colisiones si se proporcionaron
                if (!empty($casillas)) {
                    $modelo->guardarColisiones($casillas, $id);
                }
            
                $this->mensaje = 'Escenario actualizado correctamente';
                header("Location: index.php?c=escenario&m=mEscenario");
                exit;
            }
            
    
            $this->tituloPag = 'Modificar Escenario';
            $this->vista = 'modificacionEscenarios';
            return $escenario; // Devuelve datos a la vista, en la vista se obtiene con $datos (debido al index.php)
        }
          

        

    }