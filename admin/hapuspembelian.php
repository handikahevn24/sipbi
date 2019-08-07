<?php
include "../config/db.php";
$no_faktur = $_GET['no_faktur'];

$query = mysqli_query($con,"DELETE FROM pembelian WHERE no_faktur='$no_faktur'")or die(mysqli_error());
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'pembelian.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!'); window.location = 'pembelian.php'</script>";	
}
?>