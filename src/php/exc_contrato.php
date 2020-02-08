<?php
require "conexion_mysql.php";
$conexion = ctar_nvl_0();

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Contratos.xls");

$sql_emp = "SELECT * FROM empleado e, contrato c,departamento d,datosempleado da WHERE e.idEmpleado=c.Empleado_idEmpleado AND da.idEmpleado= e.idEmpleado AND da.Departamento_idDepartamento=d.idDepartamento;";
$resul_emp = mysqli_query($conexion, $sql_emp);

$total = mysqli_num_rows($resul_emp);
?>
<h2 align="center"> Contratos </h2>

<table width="100%" border="1" cellspacing="1" align="center">
    <tr>
        <td width="8%" nowrap="nowrap">Rut</td>
        <td width="18%" nowrap="nowrap">Nombres</td>
        <td width="9%" nowrap="nowrap">Sexo</td>
        <td width="13%" nowrap="nowrap">Cargo</td>
        <td width="17%" nowrap="nowrap">Departamento</td>
        <td width="15%" nowrap="nowrap">Sueldo Base</td>
        <td width="20%" nowrap="nowrap">Tipo de Contrato</td>
    </tr>
    <?php
    while ($datos_emp = mysqli_fetch_array($resul_emp)) {
    ?>
        <tr>
            <td><?php echo $datos_emp['DocumentoIdentidad']; ?></td>
            <td><?php echo $datos_emp['Nombres'] . " " . $datos_emp['ApellidoPaterno'] . " " . $datos_emp['ApellidoMaterno']; ?></td>
            <td><?php if ($datos_emp['Sexo'] == 1) {
                    echo "Masculino";
                } else {
                    echo "Femenino";
                } ?>
            </td>
            <td><?php echo $datos_emp['Cargo']; ?></td>
            <td><?php echo $datos_emp['Nombre']; ?></td>
            <td><?php echo $datos_emp['Sueldo']; ?></td>
            <td><?php echo $datos_emp['TipoContrato']; ?></td>
        </tr>
    <?php } ?>
</table>