<?php

class Crespuestas {

    public $obj_maccion;

    public $mensaje;

    function __construct (){
        require_once 'app/modelos/mAccionRespuestas.php';
        $this->obj_maccion = new mAccionRespuestas();
    }

    public function mostrarDatos (){
        $idDialogo = $_GET['id'];

        $datos = $this->obj_maccion->obtenerDatos($idDialogo);
        return $datos;
    
    }

    public function mostrarDialogos (){
        
        $datosDialogo = $this->obj_maccion->obtenerDialogos();
        return $datosDialogo;
    
    }
    public function mostrarEscenarios (){
        
        $datosDialogo = $this->obj_maccion->obtenerEscenarios();
        return $datosDialogo;
    
    }

                    /*------MODIFICACIONES TABLA RESPUESTAS------*/
/*Modificar RESPUESTA 1*/
    public function modificarRespuesta1(){
        $idResp1 = $_POST['idResp1'];

        if (isset($_POST['resp1Dialogo'])){
            $resp1Dialogo = $_POST['resp1Dialogo'];

            $resultadoReturn = $this->obj_maccion->modRespuesta1Dialogo($idResp1, $resp1Dialogo);

            if($resultadoReturn == false){
                $this->mensaje = "NO se ha logrado actualizar el diálogo de Respuesta 1";
            }

            return $this->mensaje = "Se ha actualizado el diálogo de Respuesta 1";

        } elseif (isset($_POST['resp1Escenario'])){
            $resp1Escenario = $_POST['resp1Escenario'];

            $resultadoReturn = $this->obj_maccion->modRespuesta1Escenario($idResp1,  $resp1Escenario);

            if($resultadoReturn == false){
                $this->mensaje = "NO se ha logrado actualizar el escenario de Respuesta 1";
            }

            return $this->mensaje = "Se ha actualizado el escenario de Respuesta 1";

        } else {

            $this->mensaje = "NO se ha seleccionado acción para la Respuesta 1";

            return $this->mensaje;
        }
    }

/*Modifica RESPUESTA 2*/
    public function modificarRespuesta2(){
        $idResp2 = $_POST['idResp2'];

        if (isset($_POST['resp2Dialogo'])){
            $resp2Dialogo = $_POST['resp2Dialogo'];

            $resultadoReturn = $this->obj_maccion->modRespuesta2Dialogo($idResp2, $resp2Dialogo);

            if($resultadoReturn == false){
                $this->mensaje = "No se ha logrado actualizar el diálogo de Respuesta 2";
            }

            return $this->mensaje = "Se ha actualizado el diálogo de Respuesta 2";

        } elseif (isset($_POST['resp2Escenario'])){
            $resp2Escenario = $_POST['resp2Escenario'];

            $resultadoReturn = $this->obj_maccion->modRespuesta1Escenario($idResp2,  $resp2Escenario);

            if($resultadoReturn == false){
                $this->mensaje = "NO se ha logrado actualizar el escenario de Respuesta 2";
            }

            return $this->mensaje = "Se ha actualizado el escenario de Respuesta2";
        
        } else {
            
            $this->mensaje = "NO se ha seleccionado acción para la Respuesta 2";

            return $this->mensaje;
        }

    }
    


}




?>