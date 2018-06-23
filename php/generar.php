<?php
require_once("procesar.php");
//echo "<pre>";
//print_r($GLOBALS);
//exit(1);

$fuente = json_decode($_POST['f'], true);

$ret = procesar($fuente);

//echo "\n---------\n";
echo json_encode($ret);
