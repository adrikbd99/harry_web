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
    <link rel="stylesheet" href="css/estilos_partida.css">
    <link rel="stylesheet" href="css/quitar_branding.css">
    <!-- LIBRERÍAS -->
    <?php include("librerias/conexionBBDD.php");?>
    <!-- AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- CONFETTI -->
    <script src="js/confetti.js" defer></script>
</head>
<body>

    <?php
        $nick = strtolower($_POST["nick"]);
        $ruta = $_POST["ruta"];

        // CONSULTA PARA SABER EL NÚMERO DE PREGUNTAS QUE HAY
        $consulta1 = "SELECT COUNT(*) AS 'numero_registros' FROM preguntas";
        $resultado = $conexion -> query($consulta1);
        while ($row = $resultado->fetch_assoc()) {
            $total_preguntas = $row['numero_registros'];
        }
        $num_pregunta = 1;

    ?>

    <div id="menu">
            <!-- BOTON PARA VOLVER A INICIO -->
            <div>
                <img src="imagenes/pause.png" alt="Botón inicio" class="volver" onclick="abrirMenu()">
            </div>
            
            <div id="opciones_sonidos">
                <!-- BOTONES DE SILENCIAR O NO LA MÚSICA Y EL SONIDO -->
                <img src="imagenes/volume.png" alt="sonido" id="cambiarSonido" onclick="cambiarSonido()">
                <img src="imagenes/music.png" alt="musica" id="cambiarMusica" onclick="cambiarMusica()">
            </div>
    </div>

    <div id="container">
        <div id="puntuacion">
            <div id="titulo_puntuacion">
                <p>puntuación</p>
            </div>
            <div id="cartas">
                <span id="1" class="carta">0</span>
                <span id="2" class="carta">0</span>
                <span id="3" class="carta">0</span>
                <span id="4" class="carta">0</span>
            </div>
        </div>
        <div id="tiempo">
             <span id="temporizador"></span>
             <span id="segundos">s</span> 
        </div>
        <div id="jugador">
             <p><?php echo $nick ?></p>
             <img src="<?php echo $ruta ?>" alt="dobby" id="snape" class="img">
        </div>
        <div id="tablero">
        </div>
        <div id="progreso">
            <div id="fondo_barra">
                <div id="progreso_barra">
                    
                </div>
                
            </div>
            <div id="progreso_contador">

            </div>
        </div>

    </div>

    <!-- VENTANA MODAL OPCIONES -->
    <div id="contenedor_modal">
        <div id="opciones">
            <div id="inicio"><a href="index.php"><img src="imagenes/inicio2.png" alt="Inicio"></a></div>
            <div id="texto_inicio"><span>ir a inicio</span></div>
            <div id="continuar"><img src="imagenes/resume.png" alt="Continuar" onclick="continuarPartida()"></div>
            <div id="texto_continuar"><span>continuar</span></div>
        </div>
    </div>  

    <!-- PANTALLA FINAL -->

    <div id="resultado_final">
    
    </div>

    <div id="version">
        versión 1.0 (BETA)
    </div>

    <script>

        total = <?php echo $total_preguntas ?>;
        contadorPregunta = 1;
        puntuacion = 0;
        barra_progreso = 0;
        parar = false;
        inicio_aux = 0;
        nick = "<?php echo $nick ?>";
        avatar = "<?php echo $ruta ?>";
        preguntas_hechas = [];
        num_pregunta = 0;
        aud_final = null;

        // FUNCIÓN PEDIR PREGUNTA
        function pedirPregunta() {

            console.log("He pedido la pregunta " + num_pregunta);

            console.log("He entrado en pedir pregunta");
            if(contadorPregunta <= total) {

                if (contadorPregunta == 1) {
                    num_pregunta = parseInt((Math.random() * total) + 1);
                    preguntas_hechas[contadorPregunta - 1] = num_pregunta;
                }
                else {
                    correcto = false;
                    while (!correcto) {
                        num_pregunta = parseInt((Math.random() * total) + 1);
                        encontrado = false;
                        for (i = 0; i < preguntas_hechas.length; i++) {
                            if (preguntas_hechas[i] == num_pregunta) {
                                encontrado = true;
                            }
                        }
                        if (!encontrado) {
                            correcto = true;
                        }
                    } 

                    preguntas_hechas[contadorPregunta - 1] = num_pregunta;

                }

                barra_progreso +=  (100 / total);
                document.getElementById("progreso_barra").style.width = barra_progreso + "%";
                document.getElementById("progreso_contador").innerHTML = contadorPregunta + " / " + total;

                inicio = 20;
                temporizador();
                // AJAX
                conexion = null;
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                }

                conexion.onreadystatechange = function() {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        document.getElementById("tablero").innerHTML = conexion.responseText;
                        if (musica == 0) {
                            aud = document.getElementById("musica_fondo");
                            aud.volume = 0;
                        }
                    }
                }

                conexion.open("GET", "librerias/consultasPyR.php?p="+num_pregunta, true);
                conexion.send();
            }
            else {
                console.log("No hay más preguntas jaja salu2");
                
                // AJAX
                conexion = null;
                if (window.XMLHttpRequest) {
                    conexion = new XMLHttpRequest();
                }

                conexion.onreadystatechange = function() {
                    if (conexion.readyState == 4 && conexion.status == 200) {
                        document.getElementById("resultado_final").innerHTML = conexion.responseText;
                        console.log(musica);
                        if (musica == 0) {
                            aud_final = document.getElementById("musica_final");
                            aud_final.volume = 0;
                        }
                        else {
                            setTimeout(function() {
                                aud_final = document.getElementById("musica_final");
                                aud_final.volume = 0.3;
                            }, 12000);
                        }
                    }
                }

                conexion.open("GET", "librerias/insertarJugador.php?n="+nick+"&a="+avatar+"&p="+puntuacion, true);
                conexion.send();

                resultadoFinal();
            }

        }

        // FUNCIÓN COMPROBAR RESPUESTA
        function comprobar(id) {
            if (musica == 1 && sonido == 1) {
                aud = document.getElementById("musica_fondo");
                aud.volume = 0.4;
            }
            
            console.log("Estoy comprobando");
            textoRespuesta = document.getElementById(id).innerHTML;
            consultaRespuesta(textoRespuesta, id);
            inicio = 0;
        }

        // FUNCIÓN COMPROBAR RESPUESTA CORRECTA
        function consultaRespuesta(textoRespuesta, id) {
            // AJAX
            conexion = null;
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    textoCorrecto = conexion.responseText;
                    console.log(textoCorrecto);

                    if (textoRespuesta == textoCorrecto) {
                        document.getElementById(id).classList.add("acertada");
                        puntuacion += 100;
                        sonidoMarcador();

                        if (puntuacion > 0 && puntuacion < 1000) {
                            actual = document.getElementById("2").innerHTML;
                            actual = parseInt(actual);
                            document.getElementById("2").innerHTML = actual + 1;
                            document.getElementById("2").classList.add("sumar_puntuacion");
                            document.getElementById("3").classList.add("sumar_puntuacion");
                            document.getElementById("4").classList.add("sumar_puntuacion");
                        }
                        else if (puntuacion == 1000 || puntuacion == 2000 || puntuacion == 3000 || puntuacion == 4000 || puntuacion == 5000 || puntuacion == 6000 || puntuacion == 7000 || puntuacion == 8000 || puntuacion == 9000) {
                            actual = document.getElementById("1").innerHTML;
                            actual = parseInt(actual);
                            document.getElementById("1").innerHTML = actual + 1;
                            document.getElementById("2").innerHTML = 0;
                            document.getElementById("1").classList.add("sumar_puntuacion");
                            document.getElementById("2").classList.add("sumar_puntuacion");
                            document.getElementById("3").classList.add("sumar_puntuacion");
                            document.getElementById("4").classList.add("sumar_puntuacion");
                        }
                        else {
                            actual = document.getElementById("2").innerHTML;
                            if (actual == 0) {
                                document.getElementById("2").innerHTML = 1;
                            }
                            else {
                                document.getElementById("2").innerHTML = parseInt(actual) + 1;
                            }

                            document.getElementById("1").classList.add("sumar_puntuacion");
                            document.getElementById("2").classList.add("sumar_puntuacion");
                            document.getElementById("3").classList.add("sumar_puntuacion");
                            document.getElementById("4").classList.add("sumar_puntuacion");
                        }


                        
                    }
                    else {
                        document.getElementById(id).classList.add("fallada");
                        sonidoIncorrecto();

                        if (puntuacion == 0) {

                        }
                        else if (puntuacion > 0 && puntuacion < 1000) {
                            puntuacion -= 50;
                            actual = document.getElementById("3").innerHTML;
                            actual = parseInt(actual);

                            if (actual == 0) {
                                document.getElementById("3").innerHTML = 5;
                                document.getElementById("2").innerHTML -= 1;
                            }
                            else {
                                document.getElementById("3").innerHTML = 0;
                            }

                            actual2 = document.getElementById("2").innerHTML;
                            if (actual == 5 && actual2 == 0) {
                                document.getElementById("3").classList.add("restar_puntuacion");
                                document.getElementById("4").classList.add("restar_puntuacion");
                            }
                            else {
                                document.getElementById("2").classList.add("restar_puntuacion");
                                document.getElementById("3").classList.add("restar_puntuacion");
                                document.getElementById("4").classList.add("restar_puntuacion");
                            }

                            
                        }
                        else if (puntuacion == 1000 || puntuacion == 2000 || puntuacion == 3000 || puntuacion == 4000 || puntuacion == 5000 || puntuacion == 6000 || puntuacion == 7000 || puntuacion == 8000 || puntuacion == 9000) {
                            puntuacion -= 50;

                            document.getElementById("1").innerHTML -= 1;
                            document.getElementById("2").innerHTML = 9;
                            document.getElementById("3").innerHTML = 5;

                            document.getElementById("1").classList.add("restar_puntuacion");
                            document.getElementById("2").classList.add("restar_puntuacion");
                            document.getElementById("3").classList.add("restar_puntuacion");
                            document.getElementById("4").classList.add("restar_puntuacion");
                            
                            
                        }
                        else {
                            puntuacion -= 50;

                            actual = document.getElementById("2").innerHTML;
                            if (actual == 0) {
                                document.getElementById("3").innerHTML = 0;
                            }
                            else {
                                actual2 = document.getElementById("3").innerHTML;

                                if (actual2 == 0) {
                                    document.getElementById("2").innerHTML -= 1;
                                    document.getElementById("3").innerHTML = 5;
                                }
                                else {
                                    document.getElementById("3").innerHTML = 0;
                                }
                            }

                            document.getElementById("1").classList.add("restar_puntuacion");
                            document.getElementById("2").classList.add("restar_puntuacion");
                            document.getElementById("3").classList.add("restar_puntuacion");
                            document.getElementById("4").classList.add("restar_puntuacion");
                            
                        }

                    }
                console.log(puntuacion);  
                }
            }

            conexion.open("GET", "librerias/respuestaCorrecta.php?p="+num_pregunta, true);
            conexion.send();
        }

        // TEMPORIZADOR
        inicio = 20;
        final = 0;

        function temporizador() {
            console.log("He entrado al temporizador");
            if (inicio >= final) {
                

                if (parar == false) {
                    if (inicio <= 5) {
                        document.getElementById("temporizador").classList.add("poco_tiempo");
                        document.getElementById("segundos").classList.add("poco_tiempo");
                    }
                    else {
                        document.getElementById("temporizador").classList.remove("poco_tiempo");
                        document.getElementById("segundos").classList.remove("poco_tiempo");
                    }
                    setTimeout(temporizador, 1000);
                    document.getElementById("temporizador").innerHTML = inicio;
                    inicio--;
                }
                else {
                    setTimeout(temporizador, 1000);
                }
                
            }
            else {
                contadorPregunta++;
                sonidoPasarPregunta();
                pedirPregunta();
                document.getElementById("1").classList.remove("sumar_puntuacion");
                document.getElementById("2").classList.remove("sumar_puntuacion");
                document.getElementById("3").classList.remove("sumar_puntuacion");
                document.getElementById("4").classList.remove("sumar_puntuacion");

                document.getElementById("1").classList.remove("restar_puntuacion");
                document.getElementById("2").classList.remove("restar_puntuacion");
                document.getElementById("3").classList.remove("restar_puntuacion");
                document.getElementById("4").classList.remove("restar_puntuacion");
            }

        }

        pedirPregunta();

        function abrirMenu() {
            document.getElementById("contenedor_modal").style.visibility="visible";
            parar = true;
            inicio_aux = inicio;

            aud = document.getElementById("musica_fondo");
            aud.pause();

        }

        function continuarPartida() {
            setTimeout(ocultarModal, 300);
            aud = document.getElementById("musica_fondo");
            aud.play();
        }

        function ocultarModal() {
            document.getElementById("contenedor_modal").style.visibility="hidden";
            parar = false;
        }

        // CONTROL DE SONIDO Y VOLUMEN
        sonido = 1;
        musica = 1;

        function cambiarSonido() {
            if (sonido == 1) {
                sonido = 0;
                document.getElementById("cambiarSonido").src = "imagenes/noVolume.png";
                console.log("He entrado en cambiarSonido");
            }
            else {
                sonido = 1;
                document.getElementById("cambiarSonido").src = "imagenes/volume.png";
            }
        }

        function cambiarMusica() {
            aud = document.getElementById("musica_fondo");
            if (musica == 1) {
                musica = 0;
                document.getElementById("cambiarMusica").src = "imagenes/noMusic.png";
                aud.volume = 0;
            }
            else {
                musica = 1;
                document.getElementById("cambiarMusica").src = "imagenes/music.png";
                aud.volume = 1;
            }
        }

        // EFECTOS SONIDO
        function sonidoMarcador() {
            if (sonido == 1) {
                efecto = new Audio("audios/sonido_marcador.mp3");
                efecto.load();
                efecto.play();
            }
            
        }

        function sonidoIncorrecto() {
            if (sonido == 1) {
                efecto = new Audio("audios/sonido_incorrecto.mp3");
                efecto.load();
                efecto.play();
            }
            
        }

        function sonidoPasarPregunta() {
            if (sonido == 1) {
                efecto = new Audio("audios/sonido_pasar_pregunta.mp3");
                efecto.load();
                efecto.play();
            }
            
        }

        // RESULTADO FINAL
        function resultadoFinal() {
            aud_fondo = document.getElementById("musica_fondo");
            aud_fondo.volume = 0;

            document.getElementById("resultado_final").style.visibility = "visible";
            console.log("He entrado en el resultado final");

            // PARA EMPEZAR EL CONFETTI
            const start = () => {
                setTimeout(function() {
                    confetti.start();
                }, 500);
            };

            // PARA DETENER EL CONFETTI
            const stop = () => {
                setTimeout(function() {
                    confetti.stop();
                }, 10000);
            };

            start();
            stop();

        }

    </script>

</body>
</html>