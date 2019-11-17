<?php
include '../Model/Persona.php';
include '../Model/Tarea.php';
define ("CLAVE", "m._cl22@ddDPZ_ffDcc1!23ss");

#Recibimos información de la tarea seleccionada (posicion en el arreglo, identificacion de la persona, accion del checkbox)
$index = $_POST['index'];
$identificacion = $_POST['identificacion'];
$isSelected = $_POST['isSelected'];


#Recuperar datos del objeto JSON
$datos_usuario = file_get_contents("../Controller/objetosJson/".md5(CLAVE . $identificacion).".json");
$json_usuario = json_decode($datos_usuario, true);


#Recuperacion a traves de variables del objeto Json
$identificacion = $json_usuario['perIdentificacion'];
$nombre = $json_usuario['perNombre'];
$tareas= $json_usuario['perTareas'];

#Modifico el valor de la tarea, si esta realiza es true, de lo contrario seria false
if($isSelected==1){
    $tareas[$index]['tarRealizada']=true;
    echo "True";
}else{
    $tareas[$index]['tarRealizada']=false;
    echo "False";
}


#Cracion del objetoPersona con la nueva actualizacion del estado de la tarea
$objPersona = new Persona($identificacion,$nombre,$tareas);

#Guardar el nuevo json
#Codificamos el objeto Persona a un formato JSON
$json = json_encode($objPersona);

#Creamos el archivo con  el formato JSON realizando el  md5 de la identificacion y la clave
$file = md5(CLAVE . $identificacion).'.json';

#Guardamos el archivo en en la carpeta designada(Aqui estamos reemplazando el archivo JSON)
file_put_contents("objetosJson/".$file, $json);

#que retorne la nueva tabla con todas las tareas
#Despues de haber guardado el archivo JSON, volvemos a leer el archivo JSON, pero solo sacamos
#las tareas, y con base en ese array regresamos todas 

$datos_usuario = file_get_contents("../Controller/objetosJson/".md5(CLAVE . $identificacion).".json");
$json_usuario = json_decode($datos_usuario, true);
$tareas= $json_usuario['perTareas'];


#Retorno del objeo AJAX
foreach ($tareas as $indice => $tarea) {
    #variable que me permite "agregar" el estilo css
    $estado="tachado";
    ##variable que me permite "agregar" el estilo css para que este seleccionado
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


