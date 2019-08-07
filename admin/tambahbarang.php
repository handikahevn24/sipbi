<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $register = $_POST['register'];
    $merk = $_POST['merk'];
    $ukuran = $_POST['ukuran'];
    $bahan = $_POST['bahan'];
    $tanggal_beli = $_POST['tanggal_beli'];
    $no_pabrik = $_POST['no_pabrik'];
    $sumber_perolehan = $_POST['sumber_perolehan'];
    $harga_perolehan = $_POST['harga_perolehan'];
    $supplier = $_POST['supplier'];
    $ruang = $_POST['ruang'];
    
    $sql = "INSERT INTO barang (kode_barang, nama_barang, register, merk, ukuran, bahan, tanggal_beli, no_pabrik, sumber_perolehan, harga_perolehan, supplier, ruang)
    VALUES ('$kode_barang', '$nama_barang', '$register','$merk', '$ukuran', '$bahan', '$tanggal_beli', '$no_pabrik', '$sumber_perolehan', '$harga_perolehan', '$supplier', '$ruang')";

    if ($con->query($sql) === TRUE) {
        header('location: barang.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>