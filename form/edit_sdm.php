<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $id_sdm   = $_GET['rowid'];
        $query    = mysqli_query($koneksi,("SELECT * FROM tb_sdm WHERE id_sdm = '$id_sdm'"));
        $data     = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_sdm" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="id_sdm_pk" value="<?php echo $data['id_sdm'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">ID SDM</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="id_sdm" value="<?php echo $data['id_sdm'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nama" value="<?php echo $data['nama'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Kelamin</label>
        <div class="col-md-8">
            <select class="form-control select" name="jenis_kelamin">
                <?php
                    error_reporting(0);
                    if ($data['jenis_kelamin'] == "L") {
                        $lk = "selected=selected";
                    }
                    else if ($data['jenis_kelamin']== "P") {
                        $pr = "selected=selected";
                    }
                ?>
				<option value="L" <?php echo $lk ?>>L</option>
				<option value="P" <?php echo $pr ?>>P</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Status Kepegawaian</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="status_kepegawaian" value="<?php echo $data['status_kepegawaian'] ?>" placeholder="input..">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Provinsi</label>
        <div class="col-md-8">
            <select class="form-control select" name="nama_prov" data-live-search="true" data-size="5">
                <?php
                    $query_prov  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY nama_prov ASC"));
                    foreach($query_prov as $data_prov){
                        if ($data['nama_prov'] == $data_prov['nama_prov']) {
                ?>
                <option value="<?php echo $data_prov['nama_prov'] ?>" selected><?php echo $data_prov['nama_prov'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_prov['nama_prov'] ?>"><?php echo $data_prov['nama_prov'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Kabupaten</label>
        <div class="col-md-8">
            <select class="form-control select" name="nama_kab" data-live-search="true" data-size="5">
                <?php
                    $query_kab  = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota ORDER BY nama_kab ASC"));
                    foreach($query_kab as $data_kab){
                        if ($data['nama_kab'] == $data_kab['nama_kab']) {
                ?>
                <option value="<?php echo $data_kab['nama_kab'] ?>" selected><?php echo $data_kab['nama_kab'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_kab['nama_kab'] ?>"><?php echo $data_kab['nama_kab'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nama Unit</label>
        <div class="col-md-8">
            <select class="form-control select" name="nama_unit" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_fasyankes"));
                    foreach($query as $data_fas){
                        if ($data['nama_unit'] == $data_fas['nama_fasyankes']) {
                ?>
                <option value="<?php echo $data_fas['nama_fasyankes'] ?>" selected><?php echo $data_fas['nama_fasyankes'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_fas['nama_fasyankes'] ?>"><?php echo $data_fas['nama_fasyankes'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Rumpun SDMK</label>
        <div class="col-md-8">
            <select class="form-control select" name="rumpun_sdmk" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk GROUP BY rumpun ASC"));
                    foreach($query as $data_sdmk){
                        if ($data['rumpun_sdmk'] == $data_sdmk['rumpun']) {
                ?>
                <option value="<?php echo $data_sdmk['rumpun'] ?>" selected><?php echo $data_sdmk['rumpun'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_sdmk['rumpun'] ?>"><?php echo $data_sdmk['rumpun'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jenis SDMK</label>
        <div class="col-md-8">
            <select class="form-control select" name="jenis_sdmk" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk ORDER BY nomenklatur ASC"));
                    foreach($query as $data_sdmk2){
                        if ($data['jenis_sdmk'] == $data_sdmk2['nomenklatur']) {
                ?>
                <option value="<?php echo $data_sdmk2['nomenklatur'] ?>" selected><?php echo $data_sdmk2['nomenklatur'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_sdmk2['nomenklatur'] ?>"><?php echo $data_sdmk2['nomenklatur'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Strata Pendidikan</label>
        <div class="col-md-8">
            <select class="form-control select" name="strata_pendidikan" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY kode_strata ASC"));
                    foreach($query as $data_strata){
                        if ($data['strata_pendidikan'] == $data_strata['kode_strata']) {
                ?>
                <option value="<?php echo $data_strata['kode_strata'] ?>" selected><?php echo $data_strata['kode_strata'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_strata['kode_strata'] ?>"><?php echo $data_strata['kode_strata'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Program Studi</label>
        <div class="col-md-8">
            <select class="form-control select" name="program_studi" data-live-search="true" data-size="5">
                <?php
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY nama_dik ASC"));
                    foreach($query as $data_studi){
                        if ($data['program_studi'] == $data_studi['nama_dik']) {
                ?>
                <option value="<?php echo $data_studi['nama_dik'] ?>" selected><?php echo $data_studi['nama_dik'] ?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $data_studi['nama_dik'] ?>"><?php echo $data_studi['nama_dik'] ?></option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<script type="text/javascript" src="js/plugins.js"></script>
