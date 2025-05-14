<?php
// Incluir conexión
include 'conexion.php';

// Verificar si se recibió el ID de la publicación
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_publicacion = $_GET['id'];

    // Obtener los datos de la publicación a editar
    $sql = "SELECT contenido, nombre_imagen FROM publicaciones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_publicacion);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $publicacion = $resultado->fetch_assoc();
    } else {
        // Si no se encuentra la publicación, redirigir o mostrar un error
        header("Location: index.php");
        exit();
    }

    $stmt->close();
} else {
    // Si no se proporciona un ID válido, redirigir o mostrar un error
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
    <link rel="stylesheet" href="estilos1.css">
</head>
<body>
    <h1>Editar Publicación</h1>
    <form action="actualizar_publicacion.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id_publicacion; ?>">

        <label for="contenido">Contenido:</label><br>
        <textarea name="contenido" rows="4" cols="50" required><?php echo htmlspecialchars($publicacion['contenido']); ?></textarea><br><br>

        <label for="nombre_imagen">Cambiar imagen:</label>
        <input type="file" name="nombre_imagen" id="nombre_imagen" accept="image/*"><br>
        <?php if (!empty($publicacion['nombre_imagen'])): ?>
            <p>Imagen actual:</p>
            <img src="<?php echo htmlspecialchars($publicacion['nombre_imagen']); ?>" alt="Imagen actual" style="max-width: 200px; height: auto; margin-bottom: 10px;">
            <label><input type="checkbox" name="eliminar_imagen_actual" value="1"> Eliminar imagen actual</label><br><br>
        <?php endif; ?>

        <button type="submit">Guardar Cambios</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>