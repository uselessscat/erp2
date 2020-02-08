<?php
// iniciar sesion y comprobar que esta registrado
//conectar con la base datos
require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

?>
<script type="text/javascript">

function capturarDatos(){
return "idPrevision=" + $("#frm_idPrevision").val()
+ "&Nombre=" + $("#frm_Nombre").val()
+ "&Rut=" + $("#frm_Rut").val()
+ "&Fono=" + $("#frm_Fono").val()
+ "&Direccion=" + $("#frm_Direccion").val()
+ "&Ciudad_idCiudad=" + $("#frm_Ciudad_idCiudad").val();
}

function cargarDatos (id) {
   $.post("adm_prevision_qry.php", "funcion=cargar&idPrevision=" + id,
      function (data) {
      var datos = $.parseJSON(data);
$("#frm_idPrevision").attr("value", datos["idPrevision"]);
$("#frm_Nombre").attr("value", datos["Nombre"]);
$("#frm_Rut").attr("value", datos["Rut"]);
$("#frm_Fono").attr("value", datos["Fono"]);
$("#frm_Direccion").attr("value", datos["Direccion"]);
$("#frm_Ciudad_idCiudad > option[value=" + datos["Ciudad_idCiudad"] + "]").attr('selected', true);
});}

function ingresarDatos() {
    $.post("adm_prevision_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }
    
    function modificarDatos() {
    $.post("adm_prevision_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }

    function eliminarDatos(id) {
    $.post("adm_prevision_qry.php", "funcion=eliminar&idPrevision=" + id,
      function (data) {
      alert(data);
      });
    }
		 function cancelar() {
    window.location.href = "index.php?pg=adm_empleado";
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
 $( document ).ready(function() {
	 
	
	$( ".btn" ).click(function() {
	cargar('#pag','adm_prevision.php');
	window.location.reload();
  	return true;});
	
	$(document).ready(function () {
      $.post("util_generarSelect.php", "t=ciudad&v=idCiudad&n=Nombre",
        function (data) {
          $("#frm_Ciudad_idCiudad").html(data);
        }
      );
    });
 });
</script>
<div id="pag">
<table border="1" cellspacing="1">
  <tr>
    <th colspan="2"><div align="center">Prevision de salud</div></th>
  </tr>
  <tr>
    <td><label for="frm_idPrevision">idPrevision</label></td>
    <td><input type="text" disabled="disabled" id="frm_idPrevision" /></td>
  </tr>
  <tr>
    <td><label for="frm_Nombre">Nombre</label></td>
    <td><input type="text" id="frm_Nombre" /></td>
  </tr>
  <tr>
    <td><label for="frm_Rut">Rut</label></td>
    <td><input type="text" id="frm_Rut" /></td>
  </tr>
  <tr>
    <td><label for="frm_Fono">Fono</label></td>
    <td><input type="text" id="frm_Fono" /></td>
  </tr>
  <tr>
    <td><label for="frm_Direccion">Direccion</label></td>
    <td><input type="text" id="frm_Direccion" /></td>
  </tr>
  <tr>
    <td><label for="frm_Ciudad_idCiudad">Ciudad</label></td>
    <td><label for="frm_Ciudad_idCiudad"></label>
      <select name="frm_Ciudad_idCiudad" id="frm_Ciudad_idCiudad">
    </select></td>
  </tr>
  <tr>
      <td colspan="2"><table border="1" align="center" cellspacing="2">
          <tr align="center">
            <td><input type="button" class="btn" id="btn_Ingresar" value="Ingresar" onclick="ingresarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Modificar"  value="Modificar" onclick="modificarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Eliminar"  value="Eliminar" onclick="eliminarDatos($('#frm_idPrevision'))" /></td>
            <td><input type="button" class="btn"  id="btn_Cancelar"  value="Cancelar" onclick="cancelar()"/></td>
          </tr>
        </table></td>
    </tr>
</table>
<?php
$sql_pre = "select * from previsiosalud;";
$resul_pre = mysql_query($sql_pre);

$total = mysqli_num_rows($resul_pre);
?>
<div id="grilla"> <a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a> <a href="../php/pdf_contrato"></a> <a href="../php/excl_prevision.php"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
  <table width="409" border="1">
    <tr>
      <th>Id Prevision</th>
      <th>Nombre</th>
      <th>Rut</th>
      <th>Fono</th>
      <th>Direccion</th>
      <th>Ciudad</th>
      <th>Accion</th>
    </tr>
    <?php
    while ($datos_pre = mysqli_fetch_array($resul_pre)) {
      ?>
    <tr>
      <td><?= $datos_pre['idPrevision'] ?></td>
      <td><?= $datos_pre['Nombre'] ?></td>
      <td><?= $datos_pre['Rut'] ?></td>
      <td><?= $datos_pre['Fono'] ?></td>
      <td><?= $datos_pre['Direccion'] ?></td>
      <td><?= $datos_pre['Ciudad_idCiudad'] ?></td>
      <td ><a href="#" onclick="cargarDatos(<?= $datos_pre["idPrevision"] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onclick="eliminarDatos(<?= $datos_pre["idPrevision"] ?>)"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a></td>
    
    </tr>
    <?php } ?>
  </table>
  </div>
</div>
