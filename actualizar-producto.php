<?php
$db = mysqli_connect('localhost', 'username', 'password', 'database');
$brand = $_POST['brand'];
$qty = $_POST['quantity'];
$price = $_POST['price'];
$pid = $_POST['pid'];
$pname = $_POST['product-name'];
date_default_timezone_set("Asia/Kolkata");
$t = time();
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
//update the products table    
$query = "UPDATE products SET 
                product_name = '$pname', price = '$price', brand='$brand', qty = '$qty', image= '$target_file[0]', updated_date = '$updated_date' WHERE id = '$pid'";
$result = mysqli_query($db, $query);
if (!$result) {
    die(mysqli_error());
    echo 11;
    exit();
}
//Delete the image entries from product_images table and insert the new images as a new row.

$query = "DELETE FROM product_images WHERE pid='$pid'";
$result = mysqli_query($db, $query);
for ($i = 0; $i < $total; $i++) {
    $query = "INSERT INTO product_images (pid,image) VALUES('$pid','$target_file[$i]')";
    $result = mysqli_query($db, $query);
}
header('Location: products-display.php');
