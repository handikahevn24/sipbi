<?php
include "../config/db.php";
$no_faktur = $_GET['no_faktur'];
$kode_barang = $_GET['kode_barang'];

$query = mysqli_query($con,"DELETE FROM pembelian WHERE no_faktur='$no_faktur' AND kode_barang='$kode_barang'")or die(mysqli_error());
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'pembelian.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!'); window.location = 'pembelian.php'</script>";	
}
?>