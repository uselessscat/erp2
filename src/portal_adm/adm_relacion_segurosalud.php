<?php
// iniciar sesion y comprobar que esta registrado
session_start();
if (!isset($_SESSION['aid'])) {
  header('Location: index.php');
  exit;
}

//conectar con la base datos
require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();
?>
<script type="text/javascript" src="../javascript/calendario.js"></script>

<script type="text/javascript">

  function cargarDatos(id, todo) {
    if (todo == true) {
      $.post("adm_relacion_segurosalud_qry.php", "funcion=cargar&idEmpleado=" + id, function (data) {
        var datos1 = $.parseJSON(data);
        $('#frm_isapre').attr('value', datos1['Nombre']);
        $('#frm_cod').attr('value', datos1['idPrevision']);
        $('#frm_rut').attr('value',datos1['Rut']);
        $('#frm_ciudad').attr('value', datos1['Ciudad_idCiudad']);
        $('#frm_porcentaje').attr('value', datos1['Finiquito']);
		$('#frm_estado_isapre').attr('value', datos1['Finiquito']);
		
      });
    }

    $.post("util_consultaTablaSimple.php", "t=empleado&n=" + ((todo == true) ? "idEmpleado" : "DocumentoIdentidad") + "&v=" + id, function (data) {
      var datos2 = $.parseJSON(data);
      
      $('#frm_DocumentoIdentidad').attr('value', datos2['DocumentoIdentidad']);
      $('#frm_Nombres').attr('value', datos2['Nombres']);
      $('#frm_ApellidoPaterno').attr('value', datos2['ApellidoPaterno']);
      $('#frm_ApellidoMaterno').attr('value', datos2['ApellidoMaterno']);
      $('#frm_FechaNacimiento').attr('value', datos2['FechaNacimiento']);
      $('#frm_sexo').attr('value', datos2['Sexo']);
      $('#frm_estado').attr('value', datos2['EstadoCivil']);
     
	  
    });

    $("#btn_modificar").show();
    $("#btn_eliminar").show();
  }


  function eliminarDatos(id) {
    $.post("adm_relacion_segurosalud_qry.php", "funcion=eliminar&idEmpleado=" + id, function (data) {
      alert(data);
    });
  }

  function cancelar() {
    window.location.href = "index.php?pg=adm_relacion_finiquito";
  }

  function capturarParametros() {
    return 
	 "IdIsapre=" + $('#frm_isapre').val()
      + "&RutEmpleado=" + $('#frm_DocumentoIdentidad').val();
	  
     
  }

  function ingresarDatos() {
    var params = "funcion=ingresar&" + capturarParametros();
	alert (params);
    $.post("adm_relacion_segurosalud_qry.php", params, function (data) {
      // mostrar mensaje de error o ingreso
      alert(data);
    });
  }

  function modificarDatos() {
    var params = "funcion=modificar&" + capturarParametros();
    $.post("adm_relacion_segurosalud_qry.php", params, function (data) {
      alert(data);
    });
  }
</script>
<script>
    function imprimirSelec(nombre) {
      var ficha = document.getElementById(nombre);
      var ventimp = window.open(' ', 'popimpr');
      ventimp.document.write(ficha.innerHTML);
      ventimp.document.close();
      ventimp.print();
      ventimp.close();
    }
  </script>
<script>
    $(document).ready(function () {
      $.post("util_generarSelect.php", "t=previsiosalud&v=idPrevision&n=Nombre",
        function (data) {
          $("#frm_isapre").html(data); 
		}
      );
	  $("#frm_isapre").change(function(e) {
         $.post("util_consultaTablaSimple.php","t=previsiosalud&n=idPrevision&v="+$("#frm_isapre").val(),
        function (data) {
          var datos = $.parseJSON(data);
          $("#frm_cod").attr("value", datos["idPrevision"]);
		  $("#frm_rut").attr("value", datos["Rut"]);
		  $("#frm_ciudad").attr("value", datos["Ciudad_idCiudad"]);
		   $("#frm_estado_isapre > option[value=" + datos["Estado"] + "]").attr('selected', true);
		  
		}
		
		);
		
		
    });
	$("#frm_isapre").change(function(e) {
         $.post("util_consultaTablaSimple.php","t=datosempleado&n=idEmpleado&v="+$("#frm_isapre").val(),
        function (data) {
          var datos = $.parseJSON(data);
          
		  $("#frm_porcentaje").attr("value", datos["Isapre_Porcentaje"]);
		  
		}
		
		);
		
		
    });
	
	  
    }
	
    );</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<table width="331" border="1" cellspacing="1">
  <tr>
    <td colspan="2"><div align="center">Isapre</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Datos del empleado</div></td>
  </tr>
  <tr>
    <td>Rut</td>
    <td><label for="textfield"></label>
      <input name="frm_rut2" type="text" required id="frm_rut2" maxlength="12" />
      <input type="button" value="Buscar" onClick="buscar()"/></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input name="frm_nombres" type="text" disabled="disabled" id="frm_nombres" /></td>
  </tr>
  <tr>
    <td>Fecha Nacimiento</td>
    <td><label for="textfield2"></label>
      <input name="frm_fnac" type="text" disabled="disabled" id="frm_fnac" readonly /></td>
  </tr>
  <tr>
    <td>Sexo</td>
    <td><input name="frm_sexo" type="text" disabled="disabled" id="frm_sexo" readonly /></td>
  </tr>
  <tr>
    <td>Estado Civil</td>
    <td><input name="frm_civil" type="text" disabled="disabled" id="frm_civil" readonly /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Datos de Isapre</div></td>
  </tr>
  <tr>
    <td width="93">Nombre Isapre</td>
    <td width="225"><select name="frm_isapre" id="frm_isapre">
        <option selected="selected">Seleccione</option>
      </select></td>
  </tr>
  <tr>
    <td>Codigo</td>
    <td><input name="frm_cod" type="text" readonly id="frm_cod" /></td>
  </tr>
  <tr>
    <td>Rut</td>
    <td><input name="frm_rut" type="text" readonly id="frm_rut" /></td>
  </tr>
  <tr>
    <td>Ciudad</td>
    <td><input name="frm_ciudad" type="text" readonly id="frm_ciudad" /></td>
  </tr>
  <tr>
    <td>Porcentaje</td>
    <td><label for="frm_porcentaje"></label>
      <input name="frm_porcentaje" type="text" id="frm_porcentaje" readonly /></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><label for="frm_isapre"></label>
      <select name="frm_estado_isapre" id="frm_estado_isapre">
        <option value="-1">seleccione</option>
        <option value="0">Activo</option>
        <option value="1">Inactivo</option>
      </select></td>
  </tr>
  <tr>
    <td height="36" colspan="2"><table width="203" border="1" cellspacing="1">
        <tr>
          <td width="195"><div align="center">
              <input type="button" name="frm_modificar" id="frm_modificar" value="Modificar" onClick="modificarDatos()"/>
            </div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>