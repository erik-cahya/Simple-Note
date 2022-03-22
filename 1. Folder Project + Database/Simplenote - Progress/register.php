<?php

session_start();
if (isset($_SESSION["login"])) {
    header("Location: notes-dashboard.php");
    exit;
}

require 'functions/functions.php';

if (isset($_POST["register"])) {

    if (register($_POST) > 0) {
        echo "
            <script>
                alert('Regsitrasi Berhasil');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
};

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Simplenote - Register Page</title>
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
            <h1 class="h4 mt-2 font-weight-regular">Register Account</h1>

        </div>

        <div class="form-label-group">

            <input type="email" name="email" id="email" class=" form-login" placeholder="Email address" autocomplete="off" required autofocus>

            <label for="email">Email address</label>

        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="password" class="form-login" placeholder="Password" required>
            <label for="password">Password</label>
        </div>


        <div class="form-label-group">
            <input type="password" name="password2" id="password2" class="form-login" placeholder="Password" required>
            <label for="password2">Verification Password</label>
        </div>


        <button class="btn btn-lg btn-primary btn-block mt-5" type="submit" name="register">Register</button>



        <p class="mt-5 mb-3 text-muted text-center">Already have an account ?
            <a href="login.php">Login</a>
        </p>
        <p class="mt-5 mb-3 text-muted text-center">&copy; Erik Cahya Pradana</p>
    </form>

</body>

</html>