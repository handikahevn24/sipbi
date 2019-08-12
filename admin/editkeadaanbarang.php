<?php
include '../config/db.php';
if (isset($_GET['kode_barang'])) {
  $kode_barang = $_GET['kode_barang'];
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
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="barang.php">
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
                  <span data-feather="edit">(current)</span>
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
            <h1 class="h2">Barang</h1>
          </div>
          <h2>Data Keadaan Barang</h2>
          <div class="table-responsive">
            <table id="keadaanbarang" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Jumlah</th>
                  <th>Rusak Ringan</th>
                  <th>Rusak Berat</th>
                  <th>Hilang</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
                    $sql = "SELECT * From keadaan_barang";
                    if ($result = $con->query($sql)){
                        while($data = $result->fetch_assoc()){
                          ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['kode_barang'];?></td>
                            <td><?= $data['jumlah'];?></td>
                            <td><?= $data['rusak_ringan'];?></td>
                            <td><?= $data['rusak_berat'];?></td>
                            <td><?= $data['hilang'];?></td>
                            <td><a href="editkeadaanbarang.php?kode_barang=<?=$data['kode_barang'];?>"><span data-feather="edit"></span></a> | <a href="hapuskeadaanbarang.php?kode_barang=<?=$data['kode_barang'];?>"><span data-feather="trash"></span></a></td>
                          </tr>
                          <?php
                        }
                    }
              ?>
              </tbody>
            </table>
          </div>

          <?php

            $query_kbarang = mysqli_query($con,"SELECT * FROM keadaan_barang,barang where keadaan_barang.kode_barang = barang.kode_barang and keadaan_barang.kode_barang='$kode_barang'")or die(mysqli_error());
            $databar = mysqli_fetch_array($query_kbarang);
          ?>
            <!-- The Modal -->
            <div class="modal" id="updatebarang">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="updatekeadaanbarang.php"class="form-barang" method="POST" id="form-barang">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang:</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $databar['kode_barang'];?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang:</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $databar['nama_barang'];?>">
                    </div>
                    <div class="form-group">
                        <label for="rusak_ringan">Rusak Ringan</label>
                        <input type="text" class="form-control" id="rusak_ringan" name="rusak_ringan" value="<?= $databar['rusak_ringan'];?>">
                    </div>
                    <div class="form-group">
                        <label for="rusak_berat">Rusak Berat:</label>
                        <input type="text" class="form-control" id="rusak_berat" name="rusak_berat" value="<?= $databar['rusak_berat'];?>">
                    </div>
                    <div class="form-group">
                        <label for="hilang">Hilang:</label>
                        <input type="text" class="form-control" id="hilang" name="hilang" value="<?= $databar['hilang'];?>">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-primary" value="simpan" name="simpan" id="simpan">Simpan</button>                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
            </div>

        </main>
      </div>
    </div>
    <?php include"js.php";?>
    <script type="text/javascript" charset="utf8" src="../datatables/datatables.min.js"></script>
    <script type="text/javascript">
$(document).ready(function() {
    $('#tbbarang').DataTable( {
        dom: 'lBfrtip',
        buttons: [ 
            {
                text: 'Tambah',
                action: function ( e, dt, node, config ) {
                    $("#updatebarang").modal()
                }
            }, 'copy', 'excel','print'
        ]
    } );
    $("#updatebarang").modal();
} );
    </script>
    
    </body>
</html>
<?php
}
?>