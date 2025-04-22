<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'new');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todas las publicaciones de la tabla "entrada"
$sql = "SELECT * FROM entrada ORDER BY created_at DESC";
$result = $conn->query($sql);
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