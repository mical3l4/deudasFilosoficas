<?php
// Incluir conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $usuario = trim($_POST["usuario"]);
    $contrasenha = password_hash($_POST["contrasenha"], PASSWORD_DEFAULT); // Cifrado
    $correo = trim($_POST["correo"]);

    // Preparar consulta segura con prepare()
    $sql = "INSERT INTO usuario (nombre, apellido, usuario, contrasenha, correo) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $nombre, $apellido, $usuario, $contrasenha, $correo);

        if ($stmt->execute()) {
            echo "Usuario registrado correctamente";
            header("Location: principal.html");
            exit();
        } else {
            echo "Error al registrar usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la consulta";
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "Acceso denegado";
}
?>