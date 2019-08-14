<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location: ../index.php');
}else {
include '../config/db.php';
$sqlfaktur = "SELECT * FROM pembelian group by no_faktur";
$rfaktur = $con->query($sqlfaktur);
$rowfaktur = $rfaktur->num_rows;
$sqlsupplier = "SELECT * FROM supplier group by kode_supplier";
$rsupplier = $con->query($sqlsupplier);
$rowsupplier = $rsupplier->num_rows;
$sqlbarang = "SELECT * FROM barang group by kode_barang";
$rbarang = $con->query($sqlbarang);
$rowbarang = $rbarang->num_rows;
$sqlpenanggungjawab = "SELECT * FROM penanggung group by nama";
$rpenanggung = $con->query($sqlpenanggungjawab);
$rowpenanggungjawab = $rpenanggung->num_rows;
$sqlrusakringan = "SELECT sum(rusak_ringan) as rusak_ringan, sum(hilang) as hilang, sum(rusak_berat) as rusak_berat FROM keadaan_barang";
$rrusakringan = $con->query($sqlrusakringan);
$datakeadaan_barang = $rrusakringan->fetch_assoc();

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">        
        <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/custom.css" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">SIPBI</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../proseslogout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="barang.php">
                  <span data-feather="box"></span>
                  Barang
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="supplier.php">
                  <span data-feather="users"></span>
                  Supplier
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pembelian.php">
                  <span data-feather="shopping-cart"></span>
                  Pembelian
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="keadaanbarang.php">
                  <span data-feather="edit"></span>
                  Keadaan Barang
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="penanggungjawab.php">
                  <span data-feather="layers"></span>
                  Penanggung Jawab
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pengaturanuser.php">
                  <span data-feather="settings"></span>
                  Pengaturan User
                </a>
              </li>
            </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>
          <div class="row border border-dark text-center">
              <div class="col-md-4 border border-dark" style="background-color:#11aab3;">
                <h3>Jumlah Faktur</h3>
                <br />
                <p style="font-size:70px;"><?=$rowfaktur;?></p>
              </div>
              <div class="col-md-4 border border-dark" style="background-color:#80ffff;">
              <h3>
                Jumlah Barang
              </h3>
              <br />
                <p style="font-size:70px;"><?=$rowbarang;?></p>
              </div>
              <div class="col-md-4 border border-dark" style="background-color:#c4ffff;">
                <h3>Jumlah Supplier</h3>
                <br />
                <p style="font-size:70px;"><?=$rowsupplier;?></p>
              </div>
          </div>
          <div class="row border border-dark">
              <div class="col-md-4 border border-dark text-center"style="background-color:#c4ffff;">
              <h3>Jumlah Penanggung Jawab</h3>
              <br />
                <p style="font-size:70px;"><?=$rowpenanggungjawab;?></p>
              </div>
              <div class="col-md-8 border border-dark text-center" style="background-color:#80ffff;">
              <h3>Keadaan Barang</h3>
                <div class="row text-center">
                  <div class="col-md-4">
                    <h5>Hilang</h5>
                    <br />
                    <p style="font-size:70px;"><?=$datakeadaan_barang['hilang'];?></p>
                  </div>
                  <div class="col-md-4">
                    <h5>Rusak Ringan</h5>
                    <br />
                    <p style="font-size:70px;"><?=$datakeadaan_barang['rusak_ringan'];?></p>
                  </div>
                  <div class="col-md-4">
                  <h5>Rusak Berat</h5>
                  <br />
                    <p style="font-size:70px;"><?=$datakeadaan_barang['rusak_berat'];?></p>
                  </div>
                </div>
              </div>
            </div>

          <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

        </main>
      </div>
    </div>
    <?php include"js.php";?>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#idtable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'print'
        ]
        });
      } );
    </script>
    
    </body>
</html>
    <?php }?>