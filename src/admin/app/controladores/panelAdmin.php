<?php
    
    class CpanelAdmin {

        /**
         * Se carga un string con el nombre de la vista que se
         * va a cargar en el index para mostrar la información
         * esta vista va sin extension ya que todas son php
         * @var string
         */
        public readonly string $vista;
        // public readonly string $mensaje; no es necesario de momento, descomentar si fuese necesario

        public function __construct() {
            // require_once 'php/config/conexion.php';
        }

        /**
         * Método que se encarga de mostrar la vista del panel de administrador
         * y lo carga en la atributo/propiedad $vista
         * @return void
         */
        public function inicio() {

            $this->vista = 'panelAdministrador';

        }

    }
    
?>