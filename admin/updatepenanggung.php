<?php
include "../config/db.php";

$query_barang = mysqli_query($con,"SELECT * FROM penanggung order by nama desc")or die(mysql_error());
$row_barang = mysqli_fetch_array($query_barang);
$totalrow_barang = mysqli_num_rows($query_barang);

$nama = $_POST['nama'];
$nip = $_POST['nip'];
$kelas = $_POST['kelas'];

			$sql="UPDATE penanggung set nip = '$nip', kelas = '$kelas' where nama = '$nama'";
            $res=mysqli_query($con,$sql) or die (mysqli_error());
            
            if($res){
                echo "<script>alert('Data Berhasil Di Edit.'); window.location = 'penanggungjawab.php'</script>";
            }

?>