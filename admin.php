<?php
include('condb.php');
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must login first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}

$sql = "SELECT COUNT(product_id) AS total_products FROM product";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
}

$sql1 = "SELECT COUNT(id) AS total_members FROM member";
$result1 = mysqli_query($conn, $sql1);

if ($result1) {
    $row1 = mysqli_fetch_assoc($result1);
    $totalMembers = $row1['total_members'];
}
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
    <title>Admin Page</title>
    <style>
        * {
            font-family: 'Sora';
            color: #2d483f;
        }

        .navbar-brand img:hover {
            rotate: 10deg;
        }

        .nav-link {
            color: #2d483f;
        }

        .nav-link:hover {
            color: #8ec25e;
        }

        .btn:hover {
            background-color: #2d483f;
            color: white;
            text-decoration: none;
        }

        .btn {
            background-color: transparent;
            border: 1px solid #2d483f;
            color: #2d483f;
        }

        th {
            color: #2d483f;
        }
    </style>
</head>

<body class="bg-white">
    <nav class="navbar navbar-expand navbar-light bg-none">
        <div class="container">
            <a class="navbar-brand fs-4" href="index.php" style="font-family: 'Mitr'; color:#2d483f;">
                <img src="images/broccoli.png" height="80px" class="d-inline-block align-text-center">Broccoli
            </a>
            <ul class="navbar-nav fs-5 fw-medium">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#product">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#member">Member</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="index.php?logout='1'" class="nav-link text-center link-light text-decoration-none py-1 px-3 rounded-pill" style="background-color:indianred">Logout</a></p>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container rounded-5">
            <div class="row d-flex align-items-center justify-content-start">
                <div class="col-6 col-xl-9 d-flex flex-column align-items-center justify-content-center rounded-4 p-3" style="background-color: #d6e394;">
                    <img src="images/young-woman-sitting-on-floor-in-headphones.png" style="width: 300px;">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <h3 class="text-center py-4">Welcome back <?php echo $_SESSION['username']; ?>!</h3>
                    <?php endif ?>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="rounded-4 p-5 mb-3 mb-xl-2 text-center" style="background-color: #8ec25e;">
                        <h5>Total Products</h5>
                        <h1><?php echo $totalProducts ?></h1>
                    </div>
                    <div class="rounded-4 p-5 text-center" style="background-color: #8ec25e;">
                        <h5>Total Membership</h5>
                        <h1><?php echo $totalMembers ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section>
        <div class="container py-5">
            <span class="d-flex justify-content-between">
                <h2 id="product" class="py-3">Products</h2>
                <a class="btn rounded-pill mb-4 mt-4" href="fr_product.php" role="button">Add product</a>
            </span>
            <table class="table table-striped text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th></th>
                </tr>
                <?php
                $sql2 = "SELECT * FROM product,category WHERE product.category = category.category_id";
                $hand = mysqli_query($conn, $sql2);
                while ($row = mysqli_fetch_array($hand)) {
                ?>
                    <tr>
                        <td><?= $row["product_id"] ?></td>
                        <td><?= $row["product_name"] ?></td>
                        <td><?= $row["category"] ?></td>
                        <td><?= $row["price"] ?> Baht</td>
                        <td><?= $row["quantity"] ?></td>
                        <td class="w-50"><?= $row["description"] ?></td>
                        <td><img src="images/<?= $row["image"] ?>" width="100px" height="100px" style="object-fit:contain;"></td>
                        <td class="d-flex">
                            <a href="edit_product.php?product_id=<?= $row["product_id"] ?>" class="rounded-pill link-light text-decoration-none py-1 px-3" style="background-color:burlywood;">EDIT</a>
                            <a href="delete_product.php?product_id=<?= $row["product_id"] ?>" class="rounded-pill link-light text-decoration-none py-1 px-3" style="background-color:indianred;" onclick="Del(this.href);return:false;">DELETE</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="container py-5">
            <h2 id="member" class="py-3">Member</h2>
            <table class="table table-striped text-center">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Usertype</th>
                </tr>
                <?php
                $sql3 = "SELECT * FROM member";
                $hand = mysqli_query($conn, $sql3);
                while ($row_mem = mysqli_fetch_array($hand)) {
                ?>
                    <tr>
                        <td><?= $row_mem["id"] ?></td>
                        <td><?= $row_mem["username"] ?></td>
                        <td><?= $row_mem["email"] ?></td>
                        <td><?= $row_mem["gender"] ?></td>
                        <td><?= $row_mem["usertype"] ?></td>
                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
    </section>
</body>

<script language="Javascript">
    function Del(AdminPage) {
        var agree = confirm("Do you want to delete?");
        if (agree) {
            window.location = Admin;
        }
    }
</script>

</html>