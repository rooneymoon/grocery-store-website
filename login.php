<?php
session_start();
include('condb.php');
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
    <title>Login</title>
    <style>
        * {
            font-family: 'Sora';
            color: #2d483f;
        }

        label {
            color: #2d483f;
        }

        .container {
            animation: main 2s ease 0s 1 normal forwards;
        }

        @keyframes main {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .btn {
            background-color: #2d483f;
            color: #fefbf6;
        }

        .btn:hover {
            background-color: transparent;
            border: 1px solid #2d483f;
            color: #2d483f;
        }
    </style>
</head>

<body>
    <main class="py-5" style="background-image: url(images/broccoli-bg.png); background-size:cover;">
        <div class="container d-flex flex-column align-items-center my-5">
            <div class="col-10 col-xl-6 px-5 rounded-5 my-5 py-5 bg-white">
                <h1 class="fw-bold pb-3 pt-5 text-center pt-5 pb-5">Sign In</h1>
                <form action="login_db.php" method="post">
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error">
                            <h3>
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </h3>
                        </div>
                    <?php endif ?>
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control form-control-sm" name="username" id="floatingInput" placeholder="username" required>
                        <label for="floatingInput" class="fw-medium">Username</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control form-control-sm" name="password" id="floatingInput" placeholder="xxx xxx" required>
                        <label for="floatingInput" class="fw-medium">Password</label>
                    </div>
                    <div class="col-12 mt-5 d-flex justify-content-center">
                        <button type="submit" class="col-12 btn rounded-pill fs-5 mt-3" name="login_user">Login</button>
                    </div>
                    <p class="mt-5">Not yet a member?<a href="register.php" style="color: #8ec25e;"> Sign up</a></p>
                    <p class="mb-5">Are you admin?<a href="admin.php" style="color: #8ec25e;"> Admin</a></p>
                </form>
            </div>
        </div>
    </main>
</body>

</html>