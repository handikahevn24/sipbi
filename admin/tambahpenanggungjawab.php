<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $ruang = $_POST['ruang'];
    
    $sql = "INSERT INTO penanggung (nama, nip, kelas)
    VALUES ('$nama', '$nip', '$ruang')";

    if ($con->query($sql) === TRUE) {
        header('location: penanggungjawab.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>