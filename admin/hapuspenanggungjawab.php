<?php
include "../config/db.php";
$nama = $_GET['nama'];

$query = mysqli_query($con,"DELETE FROM penanggung WHERE nama='$nama'")or die(mysqli_error());
if ($query){
	echo "<script>alert('Data Berhasil dihapus!'); window.location = 'penanggungjawab.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dihapus!'); window.location = 'penanggungjawab.php'</script>";	
}
?>