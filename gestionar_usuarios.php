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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        h2 {
            color: #37474f;
            margin-bottom: 20px;
            text-align: center;
        }

        .volver {
            display: inline-block;
            padding: 10px 15px;
            background-color: #2196f3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .volver:hover {
            background-color: #1976d2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3f51b5;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        input[type="text"],
        input[type="email"] {
            padding: 8px;
            width: calc(100% - 16px);
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .actualizar {
            background-color: #4caf50;
            color: white;
        }

        .actualizar:hover {
            background-color: #45a049;
        }

        .eliminar {
            background-color: #f44336;
            color: white;
        }

        .eliminar:hover {
            background-color: #d32f2f;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            table {
                border: 0;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 10px;
                display: block;
                border-bottom: 2px solid #ddd;
            }

            td {
                display: block;
                text-align: right;
                padding-left: 0.5em;
            }

            td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>




</head>
<body>

    <h2>Gestión de Usuarios</h2>
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