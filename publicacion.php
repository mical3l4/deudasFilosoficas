<?php
// Incluir conexión
include 'conexion.php';

// Datos de ejemplo
$contenido = "Mi primera publicación";
$descripcion = "Esta es una prueba de publicación";
$fecha = date("Y-m-d H:i:s"); // Fecha actual

// Query SQL
$sql = "INSERT INTO publicaciones (id, titulo, descripcion, fecha) VALUES (NULL, ?, ?, ?)";

// Preparar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $contenido, $descripcion, $fecha);

if ($stmt->execute()) {
    echo "Publicación agregada correctamente";
} else {
    echo "Error al agregar publicación: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>