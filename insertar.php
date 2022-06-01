<?php
    include("conexion.php");
    $con=conectar();
    $categoria=$_POST['categoria'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $artista=$_POST['artista'];
    //$imagen=$_POST['imagen'];

    $sql="INSERT INTO productos (categoria, nombre, precio, artista) VALUES('$categoria','$nombre','$precio','$artista')";
    $query= mysqli_query($con,$sql);

    if($query){ //si se logra insertar el registro...
        Header("Location: productos.php");
        
    }else { //sino lo logra:
        echo'Error: No se pudo insertar el registro';
        echo'<br>';
        echo'<a href="productos.php">Volver a la página anterior.<a>';
    }
?>