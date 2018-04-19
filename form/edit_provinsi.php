<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $kode_prov  = $_GET['rowid'];
        $query      = mysqli_query($koneksi,("SELECT * FROM tb_prov WHERE kode_prov = '$kode_prov'"));
        $data       = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_kodeprov" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="kode_prov_pr" value="<?php echo $data['kode_prov'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Provinsi</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_prov" value="<?php echo $data['kode_prov'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Provinsi</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nama_prov" value="<?php echo $data['nama_prov'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<!--<script type="text/javascript" src="js/plugin_date.js"></script>-->
