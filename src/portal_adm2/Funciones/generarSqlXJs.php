<?php

require './conexion_mysql.php';
$tg_sql = stripslashes($_POST["tg_sql"]);
$tg_id = stripslashes($_POST["tg_id"]);
$tg_accion = stripslashes($_POST["tg_accion"]);

include './generarTablaXSql.php';
