<?php
    
    class Cjugar {

        public readonly string $vista;
        public function __construct() {}

        public function index() {

            $this->vista = "formularioJugar";

        }

        public function juego() {

            $this->vista = "jugar";

        }

    }
    
?>