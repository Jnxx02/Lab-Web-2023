<?php
include("./controllers/LoginController.php");

if (isset($_POST['submit'])) {
    $register = new LoginController($_POST);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-warning-subtle">
    <nav class="navbar sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand ps-3">Login Page</a>
            <form class="d-flex pe-3">
                <a href="register.php" class="btn btn-outline-success">Register</a>
            </form>
        </div>
    </nav>

    <div class="container col-lg-4">
        <h1 class="text-center my-4">Login</h1>
        <hr>
        <?php
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-info' role='alert'>$_GET[message]</div>";
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username (NIM)</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-outline-primary" name="submit">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>