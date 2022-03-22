<?php
session_start();

require 'functions/functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];


    $result = mysqli_query($conn, "SELECT email FROM tb_users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: notes-dashboard.php");
    exit;
}


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            // remember me
            if (isset($_POST["remember"])) {
                setcookie('id', $row["id"], time() + 60);
                setcookie('key', hash('sha256', $row["username"]), time() + 60);
            }

            header("Location: notes-dashboard.php");
            exit;
        }
    }

    $error = true;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Simplenote - Login Page</title>
    <link rel="icon" href="assets/logo.png" type="image/gif" sizes="16x16">




    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="style/login-style.css" rel="stylesheet">
</head>

<body>

    <form class="form-signin" action="" method="POST">

        <div class="text-center mb-4 wrapper-title">

            <img class="mb-4" src="assets/logo.png" alt="" width="72" height="72">
            <h1 class="h1 mb-3 font-weight-bold">Simplenote</h1>
            <h1 class="h4 mt-2 font-weight-regular">Login</h1>

        </div>


        <div class="form-label-group">

            <input type="email" id="email" name="email" class=" form-login" placeholder="Email address" autocomplete="off" required autofocus>

            <label for="email">Email address</label>

        </div>

        <div class="form-label-group">
            <input type="password" id="password" name="password" class="form-login" placeholder="Password" required>
            <label for="password">Password</label>
        </div>


        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me" id="remember" name="remember"> Remember me
            </label>
        </div>


        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                Username / Password anda salah
            </div>
        <?php endif; ?>



        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>



        <p class="mt-5 mb-3 text-muted text-center">Don't have an account ?
            <a href="register.php">Register</a>
        </p>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Erik Cahya Pradana</p>
    </form>



</body>

</html>