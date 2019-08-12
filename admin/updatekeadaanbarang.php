<?php
include "../config/db.php";

$query_barang = mysqli_query($con,"SELECT * FROM barang order by kode_barang desc")or die(mysql_error());
$row_barang = mysqli_fetch_array($query_barang);
$totalrow_barang = mysqli_num_rows($query_barang);

$kode_barang = $_POST['kode_barang'];
$nama_barang = $_POST['nama_barang'];
$rusak_ringan = $_POST['rusak_ringan'];
$rusak_berat = $_POST['rusak_berat'];
$hilang = $_POST['hilang'];

			$sql="UPDATE keadaan_barang set rusak_ringan = '$rusak_ringan', rusak_berat = '$rusak_berat',
            hilang = '$hilang' where kode_barang = '$kode_barang'";
            $res=mysqli_query($con,$sql) or die (mysqli_error());
            
            if($res){
                echo "<script>alert('Data Berhasil Di Edit.'); window.location = 'keadaanbarang.php'</script>";
            }

?>