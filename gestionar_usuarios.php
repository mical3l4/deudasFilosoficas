<?php
include 'conexion.php';

// ELIMINAR USUARIO
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $sql_eliminar = "DELETE FROM usuario WHERE id = ?";
    $stmt_eliminar = $conexion->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $id);
    $stmt_eliminar->execute();
    header("Location: gestionar_usuarios.php");
    exit;
}

// ACTUALIZAR USUARIO
if (isset($_POST['actualizar'])) {
    $id     = intval($_POST['id']);
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $correo = $conexion->real_escape_string($_POST['correo']);

    $sql_actualizar = "UPDATE usuario SET nombre=?, correo=? WHERE id=?";
    $stmt_actualizar = $conexion->prepare($sql_actualizar);
    $stmt_actualizar->bind_param("ssi", $nombre, $correo, $id);
    $stmt_actualizar->execute();
    header("Location: gestionar_usuarios.php");
    exit;
}

// OBTENER USUARIOS
$sql_obtener = "SELECT id, nombre, correo FROM usuario";
$resultado = $conexion->query($sql_obtener) or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos1.css">
    <title>Gestionar Usuarios</title>
    <style>
        /*body { font-family: Arial, sans-serif; background-color: #ffeef5; color: #333; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f7a6c3; color: white; }
        input[type="text"], input[type="email"] { padding: 5px; width: 90%; }
        .btn { padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .editar { background-color: #ffc107; color: #333; }
        .eliminar { background-color: #dc3545; color: white; }
        .actualizar { background-color: #28a745; color: white; }
        .volver { margin-top: 20px; display: inline-block; background-color: #007bff; color: white; }*/
    </style>
</head>
<body>

    <h2>Panel de Gestión de Usuarios</h2>
    <a href="principal.php" class="btn volver">← Volver al Panel Principal</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
        <tr>
            <form method="POST" action="gestionar_usuarios.php">
                <td><?= $row['id'] ?></td>
                <td><input type="text" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>"></td>
                <td><input type="email" name="correo" value="<?= htmlspecialchars($row['correo']) ?>"></td>
                <td>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button class="btn actualizar" type="submit" name="actualizar">Actualizar</button>
                    <a class="btn eliminar" href="?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Estás segura de eliminar a este usuario?')">Eliminar</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>