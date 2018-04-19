<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $id_sdmk            = $_GET['rowid'];
        $query              = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk WHERE id_sdmk = '$id_sdmk'"));
        $data               = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_sdmk" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="urut" value="<?php echo $data['urut'] ?>">
    <div class="form-group">
        <label class="col-sm-3 control-label">ID SDMK</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="id_sdmk" value="<?php echo $data['id_sdmk'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nomenklatur</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="nomenklatur" value="<?php echo $data['nomenklatur'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Rumpun</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="rumpun" value="<?php echo $data['rumpun'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Jenis Rumpun</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="jenis_rumpun" value="<?php echo $data['rumpun_jenis'] ?>">
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>
<!--<script type="text/javascript" src="js/plugin_date.js"></script>-->
