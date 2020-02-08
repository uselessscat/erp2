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
    $.post("util_generarSelect.php", "t=region&v=idRegion&n=Nombre",
      function (data) {
        $("#frm_region").html(data);
      }
    );
    $("#frm_region").change(function () {
      $.post("util_generarSelect.php", "t=ciudad&v=idCiudad&n=Nombre&r=Region_idRegion&rv=" + $(this).val(),
        function (data) {
          $("#frm_ciudad").html(data);
        }
      );
    }
    );
    $.post("util_generarSelect.php", "t=departamento&v=idDepartamento&n=Nombre",
      function (data) {
        $("#frm_dpto").html(data);
      }
    );
  }
  );</script>
<script type="text/javascript">
  function capturarDatos() {
    return "DocumentoIdentidad=" + $("#frm_rut").val() +
      "&Nombres=" + $("#frm_nombres").val() +
      "&ApellidoPaterno=" + $("#frm_ap_paterno").val() +
      "&ApellidoMaterno=" + $("#frm_ap_materno").val() +
      "&Pais_idPais=" + $("#frm_pais").val() +
      "&Sexo=" + $("#frm_sexo").val() +
      "&FechaNacimiento=" + $("#frm_fnac").val() +
      "&EstadoCivil=" + $("#frm_civil").val() +
      "&departamento=" + $("#frm_dpto").val() +
      "&Cargo=" + $("#frm_cargo").val() +
      "&region=" + $("#frm_region").val() +
      "&ciudad=" + $("#frm_ciudad").val() +
      "&fecha=" + $("#fecha").val() +
      "&DiaInicioTrabajo=" + $("#frm_dpto").val() +
      "&DiaFinTrabajo=" + $("#frm_dpto").val() +
      "&HoraInicio=" + $("#").val() + ":" + $("#Minicio").val() + ":00" +
      "&HoraFin=" + $("#Hfin").val() + ":" + $("#minf").val() + ":00" +
      "&DescansoInicio=" + $("#frm_dpto").val() +
      "&DescansoFin=" + $("#frm_dpto").val() +
      "&Sueldo=" + $("#frm_sueldo").val() +
      "&TipoContrato=" + $("#frm_contrato").val();
  }
  function ingresarDatos() {
    $.post("adm_relacion_contrato_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
      alert(data);
    });
  }

  function modificarDatos() {
    $.post("adm_relacion_contrato_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
      alert(data);
    });
  }

  function eliminarDatos(id) {
    $.post("adm_relacion_contrato_qry.php", "funcion=eliminar&idempleado=" + id,
      function (data) {
        alert(data);
      });
  }

  function buscar(id) {
    $.post("adm_relacion_contrato_qry.php", "funcion=buscar&DocumentoIdentidad=" + $("#frm_rut").val(),
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

  function cargarDatos(id) {
    $.post("adm_relacion_contrato_qry.php", "funcion=cargar&idempleado=" + id,
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


  $(document).ready(function () {
    $.post("util_generarSelect.php", "t=afp&v=idafp&n=Nombre",
      function (data) {
        $("#frm_afp").html(data);
      }
    );
  });</script>
<div align="center">
  <table width="473" border="1" cellspacing="1">
    <tr>
      <th colspan="4" style="font-size: 36px" scope="col">Contrato del Personal</th>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Datos del Trabajador</div></td>
    </tr>
    <tr>
      <td width="126"><label for="frm_rut">Rut</label></td>
      <td width="334"><input name="frm_rut" type="text" required id="frm_rut" maxlength="12" />
        <input type="button" value="Buscar" onClick="buscar()"/></td>
    </tr>
    <tr>
      <td><label for="frm_nombres">Nombres</label></td>
      <td><input type="text" disabled="disabled" required id="frm_nombres" readonly /></td>
    </tr>
    <tr>
      <td><label for="frm_ap_paterno">Apellido Paterno</label></td>
      <td><input type="text" disabled="disabled" required id="frm_ap_paterno" readonly /></td>
    </tr>
    <tr>
      <td><label for="frm_ap_materno">Apellido Materno</label></td>
      <td><input type="text" disabled="disabled" required id="frm_ap_materno" readonly /></td>
    </tr>
    <tr>
      <td>Nacionalidad</td>
      <td><input name="frm_pais" type="text" disabled="disabled" required id="frm_pais" readonly /></td>
    </tr>
    <tr>
      <td><label for="frm_sexo">Sexo</label></td>
      <td><input type="text" disabled="disabled" required id="frm_sexo" readonly /></td>
    </tr>
    <tr>
      <td><label for="frm_fnac">Fecha Nacimiento</label></td>
      <td><input type="text" id="frm_fnac" disabled="disabled" readonly /></td>
    </tr>
    <tr>
      <td><label for="frm_civil">Estado civil</label></td>
      <td><input type="text" disabled="disabled" required id="frm_civil" readonly /></td>
    </tr>
    <tr>
      <td>Departamento</td>
      <td><label for="frm_dpto"></label>
        <select name="frm_dpto" id="frm_dpto">
          <option value="-1">Seleccione</option>
        </select></td>
    </tr>
    <tr>
      <?php
      $sql_dep = "Select * from departamento";
      $resul_dep = mysql_query($sql_dep);
      ?>
      <td>Cargo</td>
      <td><input name="frm_cargo" type="text" required id="frm_cargo" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">Datos del Contrato</div></td>
    </tr>
    <tr>
      <td>Region</td>
      <td><label for="frm_region"></label>
        <select name="frm_region" id="frm_region">
          <option value="-1">Seleccione</option>
        </select></td>
    </tr>
    <tr>
      <td>Ciudad</td>
      <td><select name="frm_ciudad" id="frm_ciudad">
          <option value="-1">Seleccione</option>
        </select></td>
    </tr>
    <tr>
      <td>Fecha Contrato</td>
      <td><input name="fecha" type="text" class="datepicker" id="fechacont" readonly /></td>
    </tr>
    <tr>
      <td>Dias de trabajo</td>
      <td>De
        <select name="frm_dinicio" required id="frm_dinicio">
          <option value="0" selected="selected">Lunes</option>
          <option value="1">Martes</option>
          <option value="2">Miercoles</option>
          <option value="3">Jueves</option>
          <option value="4">Viernes</option>
          <option value="5">Sábado</option>
          <option value="6">Domingo</option>
        </select>
        A
        <select name="frm_dfin" required id="frm_dfin">
          <option value="1" selected="selected">Lunes</option>
          <option value="2">Martes</option>
          <option value="3">Miercoles</option>
          <option value="4">Jueves</option>
          <option value="5">Viernes</option>
          <option value="6">Sábado</option>
          <option value="7">Domingo</option>
        </select></td>
    </tr>
    <tr>
      <td>Horario de trabajo</td>
      <td>Desde las
        <label for="Hinicio"></label>
        <select name="Hinicio" required id="Hinicio">
          <?php
          for ($i = 00; $i <= 23; $i++) {
            ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php } ?>
        </select>
        :
        <select name="Minicio" required id="Minicio">
          <?php
          for ($x = 00; $x <= 59; $x++) {
            ?>
            <option value="<?php echo $x ?>"><?php echo $x ?></option>
          <?php } ?>
        </select>
        Hasta
        <label for="Hfin"></label>
        <select name="Hfin" required id="Hfin">
          <?php
          for ($y = 00; $y <= 23; $y++) {
            ?>
            <option value="<?php echo $y ?>"><?php echo $y ?></option>
          <?php } ?>
        </select>
        :
        <select name="minf" required id="minf">
          <?php
          for ($z = 00; $z <= 59; $z++) {
            ?>
            <option value="<?php echo $z ?>"><?php echo $z ?></option>
          <?php } ?>
        </select>
        Hrs</td>
    </tr>
    <tr>
      <td>Dias de descanso</td>
      <td>Inicio
        <select name="frm_desini" required id="frm_desini">
          <option value="0" selected="selected">Lunes</option>
          <option value="1">Martes</option>
          <option value="2">Miercoles</option>
          <option value="3">Jueves</option>
          <option value="4">Viernes</option>
          <option value="5">Sábado</option>
          <option value="6">Domingo</option>
        </select>
        Fin
        <select name="frm_desfin" required id="frm_desfin">
          <option value="0" selected="selected">Lunes</option>
          <option value="1">Martes</option>
          <option value="2">Miercoles</option>
          <option value="3">Jueves</option>
          <option value="4">Viernes</option>
          <option value="5">Sábado</option>
          <option value="6">Domingo</option>
        </select></td>
    </tr>
    <tr>
      <td>Sueldo Base</td>
      <td><label for="frm_sueldo"></label>
        <input name="frm_sueldo" type="text" required id="frm_sueldo" /></td>
    </tr>
    <tr>
      <td>Tipo de contrato</td>
      <td><label for="frm_contrato"></label>
        <select name="frm_contrato" required id="frm_contrato">
          <option value="-1">Seleccione</option>
          <option value="Honorarios" >Honorarios</option>
          <option value="Indefinido">Indefinido</option>
        </select></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
          <input type="button" id="btn_Ingresar" value="Ingresar" onClick="ingresarDatos()"/>
          <input type="button"  id="btn_Modificar"  value="Modificar" onClick="modificarDatos()"/>
          <input type="button"  id="btn_Eliminar"  value="Eliminar" onClick="eliminarDatos($('#frm_idCentro'))" />
          <input type="button"  id="btn_Cancelar"  value="Cancelar" onClick="cancelar()"/>
        </div></td>
    </tr>
  </table>
</div>
<p>
  <?php
  $sql_emp = "select * from empleado e, contrato c,departamento d,datosempleado da where e.idEmpleado=c.Empleado_idEmpleado and da.idEmpleado= e.idEmpleado and da.Departamento_idDepartamento=d.idDepartamento;";
  $resul_emp = mysqli_query($conexion, $sql_emp);

  $total = mysqli_num_rows($resul_emp);
  ?>
</p>
<div id="grilla"> 
  <div align="center"><a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a> <a href="../php/pdf_contrato"></a> <a href="../php/excel_contrato.html"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
    <table border="1" cellspacing="1">
      <tr>
        <td>Rut</td>
        <td>Nombres</td>
        <td>Sexo</td>
        <td>Cargo</td>
        <td>Departamento</td>
        <td>Sueldo Base</td>
        <td>Tipo de Contrato</td>
        <td>Accion</td>
      </tr>
      <?php
      while ($datos_emp = mysqli_fetch_array($resul_emp)) {
        ?>
        <tr>
          <td><?php echo $datos_emp['DocumentoIdentidad']; ?></td>
          <td><?php echo $datos_emp['Nombres'] . " " . $datos_emp['ApellidoPaterno'] . " " . $datos_emp['ApellidoMaterno']; ?></td>
          <td><?php
            if ($datos_emp['Sexo'] == 1) {
              echo "Masculino";
            } else {
              echo "Femenino";
            };
            ?></td>
          <td><?php echo $datos_emp['Cargo']; ?></td>
          <td><?php echo $datos_emp['Nombre']; ?></td>
          <td><?php echo $datos_emp['Sueldo']; ?></td>
          <td><?php echo $datos_emp['TipoContrato']; ?></td>
          <td><a href="#" onClick="cargarDatos(<?= $datos_emp['idEmpleado'] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onClick="eliminarDatos(<?= $datos_emp['idEmpleado'] ?>)"><img src="../imagen/tema/cross.png" width="16" height="16" /></a>
            <a href="../php/pdf_contrato?id=<?= $datos_emp['idEmpleado'] ?>"><img src="../imagen/tema/document_pdf.png" width="16" height="16" /></a></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>
