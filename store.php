<?php
session_start();
include 'condb.php';
$query_category = "SELECT * FROM category ORDER BY category_name ASC";
$result_category = mysqli_query($conn, $query_category);

$query_product = "SELECT * FROM product, category
WHERE product.category = category.category_id 
ORDER BY product_name ASC";
$result_product = mysqli_query($conn, $query_product);

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
    <title>Store</title>
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
    <main>
        <div class="container py-5 px-5 rounded-5" style="background-color: #d6e394;">
            <div class="row d-flex align-items-center">
                <div class="col-8">
                    <h2>"Convenience at your fingertips</h2>
                    <h2>Shop for all your grocery needs online!"</h2>
                    <form class="col-5 d-flex mt-4" action="store.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-success rounded-pill" type="submit">Search</button>
                    </form>
                </div>
                <div class="col-4">
                    <img src="images/looking-into-a-paper-tube.png" class="img-fluid">
                </div>
            </div>
        </div>
    </main>
    <section>
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-4 col-md-3 col-xl-2">
                    <div class="list-group">
                        <?php foreach ($result_category as $row) { ?>
                            <a href="store.php?act=category&category_id=<?php echo $row['category_id']; ?>" class="list-group-item list-group-item-action list-group-item-light">
                                <?php echo $row["category_name"]; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-7 col-md-9 col-xl-9">
                    <div class="row gap-2">
                        <?php $act = (isset($_GET['act']) ? $_GET['act'] : '');
                        $search = (isset($_GET['search']) ? $_GET['search'] : '');
                        if ($act == 'category') {
                            $category_id = $_GET['category_id'];

                            $query_product_ctg = "SELECT * FROM product
                            
                            INNER JOIN category
                            ON product.category = category.category_id
                            WHERE product.category = $category_id
                            ORDER BY product_name ASC";
                            $result_product_ctg = mysqli_query($conn, $query_product_ctg);

                            foreach ($result_product_ctg as $row_pro) { ?>
                                <div class="card align-items-center rounded-5 py-3" style="width: 18rem;">
                                    <img src="images/<?php echo $row_pro['image']; ?>" class="card-img-top" width="150" height="150" style="object-fit:contain;">
                                    <div class="card-body align-self-start">
                                        <h5 class="card-title" style="color: #2d483f;"><?php echo $row_pro['product_name']; ?></h5>
                                        <p class="card-text"><?php echo $row_pro['category_name']; ?></p>
                                        <h6 class="card-text"><?php echo $row_pro['price']; ?> B</h6>
                                        <a class="btn btn-outline-success mt-3" href="product_detail.php?product_id=<?php echo $row_pro['product_id'] ?>">Detail</a>
                                        <a class="btn link-light mt-3" href="insert_cart.php?product_id=<?= $row_pro['product_id'] ?>" style="background-color:#8ec25e;">Add to Cart
                                            <i class="bi bi-cart text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } elseif ($search != '') {
                            $search = $_GET['search'];

                            $query_product_s = "SELECT * FROM product
                                INNER JOIN category
                                ON product.category = category.category_id
                                WHERE product.product_name LIKE '%$search%'
                                ORDER BY product_name ASC";
                            $result_product_s = mysqli_query($conn, $query_product_s);

                            foreach ($result_product_s as $row_pro) { ?>
                                <div class="card align-items-center rounded-5 py-3" style="width: 18rem;">
                                    <img src="images/<?php echo $row_pro['image']; ?>" class="card-img-top" width="150" height="150" style="object-fit:contain;">
                                    <div class="card-body align-self-start">
                                        <h5 class="card-title" style="color: #2d483f;"><?php echo $row_pro['product_name']; ?></h5>
                                        <p class="card-text"><?php echo $row_pro['category_name']; ?></p>
                                        <h6 class="card-text"><?php echo $row_pro['price']; ?> B</h6>
                                        <a class="btn btn-outline-success mt-3" href="product_detail.php?product_id=<?php echo $row_pro['product_id'] ?>">Detail</a>
                                        <a class="btn link-light mt-3" href="insert_cart.php?product_id=<?= $row_pro['product_id'] ?>" style="background-color:#8ec25e;">Add to Cart
                                            <i class="bi bi-cart text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } else {
                            foreach ($result_product as $row_pro) { ?>
                                <div class="card align-items-center rounded-5 py-3" style="width: 18rem;">
                                    <img src="images/<?php echo $row_pro['image']; ?>" class="card-img-top" width="150" height="150" style="object-fit:contain;">
                                    <div class="card-body align-self-start">
                                        <h5 class="card-title" style="color: #2d483f;"><?php echo $row_pro['product_name']; ?></h5>
                                        <p class="card-text"><?php echo $row_pro['category_name']; ?></p>
                                        <h6 class="card-text"><?php echo $row_pro['price']; ?> B</h6>
                                        <a class="btn btn-outline-success mt-3" href="product_detail.php?product_id=<?php echo $row_pro['product_id'] ?>">Detail</a>
                                        <a class="btn link-light mt-3" href="insert_cart.php?product_id=<?= $row_pro['product_id'] ?>" style="background-color:#8ec25e;">Add to Cart
                                            <i class="bi bi-cart text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            <?php } ?>
            </div>
    </section>
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