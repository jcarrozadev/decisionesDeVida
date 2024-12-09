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

                $this->tituloPag = 'Alta Dialogo';
                $this->vista = 'altaDialogo';

                // Llamo al modelo de NPC para sacar el listado de NPCs
                $modeloNPC = new mNPC();
                $npcs = $modeloNPC->listarNPCs();

                $datos['npcs'] = $npcs; // Saco los NPC de la base de datos
                $datos['escenarios'] = $_POST; // Saco la información de escenarios que se ha pasado por POST
                
                // Divido el id y el nombre del escenario
                $datos['escenarios'] = explode('#', $datos['escenarios']['listaEscenario']); 

                return $datos;

            }

    }