<?php
    
    class CpanelAdmin {

        public readonly string $vista;
        public readonly string $mensaje;

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }

        public function inicio() {

            $this->vista = 'panelAdministrador';

        }

    }
    
?>