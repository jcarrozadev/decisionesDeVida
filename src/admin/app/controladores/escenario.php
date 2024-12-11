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
            

            $this->tituloPag = 'Gestión de Escenarios';
            $this->vista = 'gestionEscenarios';
            return $escenarios;

        }
        
        
        public function modificarEscenario() {
            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mEscenario.php';
        
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                $this->vista = 'vMensaje';
                $this->mensaje = 'No se ha seleccionado ningún escenario o el ID es inválido';
                return false; // No se puede continuar sin un ID válido
            }
        
            $id = intval($_GET['id']);
        
            $modelo = new MEscenario();
            $escenario = $modelo->obtenerDatosEscenario($id);
        
            // Verificamos si no se encontró el escenario
            if (!$escenario) {
                $this->vista = 'vMensaje';
                $this->mensaje = 'El escenario no existe o no se pudo cargar';
                return false;
            }
        
            $this->tituloPag = 'Modificar Escenario';
            $this->vista = 'modificacionEscenarios';
        
            // Devolvemos los datos del escenario para ser utilizados en la vista
            return $escenario;
        }
          


    }