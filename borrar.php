<?php
    session_start();
    include("conexion.php");
    $con=conectar();

    $id=$_GET['id'];
    $sql="DELETE FROM productos WHERE id='$id'";
    $query=mysqli_query($con,$sql);
    if($query){
        Header("Location: productos.php");
    }else{
        echo'Error: No se pudo borrar el registro';
        echo'<br>';
        echo'<a href="productos.php">Volver a la página anterior.<a>';
    }
?>
