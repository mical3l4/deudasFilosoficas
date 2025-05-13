<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenido = $_POST["contenido"];
    $nombre_imagen = null; 

    
    if (isset($_FILES["nombre_imagen"]) && $_FILES["nombre_imagen"]["error"] === UPLOAD_ERR_OK) {
        $carpeta_destino = "uploads/"; 
        $nombre_archivo = basename($_FILES["nombre_imagen"]["name"]);
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["nombre_imagen"]["tmp_name"], $ruta_archivo)) {
            $nombre_imagen = $ruta_archivo; 
        } else {
            echo "Error al mover el archivo.";
            exit();
        }
    }

   
    $conexion= new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO publicaciones (contenido, nombre_imagen) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $contenido, $nombre_imagen);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar la publicación: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>