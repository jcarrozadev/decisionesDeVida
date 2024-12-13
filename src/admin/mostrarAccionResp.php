<?php
  require_once 'app/config/config.php'; //Incluimos el archivo de configuración
  include 'app/controladores/accionrespuestas.php'; //Incluimos el archivo del controlador para instanciar su clase.

  $_GET['id'];//A través del botón de Accion de Respuestas ("Listar Dialogos"), pasamos por url el id

  $obj_accionrespuestas = new Crespuestas(); //Instanciamos el objeto de la clase del controlador.


//---------Llamamos al primer método que devuelve datos necesarios y lo ALMACENAMOS
  $datos = $obj_accionrespuestas->mostrarDatos(); 
  print_r($datos);
//---------Llamamos al segundo método que devuelve TODOS los diálogos y lo ALMACENAMOS
  $datosDialogos = $obj_accionrespuestas->mostrarDialogos();

//---------Llamamos al tercer método que devuelve TODOS los escenarios y lo ALMACENAMOS
  $datosEscenarios = $obj_accionrespuestas->mostrarEscenarios();

  include 'app/vistas/accionRespuesta.php'; //Incluimos la vista que haremos DINÁMICA con los datos obtenidos, para utilizar el ella estos datos.

?>