<?php

    include("conexionBBDD.php");

    $num_pregunta = $_GET["p"];                        

    // CONSULTA PREGUNTA
    $consulta_pregunta = "SELECT cod_p, texto_p, tipo, musica FROM preguntas WHERE cod_p = $num_pregunta";
    $resultado = $conexion -> query($consulta_pregunta);

    $cod_p;
    $texto_p;
    $tipo_p;
    $musica_p;
    while ($row = $resultado->fetch_assoc()) {
        $cod_p = $row['cod_p'];
        $texto_p = $row['texto_p'];
        $tipo_p = $row['tipo'];
        $musica_p = $row['musica'];
    }
    
    // CONSULTA RESPUESTAS
    $consulta_respuestas = "SELECT cod_r, texto_r FROM respuestas WHERE cod_p = $num_pregunta";
    $resultado = $conexion -> query($consulta_respuestas);

    $cods_r = [];
    $texto_r = [];

    $i = 0;
    while ($row = $resultado->fetch_assoc()) {
        $cod_r[$i] = $row['cod_r'];
        $texto_r[$i] = $row['texto_r'];
        $i++;
    }

    if ($tipo_p == 'c') {
        $pregunta = explode("-", $texto_p);
    }
    
    switch ($tipo_p) {

        case 'a':
            echo "<div id='pagina1'><div id='enunciado1'><p>" . $texto_p . "</p></div><div id='respuesta1'><span id='span1' class='opcion' onclick='comprobar(`span1`)'>" . $texto_r[0] . "</span></div><div id='respuesta2'><span id='span2' class='opcion' onclick='comprobar(`span2`)'>" . $texto_r[1] . "</span></div><div id='respuesta3'><span id='span3' class='opcion' onclick='comprobar(`span3`)'>" . $texto_r[2] . "</span></div><div id='respuesta4'><span id='span4' class='opcion' onclick='comprobar(`span4`)'>" . $texto_r[3] . "</span></div></div>";
            break;

        case 'b':
            echo "<div id='pagina2'><div id='enunciado2'><p>" . $texto_p . "</p></div><div id='verdadero'><span id='span1' class='opcion' onclick='comprobar(`span1`)'>" . $texto_r[0] . "</span></div><div id='falso'><span id='span2' class='opcion' onclick='comprobar(`span2`)'>" . $texto_r[1] . "</span></div></div>";
            break;

        case 'c':
            echo "<div id='pagina3'><div id='enunciado3'><p>" . $pregunta[0] . "</p></div><div id='imagen'><img src='" . $pregunta[1] . "' alt='Dobby'></div><div id='opcion1' ><span id='span1' class='opcion' onclick='comprobar(`span1`)'>" . $texto_r[0] . "</span></div><div id='opcion2' ><span id='span2' class='opcion' onclick='comprobar(`span2`)'>" . $texto_r[1] . "</span></div></div>";

    }

    echo "<audio autoplay id='musica_fondo'><source src='audios/$musica_p.mp3' type='audio/mp3'><embed src='audios/$musica_p.mp3' autostart='true' hidden='true'></audio>";

?>