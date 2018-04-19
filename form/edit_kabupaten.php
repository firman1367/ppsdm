<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $kode_kab   = $_GET['rowid'];
        $query      = mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                              INNER JOIN tb_prov AS a USING(kode_prov)
                                              WHERE kode_kab = '$kode_kab'"));
        $data       = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_kabupaten" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="kode_kab_pr" value="<?php echo $data['kode_kab'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Kabupaten</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_kab" value="<?php echo $data['kode_kab'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Kabupaten</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nama_kab" value="<?php echo $data['nama_kab'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Provinsi</label>
        <div class="col-md-8">
            <select class="form-control select" name="kode_prov" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY nama_prov ASC"));
                    foreach($query as $data_prov){
                        if ($data['kode_prov'] == $data_prov['kode_prov']) {
                            echo "<option value = $data_prov[kode_prov] selected>$data_prov[nama_prov]</option>";
                        }else{
                            echo "<option value= $data_prov[kode_prov]>$data_prov[nama_prov]</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jumlah Puskesmas</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="jml_puskesmas" value="<?php echo $data['jml_puskesmas'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jumlah RS</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="jml_rs" value="<?php echo $data['jml_rs'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<script type="text/javascript" src="js/plugins.js"></script>
