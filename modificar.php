<?php
require_once("conexion.php");
$contenido=$_POST['$contenido'];
$descripcion=$_POST['$descripcion'];
$fecha=$_POST['$fecha'];

$sql="update from publicaciones where titulo =".$contenido,"descripcion=".$descripcion,
"fecha=".$fecha_creacion;
