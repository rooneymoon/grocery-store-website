<?php
session_start();
include 'condb.php';
$product_id = $_GET['product_id'];

$sql = "SELECT * FROM product
INNER JOIN category
ON product.category = category.category_id
AND product_id = $product_id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
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
    <title><?= $row['product_name'] ?>Detail</title>
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

        #weeklydeals-container {
            overflow-x: auto;
            scroll-snap-type: x mandatory;
        }

        .card {
            border: none;
            flex-shrink: 0;
            scroll-snap-align: start;
        }

        .card-img-top {
            width: 150px;
            height: 150px;
            object-fit: contain;
            object-position: center;
            transition: 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <header style="background-color: #8ec25e;" class="d-flex justify-content-center align-items-center pt-3">
        <p class="text-white"><?= $row['category_name'] ?></p>
    </header>
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
        <div class="container py-5 mt-5">
            <div class="row my-5">
                <div class="col-5 d-flex justify-content-center align-self-center">
                    <img src="images/<?= $row['image'] ?>" width="350" height="350" class="p-5" style="border: 2px solid #8ec25e; object-fit: contain;">
                </div>
                <div class="col-4 ms-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="store.php" class="text-decoration-none" style="color: #8ec25e;">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $row['product_name'] ?></li>
                        </ol>
                    </nav>
                    <h1 class="display-5 fw-medium"><?= $row['product_name'] ?></h1>
                    <p class="text-secondary"><?= $row['category_name'] ?></p>
                    <p class="fs-6s mb-4"><?= $row['description'] ?></p>
                    <h5 class="fw-bold fs-4" style="color:#8ec25e;"><?= $row['price'] ?> B</h5>
                    <a class="btn rounded-pill link-light px-4 py-1 mt-5 fs-5" href="insert_cart.php?product_id=<?= $row['product_id'] ?>" style="background-color:#8ec25e">Add to cart
                        <i class="bi bi-cart text-light"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <section class="py-5 mt-5">
        <div class="container text-center py-3 px-5 rounded-5 mb-5" style="background-color: #d6e394">
            <h1 class="fw-bold mt-5 mb-3 fs-2">Weekly Deals</h1>
            <p class="mb-5">Exclusive Offers Every Week: Discover Irresistible Weekly Deals.</p>
            <div class="row gap-3 d-flex justify-content-xxl-center justify-content-start py-3 flex-nowrap" id="weeklydeals-container">
                <div class="card align-items-center rounded-4" style="width: 18rem;">
                    <h6 class="position-relative px-3 py-1" style="left: -75px; top: 20px; background-color: #8ec25e; color: white;">Special Price</h6>
                    <img src="images/business-3d-avocado.png" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Fruits</h5>
                        <p class="card-text text-start">
                            Nature's Fresh Bounty: Taste the Juicy Goodness of Freshly Picked Fruits.</p><br>
                        <a href="#" class="rounded-pill text-decoration-none py-1 px-3 link-light" style="background-color: #2d483f;">See more</a>
                    </div>
                </div>
                <div class="card align-items-center rounded-4" style="width: 18rem;">
                    <h6 class="position-relative px-3 py-1" style="left: -75px; top: 20px; background-color: #8ec25e; color: white;">Special Price</h6>
                    <img src="images/business-3d-onion.png" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Vegetables</h5>
                        <p class="card-text text-start">Crisp and Nourishing Greens Straight from Nature's Garden.</p>
                        <br>
                        <a href="#" class="rounded-pill text-decoration-none py-1 px-3 link-light" style="background-color: #2d483f;">See more</a>
                    </div>
                </div>
                <div class="card align-items-center rounded-4" style="width: 18rem;">
                    <h6 class="position-relative px-3 py-1" style="left: -75px; top: 20px; background-color: #8ec25e; color: white;">Special Price</h6>
                    <img src="images/business-3d-paper-coffee-cup-standing.png" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Beverages</h5>
                        <p class="card-text text-start">Sip and Enjoy: Quench Your Thirst with Exquisite Beverages.</p>
                        <br>
                        <a href="#" class="rounded-pill text-decoration-none py-1 px-3 link-light" style="background-color: #2d483f;">See more</a>
                    </div>
                </div>
                <div class="card align-items-center rounded-4" style="width: 18rem;">
                    <h6 class="position-relative px-3 py-1" style="left: -75px; top: 20px; background-color: #8ec25e; color: white;">Special Price</h6>
                    <img src="images/burgur.png" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Food</h5>
                        <p class="card-text text-start">Deliciously Convenient: Delight in Ready-to-Eat Culinary
                            Delights.</p><br>
                        <a href="#" class="rounded-pill text-decoration-none py-1 px-3 link-light" style="background-color: #2d483f;">See more</a>
                    </div>
                </div>
            </div>
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