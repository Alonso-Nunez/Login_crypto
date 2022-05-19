<?php

    function conn(){
        $hostname="localhost";
        $usuarioBD="root";
        $passwordBD="";
        $nameBD="usuarios";

        //generando la conexion con el servidor
        $conexion=mysqli_connect($hostname, $usuarioBD, $passwordBD, $nameBD);
        if (!$conexion) {
            echo "Tu conexión ha fallado, revisala porfavor". mysqli_connect_errno();
        }
        else{
            return $conexion;
        }
    } 
?>