<?php
$servidor = "localhost";
$usuario = "root"; 
$contrasenha = ""; 
$base_datos = "prueba1";


$conexion = new mysqli($servidor, $usuario, $contrasenha, $base_datos);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos";
?>