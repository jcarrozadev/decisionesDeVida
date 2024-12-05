<?php

    class Ccontrolador {
        /**
         * Nombre de la vista a cargar
         * @var string
         */
        public string $vista;

        /**
         * Título de la página
         * @var string
         */
        public string $tituloPag;

        /**
         * Mensaje a mostrar en la vista
         * @var string
         */
        public string $mensaje;

        /**
         * Constructor de la clase Controlador
         */
        public function __construct(string $vista = '', string $tituloPag = '', string $mensaje = '')
        {
            $this->vista = $vista;
            $this->tituloPag = $tituloPag;
            $this->mensaje = $mensaje;
        }

        /**
         * Establece la vista a cargar
         */
        public function setVista(string $vista): void
        {
            $this->vista = $vista;
        }

        /**
         * Obtiene la vista actual
         */
        public function getVista(): string
        {
            return $this->vista;
        }

        /**
         * Establece el título de la página
         */
        public function setTituloPag(string $tituloPag): void
        {
            $this->tituloPag = $tituloPag;
        }

        /**
         * Obtiene el título de la página
         */
        public function getTituloPag(): string
        {
            return $this->tituloPag;
        }

        /**
         * Establece un mensaje
         */
        public function setMensaje(string $mensaje): void
        {
            $this->mensaje = $mensaje;
        }

        /**
         * Obtiene el mensaje actual
         */
        public function getMensaje(): string
        {
            return $this->mensaje;
        }
    }
