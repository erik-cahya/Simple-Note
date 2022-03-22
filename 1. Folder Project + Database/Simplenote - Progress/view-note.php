<?php

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions/functions.php';

$id = $_GET["id"];

$catatan = query("SELECT * FROM tb_notes WHERE id = $id")[0];

if (isset($_POST["kirim"])) {

    if (edit($_POST) > 0) {
        echo "
            <script>
                alert('Note Berhasil Diedit');
                document.location.href = 'notes-dashboard.php';
            </script>
        ";
    } else {
        $error = mysqli_error($conn);
        var_dump($error);
    }
}


?>


<!doctype html>
<html lang="en" id="home">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="style/view.css">

    <!-- My Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.2/css/all.css">
    <title>Simplenote - Your Notes</title>
    <link rel="icon" href="assets/logo.png" type="image/gif" sizes="16x16">
</head>

<body>

    <div class="wrapper-container">

        <form action="" method="POST">
            <div class="card bg-dark text-center mx-auto text-white view-card">

                <input type="hidden" id="id" name="id" value="<?= $catatan['id']; ?>">

                <div class="card-header">
                    <input type="text" class="text-center" value="<?= $catatan['name']; ?>" name="name" id="name">
                </div>
                <div class="card-body">

                    <input type="text" name="title" id="title" class="card-title h4 text-center" width="800" value="<?= $catatan['title']; ?>" autocomplete="off">

                    <hr>

                    <textarea name="content" id="content" class="card-text"><?= $catatan['content']; ?></textarea>

                    <br>

                    <button class="btn btn-primary" type="submit" name="kirim">Save Data</button>

                    <a href="notes-dashboard.php" class="btn btn-success">Go Back</a>


                </div>
                <div class="card-footer text-muted">
                    <?= $catatan['date']; ?>
                </div>
        </form>
    </div>

    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>