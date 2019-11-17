<?php

define ("CLAVE", "m._cl22@ddDPZ_ffDcc1!23ss");
 
//Para generar una URL segura para el método GET
function generaURLSegura ($metodo, $valor)
{
  return $metodo . "=" . md5(CLAVE . $valor);
}
#Recibo las variables que vienen desde el formulario
$identificacion = $_POST['identificacion'];

#recuperarTareasUsuario
$json = @file_get_contents("objetosJson/".md5(CLAVE . $identificacion).".json", true);
if ($json === false) {
    #Es necesario crear un objeto JSON

    echo '
    <form action="Controller/crearObjJson.php" method="POST" style="margin-top:1em">
        <div class="alert alert-danger" role="alert">
            El usuario no se encuentra registrado con tareas. 
        </div>
        <div class="form-group">
            <input id="byname" name="nombre" type="text" class="form-control" placeholder="Ingrese su nombre">
        </div>
        <input id="id" name="id" value="'.$identificacion.'" type="hidden">
        <button style="background-color: #007bff" id="btnCrear" type="" class="btn btn-success" >Crear</button>
        
     
    </form>
    
    
   ';
   
}
else{
    #Es necesario recorrer la información del objeto JSON
    echo '<div class="alert alert-success" role="alert" style="margin-top:1em">
    ¡Hemos encontrado todas sus tareas! 
    <a  href="View/Tareas.php?'.generaURLSegura("id",$identificacion).'" alt="Home" title="Home Page" > Click aquí</a> 
    para ir a tus tareas.
    </div>';
    
    #redireccionar a administrador de tareas
}

