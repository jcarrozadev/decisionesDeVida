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

        $consulta = "SELECT d.nombreDiálogo,
                            d.mensaje,         
	                        r1.idRespuesta AS idRespuesta1, 
	                        r1.mensaje AS mensajeRespuesta1, 
	                        r2.idRespuesta AS idRespuesta2, 
	                        r2.mensaje AS mensajeRespuesta2 
                    FROM Dialogos d 
                    INNER JOIN Respuestas r1 ON d.idRespuesta1 = r1.idRespuesta 
                    INNER JOIN Respuestas r2 ON d.idRespuesta2 = r2.idRespuesta 
                    WHERE d.idDialogo ='".$idDialogo."'";

        $resultado = $this->conexion->query($consulta);

        $datos = [];

        if ($resultado->num_rows == 0){
            return false;
        }

        while ($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
        

        return $datos;
        
    }
    
/*--------Función que obtiene todos datos necesarios para el SELECT DE DIÁLOGO---------*/
    public function obtenerDialogos(){
        $consulta = "SELECT idDialogo, nombreDiálogo FROM Dialogos";
        $resultado = $this->conexion->query($consulta);

        $nombresDialogos = [];

        if ($resultado->num_rows == 0){
            return false;
        }

        while ($fila = $resultado->fetch_assoc()){
            $nombresDialogos[] = $fila;
        }
        

        return $nombresDialogos;

    } 

/*--------Función que obtiene datos necesarios para el SELECT DE ESCENARIOS---------*/
    public function obtenerEscenarios(){
        $consulta = "SELECT idEscenario, nombreEscenario FROM Escenario";
        $resultado = $this->conexion->query($consulta);

        $nombresEscenario = [];

        if ($resultado->num_rows == 0){
            return false;
        }

        while ($fila = $resultado->fetch_assoc()){
            $nombresEscenario[] = $fila;
        }
        

        return $nombresEscenario;

    }


            /*------MODIFICACIONES TABLA RESPUESTAS------*/

/*---------------Modifica el idDialogo en la Respuesta 1------------*/
    public function modRespuesta1Dialogo($idResp1, $resp1Dialogo){

        $consulta = "UPDATE Respuestas 
                        SET idDialogo = '" . $resp1Dialogo . "' 
                        WHERE idRespuesta = " . $idResp1;
        $resultado = $this->conexion->query($consulta);

        if ($resultado) {
            return true;

        } else {

            return false;
        }

    }
/*---------------Modifica el idEscenario en la Respuesta 1------------*/
    public function modRespuesta1Escenario($idResp1, $resp1Escenario){
        $consulta = "UPDATE Respuestas 
                        SET idEscenario = '" . $resp1Escenario . "' 
                        WHERE idRespuesta = " . $idResp1;
        $resultado = $this->conexion->query($consulta);

        if ($resultado) {
        return true;

        } else {

        return false;
        }
    }

/*---------------Modifica el idDialogo en la Respuesta 2------------*/
    public function modRespuesta2Dialogo($idResp2, $resp2Dialogo){

        $consulta = "UPDATE Respuestas 
                        SET idDialogo = '" . $resp2Dialogo . "' 
                        WHERE idRespuesta = " . $idResp2;
        $resultado = $this->conexion->query($consulta);

        if ($resultado) {
            return true;

        } else {

            return false;
        }

    }

/*---------------Modifica el idEscenario en la Respuesta 2------------*/
    public function modRespuesta2Escenario($idResp2, $resp2Escenario){
        $consulta = "UPDATE Respuestas 
                        SET idEscenario = '" . $resp2Escenario . "' 
                        WHERE idRespuesta = " . $idResp2;
        $resultado = $this->conexion->query($consulta);

        if ($resultado) {
        return true;

        } else {

        return false;
        }
    }



}










?>