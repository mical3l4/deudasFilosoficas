<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenido = $_POST["contenido"];
    $nombre_imagen = null; 

    
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $carpeta_destino = "uploads/"; 
        $nombre_archivo = basename($_FILES["imagen"]["name"]);
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_archivo)) {
            $nombre_imagen = $ruta_archivo; 
        } else {
            echo "Error al mover el archivo.";
            exit();
        }
    }

   
    $conexion = new mysqli("localhost", "root", "", "publi");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO publicaciones (contenido, imagen) VALUES (?, ?)";
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