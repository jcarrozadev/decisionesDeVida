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
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validar campos obligatorios
                $nombreEscenario = htmlspecialchars(trim($_POST['nombreEscenario'] ?? ''));
                $mensajeNarrativo = htmlspecialchars(trim($_POST['mensajeNarrativo'] ?? ''));
                $casillaInicio = htmlspecialchars(trim($_POST['casillaInicio'] ?? ''));
                $casillas = isset($_POST['casilla']) ? explode('#', $_POST['casilla']) : [];
        
                if (empty($nombreEscenario) || empty($mensajeNarrativo) || empty($casillaInicio)) {
                    echo 'Todos los campos son obligatorios.';
                    return false;
                }
        
                // Procesar imagen
                if (isset($_FILES['imgEscenario']) && $_FILES['imgEscenario']['error'] === UPLOAD_ERR_OK) {
                    // Nombre del archivo subido
                    $nombreArchivo = basename($_FILES['imgEscenario']['name']);
                    
                    // Ruta completa para guardar la imagen en el directorio deseado
                    $rutaDestino = ESCENARIO_PATH . $nombreArchivo;
                
                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($_FILES['imgEscenario']['tmp_name'], $rutaDestino)) {
                        // Guardar el nombre del archivo en la base de datos
                        $modelo->actualizarImagenEscenario($id, $nombreArchivo);
                    } else {
                        echo 'Error al subir la imagen.';
                        return false;
                    }
                }
                
                
        
                // Actualizar otros datos del escenario
                $modelo->actualizarEscenario($id, $nombreEscenario, $mensajeNarrativo, $casillaInicio);
        
                // Guardar las colisiones
                if (!empty($casillas)) {
                    $modelo->guardarColisiones($casillas, $id);
                }
        
                echo 'Escenario actualizado correctamente.';
                return true;
            }
        
            $this->tituloPag = 'Modificar Escenario';
            $this->vista = 'modificacionEscenarios';
            return $modelo->obtenerDatosEscenario($id);
        }
        
           

    }