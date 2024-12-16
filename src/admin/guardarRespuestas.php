<?php
/*-------Este archivo GUARDA las modificaciones de Respuestas según lleve a un ESCENARIO o a un DIALOGO----*/

  require_once 'app/config/config.php'; //Incluimos el archivo de configuración
  include 'app/controladores/accionrespuestas.php'; //Incluimos el archivo del controlador para instanciar su clase.

//Los id se envían desde un input hidden por método $_POST.(IGNORAR LINEA 8 Y 9, son explicativas más que otra cosa)
$_POST['idResp1']; 
$_POST['idResp2'];

//---------Instanciamos el objeto de la clase.
  $obj_accionrespuestas = new Crespuestas(); //Instanciamos el objeto de la clase.

/*---------Llamamos a los métodos del controlador que modifican las respuestas 1 y 2 y lo almacenamos en $resultado1/2*/

/*Como tenemos la vista que muestra los mensajes incluida(línea 20), podremos utilizar esa variable para mostrar los mensajes.*/
  $resultado1 =$obj_accionrespuestas->modificarRespuesta1();

  $resultado2 = $obj_accionrespuestas->modificarRespuesta2();
  
//En esta vista se mostrarán los mensajes de confirmación y validaciones que sean necesarios ($resultado1 y $resultado2).
include 'app/vistas/mostrarRespuesta.php';
?>