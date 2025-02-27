<?php
include '../connection.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Insert Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <style>
       body {
        background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpvXuuKOW1FWrx4YOFfQy9H6tKBDmOEycMiw&s");
        background-repeat: no-repeat;
        background-size: cover;
      }

        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .form-floating input {
            border-radius: 8px;
        }

        label {
            font-weight: 500;
        }
        h2 {
            font-size: 2rem;
            font-weight: bold;
            color:black;
        }
        .feedback {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Product Management</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container my-5">
            <h2 class="text-center mb-4">Insert New Product</h2>
            <form action="show.php" method="post">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        placeholder="Enter product name" />
                    <label for="name">Product Name</label>
                    <div class="feedback" id="nameFeedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="number"
                        class="form-control"
                        name="price"
                        id="price"
                        placeholder="Enter product price" />
                    <label for="price">Price</label>
                    <div class="feedback" id="priceFeedback"></div>
                </div>

                <div class="form-floating mb-3">
                    <textarea
                        class="form-control"
                        name="desc"
                        id="desc"
                        placeholder="Enter product description"
                        style="height: 100px;"></textarea>
                    <label for="desc">Description</label>
                    <div class="feedback" id="descFeedback"></div>
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" type="submit">Insert</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['desc'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['desc'];

                $sql = $con->prepare("INSERT INTO product_info(pname,price,description) values (?,?,?)");
                $sql->bind_param("sis", $name, $price, $description);

                if ($sql->execute()) {
                    echo "<div class='alert alert-success text-center mt-4'>Product added successfully!</div>";
                    header('Location: home.php');
                } else {
                    echo "<div class='alert alert-danger text-center mt-4'>Error: {$sql->error}</div>";
                }
            } else {
                echo "<div class='alert alert-warning text-center mt-4'>Please fill in all the fields!</div>";
            }
        }
        ?>
    </main>

    <footer class="text-center mt-5">
        <p class="text-muted">© 2025 Product Management System</p>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
