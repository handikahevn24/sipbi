<?php
include '../config/db.php';
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
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="barang.php">
                  <span data-feather="box">(current)</span>
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
                <a class="nav-link" href="laporan.php">
                  <span data-feather="bar-chart-2"></span>
                  Laporan
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
          <h2>Data Barang</h2>
          <div class="table-responsive">
            <table id="tbbarang" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Register</th>
                  <th>Merk</th>
                  <th>Ukuran</th>
                  <th>Bahan</th>
                  <th>Tanggal Beli</th>
                  <th>No Pabrik</th>
                  <th>Sumber Perolehan</th>
                  <th>Harga Perolehan</th>
                  <th>Supplier</th>
                  <th>Ruang</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
                    $sql = "SELECT * From barang order by kode_barang Asc";
                    if ($result = $con->query($sql)){
                        while($data = $result->fetch_assoc()){
                          ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['kode_barang'];?></td>
                            <td><?= $data['nama_barang'];?></td>
                            <td><?= $data['register'];?></td>
                            <td><?= $data['merk'];?></td>
                            <td><?= $data['ukuran'];?></td>
                            <td><?= $data['bahan'];?></td>
                            <td><?= $data['tanggal_beli'];?></td>
                            <td><?= $data['no_pabrik'];?></td>
                            <td><?= $data['sumber_perolehan'];?></td>
                            <td><?= 'Rp' . number_format($data['harga_perolehan'],0);?></td>
                            <td><?= $data['supplier'];?></td>
                            <td><?= $data['ruang'];?></td>
                            <td><a href="editbarang.php?kode_barang=<?=$data['kode_barang'];?>"><span data-feather="edit"></span></a> | <a href="hapusbarang.php?kode_barang=<?=$data['kode_barang'];?>"><span data-feather="trash"></span></a></td>
                          </tr>
                          <?php
                        }
                    }
              ?>                  
              </tbody>
            </table>
          </div>
            <!-- The Modal -->
            <div class="modal" id="tambahbarang">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Data Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="tambahbarang.php"class="form-barang" method="POST" id="form-barang">
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang:</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="KB">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang:</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label for="register">Register</label>
                        <input type="text" class="form-control" id="register" name="register">
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk:</label>
                        <input type="text" class="form-control" id="merk" name="merk">
                    </div>
                    <div class="form-group">
                        <label for="ukuran">Ukuran:</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran">
                    </div>
                    <div class="form-group">
                        <label for="bahan">Bahan:</label>
                        <input type="text" class="form-control" id="bahan" name="bahan">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_beli">Tanggal Beli:</label>
                        <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli">
                    </div>
                    <div class="form-group">
                        <label for="no_pabrik">No Pabrik:</label>
                        <input type="text" class="form-control" id="no_pabrik" name="no_pabrik">
                    </div>
                    <div class="form-group">
                        <label for="sumber_perolehan">Sumber Perolehan:</label>
                        <input type="text" class="form-control" id="sumber_perolehan" name="sumber_perolehan">
                    </div>
                    <div class="form-group">
                        <label for="harga_perolehan">Harga Perolehan:</label>
                        <input type="text" class="form-control" id="harga_perolehan" name="harga_perolehan">
                    </div>
                    <div class="form-group">
                        <label for="supplier">Supplier:</label>
                        <select name="supplier" class="form-control show-tick" data-live-search="true">
                            <option> ---- Pilih Salah Satu ---- </option>
                                <?php
                                    $supplier = mysqli_query($con,"SELECT * FROM supplier ORDER BY kode_supplier ASC");
                                    if(mysqli_num_rows($supplier) != 0){
                                    while($dataku = mysqli_fetch_assoc($supplier)){
                                    echo '<option value='.$dataku['kode_supplier'].'>'.$dataku['nama_supplier'].'</option>'; }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ruang">Ruang:</label>
                        <input type="text" class="form-control" id="ruang" name="ruang">
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
    $('#tbbarang').DataTable( {
        dom: 'lBfrtip',
        buttons: [ 
            {
                text: 'Tambah',
                action: function ( e, dt, node, config ) {
                    $("#tambahbarang").modal()
                }
            }, 'copy', 'excel','print'
        ]
    } );
} );
    </script>
    
    </body>
</html>