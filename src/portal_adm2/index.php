<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="./Estilo/estilo_adm.css" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>

    <script src="./Javascript/jqAcciones.js" type="text/javascript"></script>
    <script src="./Javascript/Validacion.js" type="text/javascript"></script>
    <script src="./Javascript/objetosbd.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() { // cargar al iniciar
            cargar("./login.php", "panel");
            cargar("./barra_lateral.php", "barralateral");
        });

        function cargar(dir, id) {
            $("#" + id).load(dir);
        }

        function poner(datos, id) {
            $("#" + id).html(datos);
        }
    </script>
    <title>Portal admistrador</title>
</head>

<body>
    <div id="barralateral" class="barralateral">
    </div>
    <div id="contenido">
        <div id="panel" class="panel"></div>
    </div>
</body>

</html>