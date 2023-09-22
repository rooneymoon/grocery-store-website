<?php
include 'condb.php';
$product_id = $_GET['product_id'];
$sql = "DELETE FROM product WHERE product_id = '$product_id' ";

if(mysqli_query($conn,$sql)){
    echo "<script>alert('Deleted');</script>";
    echo "<script>window.location = 'admin.php';</script>";
} else {
    echo "Error : " . $sql . "<br>" , mysqli_error($conn);
    echo "<script>alert('can not delete');</script>";
}

mysqli_close($conn);

?>