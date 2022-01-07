<?php
    include("conexionBBDD.php");

    $nick = $_GET["n"]; 
    $avatar = $_GET["a"];
    $puntuacion = intval($_GET["p"]);
    $fecha = date("Y-m-d");

    // CONSULTA RESPUESTA CORRECTA
    $insert = "INSERT INTO jugadores (fecha, nombre, avatar, puntuacion) VALUES ('$fecha', '$nick', '$avatar', $puntuacion)";
    $resultado = $conexion -> query($insert);

    echo "<div id='diploma'>";
    echo "<div id='borde_diploma'>";

    echo "<div id='puntuacion_final'><div id='tabla_diploma'><span id='avatar_final'><img src='$avatar' alt='dobby'></span><span id='nick_final'>$nick</span><span id='fecha_final'>$fecha</span></div><p>¡enhorabuena! has conseguido: </p><p id='puntos_finales'>$puntuacion pts</p></div>";

    echo "<div id='enlaces_finales'><a href='index.php'>INICIO</a><a href='ranking.php'>RÁNKING</a></div>";

    echo "<div id='agradecimientos'><p>¡TRAVESURA REALIZADA!</p>
    <p>Gracias por jugar a este juego y por apoyar este humilde proyecto realizado por dos estudiantes de desarrollo web, con el fin de mejorar sus habilidades como programadores.</p><p id='imagenes_agradecimientos' ><img src='imagenes/logos_diploma.png'></p></div>";

    echo "</div>";
    echo "</div>";

    echo "<audio autoplay loop id='musica_final'><source src='audios/musica_final.mp3' type='audio/mp3'><embed src='audios/musica_final.mp3' autostart='true' loop='true' hidden='true'></audio>";
?>