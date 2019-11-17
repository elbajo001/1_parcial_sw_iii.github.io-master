var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos(){
    
    var btnNewTask = $("#btnNewTask");
    btnNewTask.click(saveTask);
}

function saveTask(){
    var task =  $("#txtTask").val();
    $("#txtTask").val("");

    var identificacion = $("#txtIdentificacion").text();
    var parametros ={
        "task":task,
        "identificacion":identificacion
    }
    
    //Ajax para guardar la tarea nueva
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
        //dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        url:"../Controller/guardarTarea.php",
        data:parametros,
        beforeSend:inicioEnvio,
        success:llegadaDatos,
        timeout:4000,
        error:problemas
      }); 
        return false;
  }
        function inicioEnvio()
        {
        var x=$("#resultados");
        x.html('<img src="../View/sources/cargando.gif">');
        }
        function llegadaDatos(datos)
        {
        
        console.log("Llegaron los datos: "+datos);
        $("#resultados").html(datos);
        
        
      }

        function problemas()
        {
        $("#resultadoStart").text('Problemas en el servidor.');
        }
    
    


