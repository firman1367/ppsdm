<?php

    $host   = "localhost";
    $user   = "root";
    $pw     = "";
    $db     = "db_kemenkes";

    $koneksi    = mysqli_connect($host,$user,$pw);
    $select     = mysqli_select_db($koneksi,$db);

    if (isset($_GET['rowid'])) {
        $id_admin           = $_GET['rowid'];
        $query              = mysqli_query($koneksi,("SELECT * FROM tb_admin WHERE id_admin = '$id_admin'"));
        $data               = mysqli_fetch_array($query);
    }
?>
<form role="form" action="function/edit.php?aksi=edit_admin" class="form-horizontal" enctype="multipart/form-data" method="post">
    <input type="hidden" class="form-control" name="id_admin" value="<?php echo $data['id_admin'] ?>">
    <div class="form-group">
        <label class="col-md-3 control-label">Fullname</label>
        <div class="col-md-8">
            <input class="form-control" type="text" name="fullname" value="<?php echo $data['fullname'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Username</label>
        <div class="col-md-8">
            <input class="form-control" type="text" name="username" value="<?php echo $data['username'] ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Password</label>
        <div class="col-md-8">
            <input class="form-control" type="password" name="password" placeholder="input password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">New Password</label>
        <div class="col-md-8">
            <input class="form-control" type="password" name="password_baru" placeholder="input password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Confirm Password</label>
        <div class="col-md-8">
            <input class="form-control" type="password" name="password_conf" placeholder="input password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Authority</label>
        <div class="col-md-8">
            <select class="form-control select" name="level" data-live-search="true">
                <?php
                    error_reporting(0);
                    if ($data['level']=="superadmin") {
                        $a = "selected=selected";
                    }
                    else if ($data['level']=="admin") {
                        $b = "selected=selected";
                    }
                ?>
				<option value="superadmin" <?php echo $a ?>>superadmin</option>
				<option value="admin" <?php echo $b ?>>admin</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Status</label>
        <div class="col-md-8">
            <select class="form-control select" name="status" data-live-search="true">
                <?php
                    error_reporting(0);
                    if ($data['status']=="active") {
                        $e = "selected=selected";
                    }
                    else if ($data['status']=="block") {
                        $f = "selected=selected";
                    }
                ?>
				<option value="active" <?php echo $e ?>>active</option>
				<option value="block" <?php echo $f ?>>block</option>
            </select>
        </div>
    </div>
    <div class="update-footer" style="text-align:left">
        <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">update</button>
    </div>
</form>

<script type="text/javascript" src="js/plugins.js"></script>
