<?php
    include_once('conexion.php');
    $conexion=conn();
    $correo = $_POST["correo"];
    $pass = $_POST["temp-pass"];
    $contrasena = hash('md5',$pass,false);
    $new_pass =$_POST["new-pass"];
    $new_contrasena = hash('md5',$new_pass,false);

    $sql = "SELECT * FROM usuario WHERE email ='$correo'";
    $resultado=mysqli_query($conexion, $sql);

    $fila = mysqli_fetch_array($resultado);
    if ($fila['password']==$contrasena){
        $sql = "UPDATE usuario SET 'password' = $new_contrasena WHERE email ='$correo' ";
    }else{
        echo "noes";
    }
?>  