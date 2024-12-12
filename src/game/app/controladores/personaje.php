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
         * Listado de personajes a la hora de crear un jugador
         * @return array
         */
        public function listarPersonajes() {

            require_once CONFIG_PATH . 'config.php';
            require_once MODEL_PATH . 'mPersonaje.php';

            $personaje = new MPersonaje();
            $personajes = $personaje->listarPersonajes();

            return $personajes;

        }

        public function obtenerPersonajePorId($idPersonaje) {
            require_once MODEL_PATH . 'mPersonaje.php';
            $modeloPersonaje = new mPersonaje();
            
            // Obtener los datos del personaje desde el modelo
            $personaje = $modeloPersonaje->obtenerDatosPersonaje($idPersonaje);
            
            $nombrePersonaje = $personaje['nombrePersonaje'];

            // Si los sprites son BLOB, convertirlos a base64
            $spriteFront = base64_encode($personaje['spriteFront']);
            $spriteBack = base64_encode($personaje['spriteBack']);
            $spriteLeft = base64_encode($personaje['spriteLeft']);
            $spriteRight = base64_encode($personaje['spriteRight']);
            
            return [
                'nombrePersonaje' => $nombrePersonaje,
                'spriteFront' => 'data:image/png;base64,' . $spriteFront,
                'spriteBack' => 'data:image/png;base64,' . $spriteBack,
                'spriteLeft' => 'data:image/png;base64,' . $spriteLeft,
                'spriteRight' => 'data:image/png;base64,' . $spriteRight
            ];
        }
              
    }
    
?>