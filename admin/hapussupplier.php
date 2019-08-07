<?php
include "../config/db.php";
$kode_supplier = $_GET['kode_supplier'];

$query = mysqli_query($con,"DELETE FROM supplier WHERE kode_supplier='$kode_supplier'")or die(mysqli_error());
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'supplier.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!'); window.location = 'supplier.php'</script>";	
}
?>