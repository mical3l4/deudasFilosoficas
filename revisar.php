<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal</title>
    <link rel="stylesheet" href="principal.css">
</head>
<body>
    <div class="container">
        <header>
           <h3>Deudas filosoficas</h3> 
            <nav>
                <a href="?seccion=sube">Sube una deuda</a>
                <a href="?seccion=revisa">revisa las deudas</a>
                <a href="index.html">Inicia Sessión</a>
                <a href="?seccion=inicio">Inicio</a>
            </nav>
        </header>
        <?php
        $seccion = isset($_GET["seccion"]) ? $_GET["seccion"] : "";
        switch($seccion){
            case "sube":
                echo "ddddddddddd";
            break;
            case "revisa":
                echo "dfffggggfff";
            break;
            case "inicia":
                echo '😊';
            break;
            case "inicio":
                echo '<div class="texto">
                        <h2 class="text-center">Título</h2>
                        <p  class="text-center"> descripción</p>
                        </div>';
            break;
        }
        ?>
    </div>
</body>
</html>