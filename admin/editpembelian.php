<?php
include '../config/db.php';
if (isset($_GET['kode_barang'])) {
  $kode_barang = $_GET['kode_barang'];
  $no_faktur = $_GET['no_faktur'];
  $tanggal_pembelian = $_GET['tanggal_pembelian'];
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
          <h2>Data Edit Barang</h2>
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
             $sql = "SELECT * From pembelian where no_faktur = '$no_faktur'";
             if ($result = $con->query($sql)){
                 while($data = $result->fetch_assoc()){
                   ?>
                   <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $data['kode_barang'];?></td>
                     <td><?= $data['jumlah_barang'];?></td>
                     <td><?= $data['harga_satuan'];?></td>
                     <td><?= $data['harga_total'];?></td>
                     <td><a href="editpembelian.php?no_faktur=<?=$data['no_faktur'];?>&kode_barang=<?=$data['kode_barang'];?>&tanggal_pembelian=<?=$tanggal_pembelian;?>&kode_supplier=<?=$kode_supplier;?>"><span data-feather="edit"></span></a> | <a href="hapuspembeliansatu.php?no_faktur=<?=$data['no_faktur'];?>&kode_barang=<?=$data['kode_barang'];?>"><span data-feather="trash"></span></a></td>
                   </tr>
                          <?php
                        }
                    }
              ?>
              </tbody>
            </table>
          </div>

          <?php

            $query_kbarang = mysqli_query($con,"SELECT * FROM pembelian where no_faktur = '$no_faktur' and kode_barang='$kode_barang'")or die(mysqli_error());
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
                <form action="updatepembeliandetail.php"class="form-barang" method="POST" id="form-barang">
                    <div class="form-group">
                        <!-- <label for="no_faktur">No Faktur:</label> -->
                        <input type="hidden" class="form-control" id="no_faktur" name="no_faktur" value="<?= $databar['no_faktur'];?>" readonly>
                    </div>
                    <div class="form-group">
                      <!-- <label for="tanggal_pembelian">Tanggal Pembelian</label> -->
                      <input type="hidden" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?=$tanggal_pembelian;?>" readonly>
                    </div>
                    <div class="form-group">
                      <!-- <label for="tanggal_pembelian">Tanggal Pembelian</label> -->
                      <input type="hidden" class="form-control" id="kode_supplier" name="kode_supplier" value="<?=$kode_supplier;?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Barang:</label>
                        <select name="barang" class="form-control show-tick" data-live-search="true">
                            <option> ---- Pilih Salah Satu ---- </option>
                                <?php
                                    $barang = mysqli_query($con,"SELECT * FROM barang ORDER BY kode_barang ASC");
                                    if(mysqli_num_rows($barang) != 0){
                                    while($dataku = mysqli_fetch_assoc($barang)){
                                    echo '<option value='.$dataku['kode_barang'].'>'.$dataku['kode_barang'].' | '.$dataku['nama_barang'].'</option>'; }
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang">Jumlah Barang:</label>
                          <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?=$databar['jumlah_barang'];?>">
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan:</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" onkeyup='hitung()'>
                    </div>
                    <div class="form-group">
                        <label for="harga_total">Harga Total:</label>
                        <input type="text" class="form-control" id="harga_total" name="harga_total" readonly>
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
    var hitung = function(){
      let total = 0;
    jumlah_barang = $("#jumlah_barang").val();
    harga_satuan = $("#harga_satuan").val();
    total = jumlah_barang * harga_satuan;   
    $("#harga_total").val(total);
  
    };
    $("body").on('keyup', "#harga_satuan", hitung);
} );
    </script>
    
    </body>
</html>
<?php
}
?>