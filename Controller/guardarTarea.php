<?php
include '../Model/Persona.php';
include '../Model/Tarea.php';
define ("CLAVE", "m._cl22@ddDPZ_ffDcc1!23ss");
#Recibimos la tarea
$task = $_POST['task'];
$identificacion = $_POST['identificacion'];

#Recuperar datos del objeto JSON
$datos_usuario = file_get_contents("../Controller/objetosJson/".md5(CLAVE . $identificacion).".json");
$json_usuario = json_decode($datos_usuario, true);
//print_r($json_usuario);
#Recuperacion del objeto Json
$identificacion = $json_usuario['perIdentificacion'];
$nombre = $json_usuario['perNombre'];
$tareas= $json_usuario['perTareas'];

#Cracion del objetoPersona
$objPersona = new Persona($identificacion,$nombre,$tareas);

date_default_timezone_set('America/Bogota');
$hoy = date('Y/m/d H:i:s');

$objTarea = new Tarea($task,$hoy,false);

#Agrego la tarea a la persona
$objPersona->agregarTarea($objTarea);
#imprimir si tengo el objeto lleno
#print_r($objPersona);
#Guardar el nuevo json
#Codificamos el objeto Persona a un formato JSON
$json = json_encode($objPersona);

#Creamos el archivo con  el formato JSON realizando el  md5 de la identificacion y la clave
$file = md5(CLAVE . $identificacion).'.json';

#Guardamos el archivo en en la carpeta designada
file_put_contents("objetosJson/".$file, $json);

#que retorne la nueva tabla con todas las tareas


#Despues de haber guardado el archivo JSON, volvemos a leer el archivo JSON, pero solo sacamos
#las tareas, y con base en ese array regresamos todas 

$datos_usuario = file_get_contents("../Controller/objetosJson/".md5(CLAVE . $identificacion).".json");
$json_usuario = json_decode($datos_usuario, true);


$tareas= $json_usuario['perTareas'];
foreach ($tareas as $indice => $tarea) {
    $estado="tachado";
    $estadoCheck="checked";
    if($tarea['tarRealizada']==false){
        $estado="";
        $estadoCheck="";
    }
    echo '<tr>
    <th scope="row">'.$indice.'</th>
    <td><h4 class="'.$estado.' centrado">'.$tarea['tarDescripcion'].'</h4></td>
    <td><h5>'.$tarea['tarFecha'].'</h5></td>
    <td> 
    <div class="form-check">
    <input type="checkbox" class="form-check-input"  value="'.$indice.'" '.$estadoCheck.'>
    
    </div>
    </td>
  </tr>';
  }


