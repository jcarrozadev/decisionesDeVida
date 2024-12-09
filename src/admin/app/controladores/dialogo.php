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

            if (strlen($datos['casilla']) != 2) {
                $this->mensaje = 'La casilla debe tener exactamente dos caracteres';
                echo $this->mensaje;
                return false;
            }

            if (!preg_match('/^[A-J][1-9]$|^[A-J]1[0-2]$/', $datos['casilla'])) {
                $this->mensaje = 'La casilla debe ser una letra de la A a la J seguida de un número del 1 al 12';
                echo $this->mensaje;
                return false;
            }

            $modeloDialogo = new mDialogo();
            $resultado = $modeloDialogo->altaDialogo($datos);

            if ($resultado) {
                $this->mensaje = 'El dialogo se ha dado de alta correctamente';
            } else {
                $this->mensaje = 'Ha habido un error al dar de alta el dialogo';
            }

            $this->tituloPag = 'Fin Alta Dialogo';
            echo $this->mensaje;


            /**
             * 
             * LOS MENSAJES TIENEN QUE PONERSE CON JAVASCRIPT
             * 
             */

        }

    }