<?php
include "connect.php";
session_start();

if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Product Management</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <style>
       body {
        background-image: url("https://images.unsplash.com/photo-1523275335684-37898b6baf30?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080");
        background-repeat: no-repeat;
        background-size: cover;
      }

        header {
            margin-bottom: 20px;
        }

        .table-primary {
            background-color: white !important;
            border-radius: 10px;
        }

        th, td {
            text-align: center;
        }

        .btn-custom {
            border-radius: 10px;
            padding: 8px 20px;
        }

        .btn-custom-insert {
            background-color: #4caf50;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-custom-logout {
            background-color: #dc3545;
            color: white;
            font-size: 14px;
        }

        .navbar-dark .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Product Management</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container my-4">
            <div class="d-flex justify-content-end mb-4">
                <a href="add.php">
                    <button class="btn btn-custom btn-custom-insert">Insert New Product</button>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-primary">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM Product_info";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['pname']}</td>
                                        <td>₹{$row['price']}</td>
                                        <td>{$row['description']}</td>
                                        <td>
                                            <a href='update.php?id={$row['id']}'>
                                                <button class='btn btn-primary btn-custom'>Update</button>
                                            </a>
                                            <a href='delete.php?id={$row['id']}'>
                                                <button class='btn btn-danger btn-custom'>Delete</button>
                                            </a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2025 Product Management System</p>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2
