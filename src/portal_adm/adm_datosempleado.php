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
  function capturarDatos() {
    return "idempleado=" + $("#frm_idempleado").val() +
            "&afp=" + $("#frm_afp").val() +
            "&isapre=" + $("#frm_isapre").val() +
            "&isapre_porcentaje=" + $("#frm_isapre_porcentaje").val() +
            "&centrocosto=" + $("#frm_centrocosto").val() +
            "&departamento=" + $("#frm_departamento").val();
  }

  function ingresarDatos() {
    $.post("adm_datosempleado_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
      alert(data);
    });
  }

  function modificarDatos() {
    $.post("adm_datosempleado_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
      alert(data);
    });
  }

  function eliminarDatos(id) {
    $.post("adm_datosempleado_qry.php", "funcion=eliminar&idempleado=" + id,
            function (data) {
              alert(data);
            });
  }

  function cargarDatos(id) {
    $.post("adm_datosempleado_qry.php", "funcion=cargar&idempleado=" + id,
            function (data) {
              var datos = $.parseJSON(data);
              $("#frm_idempleado").attr("value", datos["idEmpleado"]);
			  $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
			  $("#frm_nombre").attr("value", datos["Nombres"]);
              $("#frm_isapre_porcentaje").attr("value", datos["Isapre_Porcentaje"]);

              $("#frm_afp > option[value=" + datos["Afp_idAfp"] + "]").attr('selected', true);
              $("#frm_isapre > option[value=" + datos["Isapre_idIsapre"] + "]").attr('selected', true);
              $("#frm_centrocosto > option[value=" + datos["CentroCosto_idCentroCosto"] + "]").attr('selected', true);
              $("#frm_departamento > option[value=" + datos["Departamento_idDepartamento"] + "]").attr('selected', true);
            }
    );
  }
 
function buscar(id) {
  $.post("adm_datosempleado_qry.php", "funcion=buscar&idEmpleado=" + $("#frm_idempleado").val(),
    function(data) {
      var datos = $.parseJSON(data);
      $("#frm_idempleado").attr("value", datos["idEmpleado"]);
      $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
	$("#frm_nombre").attr("value", datos["Nombres"]);
});
}
function buscarr(id) {
  $.post("adm_datosempleado_qry.php", "funcion=buscarr&DocumentoIdentidad=" + $("#frm_rut").val(),
    function(data) {
      var datos = $.parseJSON(data);
      $("#frm_idempleado").attr("value", datos["idEmpleado"]);
      $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
	$("#frm_nombre").attr("value", datos["Nombres"]);
});
}  $(document).ready(function () {
    $.post("util_generarSelect.php", "t=afp&v=idafp&n=Nombre",
            function (data) {
              $("#frm_afp").html(data);
            }
    );

    $.post("util_generarSelect.php", "t=previsiosalud&v=idprevision&n=Nombre",
            function (data) {
              $("#frm_isapre").html(data);
            }
    );

    $.post("util_generarSelect.php", "t=departamento&v=idDepartamento&n=Nombre",
            function (data) {
              $("#frm_departamento").html(data);
            }
    );

    $.post("util_generarSelect.php", "t=centrocosto&v=idcentrocosto&n=Nombre",
            function (data) {
              $("#frm_centrocosto").html(data);
            }
    );
  });

</script>
<script>
 $( document ).ready(function() {
	
	
	$( ".btn" ).click(function() {
	cargar('#contenido','adm_datosempleado.php');
  	return false;});
 });
</script>
<div id = "pag">
<table border="1">
  <tr>
    <th colspan="2">Datos de empleado</th>
  </tr>
  <tr>
    <td width="114"><label for="frm_idempleado">Id Empleado</label>
      <br>
      <label for="frm_rut">Rut empleado</label>
      <br>
      <label for="frm_nombre">Nombre empleado</label></td>
    <td width="231"><input type="text" id="frm_idempleado" onclick="buscar()">
      <input type="button" value="Buscar" onclick="buscar()">
      <br>
      <input type="text" required="frm_rut" id="frm_rut">
      <input type="button" value="Buscar" onclick="buscarr()">
      <br>
      <input type="text" required="frm_nombre" id="frm_nombre"></td>
  <tr>
    <td><label for="frm_afp">Afp</label></td>
    <td><select id="frm_afp">
      </select></td>
  </tr>
  <tr>
    <td><label for="frm_isapre">Isapre</label></td>
    <td><select id="frm_isapre">
      </select></td>
  </tr>
  <tr>
    <td><label for="frm_isapre_porcentaje">Porcentaje Isapre</label></td>
    <td><input type="text" required="frm_isapre_porcentaje" id="frm_isapre_porcentaje"></td>
  </tr>
  <tr>
    <td><label for="frm_centrocosto">Centro costo</label></td>
    <td><select  id="frm_centrocosto" >
      </select></td>
  </tr>
  <tr>
    <td><label for="frm_departamento">Departamento</label></td>
    <td><select id="frm_departamento">
      </select></td>
  </tr>
  <tr>
    <td colspan="2"><table border="1" align="center" cellspacing="2">
        <tr align="center">
          <td><input type="button" class="btn" id="btn_Ingresar" value="Ingresar" onclick="ingresarDatos()"/></td>
          <td><input type="button" class="btn" id="btn_Modificar"  value="Modificar" onclick="modificarDatos()"/></td>
          <td><input type="button" class="btn" id="btn_Eliminar"  value="Eliminar" onclick="eliminarDatos($('#frm_idCentro'))" /></td>
          <td><input type="button" class="btn"  id="btn_Cancelar"  value="Cancelar" onclick="cancelar()"/></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php
$sql = "SELECT datosempleado.idempleado as id, afp.Nombre as afp, previsiosalud.nombre as prevision,centrocosto.nombre as centrocosto,departamento.nombre as departamento
FROM datosempleado, afp, centrocosto, previsiosalud , departamento 
WHERE departamento.iddepartamento = datosempleado.departamento_iddepartamento and centrocosto.idcentrocosto = datosempleado.centrocosto_idcentrocosto and previsiosalud.idprevision= datosempleado.isapre_idisapre and afp.idafp = datosempleado.afp_idafp";
$result = mysql_query($sql);

$total = mysqli_num_rows($result);
echo 'Total: ' . $total;
?>
<table border="1">
  <tr>
    <th>id Empleado</th>
    <th>Afp</th>
    <th>Isapre</th>
    <th>Centro Costo</th>
    <th>Departamento</th>
    <th>Opciones</th>
  </tr>
  <?php
  while ($datos = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td><?= $datos["id"]; ?></td>
      <td><?= $datos["afp"]; ?></td>
      <td><?= $datos["prevision"]; ?></td>
      <td><?= $datos["centrocosto"]; ?></td>
      <td><?= $datos["departamento"]; ?></td>
      <td ><a href="#" onclick="cargarDatos(<?= $datos["id"] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onclick="eliminarDatos(<?= $datos["id"] ?>)"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a></td>
    </tr>
    <?php
  }
  ?>
</table>

</div>