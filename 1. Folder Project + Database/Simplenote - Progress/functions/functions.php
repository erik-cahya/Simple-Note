<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_simplenote');



// mengubah format tanggal ke indonesia
function indonesia_date($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'Sepetember',
        'Oktober',
        'November',
        'Desember'
    );
    $date = explode('-', $tanggal);
    return $date[2] . ' ' . $bulan[(int)$date[1]] . ' ' . $date[0];
}


// query data from database
function query($data)
{

    global $conn;
    $result = mysqli_query($conn, $data);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// delete data
function delete($id)
{
    global $conn;
    $delete = mysqli_query($conn, "DELETE FROM tb_notes WHERE id=$id");

    return mysqli_affected_rows($conn);
}








// add data
function add_data($data)
{
    global $conn;

    $name = htmlspecialchars($data['name']);
    $title = htmlspecialchars($data['title']);
    $content = $_POST['content'];
    $date = htmlspecialchars($data['date']);

    $query = "INSERT INTO tb_notes
        VALUES ('', '$name', '$title', '$date', '$content')
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}



// Edit Data
function edit($data)
{
    global $conn;

    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $title = htmlspecialchars($data["title"]);
    $content = htmlspecialchars($data["content"]);

    $query = "UPDATE tb_notes SET
                name = '$name',
                title = '$title',
                content = '$content'

              WHERE id = $id;
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}






// Register
function register($data)
{
    global $conn;

    $email = strtolower($data["email"]);
    $password = mysqli_escape_string($conn, $data["password"]);
    $verification_pass = mysqli_escape_string($conn, $data["password2"]);


    $result = mysqli_query($conn, "SELECT email FROM tb_users WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('username sudah tersedia');
            </script>
        ";

        return false;
    }

    if ($password !== $verification_pass) {
        echo "
            <script>
                alert('Password yang anda masukkan tidak sama');
            </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO tb_users VALUES('','$email','$password')");
    return mysqli_affected_rows($conn);
}
