<?php
    
    class Cpersonaje {

        /**
         * Se carga un string con el nombre de la vista que se
         * va a cargar en el index para mostrar la información
         * esta vista va sin extension ya que todas son php
         * @var string
         */
        public readonly string $vista;


        /**
         * Se carga un string para agregar el titulo de la vista
         * @var string
         */
        public readonly string $tituloPag;

        /**
         * Se carga un string con el mensaje que se mostrará
         * en la vista que se cargue en el index
         * @var string
         */
        public readonly string $mensaje;

        public function __construct() {}

        /**
         * Carga la vista de gestion de personajes y devuelve un array con los personajes
         * @return array
         */
        public function listarPersonajes() {

        }
    }
    
?>