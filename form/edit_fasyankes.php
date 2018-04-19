<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $id_fasyankes   = $_GET['rowid'];
        $query          = mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, b.kode_kab, b.nama_kab, c.* FROM tb_fasyankes AS c
                                          JOIN tb_prov AS a USING(kode_prov)
                                          JOIN tb_kab_kota AS b USING(kode_kab)
                                          WHERE id_fasyankes = '$id_fasyankes'"));

        $data           = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_fasyankes" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="id_fasyankes" value="<?php echo $data['id_fasyankes'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Fasyankes</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_fasyankes" value="<?php echo $data['kode_fasyankes'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Fasyankes</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nama_fasyankes" value="<?php echo $data['nama_fasyankes'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Tipe</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="tipe" value="<?php echo $data['tipe'] ?>" placeholder="input..">
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
        <label class="col-sm-3 control-label">Nama Kabupaten</label>
        <div class="col-md-8">
            <select class="form-control select" name="kode_kab" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota ORDER BY nama_kab ASC"));
                    foreach($query as $data_kab){
                        if ($data['kode_kab'] == $data_kab['kode_kab']) {
                            echo "<option value = $data_kab[kode_kab] selected>$data_kab[nama_kab]</option>";
                        }else{
                            echo "<option value= $data_kab[kode_kab]>$data_kab[nama_kab]</option>";
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Kode Fas Old</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="kode_fas_old" value="<?php echo $data['kode_fas_old'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<script type="text/javascript" src="js/plugins.js"></script>
