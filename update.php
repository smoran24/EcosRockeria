<?php
    session_start();
    include("conexion.php");
    $con=conectar();
    $id=$_POST['id'];
    $categoria=$_POST['categoria'];
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $artista=$_POST['artista'];
    $imagen=$_FILES['imagen']; //FILES indica que es un archivo (FILES ES UN ARRAY)

    if($imagen['size'] < 80000){ //si el tamaño de la imagen es adecuado (80000 bytes)
        $_img = explode('.',$imagen['name']); //la funcion explode() convierte en array un string recibido, en este caso el nombre de la imagen
        $imagenFinal = $_img[0].date('Ymdhms').'.'.$_img[1]; //asigna al array el nuevo nombre de la imagen (como fecha y hora en este caso) y su extension correspondiente
        move_uploaded_file($imagen['tmp_name'],'products-images/'.$imagenFinal); //mueve la imagen con sun tmp_name (nuevo nombre, temporal) a la carpeta products-images
        $nombreArchivo = 'products-images/'.$imagenFinal; //guardo en esta variable la concatenación entre la dirección de la carpeta y el nombre del archivo (para usarlo en la sentencia SQL)
        $sql="UPDATE productos SET categoria='$categoria',nombre='$nombre',precio='$precio',artista='$artista',imagen='$nombreArchivo' WHERE id='$id'";
        $query=mysqli_query($con,$sql);

        if($query){
            Header("Location: productos.php");
        }else{
            echo'Error: No se pudo actualizar el registro';
            echo'<br>';
            echo'<a href="productos.php">Volver a la página anterior.<a>';
        }
    }else{
        header('location: productos.php?size'); //redige a la pagina anterior, con el mensaje de error
    }

    
?>