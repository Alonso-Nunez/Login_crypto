<?php
    include_once('conexion.php');

    $nombre = $_POST["nombre"];
    $pass = $_POST["password"];
    $contrasena = hash('md5',$pass,false);
    echo $nombre;
    echo $contrasena;
    echo $pass;
    $conexion=conn();

    $sql = "SELECT * FROM usuario WHERE nombre_usuario ='$nombre'";
    $resultado=mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_array($resultado);
    $contra = $fila['password'];
    echo $contra;
    if ($contra==$contrasena){
        echo "sies";
    }else{
        echo "noes";
    }

?> 