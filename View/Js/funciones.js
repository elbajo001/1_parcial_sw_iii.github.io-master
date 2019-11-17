var x;
x =  $(document);
x.ready(inicializarEventos);

var color = document.getElementById("btnStart").style.backgroundColor;
console.log(color);

function inicializarEventos(){
  var btnStart = $("#btnStart");
  btnStart.click(consultarObjetoJSON);
  var btnAgain = $('#btnBuscarAgain');
  btnAgain.click(redireccionar);
}
/*
if (x.getElementById("demo").value = "") {
  
}
} else {
  
}
*/







function redireccionar(){
  console.log("redireccionando..");
  location.href = '../../';
}

function consultarObjetoJSON(){
    //consultas si existe el elemento Json a traves de una consulta AJAX
    //var v=$("#nro").attr("value");
  var v=$("#byidentificacion").val();
  console.log('valor v:'+v);
  $.ajax({
           async:true,
           type: "POST",
           dataType: "html",
           //dataType: "json",
           contentType: "application/x-www-form-urlencoded",
           url:"Controller/verificarObjJson.php",
           data:"identificacion="+v,
           beforeSend:inicioEnvio,
           success:llegadaDatos,
           timeout:4000,
           error:problemas
         }); 
  return false;
}

function inicioEnvio()
{
  var x=$("#resultadoStart");
  x.html('<img src="../parcialsw/View/sources/cargando.gif">');
}

function llegadaDatos(datos)
{
  console.log("Llegaron los datos: "+datos);
  $("#resultadoStart").html(datos);
  document.getElementById('byidentificacion').disabled = true;
  
}

function problemas()
{
  $("#resultadoStart").text('Problemas en el servidor.');
}