<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $id_dik    = $_GET['rowid'];
        $query     = mysqli_query($koneksi,("SELECT * FROM tb_kodedik WHERE id_dik = '$id_dik'"));
        $data      = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_kodedik" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="id_dik" value="<?php echo $data['id_dik'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Pendidikan</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_dik" value="<?php echo $data['kode_dik'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Strata</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_strata" value="<?php echo $data['kode_strata'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Pendidikan</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nama_dik" value="<?php echo $data['nama_dik'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<!--<script type="text/javascript" src="js/plugin_date.js"></script>-->
