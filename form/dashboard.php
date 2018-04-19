<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Total Data</h3>
    </div>
    <div class="panel-body">

        <!-- <meta http-equiv="refresh" content="30" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
        <!-- WIDGETS -->
        <div class="row">
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_sdmk">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(id_sdmk) AS total_sdmk FROM tb_kodesdmk"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_sdmk']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL KODIFIKASI SDMK</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_pendidikan">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(id_dik) AS total_dik FROM tb_kodedik"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_dik']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL KODIFIKASI PENDIDIKAN</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_provinsi">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(kode_prov) AS total_prov FROM tb_prov"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_prov']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL KODIFIKASI PROVINSI</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_kabupaten">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(kode_kab) AS total_kab FROM tb_kab_kota"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_kab']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL KODIFIKASI KABUPATEN</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_fasyankes">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(id_fasyankes) AS total_fasyankes FROM tb_fasyankes"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_fasyankes']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL KODIFIKASI FASYANKES</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-6">
                <a href="?page=mod_sdm">
                    <div class="widget widget-primary widget-no-subtitle">
                        <?php
                            $a      = mysqli_query($koneksi,("SELECT COUNT(id_sdm) AS total_sdm FROM tb_sdm"));
                            $data   = mysqli_fetch_array($a);
                        ?>
                        <div class="informer informer-default" style="margin-bottom:15px;">Data</div>
                        <div class="widget-big-int"><span class="num-count"><?php echo $data['total_sdm']; ?></span></div>
                        <div class="widget-subtitle" style="margin-top:20px;">TOTAL SDM KEMENKES</div>
                        <div><span class="fa fa-tags" style="float:right;"></span></div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END OF WIDGET -->
    </div>
</div>
