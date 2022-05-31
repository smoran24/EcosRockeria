<?php
$host="localhost";
$usuario="root";
$password="013042";
$basedatos="ecosdb";
$cadenaConexion = mysqli_connect($host, $usuario, $password, $basedatos);
$result = mysqli_query($cadenaConexion, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$query = "SELECT nom_categoria FROM productos WHERE id='$id'";
$result = mysqli_query($cadenaConexion, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$category_name = $row['name'];
$pid = rand(9999, 1000);
$artist = $_POST['artist'];
$productname = $_POST['pname'];
$qty = $_POST['qty'];
$price = $_POST['price'];
date_default_timezone_set("Argentina");
$t = time();
$created_date = date("Y-m-d:h-i-s", $t);
$updated_date = date("Y-m-d:h-i-s", $t);
$total = count($_FILES["fileToUpload"]["name"]);
$target_dir = "products-images/";
for ($i = 0; $i < $total; $i++) {
    $target_file[$i] = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file[$i], PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
    if ($check !== false) {

        $uploadOk = 1;
    } else {

        $uploadOk = 2;
    }


    // Check if file already exists
    if (file_exists($target_file[$i])) {

        $uploadOk = 3;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"][$i] > 500000) {

        $uploadOk = 4;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {

        $uploadOk = 5;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 5) {
        echo 5;
        exit();
    } else 
                        if ($uploadOk == 4) {
        echo 4;
        exit();
    } else
                            if ($uploadOk == 3) {
        echo 3;
        exit();
    } else
                                if ($uploadOk == 2) {
        echo 2;
        exit();
    } else {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file[$i]);
    }
}
$query = "INSERT INTO productos (id,id_categoria,nom_categoria,nom_producto,precio,artista,cantidad,imagen,fecha_creacion,fecha_act) VALUES('$pid','$id','$category_name','$productname','$sid','$price','$brand','$qty','$target_file[0]','$created_date','$updated_date')";
$result = mysqli_query($cadenaConexion, $query);
if (!$result) {
    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }
    function showerror($cadenaConexion)   {
        die("Se ha producido el siguiente error: " . mysqli_error($cadenaConexion));
    }
} else {
    for ($i = 0; $i < $total; $i++) {
        $query = "INSERT INTO productos_img (id_producto,imagen) VALUES('$pid','$target_file[$i]')";
        $result = mysqli_query($cadenaConexion, $query);
    }
    echo 1;
}
