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
    <link rel="stylesheet" href="css/estilos_ranking.css">
    <link rel="stylesheet" href="css/quitar_branding.css">
</head>
<body>

    <div id="container">
        <h2>ranking</h2>
        <div id="ranking">
            <?php
                include("librerias/conexionBBDD.php");
                $sql = "SELECT fecha, nombre, avatar, puntuacion FROM jugadores ORDER BY puntuacion DESC";
                $resultado = $conexion -> query($sql);
                $contador = 1;

                ?>
                <table>
                    <?php
                    while ($row = $resultado->fetch_assoc()) {
                        ?>
                        <tr>
                            <td id="numero_ranking">#<?php echo $contador ?></td>
                            <td><img src="<?php echo $row['avatar']?>" alt=""></td>
                            <td><?php echo $row['nombre']?></td>
                            <td><?php echo $row['fecha']?></td>
                            <td><?php echo $row['puntuacion']?> pts</td>
                        </tr>
                        <?php
                        $contador++;
                    }
                    ?>
                </table>
                <?php
               
            ?>
            <table>

            </table>
        </div>
    </div>

    <div id="menu">
        <!-- BOTON PARA VOLVER A INICIO -->
        <a href="index.php"><img src="imagenes/inicio.png" alt="Botón inicio" class="volver"></a>
    </div>
    
</body>
</html>