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
  return "idCentroCosto=" + (($("#frm_idCentro").val() == "") ? "null" : $("#frm_idCentro").val()) +
    "&Nombre=" + $("#frm_Nombre").val() +
    "&Encargado_idEmpleado=" + $("#frm_Encargado").val() +
    "&CentroCostoPadre=" + (($("#frm_CentroCostoPadre").val() == "") ? "null" : $("#frm_CentroCostoPadre").val()) +
    "&Fecha=" + $("#frm_Fecha").val();
}

function ingresarDatos() {
  $.post("adm_centrocosto_qry.php", "funcion=ingresar&" + capturarDatos(), function(data) {
    alert(data);
  });
}

function modificarDatos() {
  $.post("adm_centrocosto_qry.php", "funcion=modificar&" + capturarDatos(), function(data) {
    alert(data);
  });
}

function eliminarDatos(id) {
  $.post("adm_centrocosto_qry.php", "funcion=eliminar&idCentroCosto=" + id,
    function(data) {
      alert(data);
    });
}

function cargarDatos(id) {
  $.post("adm_centrocosto_qry.php", "funcion=cargar&idCentroCosto=" + id,
    function(data) {
      var datos = $.parseJSON(data);
      $("#frm_idCentro").attr("value", datos["idCentroCosto"]);
      $("#frm_Nombre").attr("value", datos["Nombre"]);
      $("#frm_Encargado").attr("value", datos["Encargado_idEmpleado"]);
	  $("#frm_nombre_encargado").attr("value", datos["Nombres"]);
      $("#frm_CentroCostoPadre").attr("value", datos["CentroCostoPadre"]);
      $("#frm_Fecha").attr("value", datos["Fechaf"]);
    }
  );
}

function buscar() {
  $.post("adm_centrocosto_qry.php", "funcion=buscar&idEmpleado=" + $("#frm_Encargado").val(),
    function(data) {
		alert(data);
      var datos = $.parseJSON(data);
      $("#frm_Encargado").attr("value", datos["idEmpleado"]);
      $("#frm_nombre_encargado").attr("value", datos["Nombres"]);
    });
}
</script>
<script>
  function imprimirSelec(nombre) {
    var ficha = document.getElementById(nombre);
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
  }
</script><script type="text/javascript" src="../javascript/calendario.js"></script>
<script>
 $( document ).ready(function() {
	
  
	$( ".btn" ).click(function() {
	cargar('#contenido','adm_centrocosto.php');
  	return false;});
 });
</script>

<form action="" method="post">
  <table  border="1" cellspacing="2">
    <tr>
      <th colspan="2">Centro de Costos Departamentos</th>
    </tr>
    <tr>
      <td><label for="frm_idCentro">ID Centro de costo</label></td>
      <td><input type="text" disabled="disabled" id="frm_idCentro" size="20" readonly="readonly"></td>
    </tr>
    <tr>
      <td><label for="frm_Nombre">Nombre centro de costo</label></td>
      <td><input type="text"  id="frm_Nombre"></td>
    </tr>
    <tr>
      <td><label for="frm_Encargado">ID Encargado</label></td>
      <td><input type="text" id="frm_Encargado" required="required">
        <input type="button" value="Buscar" onclick="buscar()" /></td>
    </tr>
    <tr>
      <td>Nombre Encargado</td>
      <td><input type="text" id="frm_nombre_encargado" /></td>
    </tr>
    <tr>
      <td><label for="frm_CentroCostoPadre">CentroCostoPadre</label></td>
      <td><input type="text"  id="frm_CentroCostoPadre"></td>
    </tr>
    <tr>
      <td><label for="frm_Fecha">Fecha</label></td>
      <td><input name="fecha" type="text" class="datepicker" id="frm_Fecha" readonly /></td>
    </tr>
    <tr>
      <td colspan="2"><table border="1" align="center" cellspacing="2">
          <tr align="center">
            <td><input type="button" class="btn" id="btn_Ingresar" value="Ingresar" onclick="ingresarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Modificar"  value="Modificar" onclick="modificarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Eliminar"  value="Eliminar" onclick="eliminarDatos($('#frm_idCentro'))" /></td>
            <td><input type="button" class="btn" id="btn_Cancelar"  value="Cancelar" onclick="cancelar()"/></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?php
$sql_emp = "select * ,DATE_FORMAT(Fecha,'%d-%m-%Y') as Fecha,(select ce.nombre from centrocosto ce where c.centrocostopadre=ce.idcentrocosto)as nombrepadre from centrocosto c;";
$result = mysqli_query($conexion, $sql_emp);
$total = mysqli_num_rows($result);
echo 'Total: ' . $total;
?>
<div id="grilla"> <a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a> <a href="../php/pdf_centros"> <img src="../imagen/tema/document_pdf.png" width="16" height="16" /></a> <a href="../php/excel_centros.php"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
  <table width="100%" border="1" cellspacing="1">
    <tr>
      <th>ID Centro Costo</th>
      <th>Nombre Centro Costo</th>
      <th>Encargado</th>
      <th>Centro Costo Padre</th>
      <th>Fecha</th>
      <th>Accion</th>
    </tr>
    <?php
  while ($datos = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td><?= $datos["idCentroCosto"]; ?></td>
      <td><?= $datos["Nombre"]; ?></td>
      <td><?= $datos["Encargado_idEmpleado"]; ?></td>
      <td>(
        <?= $datos["CentroCostoPadre"]; ?>
        )
        <?= $datos["nombrepadre"]; ?></td>
      <td><?= $datos["Fecha"]; ?></td>
      <td ><a href="#" onclick="cargarDatos(<?= $datos["idCentroCosto"] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onclick="eliminarDatos(<?= $datos["idCentroCosto"] ?>)"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a></td>
    </tr>
    <?php
  }
  ?>
  </table>
</div>
