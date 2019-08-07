<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $kode_supplier = $_POST['kode_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    
    $sql = "INSERT INTO supplier (kode_supplier, nama_supplier, alamat, no_telp)
    VALUES ('$kode_supplier', '$nama_supplier', '$alamat','$notelp')";

    if ($con->query($sql) === TRUE) {
        header('location: supplier.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>