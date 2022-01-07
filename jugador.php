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
    <link rel="stylesheet" href="css/estilos_jugador.css">
    <link rel="stylesheet" href="css/quitar_branding.css">
</head>
<body>
    
    <div id="container">
        <h2>nombre y avatar</h2>
        <form action="partida.php" method="POST">
            <div id="nombre">
                <input type="text" name="nick" id="nombre_usuario" placeholder="nombre de jugador..." minlength="2" maxlength="15" size="40" required> 
            </div>
            <div id="avatar">
                <div id="fila1">
                    <img src="imagenes/snape.jpg" alt="snape" id="snape" class="img">
                    <img src="imagenes/ron.jpg" alt="ron" id="ron" class="img">
                    <img src="imagenes/harry.jpg" alt="harry" id="harry" class="img">
                    <img src="imagenes/voldemort.jpg" alt="voldemort" id="voldemort" class="img">
                    <img src="imagenes/hermione.jpg" alt="hermione" id="hermione" class="img">
                    <img src="imagenes/dumbledore.jpg" alt="dumbledore" id="dumbledore" class="img">
                </div>
                <div id="fila2">
                    <img src="imagenes/dobby.jpg" alt="dobby" id="dobby" class="img">
                    <img src="imagenes/gini.jpg" alt="gini" id="gini" class="img">
                    <img src="imagenes/mcgonagall.jpg" alt="mcgonagall" id="mcgonagall" class="img">
                    <img src="imagenes/sirius.jpg" alt="sirius" id="sirius" class="img">
                    <img src="imagenes/hagrid.jpg" alt="hagrid" id="hagrid" class="img">
                    <img src="imagenes/draco.jpg" alt="draco" id="draco" class="img">
                    <img src="imagenes/luna.jpg" alt="luna" id="luna" class="img">
                </div>
                <input type="text" name="ruta" id="ruta" required>
            </div>
            <div id="boton">
                <input type="submit" value="JUGAR" id="boton_jugar">
            </div>
        </form>
        
        
    </div>

    <div id="menu">
        <!-- BOTON PARA VOLVER A INICIO -->
        <a href="index.php"><img src="imagenes/inicio.png" alt="Botón inicio" class="volver"></a>
    </div>
    
    <script>
        imagenes = document.getElementsByClassName("img");
        elementoActivo = null;
        hayActivo = false;
        ruta;

        for (i = 0; i < imagenes.length; i++) {
            imagen = imagenes[i];
            imagen.addEventListener("click", function() {
                if (!hayActivo) {
                    elementoActivo = this;
                    this.classList.add("activa");
                    hayActivo = true;
                    ruta = this.src;
                    document.getElementById("ruta").value = ruta;
                }
                else {
                    if (this == elementoActivo) {
                        this.classList.remove("activa");
                        elementoActivo = null;
                        hayActivo = false;
                        document.getElementById("ruta").value = "";
                    }
                    else {
                        elementoActivo.classList.remove("activa");
                        this.classList.toggle("activa");
                        elementoActivo = this;
                        ruta = this.src;
                        document.getElementById("ruta").value = ruta;
                    }
                    
                }
                
            })
        }

        

    </script>
</body>
</html>