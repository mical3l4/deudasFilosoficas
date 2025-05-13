<?php
// Conexión a la base de datos
$conexion= new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener todas las publicaciones de la tabla "entrada"
$sql = "SELECT * FROM entrada ORDER BY created_at DESC";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
</head>
<body>
    <h1>Publicaciones</h1>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div>
            <h2><?php echo $row['description']; ?></h2>
            <img src="<?php echo $row['image_url']; ?>" alt="Imagen publicada" style="width: 300px;">

            <!-- Botones para editar y borrar -->
            <form action="editar.php" method="GET">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Editar</button>
            </form>

            <form action="borrar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Borrar</button>
            </form>
        </div>
    <?php } ?>

    <?php $conn->close(); ?>
</body>
</html>