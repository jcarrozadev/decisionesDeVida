<?php

    class Cdialogo {

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
         * Carga la vista de gestion de dialogos y devuelve un array con los dialogos
         * @return array
         */
        public function listarDialogos() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mDialogo.php';

            $dialogo = new mDialogo();
            $dialogos = $dialogo->listarDialogos();

            $this->tituloPag = 'Gestión de Diálogos';
            $this->vista = 'gestionDialogos';
            return $dialogos;
        }

        /**
         * Carga la vista de modificar dialogo y devuelve un array con los datos del dialogo
         * @return mixed array|false
         */
        public function modificarDialogo() {

            require_once CONFIG_PATH . 'config.php';

            $datos = $_POST;
            $id = $_GET['id'];

            require_once MODEL_PATH . 'mDialogo.php';

            $dialogo = new mDialogo();
            $datos = $dialogo->obtenerDatosDialogo($id);

            $this->tituloPag = 'Modificar dialogo';
            $this->vista = 'modificarDialogo';
            return $datos;

        }

        /**
         * Guarda el dialogo en la base de datos
         * @return bool
         */
        public function guardarDialogo() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mDialogo.php';

            $datos = $_POST;

            $modeloDialogo = new mDialogo();
            $resultado = $modeloDialogo->modificarDialogo($datos['idDialogo'], $datos);

            if ($resultado) {
                $this->mensaje = 'El dialogo se ha guardado correctamente';
            } else {
                $this->mensaje = 'Ha habido un error al guardar el dialogo';
            }

            $this->tituloPag = 'Fin Guardar Dialogo';
            echo $this->mensaje;

            return $resultado;
        }

        /**
         * Carga la vista del formulario de alta de dialogo
         * @return void
         */
        public function formularioAltaDialogo() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mNPC.php';

            if (!isset($_POST['listaEscenario'])) {
                /**
                 * 
                 * Esto hay que validarlo con Javascript
                 * 
                 */
                $this->mensaje = 'No se ha seleccionado ningún escenario';
                echo $this->mensaje;
                return false;   

            } else {

                $this->tituloPag = 'Alta Dialogo';
                $this->vista = 'altaDialogo';

                // Llamo al modelo de NPC para sacar el listado de NPCs
                $modeloNPC = new mNPC();
                $npcs = $modeloNPC->listarNPCs();

                $datos['npcs'] = $npcs; // Saco los NPC de la base de datos

                $datos['escenarios'] = $_POST; // Saco la información de escenarios que se ha pasado por POST
            
                // Verificar si se ha enviado el escenario
                if (isset($_POST['listaEscenario'])) {
                    $datos['escenarios'] = explode('#', $_POST['listaEscenario']);
                }

                return $datos;

            }

        }

        /**
         * Da de alta un dialogo en la base de datos
         * @return bool
         */
        public function altaDialogo() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mDialogo.php';

            $datos = $_POST;

            // Validaciones

            if (!isset($datos['nombreDialogo']) || !isset($datos['casilla']) || !isset($datos['listaNPC']) || !isset($datos['idEscenario']) || !isset($datos['mensaje'])) {
                $this->mensaje = 'No se han enviado todos los datos necesarios';
                echo $this->mensaje;
                return false;
            }

            if (!is_numeric($datos['idEscenario'])) {
                $this->mensaje = 'Los datos de Escenario deben ser numéricos';
                echo $this->mensaje;
                return false;
            }

            if (!empty($datos['casilla'])) {

                if (strlen($datos['casilla']) <= 3) {
                    $this->mensaje = 'La casilla debe tener como máximo tres caracteres';
                    echo $this->mensaje;
                    return false;
                }

                if (!preg_match('/^[A-J][1-9]$|^[A-J]1[0-2]$/', $datos['casilla'])) {
                    $this->mensaje = 'La casilla debe ser una letra de la A a la J seguida de un número del 1 al 12';
                    echo $this->mensaje;
                    return false;
                }

            }

            $modeloDialogo = new mDialogo();
            $resultado = $modeloDialogo->altaDialogo($datos);

            if ($resultado) {
                $this->mensaje = 'El dialogo con sus respuestas se ha dado de alta correctamente';
            } else {
                $this->mensaje = 'Ha habido un error al dar de alta el dialogo con sus respuestas';
            }

            $this->tituloPag = 'Fin Alta Dialogo';
            echo $this->mensaje;


            /**
             * 
             * LOS MENSAJES TIENEN QUE PONERSE CON JAVASCRIPT
             * 
             */

        }


        /**
         * Elimina un dialogo de la base de datos
         * @return bool
         */
        public function eliminarDialogo() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mDialogo.php';

            $id = $_GET['id'];

            $modeloDialogo = new mDialogo();
            $resultado = $modeloDialogo->eliminarDialogo($id);

            if ($resultado) {
                $this->mensaje = 'El dialogo se ha eliminado correctamente';
            } else {
                $this->mensaje = 'Ha habido un error al eliminar el dialogo';
            }

            $this->tituloPag = 'Fin Eliminar Dialogo';
            echo $this->mensaje;

            return $resultado;
        }

    }