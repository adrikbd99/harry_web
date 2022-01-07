<?php
    $servidor = "localhost";
    $usuario = "id18234735_root";
    $contraseña = "dW~U6@F[EA5?|Kh/";
    $bd = "id18234735_quiz_hp";
    
    //ESTABLECER LA CONEXION CON EL SISTEMA DE GESTIÓN DE BASES DE DATOS
    $conexion = new mysqli($servidor, $usuario, $contraseña, $bd);

    if ($conexion -> connect_error) {
        die("Conexión fallida: " . $conexion -> connect_error);
    }
?>