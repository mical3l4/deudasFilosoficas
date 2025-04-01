<?php

//crea la conexion bd con php
$conexion= new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos";
?> 