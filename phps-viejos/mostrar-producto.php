<?php session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .text-font {
            font-size: 35px;
            font-weight: bolder;
        }
        .height {
            height: 100vh;
        }
        .error {
            color: red;
            font-size: large;

        }
        .success {
            color: green;
            font-size: large;

        }
        .error1 {
            color: red;
            font-size: large;

        }
        .success1 {
            color: green;
            font-size: large;

        }
        .error2 {
            color: red;
            font-size: large;

        }
        .success2 {
            color: green;
            font-size: large;

        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 bg-dark height">
                <p class="pt-5 pb-5 text-center">
                    <a href="mostrar-producto.php" class="text-decoration-none"><span class="text-light text-font">Admin</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="agregar-producto.php" class="text-decoration-none"><span class="text-light">Agregar productos</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="mostrar-producto.php" class="text-decoration-none"><span class="text-light">Ver productos</span></a>
                </p>
            </div>
            <div class="col-sm-10 bg-light">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="text-center pt-5">
                            <img class="rounded" src="<?php echo ("images/icono-admin.png")?>" width="150px" height="140px">
                        </p>
                    </div>
                    <div class="col-sm-8">
                        <h1 class="text-center pt-4 pb-2"><strong>Ver productos</strong></h1>
                        <hr class="w-25 mx-auto">
                    </div>
                    <div class="col-sm-2">
                        <p class="pt-5 text-center">
                            <a href="logout.php" class="btn btn-outline-primary">Cerrar Sesión</a>
                        </p>
                    </div>
                </div>

                <?php
                // Display the products as pagination with maximum products in a page.
                $limit = 5;
                $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
                $paginationStart = ($page - 1) * $limit;
                $host="localhost";
                $usuario="root";
                $password="013042";
                $basedatos="ecosdb";
                $cadenaConexion = mysqli_connect($host, $usuario, $password, $basedatos);
                $query = "SELECT COUNT(*) AS id_producto FROM productos_img";
                $result = mysqli_query($cadenaConexion, $query);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $total = $row['id_producto'];
                $pages = ceil($total / $limit);
                $query1 = "SELECT * FROM productos LIMIT $paginationStart,$limit";
                $result1 = mysqli_query($cadenaConexion, $query1);
                ?>

                <div class="container pt-5 pb-5">
                    <div class="table table-responsive">
                        <table class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-left">Categoría</th>
                                    <th class="text-left">Nombre producto</th>
                                    <th class="text-left">Artista</th>
                                    <th class="text-left">Cantidad</th>
                                    <th class="text-left">Precio</th>
                                    <th class="text-left">Imagen</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <form method="post" id="the-form" enctype="multipart/form-data">
                                            <td><input type="text" class="form-control" name="category-name" value="<?php echo ($row1['nom_categoria']); ?>" readonly></td>
                                            <td><input type="text" class="form-control" name="product-name" value="<?php echo ($row1['nom_producto']); ?>"></td>
                                            <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo ($row1['id']);  ?>" readonly>
                                            <td><input type="text" class="form-control" name="artist" value="<?php echo ($row1['artista']); ?>"></td>
                                            <td><input type="number" class="form-control" name="quantity" value="<?php echo ($row1['cantidad']); ?>"></td>
                                            <td><input type="number" class="form-control" name="price" value="<?php echo ($row1['precio']); ?>"></td>
                                            <td><img src="<?php echo ($row1['imagen']); ?>" height="80px" width="150px">
                                                <input name="fileToUpload[]" class="form-control" type="file" multiple>
                                            </td>
                                            <td><button type="submit" formaction="actualizar-producto.php" class="form-control">Actualizar</button></td>
                                            <td><button type="submit" formaction="" class="form-control">Borrar</button></td>
                                        </form>
                                    </tr>
                                <?php
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <span class="error"></span><span class="success"></span>
                <div class="container pt-5">
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item <?php if ($page <= 1) {
                                                                echo 'disabled';
                                                            } ?>">
                                        <a class="page-link" href="<?php if ($page <= 1) {
                                                                        echo '#';
                                                                    } else {
                                                                        echo "?page=" . $prev;
                                                                    } ?>">Anterior</a>
                                    </li>
                                    
                                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item <?php if ($page == $i) {
                                                                    echo 'active';
                                                                } ?>">
                                            <a class="page-link" href="new-user-requests.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?php if ($page >= $pages) {
                                                                echo 'disabled';
                                                            } ?>">
                                        <a class="page-link" href="<?php if ($page >= $pages) {
                                                                        echo '#';
                                                                    } else {
                                                                        echo "?page=" . $next;
                                                                    } ?>">Siguiente</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>