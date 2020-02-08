<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../javascript/calendario.js"></script>
    <title>Documento sin título</title>
    
   
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
      $.post("util_generarSelect.php", "t=afp&v=idAfp&n=Nombre",
        function (data) {
          $("#frm_afp").html(data); 
		}
      );
	  $("#frm_afp").change(function(e) {
         $.post("util_consultaTablaSimple.php","t=afp&n=idAfp&v="+$("#frm_afp").val(),
        function (data) {
          var datos = $.parseJSON(data);
          $("#frm_cod").attr("value", datos["idAfp"]);
		  $("#frm_rut_afp").attr("value", datos["Rut"]);
		  $("#frm_ciudad").attr("value", datos["Ciudad_idCiudad"]);
		  $("#frm_porcentaje").attr("value", datos["Porcentaje"]);
		  $("#frm_estado > option[value=" + datos["Estado"] + "]").attr('selected', true);
		}
		);
    });
	  
    }
    );</script>
    <script type="text/javascript">
    function capturarDatos() {
      return "DocumentoIdentidad=" + $("#frm_rut").val() +
         "&idAfp=" + $("#frm_afp").val();
		  
      
    }
    function ingresarDatos() {
      $.post("adm_relacion_afp_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
        alert(data);
      });
    }

    function modificarDatos() {
      $.post("adm_relacion_afp_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
        alert(data);
      });
    }

    function eliminarDatos(id) {
      $.post("adm_relacion_afp_qry.php", "funcion=eliminar&idempleado=" + id,
        function (data) {
          alert(data);
        });
    }

    function cargarDatos(id) {
      $.post("adm_relacion_afp_qry.php", "funcion=cargar&idempleado=" + id,
        function (data) {
          var datos = $.parseJSON(data);
          $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
          $("#frm_nombres").attr("value", datos["Nombres"]);
          $("#frm_ap_paterno").attr("value", datos["ApellidoPaterno"]);
          $("#frm_ap_materno").attr("value", datos["ApellidoMaterno"]);
          $("#frm_pais").attr("value", datos["Pais_idPais"]);
          $("#frm_sexo").attr("value", datos["Sexo"]);
          $("#frm_fnac").attr("value", datos["FechaNacimiento"]);
          $("#frm_civil").attr("value", datos["EstadoCivil"]);
          $("#frm_dpto > option[value=" + datos["idDepartamento"] + "]").attr('selected', true);
          $("#frm_cargo").attr("value", datos["Cargo"]);
          $("#frm_region > option[value=" + datos["idRegion"] + "]").attr('selected', true);
          $("#frm_ciudad > option[value=" + datos["idCiudad"] + "]").attr('selected', true);
          $("#fechacont").attr("value", datos["Fecha"]);
          $("#frm_dinicio > option[value=" + datos["DiaInicioTrabajo"] + "]").attr('selected', true);
          $("#frm_dfin > option[value=" + datos["DiaFinTrabajo"] + "]").attr('selected', true);
          $("#Hinicio > option[value=" + datos["horainicio"] + "]").attr('selected', true);
          $("#Minicio > option[value=" + datos["minutosinicio"] + "]").attr('selected', true);
          $("#Hfin > option[value=" + datos["horafin"] + "]").attr('selected', true);
          $("#minf > option[value=" + datos["minutosfin"] + "]").attr('selected', true);
          $("#frm_desfin > option[value=" + datos["DescansoFin"] + "]").attr('selected', true);
          $("#frm_sueldo").attr("value", datos["Sueldo"]);
          $("#frm_contrato > option[value=" + datos["TipoContrato"] + "]").attr('selected', true);
        }
      );
    }
function buscar() {
		$.post("adm_relacion_afp_qry.php", "funcion=buscar&DocumentoIdentidad=" + $("#frm_rut").val(),
        function (data) {
        var datos = $.parseJSON(data);
        $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
        $("#frm_nombres").attr("value", datos["Nombres"]);
        $("#frm_ap_paterno").attr("value", datos["ApellidoPaterno"]);
        $("#frm_ap_materno").attr("value", datos["ApellidoMaterno"]);
        $("#frm_pais").attr("value", datos["Nombre"]);
        $("#frm_sexo").attr("value", (datos["Sexo"] == 0) ? "Masculino" : "Femenino");
        $("#frm_fnac").attr("value", datos["FechaNacimiento"]);
        $("#frm_civil").attr("value", function () {
          switch (parseInt(datos["EstadoCivil"])) {
            case 0:
              return "Soltero";
              break;
            case 1:
              return "Casado";
              break;
            case 2:
              return "Viudo";
              break;
            case 3:
              return "Separado";
              break;
            default:
              alert(datos["EstadoCivil"]);
            }
        });
      });
    }
    
    $(document).ready(function () {
      $.post("util_generarSelect.php", "t=afp&v=idafp&n=Nombre",
        function (data) {
          $("#frm_afp").html(data);
        }
      );
    });</script>
    
    </head>

    <body>
    <table width="321" border="1" cellspacing="1">
      <tr>
        <td colspan="2">Ingreso de AFP</td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Datos del empleado</div></td>
      </tr>
      <tr>
        <td width="86">Rut</td>
        <td width="222"><label for="textfield"></label>
          <input name="frm_rut" type="text" required="required" id="frm_rut" maxlength="12" />
          <input type="button" value="Buscar" onClick="buscar()"/></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><input name="frm_nombres" type="text" disabled="disabled" id="frm_nombres" /></td>
      </tr>
      <tr>
        <td>Fecha Nacimiento</td>
        <td><label for="textfield2"></label>
          <input name="frm_fnac" type="text" disabled="disabled" id="frm_fnac" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Sexo</td>
        <td><input name="frm_sexo" type="text" disabled="disabled" id="frm_sexo" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Estado Civil</td>
        <td><input name="frm_civil" type="text" disabled="disabled" id="frm_civil" readonly="readonly" /></td>
      </tr>
      <tr>
        <td colspan="2"><div align="center">Datos de AFP</div></td>
      </tr>
      <tr>
        <td>AFP</td>
        <td><select name="frm_afp" id="frm_afp">
            <option>Seleccione</option>
            <option>Capital</option>
            <option>Cuprum</option>
            <option>Habitat</option>
            <option>Modelo</option>
            <option>Planvital</option>
            <option>Provida</option>
          </select></td>
      </tr>
      <tr>
        <td>Codigo</td>
        <td><input name="frm_cod" type="text" disabled="disabled" id="frm_cod" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Rut</td>
        <td><input name="frm_rut_afp" type="text" disabled="disabled" id="frm_rut_afp" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Ciudad</td>
        <td><input name="frm_ciudad" type="text" disabled="disabled" id="frm_ciudad" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Porcentaje</td>
        <td><label for="frm_porcentaje"></label>
          <input name="frm_porcentaje" type="text" disabled="disabled" id="frm_porcentaje" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td><label for="frm_afp"></label>
          <select name="frm_estado" id="frm_estado" disabled="disabled">
            <option value="0">Activo</option>
            <option value="1">Inactivo</option>
          </select></td>
      </tr>
      <tr>
        <td height="32" colspan="2"><div align="center">
          <table width="149" border="0" cellspacing="1">
            <tr>
              
              <td><div align="center">
                <input type="submit" name="frm_modificar" id="frm_modificar" value="Modificar" />
              </div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
</body>
</html>