<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal</title>
    <link rel="stylesheet" href="principal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Winky+Sans:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
           <h3>Deudas filosoficas</h3> 
            <nav>
                <a href="Formularioconcept.html">Sube una deuda</a>
                <a href="?seccion=revisa">revisa las deudas</a>
                <a href="index.html">Inicia Sessión</a>
                <a href="?seccion=inicio">Inicio</a>
            </nav>
        </header>
        <?php
        $seccion = isset($_GET["seccion"]) ? $_GET["seccion"] : "";
        switch($seccion){
            case "sube":
                echo '❤️❤️';
            break;
            case "revisa":
                echo '<div class="texto">
                        <h2 class="text-center">{$fila["titulo"]}</h2>
                        <p>{$fila["descripcion"]}</p> 
                        </div>';
            break;
            case "inicia":
                echo '😊';
            break;
            case "inicio":
                echo "<div class='texto'>
                        <h2 class='text-center'>{$fila['titulo']}</h2>
                        <p>{$fila['descripcion']}</p> 
                        </div>";
            break;
        }
        ?>
    </div>
</body>
</html>