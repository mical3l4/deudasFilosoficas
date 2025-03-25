<?php
$servidor = "localhost";
$usuario = "root"; 
$contrasenha = ""; 
$base_datos = "prueba1";

//crea la conexion bd con php
$conexion = new mysqli($servidor, $usuario, $contrasenha, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos";
?> 