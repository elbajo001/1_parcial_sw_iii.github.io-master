var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos(){
   /*Previamente tenía la siguiente instrucción con el fin de caputar todos los valores de los inputs
   , aunque si se desea tambien se hubiera utilizado la opción :checkbox para solo limitarlo a los input
   de tipo checkbox.
   $('input').click(updateStateTaks) 
   
   El problema que tiene esta forma es que luego de modificar el DOM utilizando ajax, los nuevos elementos
   ya sean input or checkbox dejaban de funcionar, como si el evento click ya no los 'cobijara'.

   Para solucionar esta problemática utilizaré la siguiente forma $('.container').on('click',':checkbox',updateStateTaks);
   esta forma me pide que coloque un contenedor general al cual pueda hacer referencia, ese contenedor debe
   contener los nuevos elementos producto de actividades relacionadas con el DOM. 
   Al realizar el evento Click de esta forma, los nuevos elementos HTML si podran ser reconocidos por el evento click
   */
   
   $('.container').on('click',':checkbox',updateStateTaks);
}

function updateStateTaks(){
   /*Recupero el valor seleccionado por el checkbox*/
   //alert("Valor: "+$(this).attr("value"));

   /*A demás de capturar el valor del checkbox selecionado, tambien necesito distiguir la opcion que el usuario
   ha realizado: seleccionar o deseleccionar el checkbox. Porque con base en ello sabré si debo modificar el estado
   de la tara a True or False.
   False = 0 y True =1

   Esta variable tambien se enviará al archivo ajax como parámetro para poder distinguir la opción.
   */

   var isSelected=0;
   if($(this).prop('checked')){
         isSelected = 1;
   }


   var posicionModificar = $(this).attr("value");
   var identificacion = $("#txtIdentificacion").text();


    var parametros ={
        "index":posicionModificar,
        "identificacion":identificacion,
        "isSelected":isSelected
    }

   
   /*Capturada la posicion debo utilizar un objeto ajax para mandare la posicion de la tarea y el nombre del archivo jason
   con el fin de realizar el debido cambio de true a false y posteriormente que retorne la lista*/

   
   $.ajax({
      async:true,
      type: "POST",
      dataType: "html",
      //dataType: "json",
      contentType: "application/x-www-form-urlencoded",
      url:"../Controller/actualizarTarea.php",
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





/* emmet*/