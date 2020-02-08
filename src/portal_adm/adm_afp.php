<?php
// iniciar sesion y comprobar que esta registrado
//conectar con la base datos
require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

?>
<script type="text/javascript">

function capturarDatos(){
return "idAfp="+$("#frm_idAfp").val()
+ "&Rut="+$("#frm_Rut").val()
+ "&Nombre="+$("#frm_Nombre").val()
+ "&Porcentaje="+$("#frm_Porcentaje").val()
+ "&Estado="+$("#frm_Estado").val()
+ "&Ciudad_idCiudad="+$("#frm_ciudad").val();
}

function cargarDatos (id) {
   $.post("adm_afp_qry.php", "funcion=cargar&idAfp=" + id,
      function (data) {
      var datos = $.parseJSON(data);
$("#frm_idAfp").attr("value",datos["idAfp"]);
$("#frm_Rut").attr("value",datos["Rut"]);
$("#frm_Nombre").attr("value",datos["Nombre"]);
$("#frm_Porcentaje").attr("value",datos["Porcentaje"]);
$("#frm_Estado > option[value=" + datos["Estado"] + "]").attr('selected', true);
$("#frm_ciudad > option[value=" + datos["Ciudad_idCiudad"] + "]").attr('selected', true);
});}

function ingresarDatos() {
    $.post("adm_afp_qry.php", "funcion=ingresar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }
    
    function modificarDatos() {
    $.post("adm_afp_qry.php", "funcion=modificar&" + capturarDatos(), function (data) {
    alert(data);
    });
    }

    function eliminarDatos(id) {
    $.post("adm_afp_qry.php", "funcion=eliminar&idAfp=" + id,
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
	//cargar('#contenido','adm_afp.php');
	
	$( ".btn" ).click(function() {
	cargar('#contenido','adm_afp.php');
  	return false;});
 });
</script>

<div id=pag> 
<table border="1" cellspacing="1">
  <tr>
    <th colspan="2"><div align="center">AFP</div></th>
  </tr>
  <tr><td><label for="frm_idAfp">Codigo</label></td><td><input type="text" id="frm_idAfp" /></td></tr>
<tr><td><label for="frm_Rut">Rut</label></td><td><input type="text" id="frm_Rut" /></td></tr>
<tr><td><label for="frm_Nombre">NombreAFP</label></td><td><input type="text" id="frm_Nombre" /></td></tr>
<tr><td><label for="frm_Porcentaje">Porcentaje</label></td><td><input type="text" id="frm_Porcentaje" /></td></tr>
<tr><td><label for="frm_Estado">Estado</label></td><td><select name="frm_Estado" id="frm_Estado">
<option value="-1">Seleccione</option>
<option value="0">Activo</option>
<option value="1">Inactivo</option>
</select></td></tr>
<tr><td>
 <?php
	     $sql_ciu="Select * from ciudad";
		 $resul_ciu=mysql_query($sql_ciu);
	  ?>
<label for="frm_Ciudad_idCiudad">Ciudad</label></td><td><select name="frm_ciudad" id="frm_ciudad">
<option value="-1">Seleccione</option>
 <?php
		  while($datos_ciu=mysqli_fetch_array($resul_ciu))
          {
			  ?>
          <option value="<?php echo $datos_ciu['idCiudad'];?>" <?php if($datos_emp['idCiudad']==$datos_ciu['idCiudad']){?> selected="selected" <?php } ?>><?php echo $datos_ciu['Nombre'];?></option>
          <?php
		  }
		  ?>
</select>

</td></tr>  <tr>
      <td colspan="2"><table border="1" align="center" cellspacing="2">
          <tr align="center">
            <td><input type="button"  class="btn" id="btn_Ingresar" value="Ingresar" onclick="ingresarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Modificar"  value="Modificar" onclick="modificarDatos()"/></td>
            <td><input type="button" class="btn" id="btn_Eliminar"  value="Eliminar" onclick="eliminarDatos($('#frm_idAfp').val())" /></td>
            <td><input type="button" class="btn" id="btn_Cancelar"  value="Cancelar" onclick="cancelar()"/></td>
          </tr>
        </table></td>
    </tr>
</table>
<?php
$sql_afp = "select idAfp,Rut,a.Nombre,Porcentaje,Estado,c.Nombre as NombreCiudad from afp a, ciudad c where c.idCiudad=a.Ciudad_idCiudad;";
$resul_afp = mysql_query($sql_afp);

$total = mysqli_num_rows($resul_afp);
?>
<div id="grilla"><a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a> <a href="../php/pdf_contrato"></a> <a href="../php/excl_afp.php"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
  <table width="456" border="1">
    <tr>
     <th width="47">Codigo</th> 
<th width="25">Rut</th> 
<th width="96">Nombre AFP</th>
<th width="71">Porcentaje</th> 
<th width="48">Estado</th> 
<th width="50">Ciudad</th> 
<th width="73">Accion</th> 
    </tr><?php
    while ($datos_afp = mysqli_fetch_array($resul_afp)) {
      ?>
      <tr>
      <td><?= $datos_afp["idAfp"] ?> </td>
<td><?= $datos_afp["Rut"] ?> </td>
<td><?= $datos_afp["Nombre"] ?> </td>
<td><?= $datos_afp["Porcentaje"] ?> </td>
<td>
<?php
            if ($datos_afp['Estado'] == 0) {
              echo "Activo";
            } else {
              echo "Inactivo";
            };
            ?></td>
<td><?= $datos_afp["NombreCiudad"] ?> </td>
       <td ><a href="#" onclick="cargarDatos(<?= $datos_afp["idAfp"] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /> </a><a class="btn" href="#" onclick="eliminarDatos(<?= $datos_afp["idAfp"] ?>)"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a></td>
    </tr>
       <?php } ?>
    
  ></table>
  </div>
  </div>
</div>
