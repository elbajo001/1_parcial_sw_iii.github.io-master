<?php
include '../Model/Persona.php';
include '../Model/Tarea.php';
define ("CLAVE", "m._cl22@ddDPZ_ffDcc1!23ss");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Document</title>
</head>
<body>
    
    <?php
   
   
      

    #La clase Administrador de Tareas debe recuperar el los datos del archivo JSON y desplegarlos en pantalla
    #recibos por metodo GET el id de la persona, el cual ya viene con md5
    $identificacion = $_GET['id'];

    
    $datos_usuario = file_get_contents("../Controller/objetosJson/".$identificacion.".json");
    $json_usuario = json_decode($datos_usuario, true);

    //print_r($json_usuario);
    #Recuperacion del objeto Json
    $identificacion = $json_usuario['perIdentificacion'];
    $nombre = $json_usuario['perNombre'];
    $tareas= $json_usuario['perTareas'];

    #Cracion del objetoPersona
    $objPersona = new Persona($identificacion,$nombre,$tareas);

    //print_r($objPersona);

    

    ?>
    <div class="container" id="p3">
    <h1>Administrador de Tareas</h1>
    <a style="background-color: #007bff" href="../index.html" class="btn btn-info" role="button">Inicio</a>
     
     
     <!--
       <h3>Convenciones</h3>
       <table class="table" WIDTH="50%">
        <tr>
          <td> <h5>Por Hacer: </h5></td>
          <td><img alt="todo" src="sources/todo.svg" width="40" height="40"></td>
        </tr>
        <tr>
          <td><h5>Realizado: </h5></td>
          <td><img alt="done" src="sources/done.svg" width="40" height="40"></td>
        </tr>
     </table>
     -->
   
    
    
    <h3 id="txtNombre"> Usuario: <?php echo $objPersona->perNombre?></h3>
    <h3 id="txtIdentificacion" hidden><?php echo $objPersona->perIdentificacion?></h3>
    <table class="table">
        <tr>
            <th><input id="txtTask" name="txtTask" class="form-control" type="text" placeholder=" Escribe tu tarea"></th>
            <th><button style="background-color: #007bff" id="btnNewTask" type="button" class="btn btn-primary"><strong> Agregar tarea </strong></button></th>
        </tr>
    </table>

    <table class="table" style="margin-top:2em">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tarea</th>
      <th scope="col">Fecha de creación</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody id="resultados">

  <?php 
    if(count($objPersona->getTareas()) == 0){
      echo '<div  id="notificaciones" class="alert alert-danger" role="alert">
                No tienes tareas!
            </div>';
    }else{
      
        foreach ($objPersona->getTareas() as $indice => $tarea) {
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
    }


  ?>
    
    
  </tbody>
</table>

    <div id="resultado" class="container">
        
    </div>

      
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="Js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="Js/funcionesNewTask.js"></script>
<script type="text/javascript" src="Js/funcionesTareaRealizada.js"></script>

</html>