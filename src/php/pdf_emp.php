<?php
require_once "../php/conexion_mysql.php";
$conexion = ctar_nvl_0();
$sql_emp = "SELECT * FROM empleado";
$resul_emp = mysqli_query($conexion, $sql_emp);

ob_start();

?>
<h1 align="center"> EMPLEADOS </h1>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="5">
    <tr class="font_titulos_grilla">
        <td width="6%" bgcolor="#CCCCCC">N°</td>
        <td width="7%" bgcolor="#CCCCCC">Rut</td>
        <td width="23%" bgcolor="#CCCCCC">Nombres</td>
        <td width="17%" bgcolor="#CCCCCC">Email</td>
        <td width="18%" bgcolor="#CCCCCC">Sexo</td>
        <td width="15%" bgcolor="#CCCCCC">Telefono Movil</td>
        <td width="14%" bgcolor="#CCCCCC">Usuario</td>
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
            <td><?php if ($datos_emp['Sexo'] == 1) {
                    echo "Femenino";
                } else {
                    echo "Masculino";
                } ?></td>
            <td><?php echo $datos_emp['TelefonoMovil']; ?></td>
            <td><?php echo $datos_emp['Login']; ?></td>
        </tr>
    <?php

        $cont++;
    }
    ?>
</table>
<?php


require_once "../dompdf/dompdf_config.inc.php";

$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Empleados" . time() . '.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>