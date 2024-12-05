<?php

    class Cnpc {

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
         * Se carga un string para mandar mensajes de error si es necesario
         * @var string
         */
        public readonly string $mensaje;

        /**
         * Constructor de la clase
         */
        public function __construct() {}

        /**
         * Carga la vista del formulario de alta de NPC
         * @return void
         */
        public function formularioAltaNPC() {

            $this->tituloPag = 'Alta NPC';
            $this->vista = 'altaNPC';

        }

        /**
         * Da de alta un NPC en la base de datos
         * @return void
         */
        public function altaNPC() {

            require_once 'app/config/config.php';
            require_once MODEL_PATH . 'mNPC.php';

            $datos = $_POST;
            $sprite = $_FILES;

            $datos += $sprite;

            if(!$this->validarDatosAlta($datos)) {
                echo $this->mensaje;
                return false;
            }

            move_uploaded_file($datos['npcSprite']['tmp_name'], SPRITE_PATH_NPC . $datos['nombre'] . '_NPC.png');
            $datos['npcSprite'] = file_get_contents(SPRITE_PATH_NPC . $datos['nombre'] . '_NPC.png');

            $npc = new MNPC();
            $npc->altaNPC($datos);

            echo $npc->mensaje; // Mensaje a JavaScript

            return true;

        }

        public function validarDatosAlta($datos) {

            if(empty($datos['nombre']) || empty($datos['npcSprite']['tmp_name'])) { // Datos rellenos
                $this->mensaje = 'Faltan datos';
                return false;
            }

            if(strlen($datos['nombre']) > 50) { // Nombre no tenga más de 50 caracteres
                $this->mensaje = 'El nombre no puede tener más de 50 caracteres';
                return false;
            }

            if(preg_match(CARACTERES_NO_PERMITIDOS, $datos['nombre'])) { // Nombre sin tenga caracteres especiales
                $this->mensaje = 'El nombre no puede contener caracteres especiales';
                return false;
            }

            if($datos['npcSprite']['type'] != 'image/png') { // Imagenes sean PNG sin posibilidad de subir otro tipo
                $this->mensaje = 'El sprite introducido debe ser de tipo PNG'; 
                return false;
            }
            
            if(($datos['npcSprite']['size'] < 1 || $datos['npcSprite']['size'] > MAX_SPRITE_SIZE)) { 
                $this->mensaje = 'El sprite deben tener un tamaño entre 1 byte y 10 KB'; // Tamaño imagenes entre 1 byte y 10 KB
                return false;
            }

            return true;

        }

    }