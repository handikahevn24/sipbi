<?php
include "../config/db.php";

$query_barang = mysqli_query($con,"SELECT * FROM barang order by kode_barang desc")or die(mysql_error());
$row_barang = mysqli_fetch_array($query_barang);
$totalrow_barang = mysqli_num_rows($query_barang);

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

			$sql="UPDATE barang set nama_barang = '$nama_barang', register = '$register',
            merk = '$merk',ukuran = '$ukuran',bahan = '$bahan',
            tanggal_beli = '$tanggal_beli',no_pabrik = '$no_pabrik',sumber_perolehan = '$sumber_perolehan',
            harga_perolehan = '$harga_perolehan',supplier = '$supplier',ruang = '$ruang'
            where kode_barang = '$kode_barang'";
            $res=mysqli_query($con,$sql) or die (mysqli_error());
            
            if($res){
                echo "<script>alert('Data Berhasil Di Edit.'); window.location = 'barang.php'</script>";
            }

?>