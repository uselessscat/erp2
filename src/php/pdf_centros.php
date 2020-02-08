<?php require_once "../php/conexion_mysql.php";
$conexion = ctar_nvl_0();

$sql_emp = "SELECT * FROM centrocosto;";
$result = mysqli_query($conexion, $sql_emp);

$total = mysqli_num_rows($result);

ob_start();
?>
<table width="100%" border="1" cellspacing="1">
    <tr>
        <th>ID Centro Costo</th>
        <th>Nombre Centro Costo</th>
        <th>Encargado</th>
        <th>Centro Costo Padre</th>
        <th>Fecha</th>
    </tr>
    <?php
    while ($datos = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?= $datos["idCentroCosto"]; ?></td>
            <td><?= $datos["Nombre"]; ?></td>
            <td><?= $datos["Encargado_idEmpleado"]; ?></td>
            <td><?= $datos["CentroCostoPadre"]; ?></td>
            <td><?= $datos["Fecha"]; ?></td>
        </tr>
    <?php
    }
    ?>
</table>

<?php
require_once "../dompdf/dompdf_config.inc.php";

$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();

$filename = "Centro" . time() . '.pdf';

file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>