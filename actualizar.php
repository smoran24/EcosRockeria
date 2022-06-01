<?php
    include("conexion.php");
    $con = conectar();
    $fila = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id='$fila'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar registro</h1>
        <br>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <input type="text" class="form-control mb-3" name="categoria" placeholder="Categoría" value="<?php echo $row['categoria']?>">
            <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']?>">
            <input type="text" class="form-control mb-3" name="precio" placeholder="Precio" value="<?php echo $row['precio']?>">
            <input type="text" class="form-control mb-3" name="artista" placeholder="Artista" value="<?php echo $row['artista']?>">
            <!--
                <p class="text-secondary pt-2"><strong>Subir imagen del producto</strong></p>
                <input type="file" name="fileToUpload[]" class="form-control" multiple>
            -->
            <input type="submit" class="btn btn-success btn-block" value="Actualizar">
            <a href="productos.php" class="btn btn-secondary"">Cancelar</a>
        </form>
    </div>
</body>
</html>