<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_publicacion = $_POST['id'];
    $contenido = $_POST['contenido'];
    $nombre_imagen = null;
    $eliminar_imagen_actual = isset($_POST['eliminar_imagen_actual']) && $_POST['eliminar_imagen_actual'] == '1';

    // Obtener la ruta de la imagen actual si existe
    $ruta_imagen_actual = null;
    if ($eliminar_imagen_actual) {
        $sql_select_imagen = "SELECT nombre_imagen FROM publicaciones WHERE id = ?";
        $stmt_select_imagen = $conexion->prepare($sql_select_imagen);
        $stmt_select_imagen->bind_param("i", $id_publicacion);
        $stmt_select_imagen->execute();
        $resultado_select_imagen = $stmt_select_imagen->get_result();
        if ($resultado_select_imagen->num_rows == 1) {
            $fila_imagen = $resultado_select_imagen->fetch_assoc();
            $ruta_imagen_actual = $fila_imagen['nombre_imagen'];
        }
        $stmt_select_imagen->close();
    }

    // Procesar la nueva imagen si se subió
    if (isset($_FILES["nombre_imagen"]) && $_FILES["nombre_imagen"]["error"] === UPLOAD_ERR_OK) {
        $carpeta_destino = "uploads/";
        $nombre_archivo = basename($_FILES["nombre_imagen"]["name"]);
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($_FILES["nombre_imagen"]["tmp_name"], $ruta_archivo)) {
            $nombre_imagen = $ruta_archivo;
            // Eliminar la imagen anterior si se reemplazó
            if ($ruta_imagen_actual && file_exists($ruta_imagen_actual)) {
                unlink($ruta_imagen_actual);
            }
        } else {
            echo "Error al mover el nuevo archivo.";
            exit();
        }
    } else {
        // Si no se subió una nueva imagen y no se eliminó la actual, mantener la imagen existente
        if (!$eliminar_imagen_actual) {
            $sql_select_imagen = "SELECT nombre_imagen FROM publicaciones WHERE id = ?";
            $stmt_select_imagen = $conexion->prepare($sql_select_imagen);
            $stmt_select_imagen->bind_param("i", $id_publicacion);
            $stmt_select_imagen->execute();
            $resultado_select_imagen = $stmt_select_imagen->get_result();
            if ($resultado_select_imagen->num_rows == 1) {
                $fila_imagen = $resultado_select_imagen->fetch_assoc();
                $nombre_imagen = $fila_imagen['nombre_imagen'];
            }
            $stmt_select_imagen->close();
        }
        // Si se eliminó la imagen actual y no se subió una nueva, $nombre_imagen permanece null
    }

    // Actualizar la base de datos
    $sql_update = "UPDATE publicaciones SET contenido = ?, nombre_imagen = ? WHERE id = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("ssi", $contenido, $nombre_imagen, $id_publicacion);

    if ($stmt_update->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la publicación: " . $stmt_update->error;
    }

    $stmt_update->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>