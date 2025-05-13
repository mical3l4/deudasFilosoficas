<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id_publicacion = $_POST["id"];

    $conexion = new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql_select = "SELECT imagen FROM publicaciones WHERE id = ?";
    $stmt_select = $conexion->prepare($sql_select);
    $stmt_select->bind_param("i", $id_publicacion);
    $stmt_select->execute();
    $resultado_select = $stmt_select->get_result();
    $fila_imagen = $resultado_select->fetch_assoc();
    $ruta_imagen_a_eliminar = $fila_imagen["imagen"];
    $stmt_select->close();

    $sql_delete = "DELETE FROM publicaciones WHERE id = ?";
    $stmt_delete = $conexion->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_publicacion);

    if ($stmt_delete->execute()) {
  
        if (!empty($ruta_imagen_a_eliminar) && file_exists($ruta_imagen_a_eliminar)) {
            if (unlink($ruta_imagen_a_eliminar)) {

                echo "success";
            } else {
         
                echo "success_image_delete_failed";
            }
        } else {
            echo "success"; 
        }
    } else {
        echo "error";
    }

    $stmt_delete->close();
    $conexion->close();
} else {
    echo "invalid request";
}
?>