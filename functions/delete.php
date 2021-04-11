<?php

require 'functions.php';

$id = $_GET['id'];

if (delete($id) > 0) {
    echo "

    <script>
        alert('catatan berhasil dihapus');
        document.location.href = '../notes-dashboard.php';
    </script>

    ";
} else {
    echo
    "
    <script>
        alert('catatan berhasil dihapus');
        document.location.href = '../notes-dashboard.php';
    </script>
    ";
}
