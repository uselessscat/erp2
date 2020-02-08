<?php

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Excel.xls");

echo $_GET["_excel"];
