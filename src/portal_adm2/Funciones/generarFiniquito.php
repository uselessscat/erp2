<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './sinpermisos.php';
}
require_once './conexion_mysql.php';

$idEmpleado = $_GET["id"];

mysqli_query($conexion, "set lc_time_names = 'es_CL';"); //Cambiar el formato de fecha a español

$sql_emp = "select *,DATE_FORMAT(FechaNacimiento,'%W %d de %M de %Y') as FechaFormat from empleado where idEmpleado=" . $idEmpleado . " ;";
$result = mysqli_query($conexion, $sql_emp);
$datos = mysqli_fetch_array($result);

$sql_ciu = "select * from ciudad where idCiudad=" . $datos["Ciudad_idCiudad"] . ";";
$result1 = mysqli_query($conexion, $sql_ciu);
$datos1 = mysqli_fetch_array($result1);

$sql_contr = "select *, DATE_FORMAT(Fecha,'%W %d de %M de %Y') as FechaFormat from Contrato where idEmpleado=" . $idEmpleado . ";";
$result2 = mysqli_query($conexion, $sql_contr);
$datos2 = mysqli_fetch_array($result2);

$sql_pais = "select * from pais where idPais=" . $datos["Pais_idPais"] . ";";
$result3 = mysqli_query($conexion, $sql_pais);
$datos3 = mysqli_fetch_array($result3);

$sql_dep = "select * from departamento dep, Empleado2 datos where dep.idDepartamento=datos.Departamento_idDepartamento and datos.idEmpleado=" . $idEmpleado . ";";
$result4 = mysqli_query($conexion, $sql_dep);
$datos4 = mysqli_fetch_array($result4);

$sql_fini = "select * from causafiniquito cau, finiquito fini,contrato c,Empleado2 em2 where cau.idCausaFiniquito=fini.CausaFiniquito_idCausaFiniquito and fini.idFiniquito=c.Finiquito_idFiniquito and c.idContrato=em2.Contrato_idContrato and em2.idEmpleado=" . $idEmpleado . ";";
$result5 = mysqli_query($conexion, $sql_fini);
$datos5 = mysqli_fetch_array($result5);

function returndiaSemana($var)
{
    switch ($var) {

        case 0:
            return "Lunes";
        case 1:
            return "Martes";
        case 2:
            return "Miercoles";
        case 3:
            return "Jueves";
        case 4:
            return "Viernes";
        case 5:
            return "Sabado";
        case 6:
            return "Domingo";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>

<body>
    <table width="50%" border="0" cellspacing="1" align="center">
        <tr>
            <h1 align="center">Finiquito</h1>
            <td>
                <div align="justify">
                    <p>En
                        <?= $datos1["Nombre"]; ?>
                        , a
                        <?= $datos2["FechaFormat"]; ?>
                        , entre Pnks Limitada representado(a) legalmente por don(a)Armando Esteban Quito RUT: 50.867.125-2, con domicilio en calle Limon Verde #2313 comuna de Santiago, región Metropolitana, en adelante “el empleador”, por una parte, y don(ña)
                        <?= $datos["Nombres"]; ?>
                        <?= $datos["ApellidoPaterno"]; ?>
                        <?= $datos["ApellidoMaterno"]; ?>
                        RUT:
                        <?= $datos["DocumentoIdentidad"]; ?>
                        , con domicilio en calle
                        <?= $datos["Direccion"]; ?>
                        , comuna de
                        <?= $datos1["Nombre"]; ?>
                        , nacido(a) el
                        <?= $datos["FechaFormat"]; ?>
                        , en adelante “el trabajador”, por otra parte, se conviene el siguiente finiquito:
                    </p>
                    <p>PRIMERO.- Don(ña)
                        <?= $datos["Nombres"]; ?>
                        <?= $datos["ApellidoPaterno"]; ?>
                        <?= $datos["ApellidoMaterno"]; ?> declara haber prestado servicios a Sr(a) Armando Esteban Quito en calidad de <?= $datos2["Cargo"]; ?> desde <?= $datos2["FechaFormat"]; ?> hasta el <?= $datos5["FechaTerminoContrato"]; ?>, fecha esta última de terminación de sus servicios, por la causa que se indica a continuación: <?= $datos5["CausaFiniquito_idCausaFiniquito"]; ?> .

                    </p>
                    <p>SEGUNDO.- Doña
                        <?= $datos["Nombres"]; ?>
                        <?= $datos["ApellidoPaterno"]; ?>
                        <?= $datos["ApellidoMaterno"]; ?> declara recibir en este acto, a su entera satisfacción de parte de Sr(a) Armando Esteban Quito las sumas que a continuación se indican, por los siguientes conceptos:

                        Concepto: <?= $datos5["Conceptos"]; ?> lo que suma un Total de$ <?= $datos5["Total"]; ?>

                    </p>
                    <p> TERCERO: Doña <?= $datos["Nombres"]; ?>
                        <?= $datos["ApellidoPaterno"]; ?>
                        <?= $datos["ApellidoMaterno"]; ?> deja constancia que durante todo el tiempo que le prestó servicios a Don(ña) Armando Esteban Quito , recibió de éste(a), correcta y oportunamente el total de las remuneraciones convenidas de acuerdo con su contrato de trabajo, clase de trabajo ejecutado, reajustes legales, pago de asignaciones familiares autorizadas por la respectiva Institución Previsional, feriados legales, en conformidad a la ley, y que nada se le adeuda por los conceptos antes indicados ni por ningún otro, sea de origen legal o contractual derivado de la prestación de sus servicios, y motivo por el cual no teniendo reclamo ni cargo alguno que formular en contra del empleador, le otorga el más amplio y total finiquito, declaración que formula libre y espontáneamente, en perfecto y cabal conocimiento de todos y cada uno de sus derechos.
                        Para constancia firman las partes el presente finiquito en dos ejemplares, quedando uno de ellos en poder del empleador y el otro en poder del trabajador. </p>
                    <table width="633" height="200" border="0" align="center" cellspacing="1">
                        <tr>
                            <td width="346">
                                <p>&nbsp;</p>
                                <p>............................................</p>
                            </td>
                            <td width="274">
                                <p>&nbsp;</p>
                                <p>............................................</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>FIRMA EMPLEADOR</p>
                                <p>&nbsp;</p>
                            </td>
                            <td>
                                <p>FIRMA TRABAJADOR</p>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>............................................</td>
                            <td>............................................</td>
                        </tr>
                        <tr>
                            <td height="21">RUT EMPLEADOR</td>
                            <td>RUT TRABAJADOR</td>
                        </tr>
                    </table>
    </table>
    <div align="justify"></div>


    </table>
</body>

</html>