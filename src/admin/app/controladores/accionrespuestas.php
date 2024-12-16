<?php

class Crespuestas {

    public $obj_maccion; /*CAMBIAR-Debería ser private porque no se utiliza desde fuera de la clase*/

    public $mensaje; /*CAMBIAR-Debería ser private porque no se utiliza desde fuera de la clase*/

    function __construct (){
        require_once 'app/modelos/mAccionRespuestas.php';
        $this->obj_maccion = new mAccionRespuestas();
    }

    /*Función que mostrará los datos necesarios para hacer dinámicos los campos del formulario*/
    public function mostrarDatos (){
        $idDialogo = $_GET['id']; /*Almacenamos en una variable el valor que pasamos a través de la página de gestión de diálogos por el botón*/

        $datos = $this->obj_maccion->obtenerDatos($idDialogo); /*Pasamos por parámetro el id del diálogo para que haga la consulta sobre un ID en concreto*/
        return $datos; /*Retornamos el array de lo que nos devuelve la consulta del modelo*/
    
    }

    /*Función que mostrará todos los DIÁLOGOS en el SELECT del formulario*/
    public function mostrarDialogos (){
        
        $datosDialogo = $this->obj_maccion->obtenerDialogos();
        return $datosDialogo; /*Retornamos lo que devuelve la consulta de los diálogos */
    
    }

    /*Función que mostrará todos los ESCENARIOS  en el SELECT del formulario*/
    public function mostrarEscenarios (){
        
        $datosDialogo = $this->obj_maccion->obtenerEscenarios(); /*LLama al método del modelo para recoger los datos del escenario */
        return $datosDialogo;
    
    }

                    /*------MODIFICACIONES TABLA RESPUESTAS------*/
/*-----------------------------------------------------------------------Modificar RESPUESTA 1*/

    public function modificarRespuesta1(){
        $idResp1 = $_POST['idResp1']; /*Recogemos desde el formulario el id de la respuesta 1*/

        if (isset($_POST['resp1Dialogo'])){ /*Si en el formulario se ha seleccionado un diálogo en el select para la RESPUESTA 1*/
            $resp1Dialogo = $_POST['resp1Dialogo']; /*Recogemos el valor y lo almacenamos en una variable*/

            /*Llamamos al método que modifica la respuesta 1 y pasamos por parámetro el id y el mensaje del DIÁLOGO seleccionado*/
            $resultadoReturn = $this->obj_maccion->modRespuesta1Dialogo($idResp1, $resp1Dialogo);

            if($resultadoReturn == false){ /*El método del modelo retorna false si no se ha insertado nada o ha habido algún problema */
                $this->mensaje = "NO se ha logrado actualizar el diálogo de Respuesta 1"; /*Envía un mensaje de que no se ha logrado modificar*/
            }

            /*Si no ocurre lo anterior, se envía un mensaje de que se ha logrado modificar */
            return $this->mensaje = "Se ha actualizado el diálogo de Respuesta 1"; 

        } elseif (isset($_POST['resp1Escenario'])){ /*Si no se ha seleccionado un diálogo aquí comprobamos que el escenario no se haya seleccionado*/
            $resp1Escenario = $_POST['resp1Escenario'];/*Recogemos el valor y lo almacenamos en una variable*/

             /*Llamamos al método que modifica la respuesta 1 y pasamos por parámetro el id y el mensaje del ESCENARIO seleccionado*/
            $resultadoReturn = $this->obj_maccion->modRespuesta1Escenario($idResp1,  $resp1Escenario);

            if($resultadoReturn == false){ /*El método del modelo retorna false si no se ha insertado nada o ha habido algún problema */
                $this->mensaje = "NO se ha logrado actualizar el escenario de Respuesta 1"; /*Envía un mensaje de que no se ha logrado modificar*/
            }

            /*Si no ocurre lo anterior, se envía un mensaje de que se ha logrado modificar */
            return $this->mensaje = "Se ha actualizado el escenario de Respuesta 1";

        } else { /*Si no se ha seleccionado ninguna opción de ninguno de los dos select...*/

            $this->mensaje = "NO se ha seleccionado acción para la Respuesta 1";/*Se envía un mensaje de que no se ha seleccionado acción para la respuesta 1 */

            return $this->mensaje;
        }
    }

/*--------------------------------------------------------------------Modifica RESPUESTA 2*/
    public function modificarRespuesta2(){
        $idResp2 = $_POST['idResp2']; /*Recogemos desde el formulario el id de la respuesta 2*/

        if (isset($_POST['resp2Dialogo'])){
            $resp2Dialogo = $_POST['resp2Dialogo'];

            //Esta vez, llamaremos al método que modifica el diálogo PERO de la respuesta 2
            $resultadoReturn = $this->obj_maccion->modRespuesta2Dialogo($idResp2, $resp2Dialogo);

            if($resultadoReturn == false){ /*El método del modelo retorna false si no se ha insertado nada o ha habido algún problema */
                $this->mensaje = "No se ha logrado actualizar el diálogo de Respuesta 2"; /*Manda un mensaje de que no se ha logrado actualizar el diálogo de la Respuesta 2*/
            }

            return $this->mensaje = "Se ha actualizado el diálogo de Respuesta 2"; /*Si no retorna false, envía un mensaje de éxito*/

        } elseif (isset($_POST['resp2Escenario'])){
            $resp2Escenario = $_POST['resp2Escenario']; /*Recogemos desde el formulario el id de la respuesta 2*/

            //Esta vez, llamaremos al método que modifica el escenario PERO de la respuesta 2
            $resultadoReturn = $this->obj_maccion->modRespuesta1Escenario($idResp2,  $resp2Escenario);

            if($resultadoReturn == false){ 
                $this->mensaje = "NO se ha logrado actualizar el escenario de Respuesta 2";/*Manda un mensaje de que no se ha logrado actualizar el escenario de la Respuesta 2*/
            }

            return $this->mensaje = "Se ha actualizado el escenario de Respuesta2"; /*Si no retorna false, envía un mensaje de éxito*/
        
        } else {
            
            $this->mensaje = "NO se ha seleccionado acción para la Respuesta 2";/*Se envía un mensaje de que no se ha seleccionado acción para la respuesta 2 */

            return $this->mensaje;
        }

    }
    


}




?>