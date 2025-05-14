<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasenha = $_POST['contrasenha'];

    // Conectar a la base de datos
    $conn = new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar el usuario en la base de datos usando sentencia preparada
    $sql = "SELECT * FROM usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasenha, $row['contrasenha'])) {
            // La contraseña es correcta, iniciar sesión
            $_SESSION['correo'] = $row['correo'];
            header("Location: principal.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>