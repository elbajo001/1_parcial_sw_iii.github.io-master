<?php
include '../Model/Persona.php';
include '../Model/Tarea.php';
define ("CLAVE", "m._cl22@ddDPZ_ffDcc1!23ss");
 
//Para generar una URL segura para el método GET
function generaURLSegura ($metodo, $valor)
{
  return $metodo . "=" . md5(CLAVE . $valor);
}

#Recibimos del formulario la identificacion y el nombre
$identificacion = $_POST['id'];
$nombre = $_POST['nombre'];


$arregloTareas = array();

#Creamos el objeto Persona
$objPersona = new Persona($identificacion,$nombre,$arregloTareas);

##Crear las dos tareas por defecto

date_default_timezone_set('America/Bogota');
$hoy = date('Y/m/d H:i:s');

$objTarea1 = new Tarea("Planear Semana",$hoy,false);
$objTarea2 = new Tarea("Ser Feliz",$hoy,false);

$objPersona->agregarTarea($objTarea1);
$objPersona->agregarTarea($objTarea2);


#Codificamos el objeto Persona a un formato JSON
$json = json_encode($objPersona);

#Creamos el archivo con  el formato JSON realizando el  md5 de la identificacion y la clave
$file = md5(CLAVE . $identificacion).'.json';

#Guardamos el archivo en en la carpeta designada
file_put_contents("objetosJson/".$file, $json);

#redireccionar a administrador de tareas
header('location:../View/Tareas.php?'.generaURLSegura("id",$identificacion));
