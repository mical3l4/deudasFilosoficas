<?php
$servidor = "localhost";
$base_datos = "u178928053_deudasf";
$usuario = "u178928053_jimena";
$contrasenha = "=T2NspU#r6I";

$conexion = new mysqli($servidor, $usuario, $contrasenha, $base_datos);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos";
?>