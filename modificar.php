<?php
require_once("conexion.php");
$titulo=$_POST['$titulo'];
$descripcion=$_POST['$descripcion'];
$fecha=$_POST['$fecha'];

$sql="update from publicaciones where titulo =".$titulo,"descripcion=".$descripcion,
"fecha=".$fecha;
