<?php
include("LoginBlok.php");

if (isset($_POST['login'])) {
    $login = new LoginBlok($_POST);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-warning-subtle">
    <div class="container col-4">
        <h1 class="text-center mt-4">Login Blok</h1>
        <hr>
        <form method="POST">
            <div class="mb-3">
                <label for="usernameOrEmail" class="form-label">Username or Email</label>
                <input type="text" class="form-control" id="usernameOrEmail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-danger" name="login">Login</button>
        </form>
        <p>Belum punya akun?
            <a class="link-opacity-50-hover" href="register.php">Register di sini</a>
        </p>
    </div>

</body>

</html>