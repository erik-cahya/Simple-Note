<?php

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions/functions.php';

// Tampilkan Data
$notes = query("SELECT * FROM tb_notes");


// Add Data
if (isset($_POST['kirim'])) {

    if (add_data($_POST) > 0) {
        echo "
        <script>
            alert('catatan berhasil ditambahkan');
            document.location.href = 'notes-dashboard.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('catatan gagal ditambahkan');
            document.location.href = 'notes-dashboard.php';
        </script>
        ";
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
    <link rel="stylesheet" href="style/notes-style.css">

    <!-- My Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.2/css/all.css">


    <title>Simplenote - My Notes</title>
    <link rel="icon" href="assets/logo.png" type="image/gif" sizes="16x16">
</head>

<body>

    <div class="wrapper-container">

        <h1 class="display-5 my-5">My Notes</h1>

        <!-- Add Data Button -->
        <!-- Button trigger modal -->

        <div class="wrapper-tombol">

            <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#exampleModal" title="Delete My Notes">
                Add Note
            </button>

            <a href="functions/logout.php" class="btn btn-danger logout mx-4">Logout</a>
        </div>
        <!-- Logout Button -->

        <!-- Akhir Logout  -->

        <!-- Modal -->
        <div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action=" " method="POST" enctype="multipart/form-data">


                            <input type="text" class="form-control" name="date" id="date" value="<?= indonesia_date(date('Y-m-d')); ?>" hidden>

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>



                            <div class="form-group">
                                <label for="content" class="col-form-label">Content</label>
                                <textarea class="form-control" name="content" id="content"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="kirim" class="btn btn-primary">Add Note</button>

                    </div>

                    </form>

                </div>

            </div>
        </div>

        <!-- Akhir Button Add Data -->

        <div class="wrapper-card">

            <?php foreach ($notes as $note) : ?>
                <div class="card text-white bg-dark">

                    <div class="card-body">
                        <h5 class="h3 card-title"><?= $note['name']; ?></h5>
                        <p class="card-text"><?= $note['title']; ?></p>

                        <!-- view data -->
                        <a href="view-note.php?id=<?= $note['id']; ?>" class="btn btn-primary" title="View My Notes"><i class="fas fa-eye"></i></a>

                        <!-- delete data -->

                        <!-- Button trigger modal -->

                        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#modalDelete<?= $note['id']; ?>" title="Delete My Notes">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade text-dark" id="modalDelete<?= $note['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>

                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda Ingin Menghapus Data ?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="functions/delete.php?id=<?= $note['id']; ?>" class="btn btn-danger">Delete Data</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <small class="text-muted"><?= indonesia_date(date('Y-m-d')); ?></small>
                    </div>

                </div>

            <?php endforeach; ?>

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