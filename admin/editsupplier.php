<?php
include '../config/db.php';
if (isset($_GET['kode_supplier'])) {
  $kode_supplier = $_GET['kode_supplier'];
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
                <a class="nav-link" href="barang.php">
                  <span data-feather="box"></span>
                  Barang
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="supplier.php">
                  <span data-feather="users">(current)</span>
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
            <h1 class="h2">Supplier</h1>
          </div>
          <h2>Data Supplier</h2>
          <div class="table-responsive">
            <table id="supplier" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Supplier</th>
                  <th>Nama Supplier</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
                    $sql = "SELECT * From supplier";
                    if ($result = $con->query($sql)){
                        while($data = $result->fetch_assoc()){
                          ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['nama_supplier'];?></td>
                            <td><?= $data['kode_supplier'];?></td>
                            <td><?= $data['alamat'];?></td>
                            <td><?= $data['no_telp'];?></td>
                            <td><a href="editsupplier.php?kode_supplier=<?=$data['kode_supplier'];?>"><span data-feather="edit"></span></a> | <a href="hapussupplier.php?kode_supllier=<?=$data['kode_supplier'];?>"><span data-feather="trash"></span></a></td>
                          </tr>
                          <?php
                        }
                    }
              ?>
              </tbody>
            </table>
          </div>

          <?php

            $query_supplier = mysqli_query($con,"SELECT * FROM supplier where kode_supplier='$kode_supplier'")or die(mysqli_error());
            $datasup = mysqli_fetch_array($query_supplier);
          ?>

            <!-- The Modal -->
            <div class="modal" id="tambahsupplier">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Data Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="updatesupplier.php"class="form-supplier" method="POST" id="form-supplier">
                    <div class="form-group">
                        <label for="kode_supplier">Kode Supplier:</label>
                        <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" value="<?= $datasup['kode_supplier'];?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier:</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?=$datasup['nama_supplier'];?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datasup['alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">No Telp:</label>
                        <input type="text" class="form-control" id="notelp" name="notelp" value="<?= $datasup['no_telp'] ?>">
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
    <script type="text/javascript">
$(document).ready(function() {
    $('#supplier').DataTable( {
        dom: 'lBfrtip',
        buttons: [ 
            {
                text: 'Tambah',
                action: function ( e, dt, node, config ) {
                    $("#tambahsupplier").modal()
                }
            }, 'copy', 'excel','print'
        ]
    } );
    $("#tambahsupplier").modal()
} );
    </script>
    
    </body>
</html>
<?php
}else {
  echo "<script>alert('Tidak ada kode supplier.'); window.history.back();</script>";
}
?>