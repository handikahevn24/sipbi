<?php
include '../config/db.php';

if (isset($_POST['simpan'])) {
    $no_faktur = $_GET['no_faktur'];
    $supplier = $_GET['supplier'];
    $barang = $_POST['barang'];
    $tanggal_pembelian = $_GET['tanggal_pembelian'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $harga_satuan = $_POST['harga_satuan'];
    $harga_total = $_POST['harga_total'];
    
    $sql = "INSERT INTO pembelian (no_faktur, kode_supplier, kode_barang, tanggal_pembelian, jumlah_barang, harga_satuan, harga_total)
    VALUES ('$no_faktur', '$supplier', '$barang','$tanggal_pembelian', '$jumlah_barang', '$harga_satuan','$harga_total')";

    if ($con->query($sql) === TRUE) {
        $cek = $con->query("Select kode_barang from keadaan_barang where kode_barang = '$barang'");
        $row = $cek->num_rows;
        if($row == 0){
            // Jika barang belum ada
            $sql2 = "INSERT INTO keadaan_barang (kode_barang,jumlah) VALUES ('$barang','$jumlah_barang')";
            $con->query($sql2);
        }else{

            $sql3 = "UPDATE keadaan_barang set jumlah = jumlah + '$jumlah_barang' where kode_barang = '$barang'";
            $con->query($sql3);
        }
        // Jika Barang sudah ada
        header('location: detailpembelian.php?no_faktur='.$no_faktur.'&supplier='.$supplier.'&tanggal_pembelian='.$tanggal_pembelian);
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();
?>