<?php
include "condb.php";
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
    <title>Form Product</title>
    <style>
        * {
            font-family: 'Sora';
            color: #2d483f;
        }

        .btn {
            background-color: #2d483f;
            color: white;
            text-decoration: none;
        }

        .btn:hover {
            background-color: transparent;
            border: 1px solid #2d483f;
            color: #2d483f;
        }

        .form-control {
            border: 1px solid #d6e394;
        }

        .form-select {
            border: 1px solid #d6e394;
        }
    </style>
</head>

<body>
    <main>
        <div class="row m-0 d-flex align-items-center">
            <div class="col-7 col-xl-5 col-md-6 col-xxl-4 px-0 mx-0">
                <img src="images/vegetables-bg.png" class="img-fluid" style="height: 948px; object-fit:cover;">
            </div>
            <div class="col-5 col-xl-6 col-xxl-7 py-5 d-flex flex-column align-items-center">
                <h1 class="h1 text-center fw-bold mb-3">Product</h1>
                <img src="images/task-management.png" id="img-input" class="img-fluid rounded-5" style="width: 150px; height: 150px; object-fit:contain; border: 1px solid #d6e394">
                <form action="insert_product.php" method="post" name="form1" enctype="multipart/form-data" class="col-12 col-xl-8 col-xxl-7">
                    <label class="fs-6 pt-3 pb-1 fw-bold">Product</label>
                    <input type="text" name="product_name" class="form-control mb-2" required>
                    <label class="fs-6 pt-3 pb-1 fw-bold">Price</label>
                    <input type="number" name="price" class="form-control mb-2" required>
                    <label class="fs-6 pt-3 pb-1 fw-bold">Category</label>
                    <select class="form-select" name="category">
                        <?php
                        $sql = "SELECT * FROM category ORDER BY category_name";
                        $hand = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($hand)) {
                        ?>
                            <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </select>
                    <label class="fs-6 pt-3 pb-1 fw-bold">Quantity</label>
                    <input type="number" name="quantity" class="form-control mb-2" required>
                    <label class="fs-6 pt-3 pb-1 fw-bold">Image</label>
                    <input type="file" class="form-control mb-2" name="file1" id="input">
                    <label class="fs-6 pt-3 pb-1 fw-bold">Description</label>
                    <textarea type="text" name="description" class="form-control mb-2" required></textarea>
                    <div class="d-flex justify-content-center mt-4">
                        <input class="btn rounded-pill" type="submit" value="CONFIRM">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

<script language="Javascript">
    const image = document.getElementById("img-input"),
        input = document.getElementById("input");

    input.addEventListener("change", () => {
        image.src = URL.createObjectURL(input.files[0]);
    });
</script>

</html>