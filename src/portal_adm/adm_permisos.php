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
<script type="text/javascript">

function capturarDatos(){
return "idEmpleado=" + $("#frm_idEmpleado").val()
+ "&Login=" + $("#frm_Login").val()
+ "&DocumentoIdentidad=" + $("#frm_DocumentoIdentidad").val()
+ "&NivelAdministrativo=" + $("#frm_nvadm").val();
}

function cargarDatos (id) {
   $.post("adm_permisos_qry.php", "funcion=cargar&idEmpleado=" + id,
      function (data) {
      var datos = $.parseJSON(data);
$("#frm_idEmpleado").attr("value", datos["idEmpleado"]);
$("#frm_Login").attr("value", datos["Login"]);
$("#frm_DocumentoIdentidad").attr("value", datos["DocumentoIdentidad"]);
$("#frm_nvadm > option[value=" + datos["NivelAdministrativo"] + "]").attr('selected', true);
});}

function ingresarDatos() {
    $.post("adm_prevision_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }
    
    function modificarDatos() {
    $.post("adm_permisos_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }

    function quitar() {
    $.post("adm_permisos_qry.php", "funcion=quitar&" + capturarDatos(),
      function (data) {
      alert(data);
      });
    }
		 function cancelar() {
    window.location.href = "index.php?pg=adm_empleado";
  }


</script>


<div align="center">
  <table border="1">
    <tr><th colspan="2">Permisos</th></tr>
    <tr><td><label for="frm_idEmpleado">idEmpleado</label></td>
    <td><input type="text" disabled="disabled" id="frm_idEmpleado" /></td></tr>
    <tr><td><label for="frm_Login">Login</label></td>
    <td><input type="text" id="frm_Login" /></td></tr>
    <tr><td><label for="frm_DocumentoIdentidad">DocumentoIdentidad</label></td>
    <td><input type="text" id="frm_DocumentoIdentidad" /></td></tr>
    <tr><td><label for="frm_NivelAdministrativo">NivelAdministrativo</label></td>
      <td><select name="frm_nvadm" id="frm_nvadm">
        <option value="0">Administrador</option>
        <option value="1">Jefazo</option>
        <option value="2">Usuario con permisos</option>
        <option value="3" selected="selected">Trabajador(Sin permisos administrativos)</option>
    </select></td></tr>
    <tr>
      <td colspan="2"><table border="1" align="center" cellspacing="2">
        <tr align="center">
          <td><input type="button"  id="btn_Modificar"  value="Modificar" onclick="modificarDatos()"/></td>
          <td><input type="button"  id="btn_Quitar_Permisos"  value="Quitar Permisos" onclick="quitar()" /></td>
          <td><input type="button"  id="btn_Cancelar"  value="Cancelar" onclick="cancelar()"/></td>
          </tr>
        </table></td>
      </tr>
  </table>
  
  <?php
$sql_emp = "select * from empleado;";
$result = mysqli_query($conexion, $sql_emp);
$total = mysqli_num_rows($result);
echo 'Total: ' . $total;
?>
</div>
<div id="grilla">
  <div align="center">
    <table  border="1" cellspacing="1">
      <tr>
        <th>Id</th>
        <th>Login</th>
        <th>Rut</th>
        <th>Nivel de Permisos</th>
        <th>Accion</th>
      </tr>
      <?php
  while ($datos = mysqli_fetch_array($result)) {
    ?>
      <tr>
        <td><?= $datos["idEmpleado"] ?> </td>
  <td><?= $datos["Login"] ?> </td>
  <td><?= $datos["DocumentoIdentidad"] ?> </td>
  <td><?= $datos["NivelAdministrativo"] ?> </td>
        <td ><a href="#" onclick="cargarDatos(<?= $datos["idEmpleado"] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a></td>
      </tr>
      <?php
  }
  ?>
    </table>
  </div>
</div>
