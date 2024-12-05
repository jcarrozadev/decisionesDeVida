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

            $this->tituloPag = 'Alta Dialogo';
            $this->vista = 'obtenerEscenario';

        }


        /**´
         * Método que se encarga de obtener los escenarios de la base de datos
         * @return array
         */
        public function listarEscenarios() {

            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mEscenario.php';

            $mEscenario = new MEscenario();
            $escenarios = $mEscenario->listarEscenarios();

            if(!$escenarios) { // Si no hay escenarios que se muestre por Javascript el mensaje
                $this->mensaje = 'No se han encontrado escenarios';
                return false;
            }

            return $escenarios;

        }

    }