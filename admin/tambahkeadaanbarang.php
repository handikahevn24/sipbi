<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $rusak_ringan = $_POST['rusak_ringan'];
    $rusak_berat = $_POST['rusak_berat'];
    $hilang = $_POST['hilang'];
    
    $sql = "INSERT INTO keadaan_barang (kode_barang, jumlah, rusak_ringan, rusak_berat, hilang)
    VALUES ('$barang', '$jumlah', '$rusak_ringan','$rusak_berat','$hilang')";

    if ($con->query($sql) === TRUE) {
        header('location: keadaanbarang.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>