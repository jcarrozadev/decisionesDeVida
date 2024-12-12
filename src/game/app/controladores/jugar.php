<?php

    class Cjugar {

        /**
         * Se carga un string con el nombre de la vista a cargar
         */
        public readonly string $vista;

        /**
         * Se carga un string para agregar el titulo de la vista
         */
        public readonly string $tituloPag;

        /**
         * Constructor de la clase
         */
        public function __construct() {}

        /**
         * Carga la vista del formulario de jugar y devuelve un array con los personajes
         * @return array
         */
        public function index() {
            require_once CONFIG_PATH . 'config.php';
            require_once CONTROLLER_PATH . 'personaje.php';

            $this->vista = "formularioJugar";

            $controladorPersonaje = new Cpersonaje();
            $personajes = $controladorPersonaje->listarPersonajes();

            // Cargar la vista y pasar la variable $personajes
            include VIEW_PATH . $this->vista . '.php';
        }

        /**
         * Carga la vista del juego y devuelve un array con los datos del personaje seleccionado
         * @return array $datos
         */
        public function juego() {

            // Obtener los datos de la URL que sacamos de la COOKIE
            $datos = [
                'nombreUsuario' => $_GET['nUsr'],
                'personajeElegido' => $_GET['iPrs'],
            ];

            if(!isset($_GET['idEscenario'])){
                $datos['idEscenario'] = ESCENARIO_DEFECT;
            } else {
                $datos['idEscenario'] = $_GET['idEscenario'];
            }

            // Obtener el sprite del personaje seleccionado
            require_once CONTROLLER_PATH . 'personaje.php';
            $controladorPersonaje = new Cpersonaje();
            $personaje = $controladorPersonaje->obtenerPersonajePorId($datos['personajeElegido']); // Este método debe devolver un array con los sprites
        
            // Combinar los datos de entrada con los sprites del personaje
            $datos = array_merge($datos, [
                'nombrePersonaje' => $personaje['nombrePersonaje'],
                'spriteFront' => $personaje['spriteFront'],
                'spriteBack' => $personaje['spriteBack'],
                'spriteLeft' => $personaje['spriteLeft'],
                'spriteRight' => $personaje['spriteRight']
            ]);
        
            $this->tituloPag = "Juego | Decisiones de Vida";
            $this->vista = "jugar";
        
            return $datos;
        }
    }
?>
