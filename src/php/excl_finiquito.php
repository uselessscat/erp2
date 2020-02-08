<?php
require "conexion_mysql.php";
$conexion = ctar_nvl_0();

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Finiquitos.xls");

$sql_fin = "SELECT *, Contrato, DATE_FORMAT(FechaTerminoContrato,'%d-%m-%Y') AS fechaTerminoCont, DATE_FORMAT(FechaPagoFiniquito,'%d-%m-%Y') AS fechaPagoFiniquito FROM finiquito;";
$resul_fin = mysqli_query($conexion, $sql_fin);

$total = mysqli_num_rows($resul_fin);
?>
<div id="grilla">
    <h3 align="center">Finiquitos</h3>
    <table border="1">
        <tr class="font_titulos_grilla">
            <th>IdContrato</th>
            <th>Fecha Termino Contrato</th>
            <th>Fecha Pago Finiquito</th>
            <th>Pago Finiquito</th>
        </tr>
        <?php
        while ($datos_fin = mysqli_fetch_array($resul_fin)) {
        ?>
            <tr>
                <td><?= $datos_fin['Contrato'] ?></td>
                <td><?= $datos_fin['fechaTerminoCont'] ?></td>
                <td><?= $datos_fin['fechaPagoFiniquito'] ?></td>
                <td><?= $datos_fin['Finiquito'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>