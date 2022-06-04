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
    <script> //funcion de javascript con la cual valido los datos que se ingreseb en el form de inserción
        function validarDatos() {
            let inputCat = document.forms["formActualizar"]["categoria"].value;
            let inputNom = document.forms["formActualizar"]["nombre"].value;
            let inputPre = document.forms["formActualizar"]["precio"].value;
            let inputArt = document.forms["formActualizar"]["artista"].value;
            if (inputCat == "" || inputNom == "" || inputPre == "" || inputArt == "") { //si uno o más campos estan vacíos...
                alert("Todos los campos deben llenarse!");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Actualizar registro</h1>
        <br>
        <form name="formActualizar" action="update.php" method="POST" onsubmit="return validarDatos()" enctype="multipart/form-data"><!--enctype indica el tipo de codificación, en este caso INDISPENSABLE para subir imagenes-->
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <input type="text" class="form-control mb-3" name="categoria" placeholder="Categoría" value="<?php echo $row['categoria']?>">
            <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']?>">
            <input type="number" min="0" class="form-control mb-3" name="precio" placeholder="Precio" value="<?php echo $row['precio']?>">
            <input type="text" class="form-control mb-3" name="artista" placeholder="Artista" value="<?php echo $row['artista']?>">
            <?php if(isset($_GET['size'])):?> <!--Condicion en PHP que evalua si la imagen subida es muy grande (ver update.php)-->
            <?php echo'<label for="imagen">Imagen muy grande, intente con otra.</label><br>'?>
            <?php endif;?>
            <p class="text-secondary pt-2"><strong>Subir imagen del producto</strong></p>
            <input type="file" name="imagen" class="form-control" multiple>
            <br>
            <input type="submit" class="btn btn-success btn-block" value="Actualizar">
            <a href="productos.php" class="btn btn-secondary"">Cancelar</a>
        </form>
    </div>
</body>
</html>