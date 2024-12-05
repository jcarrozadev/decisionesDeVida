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

            $this->tituloPag = 'Alta Dialogo';
            $this->vista = 'altaDialogo';

            $datos = $_POST;

            $datos = explode('#', $datos['listaEscenario']);

            return $datos;

        }

    }