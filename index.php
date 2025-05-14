<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones con Imágenes</title>
    <link rel="stylesheet" href="estilos1.css">
</head>
<body>
    <h1>Publicaciones</h1>
    <a href="principal.html">Volver a la página de inicio</a>

    <h2>Nueva Publicación</h2>
    <form id="formulario-publicacion" action="guardar_publicacion.php" method="POST" enctype="multipart/form-data">
        <textarea name="contenido" rows="4" cols="50" required></textarea><br><br>
        <label for="nombre_imagen">Seleccionar imagen:</label>
        <input type="file" name="nombre_imagen" id="nombre_imagen" accept="image/*"><br><br>
        <button type="submit">Publicar</button>
    </form>

    

    <div id="contenedor-publicaciones">
        <?php
       
        $conexion = new mysqli("localhost", "u178928053_jimena", "=T2NspU#r6I", "u178928053_deudasf");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

  
        $sql = "SELECT id, contenido, nombre_imagen, DATE_FORMAT(fecha, '%d/%m/%Y %H:%i') AS fecha FROM publicaciones ORDER BY fecha DESC";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo '<div class="publicacion">';
                echo '<p>' . htmlspecialchars($fila["contenido"]) . '</p>';
                if (!empty($fila["nombre_imagen"])) {
                    echo '<img src="' . htmlspecialchars($fila["nombre_imagen"]) . '" alt="Imagen de la publicación" style="max-width: 300px; height: auto; margin-bottom: 10px;">';
                }
                echo '<small>Publicado el ' . $fila["fecha"] . '</small>';
                echo '<button class="eliminar-btn" data-id="' . $fila["id"] . '">Eliminar</button>';
                // Añadir enlace de edición
                echo '<a href="editar_publicacion.php?id=' . $fila["id"] . '" class="editar-btn">Editar</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay publicaciones aún.</p>";
        }

        $conexion->close();
        ?>




    </div>

 
    <script src="script1.js"></script>
</body>
</html>