<?php
    include_once('conexion.php');
    $conexion=conn();
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $pass = $_POST["password"];
    $contrasena = hash('md5',$pass,false);
    
    $sql = "INSERT INTO usuario VALUES('$correo','$contrasena','$nombre')";
    $resul=mysqli_query($conexion, $sql)    
?>  