<?php
include "../config/db.php";

$query_supplier = mysqli_query($con,"SELECT * FROM supplier order by kode_supplier desc")or die(mysql_error());
$row_supplier = mysqli_fetch_array($query_supplier);
$totalrow_supplier = mysqli_num_rows($query_supplier);

        $kode_supplier = $_POST['kode_supplier'];
		$nama_supplier= $_POST['nama_supplier'];
		$alamat=$_POST['alamat'];
        $notelp=$_POST['notelp'];

			$sql="UPDATE supplier set nama_supplier = '$nama_supplier', alamat = '$alamat',no_telp = '$notelp' where kode_supplier = '$kode_supplier'";
            $res=mysqli_query($con,$sql) or die (mysqli_error());
            
            if($res){
                echo "<script>alert('Data Berhasil Di Edit.'); window.location = 'supplier.php'</script>";
            }

?>