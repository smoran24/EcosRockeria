<?php
    include("conexion.php");
    $con=conectar();

    $id=$_POST['id'];
    $categoria=$_POST['categoria'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $artista=$_POST['artista'];
    //$imagen=$_POST['imagen'];

    $sql="UPDATE productos SET categoria='$categoria',nombre='$nombre',precio='$precio',artista='$artista' WHERE id='$id'";
    $query=mysqli_query($con,$sql);
    if($query){
        Header("Location: productos.php");
    }else{
        echo'Error: No se pudo actualizar el registro';
        echo'<br>';
        echo'<a href="productos.php">Volver a la página anterior.<a>';
    }
?>