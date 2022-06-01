<?php
    session_start(); //inicio la sesión
    // Controlo si el usuario ya está logueado en el sistema.
    if(isset($_SESSION['email'])){
        // Le doy la bienvenida al usuario.
        echo '<strong>Bienvenido, ' . $_SESSION['email'] . '</strong> <a href="logout.php" class="btn btn-primary" id="boton-logout">Cerrar sesión</a>';
    }else{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: login.html");
    }

    include("conexion.php"); //incluye el archivo conexion.php para acceder a su funcion de conexion sql
    $con = conectar(); //asigna a la variable $con el retorno de la funcion conectar() para establecer la conexion sql en este archivo
    $sql = "SELECT * FROM productos";
    $query = mysqli_query($con, $sql); //ejecuta la sentencia sql con la cadena y la conexion
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD Artículos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        #boton-logout{
            float: right;
            margin:10pt;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <h1>Añadir registro</h1>
                <br>
                <form action="insertar.php" method="POST">
                    <!--Hace POST porque envia los datos (en name) de los campos input al insertar.php-->
                    <input type="text" class="form-control mb-3" name="categoria" placeholder="Categoría">
                    <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombre">
                    <input type="text" class="form-control mb-3" name="precio" placeholder="Precio">
                    <input type="text" class="form-control mb-3" name="artista" placeholder="Artista">
                    <!--
                    <p class="text-secondary pt-2"><strong>Subir imagen del producto</strong></p>
                    <input type="file" name="fileToUpload[]" class="form-control" multiple>
                    -->
                    <br>
                    <input type="submit" class="btn btn-success form-control">
                </form>
            </div>
            <div class="col-md-9">
                <table class="table">
                    <thead class="table-success table-striped">
                        <tr>
                            <th>#</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Artista</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        while ($row = mysqli_fetch_array($query)) { //bucle que revisa si existen registros (arrays) en la base de datos y los trae a las rows(filas)
                        ?>
                            <tr> 
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['categoria'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['precio'] ?></td>
                                <td><?php echo $row['artista'] ?></td>
                                <td><img src="<?php echo $row['imagen'] ?>" alt="miniatura" width="80px"></td>
                                <td><a href="actualizar.php?id=<?php echo $row['id'] ?>" class="btn btn-info">Editar</a></td>
                                <td><a href="borrar.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Eliminar</a></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>