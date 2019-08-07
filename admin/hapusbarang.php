<?php
include "../config/db.php";
$kode_barang = $_GET['kode_barang'];

$query = mysqli_query($con,"DELETE FROM barang WHERE kode_barang='$kode_barang'")or die(mysqli_error());
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'barang.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!'); window.location = 'barang.php'</script>";	
}
?>