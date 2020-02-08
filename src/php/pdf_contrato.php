<?php

require_once "../php/conexion_mysql.php";
$conexion = ctar_nvl_0();
$idEmpleado = $_GET["id"];

mysqli_query($conexion, "set lc_time_names = 'es_CL';"); //Cambiar el formato de fecha a español

$sql_emp = "SELECT *, DATE_FORMAT(FechaNacimiento,'%W %d de %M de %Y') AS FechaFormat FROM empleado WHERE idEmpleado=" . $idEmpleado . " ;";
$result = mysqli_query($conexion, $sql_emp);
$datos = mysqli_fetch_array($result);

$sql_ciu = "SELECT * FROM ciudad WHERE idCiudad=" . $datos["Ciudad_idCiudad"] . ";";
$result1 = mysqli_query($conexion, $sql_ciu);
$datos1 = mysqli_fetch_array($result1);

$sql_contr = "SELECT *, DATE_FORMAT(Fecha,'%W %d de %M de %Y') AS FechaFormat FROM contrato WHERE Empleado_idEmpleado=" . $idEmpleado . ";";
$result2 = mysqli_query($conexion, $sql_contr);
$datos2 = mysqli_fetch_array($result2);

$sql_pais = "SELECT * FROM pais WHERE idPais=" . $datos["Pais_idPais"] . ";";
$result3 = mysqli_query($conexion, $sql_pais);
$datos3 = mysqli_fetch_array($result3);

$sql_dep = "SELECT * FROM departamento dep,datosempleado datos WHERE dep.idDepartamento=datos.Departamento_idDepartamento AND datos.idEmpleado=" . $idEmpleado . ";";
$result4 = mysqli_query($conexion, $sql_dep);
$datos4 = mysqli_fetch_array($result4);

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
    <table width="60%" border="0" cellspacing="1" align="center">
        <tr>
            <td>
                <h2 align="center"> Contrato Individual de Trabajo </h2>
                <p>
                </p>
                <div id align="justify">

                    <p>En
                        <?= $datos1["Nombre"]; ?>
                        a
                        <?= $datos2["FechaFormat"]; ?>
                        entre (nombre o razón social) Pnks Limitada , R.U.T 50.867.125-2 , representado(a) legalmente por don(a)Armando Esteban Quito, cédula de identidad 6.869.154-1., ambos con domicilio en Limon Verde #2313 comuna de Santiago, en adelante el "Empleador" y don
                        <?= $datos["Nombres"]; ?>
                        <?= $datos["ApellidoPaterno"]; ?>
                        <?= $datos["ApellidoMaterno"]; ?>
                        de
                        <?= $datos3["Nombre"]; ?>
                        , nacido el
                        <?= $datos["FechaFormat"]; ?>
                        , domiciliado en
                        <?= $datos["Direccion"]; ?>
                        , ciudad de
                        <?= $datos1["Nombre"]; ?>
                        , RUT
                        <?= $datos["DocumentoIdentidad"]; ?>
                        , en adelante "Trabajador". Se ha convenido el siguiente Contrato Individual de Trabajo:

                        <p> PRIMERO : El trabajador se compromete y obliga a prestar servicios como
                            <?= $datos2["Cargo"]; ?>
                            u otro trabajo o función similar, que tenga directa relación con el cargo ya indicado, en el Departamento (Sección) de
                            <?= $datos4["Nombre"]; ?>
                            , ubicado en
                            <?= $datos4["Direccion"]; ?>
                            , pudiendo ser trasladado a otro Departamento o Sección de la Oficina Principal o de cualquiera de las Agencias del Empleador, a condición que se trate de labores similares, en la misma ciudad, y sin que ello importe menoscabo para el trabajador, todo ello sujeto a las necesidades operativas de la Empresa. </p>
                        <p> SEGUNDO : JORNADA DE TRABAJO
                            El trabajador cumplirá una jornada semanal ordinaria de
                            <?php $hsemana = mysqli_fetch_array(mysqli_query($conexion, "SELECT SEC_TO_TIME( TIME_TO_SEC( SUBTIME( HoraFin, HoraInicio ) ) * ( DiaFinTrabajo - DiaInicioTrabajo ) )
        FROM  `contrato`
        WHERE  `Empleado_idEmpleado` = " . $idEmpleado . "
        LIMIT 0 , 30"));
                            echo $hsemana[0];
                            ?>
                            horas, de acuerdo a la siguiente distribución diaria: de
                            <?= returndiaSemana($datos2["DiaInicioTrabajo"]) ?>
                            a
                            <?= returndiaSemana($datos2["DiaFinTrabajo"]) ?>
                            , de
                            <?= $datos2["HoraInicio"]; ?>
                            a
                            <?= $datos2["HoraFin"]; ?>
                            horas. Con Turnos de descanso de
                            <?= returndiaSemana($datos2["DescansoInicio"]); ?>
                            a
                            <?= returndiaSemana($datos2["DescansoFin"]); ?>
                            tiempo que será de cargo del Jefe de turno presente. </p>
                        TERCERO : Cuando por necesidades de funcionamiento de la Empresa, sea necesario pactar trabajo en tiempo extraordinario, el Empleado que lo acuerde desde luego se obligará a cumplir el horario que al efecto determine la Empleadora, dentro de los límites legales. Dicho acuerdo constará por escrito y se firmará por ambas partes, previamente a la realización del trabajo.
                        A falta de acuerdo, queda prohibido expresamente al Empleado trabajar sobretiempo o simplemente permanecer en el recinto de la Empresa, después de la hora diaria de salida, salvo en los casos a que se refiere el inciso precedente.
                        El tiempo extraordinario trabajado de acuerdo a las estipulaciones precedentes, se remunerará con el recargo legal correspondiente y se liquidará y pagará conjuntamente con la remuneración del respectivo período.
                        <p> CUARTO : El empleado percibirá un sueldo de $
                            <?= $datos2["Sueldo"]; ?>
                            mensuales, pagaderos por meses vencidos.
                            Las deducciones que la Empleadora podrá según los casos - practicar a las remuneraciones, son todas aquéllas que dispone el artículo 58 del Código del Trabajo. </p>
                        <p> QUINTO : El trabajador, asimismo, acepta y autoriza al Empleador para que haga las deducciones que establecen las leyes vigentes y, para que le descuente el tiempo no trabajado debido a atrasos, inasistencias o permisos y, además, la rebaja del monto de las multas establecidas en el Reglamento Interno de Orden, Higiene y Seguridad, en caso que procedieren. </p>
                        <p> SEXTO : La Empresa se obliga a pagar al empleado una gratificación anual equivalente al 25% (veinticinco por ciento) del total de las remuneraciones mensuales que éste hubiere percibido en el año, con tope de 4,75 Ingresos Mínimos Mensuales.
                            Esta gratificación se calculará, liquidará y anticipará mensualmente en forma coetánea con la remuneración del mes respectivo, siendo cada abono equivalente a la doceava parte de la gratificación anual. </p>
                        <p> La gratificación así convenida es incompatible y sustituye a la que resulte de la aplicación de los artículos 47 y siguientes del Código del Trabajo, siempre que esta última fuere igual o inferior a aquélla. En caso contrario, se abonará la diferencia.
                            Para los efectos de cotejar la gratificación convenida en esta cláusula con la que, según la ley, eventualmente podría corresponder al Empleado, los valores anticipados mensualmente se reajustarán en conformidad con lo dispuesto en el artículo 63 del Código del Trabajo, y se entenderá que fueron abonados con carácter de anticipos de dichas gratificaciones legales.
                            Con todo, si las sumas anticipadas a título de gratificación convencional resultaren mayores que las que legalmente correspondieren al Empleador, el exceso se consolidará en su beneficio. </p>
                        <p> SÉPTIMO : El empleador se compromete a otorgar o suministrar al trabajador los siguientes beneficios: a)Premios por Produccion b) Bonificaciones para dias Festivos c) Transporte
                            El trabajador se obliga y compromete expresamente a cumplir las instrucciones que le sean impartidas por su jefe inmediato o por la Gerencia de la empresa y, acatar en todas sus partes las disposiciones establecidas en el Reglamento de Orden, Higiene y Seguridad las que declara conocer y que, para estos efectos se consideran parte integrante del presente contrato, reglamento del cual el trabajador recibe un ejemplar en este acto. </p>
                        <p> OCTAVO : Las partes acuerdan en este acto que los atrasos reiterados, sin causa justificada, de parte del trabajador, se considerarán incumplimiento grave de las obligaciones que impone el presente contrato y darán lugar a la aplicación de la caducidad del contrato, contemplada en el art. .160 Nº7 del Código del Trabajo
                            Se entenderá por atraso reiterado el llegar después de la hora de ingreso durante 5 días seguidos o no, en cada mes calendario. Bastará para acreditar esta situación la constancia en el respectivo Control de Asistencia. </p>
                        <p> NOVENO : El presente contrato regirá en forma
                            <?= $datos2["TipoContrato"]; ?>
                            en caso de que cualquiera de las partes, o ambas, según el caso, podrán ponerle término en cualquier momento con arreglo a la ley. </p>
                        <p> DÉCIMO : Para todas las cuestiones a que eventualmente pueda dar origen este contrato, las partes fijan domicilio en la ciudad de Santiago. </p>
                        <p> DÉCIMO PRIMERO : Se deja constancia que el Empleado ingresó al servicio de la Empresa con fecha
                            <?= $datos2["FechaFormat"]; ?>
                            El presente contrato se firma en dos ejemplares, quedando en este mismo acto uno en poder de cada contratante. </p>
                </div>
                <table width="633" border="0" align="center" cellspacing="3">
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
                        <td>RUT EMPLEADOR</td>
                        <td>RUT TRABAJADOR</td>
                    </tr>
                </table>
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>