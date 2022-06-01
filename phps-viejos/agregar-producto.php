<?php session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.html'); //redirige a la pagina de login si el campo email no esta definido
   
}
$host="localhost";
$usuario="root";
$password="013042";
$basedatos="ecosdb";
$cadenaConexion = mysqli_connect($host, $usuario, $password, $basedatos);
$query = "SELECT * FROM productos";
$result = mysqli_query($cadenaConexion, $query);
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
function showerror($cadenaConexion)   {
    die("Se ha producido el siguiente error: " . mysqli_error($cadenaConexion));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add products</title>
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

        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 bg-dark height">
                <p class="pt-5 pb-5 text-center">
                    <a href="agregar-producto.php" class="text-decoration-none"><span class="text-light text-font">Admin</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="agregar-producto.php" class="text-decoration-none"><span class="text-light">Add Products</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="mostrar-producto.php" class="text-decoration-none"><span class="text-light">View Products</span></a>
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
                        <h1 class="text-center pt-4 pb-5"><strong>Add Products</strong></h1>
                        <hr class="w-25 mx-auto">
                    </div>
                    <div class="col-sm-2">
                        <p class="pt-5 text-center">
                            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
                        </p>
                    </div>
                </div>
                <div class="container mx-auto">
                    <form action="products-add.php" id="the-form" class="form-control w-50 mx-auto" enctype="multipart/form-data" method="post">
                        <label class="pt-4 pb-2 text-center">Ingrese nombre del producto</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['pname'] ?>" id="name" name="pname" placeholder="Escriba aquí...">
                        <label class="pt-4 pb-2 text-center">Ingrese artista asociado</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['artist'] ?>" id="artist" name="artist" placeholder="Escriba aquí...">
                        <label class="pt-4 pb-2 text-center">Ingrese el precio</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['price'] ?>" id="prprice" name="price" placeholder="Escriba aquí...">
                        <label class="pt-4 pb-2 text-center">Ingrese la cantidad</label>
                        <input type="text" class="form-control" value="<?php echo $_POST['qty'] ?>" id="qty" name="qty" placeholder="Escriba aquí...">
                        <label class="pt-4 pb-2 text-center" for="categories">Elija una categoria</label>
                        <select class="form-control" id="categories" name="categories" onchange="this.form.submit()">
                            <option value=""><?php if (isset($_POST['categories'])) {
                                                    $id2 = $_POST['categories'];
                                                    $query2 = "SELECT * FROM categorias where id='$id2'";
                                                    $result2 = mysqli_query($cadenaConexion, $query2);
                                                    if (!$result2) {
                                                        if (mysqli_connect_errno()) {
                                                            printf("Falló la conexión: %s\n", mysqli_connect_error());
                                                            exit();
                                                        }
                                                        function showerror($cadenaConexion)   {
                                                            die("Se ha producido el siguiente error: " . mysqli_error($cadenaConexion));
                                                        }
                                                    }
                                                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                                    echo $row2['nombre'];
                                                } else
                                                    echo ("-");
                                                ?></option>
                            <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo ($row['id']); ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>

                        <?php
                            $id = $_POST['categories'];
                            echo "<input type='hidden' value='$id' id='id_categoria'>";
                            $query1 = "SELECT * FROM categorias where id='$id'";
                            $result1 = mysqli_query($cadenaConexion, $query1);
                            if (!$result1) {
                                if (mysqli_connect_errno()) {
                                    printf("Falló la conexión: %s\n", mysqli_connect_error());
                                    exit();
                                }
                                function showerror($cadenaConexion)   {
                                    die("Se ha producido el siguiente error: " . mysqli_error($cadenaConexion));
                                }
                            }
                        ?>
                        <br>
                        <p class="text-danger pt-2"><strong>Upload product images</strong></p>
                        <input type="file" name="fileToUpload[]" class="form-control" multiple>
                        <p>
                        </p><br>
                        <div class="container w-25 mx-auto">
                            <div class="hide"><img class="mx-auto" style="height: 50px; width: 50px;" src="/test123/products-images/ajax-loader.gif"></div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-primary form-control" onclick="addproduct()" id="btnSubmit">Add product</button>
                        <br><br>
                        <div class="error"></div>
                        <div class="success"></div>
                    </form>
                    <br><br>
                    <script>
                        function addproduct() {
                            event.preventDefault();
                            var form = $('#the-form')[0];
                            var data = new FormData(form);
                            $('.hide').show();
                            $.ajax({
                                type: "POST",
                                enctype: 'multipart/form-data',
                                url: "product-upload.php",
                                data: data,
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function(data) {
                                    if (data == 1) {
                                        $('.success').html("Product uploaded").show();
                                        $('.error').hide();
                                    }

                                    if (data == 0) {
                                        $('.error').html("Error uploading file. Pls try again.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 2) {
                                        $('.error').html("File is not an image.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 3) {
                                        $('.error').html("File already exist.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 4) {
                                        $('.error').html("File too large. Keep file size below 200KB.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 5) {
                                        $('.error').html("Uploaded file is not an image.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 6) {
                                        $('.error').html("Unknown error occurs.").show();
                                        $('.success').hide();
                                    }
                                    if (data == 0) {
                                        $('.error').html("#######").show();
                                        $('.success').hide();
                                    }

                                },
                                complete: function() {
                                    $('.hide').hide();
                                },
                                error: function(e) {
                                    $(".error").text(e.responseText);
                                    console.log("ERROR : ", e);
                                }
                            });
                        }
                    </script>
                </div>

            </div>
        </div>
    </div>