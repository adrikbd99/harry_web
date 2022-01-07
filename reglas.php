<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Potter</title>
    <!-- CDN DE LA LIBRERÍA FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="imagenes/play.png">
    <!-- ESTILOS PROPIOS -->
    <link rel="stylesheet" href="css/estilos_reglas.css">
    <link rel="stylesheet" href="css/quitar_branding.css">
</head>
<body>
    
    <div id="menu">
        <!-- BOTON PARA VOLVER A INICIO -->
        <a href="index.php"><img src="imagenes/inicio.png" alt="Botón inicio" class="volver"></a>
    </div>
    <div id="container">
        <h2>reglas</h2>

        <ul>
            <li>Al inicio deberás introducir un nombre de jugador.</li>
            <li>El quiz consta de 10 preguntas.</li>
            <li>Tendrás 20 segundos por pregunta.</li>
            <li>Cada respuesta correcta suma 100 puntos.</li>
            <li>Cada respuesta incorrecta resta 50 puntos.</li>
            <li>Al finalizar se guardará la puntuación en un <a href="ranking.php"><strong>RANKING</strong></a>.</li>
        </ul>
    </div>
    
</body>
</html>