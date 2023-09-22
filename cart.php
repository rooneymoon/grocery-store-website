<?php
session_start();
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400&display=swap" rel="stylesheet">
    <title>My Cart</title>
    <style>
        * {
            font-family: 'Sora';
            color: #2d483f;
        }

        .navbar-brand img:hover {
            rotate: 10deg;
        }

        .nav-link {
            color: #383838;
        }

        .nav-link:hover {
            color: #8ec25e;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-none">
        <div class="container">
            <a class="navbar-brand fs-4" href="index.php" style="font-family: 'Mitr'; color:#383838;">
                <img src="images/broccoli.png" height="80px" class="d-inline-block align-text-center">Broccoli
            </a>
            <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav fs-5 pe-3 fw-medium">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a type="button" class="btn position-relative" href="cart.php">
                            <i class="bi bi-cart-fill fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle px-2 rounded-circle text-white" style="background-color: indianred; font-size:12px">
                                <?php if (isset($_SESSION['num'])) : ?>
                                    <?= $_SESSION['num'] ?>
                                <?php endif ?>
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <?php if (isset($_SESSION['username'])) : ?>
                            <span class="nav-link py-0 my-2" style="border: 1px solid #383838; border-radius: 50px;">
                                <i class="bi bi-person-circle"></i>
                                <a class="fs-5 fw-medium text-decoration-none ms-2" style="color: #383838;" href="login.php"><?php echo $_SESSION['username']; ?></a></span>
                    </li>
                    <li class="nav-item py-0 my-2">
                        <a href="index.php?logout='1'" class="nav-link col-2 col-lg-12 text-decoration-none rounded-pill text-center ms-2 py-1" style="background-color:indianred; color:white">Logout</a>
                    <?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-5">
        <div class="container py-5 mb-5">
            <h1 class="mb-4">My cart</h1>
            <div class="row">
                <div class="col-8 rounded-4">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table table-hover text-center">
                                <tr>
                                    <th></th>
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Quantity</th>
                                    <th class="p-3">SubTotal</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3"></th>
                                </tr>
                                <?php
                                $total = 0;
                                $sumPrice = 0;
                                $num = 0;
                                for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                                    if (($_SESSION["strProductID"][$i]) != "") {
                                        $sql1 = "SELECT * FROM product WHERE product_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row_pro = mysqli_fetch_array($result1);

                                        $_SESSION["price"] = $row_pro['price'];
                                        $total = $_SESSION["strQty"][$i];
                                        $sum = $total * $row_pro['price'];
                                        $sum = (int)$sum;
                                        $sumPrice = (int)$sumPrice;
                                        $sumPrice = $sumPrice + $sum;
                                        $sumPrice = number_format($sumPrice);

                                ?>
                                        <tr class="fw-medium">
                                            <td><img src="images/<?= $row_pro['image'] ?> " width="120" height="120" style="object-fit:contain;"></td>
                                            <td class="p-3 fs-6"><?= $row_pro['product_name'] ?></td>
                                            <td class="p-3 fs-6"><?= $row_pro['price'] ?> B</td>
                                            <td class="p-3">
                                                <span class="d-flex justify-content-center rounded-pill p-0 align-items-center" style="border: 1px solid #2d483f;">
                                                    <a href="delete_cart.php?product_id=<?= $row_pro['product_id'] ?>" class="ms-2"><i class="bi bi-dash text-dark fs-5 m-0 p-0"></i></a>
                                                    <p class="m-0 p-0  fs-6"><?= $total ?></p>
                                                    <a href="insert_cart.php?product_id=<?= $row_pro['product_id'] ?>" class="me-2"><i class="bi bi-plus text-dark fs-5 m-0 p-0"></i></a>
                                                </span>
                                            <td class="p-3 fs-6"><?= $sum ?> B</td>
                                            <td class="p-3 fs-6"><?= $sumPrice ?> B</td>
                                            <td class="p-3 fs-6"><a href="delete_all_cart.php?line=<?= $i ?>"><i class="bi bi-trash-fill fs-5" style="color: indianred;"></i></a></td>
                                        </tr>
                                <?php
                                        $num = $num + 1;
                                        $_SESSION['num'] = 0;
                                        $_SESSION['num'] = $num;
                                    }
                                }
                                ?>
                            </table>
                            <a href="store.php" class="btn btn-outline-success mt-2 rounded-pill">Back to store</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-4 rounded-4" style="background-color: #d6e394; max-height:1000px;">
                    <h3>Cart Totals</h3>
                    <hr width="400">
                    <table class="table border-light">
                        <?php
                        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                            if (($_SESSION["strProductID"][$i]) != "") {
                                $sql1 = "SELECT * FROM product WHERE product_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                $result1 = mysqli_query($conn, $sql1);
                                $row_pro = mysqli_fetch_array($result1);

                                $_SESSION["price"] = $row_pro['price'];
                                $total = $_SESSION["strQty"][$i];
                                $sum = $total * $row_pro['price'];
                                $sum = (int)$sum;
                        ?>
                                <tr>
                                    <td class="col-10 fs-6"><?= $row_pro['product_name'] ?></td>
                                    <td class="text-secondary"><?= $sum ?> B</td>
                                </tr>
                        <?php }
                        } ?>
                    </table>
                    <span class="d-flex px-1">
                        <h5 class="col-10">Total</h5>
                        <h5><?php echo $sumPrice ?> B</h5>
                    </span>
                </div>
            </div>
        </div>
    </main>
    <footer style="background-color:#8ec25e;" class="mt-5">
        <div class="container py-5">
            <div class="row d-flex justify-content-center justify-content-sm-evenly justify-content-xl-between align-items-center">
                <div class="col-2">
                    <a class="fs-4 text-decoration-none text-white" href="index.php" style="font-family: 'Mitr';">
                        <img src="images/broccoli.png" height="80px" class="d-block align-text-center">Broccoli
                    </a>
                </div>
                <div class="col-sm-4 d-flex justify-content-center justify-content-md-evenly justify-content-xl-between mt-5 mt-md-0">
                    <div class="mx-2 mx-md-5">
                        <p>More</p>
                        <div class="d-flex flex-column">
                            <a href="index.php" class="text-decoration-none text-white">Home</a>
                            <a href="store.php" class="text-decoration-none text-white">Product</a>
                            <a href="store.php" class="text-decoration-none text-white">Category</a>
                        </div>
                    </div>
                    <div class="mx-2 mx-md-5">
                        <p>Support</p>
                        <div class="d-flex flex-column">
                            <a href="about.php" class="text-decoration-none text-white">About Us</a>
                            <a href="about.php" class="text-decoration-none text-white">Reference</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>