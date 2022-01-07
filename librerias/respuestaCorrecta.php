<?php 

    include("conexionBBDD.php");

    $cod_p = $_GET["p"]; 

    // CONSULTA RESPUESTA CORRECTA
    $consulta_correcta = "SELECT r.texto_r AS 'texto' FROM respuestas r, correctas c WHERE r.cod_r = c.cod_r AND c.cod_p = $cod_p";
    $resultado = $conexion -> query($consulta_correcta);

    $respuesta_correcta;
    while ($row = $resultado->fetch_assoc()) {
        $respuesta_correcta = $row['texto'];
    }

    echo $respuesta_correcta;

?>