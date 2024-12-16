<?php

class MAccionRespuestas {

    private $conexion;

    public function __construct(){
        include_once 'app/config/configdb.php';
        $this->conexion =  new mysqli (DB_HOST, DB_USER,DB_PASS,DB_NAME);
    }

            /*---------------------OBTENER DATOS-----------------------*/

/*--------Función que obtiene todos los datos necesarios para INPUTS DISABLED---------*/
    public function obtenerDatos ($idDialogo){

        /*La consulta devuelve el nombre del diálogo, el mensaje, el idRespuesta y el mensaje de las dos respuestas, para hacer dinámico el formulario.*/
        $consulta = "SELECT d.nombreDiálogo,    
                            d.mensaje,         
	                        r1.idRespuesta AS idRespuesta1, 
	                        r1.mensaje AS mensajeRespuesta1, 
	                        r2.idRespuesta AS idRespuesta2, 
	                        r2.mensaje AS mensajeRespuesta2 
                    FROM Dialogos d 
                    INNER JOIN Respuestas r1 ON d.idRespuesta1 = r1.idRespuesta 
                    INNER JOIN Respuestas r2 ON d.idRespuesta2 = r2.idRespuesta 
                    WHERE d.idDialogo ='".$idDialogo."'"; /*Consulta la información según un id de diálogo en concreto*/

        $resultado = $this->conexion->query($consulta); 

        $datos = []; /*Inicializamos un array vacío para almacenar los datos de la consulta*/

        if ($resultado->num_rows == 0){  /*Si el número de filas de lo que devuelva la consulta es igual a 0...*/
            return false; /*Retorna false*/
        }

        while ($fila = $resultado->fetch_assoc()) { /*Mientras haya filas, lo guardamos en un array que más tarde retornamos*/
            $datos[] = $fila;
        }
        

        return $datos;
        
    }
    
/*--------Función que obtiene todos datos necesarios para el SELECT DE DIÁLOGO---------*/
    public function obtenerDialogos(){
        $consulta = "SELECT idDialogo, nombreDiálogo FROM Dialogos";
        $resultado = $this->conexion->query($consulta); 

        $nombresDialogos = []; /*Inicializamos un array vacío para almacenar los datos de la consulta*/

        if ($resultado->num_rows == 0){/*Si el número de filas de lo que devuelva la consulta es igual a 0...*/
            return false; /*Retorna false*/
        }

        while ($fila = $resultado->fetch_assoc()){ /*Mientras haya filas, lo guardamos en un array que más tarde retornamos*/
            $nombresDialogos[] = $fila;
        }
        

        return $nombresDialogos;

    } 

/*--------Función que obtiene datos necesarios para el SELECT DE ESCENARIOS---------*/
    public function obtenerEscenarios(){
        $consulta = "SELECT idEscenario, nombreEscenario FROM Escenario";
        $resultado = $this->conexion->query($consulta);

        $nombresEscenario = []; /*Inicializamos un array vacío para almacenar los datos de la consulta*/

        if ($resultado->num_rows == 0){/*Si el número de filas de lo que devuelva la consulta es igual a 0...*/
            return false; /*Retorna false*/
        }

        while ($fila = $resultado->fetch_assoc()){ /*Mientras haya filas, lo guardamos en un array que más tarde retornamos*/
            $nombresEscenario[] = $fila;
        }
        

        return $nombresEscenario;

    }


            /*------MODIFICACIONES TABLA RESPUESTAS------*/

/*---------------Modifica el idDialogo en la Respuesta 1------------*/
    public function modRespuesta1Dialogo($idResp1, $resp1Dialogo){

        /*En la consulta, modificamos el id del diálogo en un registro de respuesta en concreto*/
        $consulta = "UPDATE Respuestas 
                        SET idDialogo = '" . $resp1Dialogo . "' 
                        WHERE idRespuesta = " . $idResp1;
        $resultado = $this->conexion->query($consulta); /*Ejecutamos la consulta*/

        /*Si hubo algún problema con la consulta el método query retorna false y en ese caso, (else) retornamos false.*/
        if ($resultado) { /*Si retorna true retornamos true*/
            return true;

        } else {

            return false;/*En caso de retornar false, en el controlador haremos un control de errores de la modificación*/
        }

    }
/*---------------Modifica el idEscenario en la Respuesta 1------------*/
    public function modRespuesta1Escenario($idResp1, $resp1Escenario){

        /*En la consulta, modificamos el id del escenario en un registro de respuesta en concreto*/
        $consulta = "UPDATE Respuestas 
                        SET idEscenario = '" . $resp1Escenario . "' 
                        WHERE idRespuesta = " . $idResp1;
        $resultado = $this->conexion->query($consulta);

        /*Si hubo algún problema con la consulta el método query retorna false y en ese caso, (else) retornamos false.*/
        if ($resultado) {
            return true;/*Si retorna true retornamos true*/

        } else {

            return false;/*En caso de retornar false, en el controlador haremos un control de errores de la modificación*/
        }
    }

/*---------------Modifica el idDialogo en la Respuesta 2------------*/
    public function modRespuesta2Dialogo($idResp2, $resp2Dialogo){

        /*En la consulta, modificamos el id del diálogo en un registro de respuesta en concreto*/
        $consulta = "UPDATE Respuestas 
                        SET idDialogo = '" . $resp2Dialogo . "' 
                        WHERE idRespuesta = " . $idResp2;
        $resultado = $this->conexion->query($consulta);

        /*Si hubo algún problema con la consulta el método query retorna false y en ese caso, (else) retornamos false.*/
        if ($resultado) {
            return true;/*Si retorna true retornamos true*/

        } else {

            return false;/*En caso de retornar false, en el controlador haremos un control de errores de la modificación*/
        }

    }

/*---------------Modifica el idEscenario en la Respuesta 2------------*/
    public function modRespuesta2Escenario($idResp2, $resp2Escenario){

         /*En la consulta, modificamos el id del escenario en un registro de respuesta en concreto*/
        $consulta = "UPDATE Respuestas 
                        SET idEscenario = '" . $resp2Escenario . "' 
                        WHERE idRespuesta = " . $idResp2;
        $resultado = $this->conexion->query($consulta);

        /*Si hubo algún problema con la consulta el método query retorna false y en ese caso, (else) retornamos false.*/
        if ($resultado) {
        return true;/*Si retorna true retornamos true*/

        } else {

        return false;/*En caso de retornar false, en el controlador haremos un control de errores de la modificación*/
        }
    }



}










?>