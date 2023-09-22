<?php
include 'condb.php';
$product_name = $_POST['product_name'];
$category = $_POST['category'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

if (is_uploaded_file($_FILES['file1']["tmp_name"])){
    $new_image_name='pr_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']),PATHINFO_EXTENSION);
    $image_upload_path = "images/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);   
} else {
    $new_image_name="";
}

$sql = "INSERT INTO product(product_name, category, description, price, quantity, image) 
VALUES ('$product_name', '$category', '$description', '$price', '$quantity', '$new_image_name')";
$result = mysqli_query($conn,$sql);

if ($result) {
    echo "<script> alert('Saved') ; </script>";
    echo "<script> window.location='admin.php'; </script>";
}else{
    echo "<script> alert('Can not save');</script>";
}
mysqli_close($conn);

?>