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
                <a class="nav-link" href="supplier.php">
                  <span data-feather="users"></span>
                  Supplier
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="pembelian.php">
                  <span data-feather="shopping-cart">(current)</span>
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
            <h1 class="h2">Pembelian</h1>
          </div>
          <?php
          $kode_supplier = mysqli_real_escape_string($con,$_GET['supplier']);
          $no_faktur = mysqli_real_escape_string($con,$_GET['no_faktur']);
          $tanggal_pembelian = mysqli_real_escape_string($con,$_GET['tanggal_pembelian']);
          $supplier1 = "SELECT * FROM supplier where kode_supplier='$kode_supplier'";
          $result = $con->query($supplier1);
          $data_sup = $result->fetch_assoc();
          ?>
          <h4>Data Pembelian <?= $_GET['no_faktur'];?></h4>
          <h4>Supplier : <?= $data_sup['nama_supplier'];?></h4>
          <h5>Tanggal : <?= $_GET['tanggal_pembelian'];?></h5>
          <div class="table-responsive">
            <table id="pembelian" class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>jumlah_barang</th>
                  <th>harga_satuan</th>
                  <th>harga_total</th>
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

            <!-- The Modal -->
            <div class="modal" id="tambahbarang">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="tambahpembelian.php?no_faktur=<?=$no_faktur;?>&supplier=<?=$kode_supplier;?>&tanggal_pembelian=<?=$tanggal_pembelian;?>" class="form-pembelian" method="POST" id="form-pembelian">
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
                          <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang">
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
            <div class="modal" id="detailpembelian">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Data Pembelian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                <form action="detailpembelian.php?"class="form-pembelian" method="GET" id="form-pembelian">
                    <div class="form-group">
                        <label for="no_Faktur">No Faktur:</label>
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="FK">
                    </div>
                    <div class="form-group">
                        <label for="supplier">Kode Supplier:</label>
                        <select name="supplier" class="form-control show-tick" data-live-search="true">
                            <option> ---- Pilih Salah Satu ---- </option>
                                <?php
                                    $supplier = mysqli_query($con,"SELECT * FROM supplier ORDER BY kode_supplier ASC");
                                    if(mysqli_num_rows($supplier) != 0){
                                    while($dataku = mysqli_fetch_assoc($supplier)){
                                    echo '<option value='.$dataku['kode_supplier'].'>'.$dataku['kode_supplier'].' | '.$dataku['nama_supplier'].'</option>'; }
                                    }
                                ?>
                        </select>
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
    $('#pembelian').DataTable( {
        dom: 'Brtip',
        buttons: [ 
            {
                text: 'Tambah Barang',
                action: function ( e, dt, node, config ) {
                    $("#tambahbarang").modal()
                }
            },
        ]
    } );

    $(document).on('keyup','#harga_satuan', function() {
    let total = 0;
    jumlah_barang = $("#jumlah_barang").val();
    harga_satuan = $("#harga_satuan").val();
    total = jumlah_barang * harga_satuan;   
    $("#harga_total").val(total);
});

} );
    </script>
    
    </body>
</html>