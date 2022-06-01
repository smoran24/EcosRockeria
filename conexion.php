<?php
function conectar(){
    $host = "localhost"; //servidor (local)
    $user = "root"; //usuario
    $pass = "013042"; //contraseña
    $db = "ecosdb"; //base de datos
    $con = mysqli_connect($host, $user, $pass); //guarda los parametros en una variable $con que representa la cadena de conexion
    mysqli_select_db($con, $db); //selecciona la base de datos con los parametros y se conecta
    return $con; //retorna la cadena de conexion
}
?>