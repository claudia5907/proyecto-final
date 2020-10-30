/********************************************************************/
function establece_caja(){
 $.ajax({
          beforeSend: function(){
           },
          url: 'establece_caja.php',
          type: 'POST',
          data: 'caja='+$("#numcaja").val(),
          success: function(x){
            alert("Se establecio el numero de caja en esta sesion...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-caja").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer el numero de caja, contacte a soporte inmediatamente...!");
           }
           });
}
/********************************************************************/
function establece_name_empresa(){
    $.ajax({
          beforeSend: function(){
           },
          url: 'estabelece_name_empresa.php',
          type: 'POST',
          data: 'name='+$("#nombre_empresa").val()+'&dom='+$("#dom_empresa").val(),
          success: function(x){
            alert("Se establecio el nombre de la empresa correctamente...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-name").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer el nombre de la empresa, contacte a soporte inmediatamente...!");
           }
           });
}

