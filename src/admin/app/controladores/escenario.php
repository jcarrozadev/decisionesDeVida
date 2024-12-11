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
    
            // Verificar si se ha enviado el formulario con las casillas
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['casilla'])) {
                // Obtener las casillas del formulario
                $casillas = explode('#', $_POST['casilla']);
                $modelo->guardarColisiones($casillas, $id);  // Guardar las colisiones en la base de datos
    
                $this->mensaje = 'Colisiones guardadas correctamente';
            }
    
            $this->tituloPag = 'Modificar Escenario';
            $this->vista = 'modificacionEscenarios'; // Carga la vista de modificación
            return $escenario; // Devuelve los datos del escenario a la vista
        }
          

        

    }