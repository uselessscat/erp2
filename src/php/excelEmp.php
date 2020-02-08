<?php
require "conexion_mysql.php";
$conexion = ctar_nvl_0();

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Empleados.xls");

$sql_emp = "SELECT * FROM empleado";
$resul_emp = mysqli_query($conexion, $sql_emp);
$total = mysqli_num_rows($resul_emp);

?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="5">
    <tr class="font_titulos_grilla">
        <td width="7%" bgcolor="#CCCCCC">N°</td>
        <td width="8%" bgcolor="#CCCCCC">Rut</td>
        <td width="18%" bgcolor="#CCCCCC">Nombres</td>
        <td width="11%" bgcolor="#CCCCCC">Email</td>
        <td width="18%" bgcolor="#CCCCCC">Usuario</td>
    </tr>
    <?php
    $cont = 1;

    while ($datos_emp = mysqli_fetch_array($resul_emp)) {
    ?>
        <tr class="font_datos_grilla">
            <td height="50"><?php echo $cont; ?></td>
            <td><?php echo $datos_emp['DocumentoIdentidad']; ?></td>
            <td><?php echo $datos_emp['Nombres'] . " " . $datos_emp['ApellidoPaterno'] . " " . $datos_emp['ApellidoMaterno']; ?></td>
            <td><?php echo $datos_emp['Email']; ?></td>
            <td><?php echo $datos_emp['Login']; ?></td>
        </tr>
    <?php
        $cont++;
    }
    ?>
</table>