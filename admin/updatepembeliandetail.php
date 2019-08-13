<?php
include "../config/db.php";

$query_supplier = mysqli_query($con,"SELECT * FROM pembelian order by no_faktur desc")or die(mysql_error());
$row_supplier = mysqli_fetch_array($query_supplier);
$totalrow_supplier = mysqli_num_rows($query_supplier);

$no_faktur = $_POST['no_faktur'];
$kode_supplier = $_POST['kode_supplier'];
$barang = $_POST['barang'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$jumlah_barang = $_POST['jumlah_barang'];
$harga_satuan = $_POST['harga_satuan'];
$harga_total = $_POST['harga_total'];

			$sql="UPDATE pembelian set kode_barang = '$barang', kode_supplier = '$kode_supplier',tanggal_pembelian = '$tanggal_pembelian',jumlah_barang = '$jumlah_barang',harga_satuan = '$harga_satuan',harga_total = '$harga_total' where no_faktur = '$no_faktur'";
            $res=mysqli_query($con,$sql) or die (mysqli_error());
            
            if($res){
                echo "<script>alert('Data Berhasil Di Edit.'); window.location = 'detailpembelian.php?no_faktur=$no_faktur&supplier=$kode_supplier&tanggal_pembelian=$tanggal_pembelian'</script>";
            }

?>