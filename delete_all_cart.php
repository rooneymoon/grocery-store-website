<?php
session_start();
include 'condb.php';

if (isset($_GET["line"])) {
    $line = $_GET["line"];
    $_SESSION["strProductID"][$line] = "";
    $_SESSION["strQty"][$line] = "";
    header("location: cart.php");
}
?>