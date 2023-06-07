<?php
     function conectar(){
        $conexion = mysqli_connect('localhost', 'root','','proyecto');
        return $conexion;
    }
