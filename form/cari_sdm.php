<?php

    $prov           = $_POST['nama_prov'];
    $rumpun         = $_POST['rumpun_sdmk'];
    $kode_strata    = $_POST['strata_pendidikan'];
    //$nama_dik       = $_POST['program_studi'];

    $query      = mysqli_query($koneksi,("SELECT * FROM tb_sdm WHERE nama_prov = '$prov' AND rumpun_sdmk = '$rumpun' OR strata_pendidikan = '$kode_strata'"));
    $data_get   = mysqli_fetch_array($query);

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">GRAFIK</h3>
    </div>
    <div class="panel-body">
        <div id="grafik"></div>
        <table id="datatable" class="table table-bordered table-hover" style="display: #;">
            <thead>
                <tr class="active">
                    <th></th>
                    <th>PROGRAM STUDI</th>
                    <th>STRATA PENDIDIKAN</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query_grafik  = mysqli_query($koneksi,("SELECT strata_pendidikan, COUNT(strata_pendidikan) AS total_strata, program_studi, COUNT(program_studi) AS total_studi FROM tb_sdm
                                                             WHERE nama_prov = '$prov' AND rumpun_sdmk = '$rumpun' OR strata_pendidikan = '$kode_strata'
                                                             GROUP BY program_studi"));
                    foreach($query_grafik as $data){
                ?>
                    <tr>
                        <td><?php echo $data['program_studi'] ?></td>
                        <td><?php echo $data['total_studi'] ?></td>
                        <td><?php echo $data['total_strata'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="alert alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>
        <span style="font-size:12px;">INFORMASI<br/>
            *Nama Provinsi dan Rumpun SDMK wajib diisi
        </span>
    </strong>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">FILTER PENCARIAN</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nama Provinsi</label>
                <div class="col-md-8">
                    <select class="form-control select" name="nama_prov" data-live-search="true" data-size="5" required="required">
                        <option value="">-- Pilih --</option>
                        <?php
                            $query_prov  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY nama_prov ASC"));
                            foreach ($query_prov as $data_prov) {
                        ?>
                        <option value="<?php echo $data_prov['nama_prov'] ?>"><?php echo $data_prov['nama_prov'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Rumpun SDMK</label>
                <div class="col-md-8">
                    <select class="form-control select" name="rumpun_sdmk" data-live-search="true" data-size="5" required="required">
                        <option value="">-- Pilih --</option>
                        <?php
                            $query_sdmk  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk GROUP BY rumpun ASC"));
                            foreach ($query_sdmk as $data_sdmk) {
                        ?>
                        <option value="<?php echo $data_sdmk['rumpun'] ?>"><?php echo $data_sdmk['rumpun'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Strata Pendidikan</label>
                <div class="col-md-8">
                    <select class="form-control select" name="strata_pendidikan" data-live-search="true" data-size="5">
                        <option value="">-- Pilih --</option>
                        <?php
                            $query_strata  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY kode_strata ASC"));
                            foreach ($query_strata as $data_strata) {
                        ?>
                        <option value="<?php echo $data_strata['kode_strata'] ?>"><?php echo $data_strata['kode_strata'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!--<div class="form-group">
                <label class="col-sm-3 control-label">Program Studi</label>
                <div class="col-md-8">
                    <select class="form-control select" name="program_studi" data-live-search="true" data-size="5">
                        <option value="">-- Pilih --</option>
                        <?php
                            $query_studi  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY nama_dik ASC"));
                            foreach ($query_studi as $data_studi) {
                        ?>
                        <option value="<?php echo $data_studi['nama_dik'] ?>"><?php echo $data_studi['nama_dik'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>-->
            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" name="cari-sdm" class="btn btn-primary btn-flat">Submit</button>
                    <a href="?page=mod_sdm" class="btn btn-primary btn-flat">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="alert alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>
        <span style="font-size:12px;">PENCARIAN<br/>
            <?php echo $prov ?>, <?php echo $rumpun ?>, <?php echo $kode_strata ?>
        </span>
    </strong>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL SDM</h3>
        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
        <div class="pull-right">
            <a href="export/sdm.php" class="btn btn-info btn-sm"><span class="fa fa-th-large"></span> Export Excel</a>
            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_sdm"><span class="fa fa-pencil"></span> Input Data</a>
        </div>
        <?php } ?>
    </div>
    <div class="panel-body" style="overflow-x:scroll;">
        <div class="table-responsive" style="width:1500px;padding-right: 20px;">
            <table id="data" class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th style="font-size:10px;" width="2%" class="text-center">No</th>
                        <th style="font-size:10px;" width="4%" class="text-center">ID SDM</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Nama</th>
                        <th style="font-size:10px;" width="3%" class="text-center">Kelamin</th>
                        <th style="font-size:10px;" width="5%" class="text-center">Status Kepegawaian</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Provinsi</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Kabupaten</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Unit</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Rumpun SDMK</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Jenis SDMK</th>
                        <th style="font-size:10px;" width="5%" class="text-center">Strata Pendidikan</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Program Studi</th>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <th class="text-center" width="10%" style="font-size:11px">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $no     = 1;
                        foreach($query as $data){

                    ?>
                    <tr style="font-size:10px;">
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $data['id_sdm'] ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td class="text-center"><?php echo $data['jenis_kelamin'] ?></td>
                        <td><?php echo $data['status_kepegawaian'] ?></td>
                        <td><?php echo $data['nama_prov'] ?></td>
                        <td><?php echo $data['nama_kab'] ?></td>
                        <td><?php echo $data['nama_unit'] ?></td>
                        <td><?php echo $data['rumpun_sdmk'] ?></td>
                        <td><?php echo $data['jenis_sdmk'] ?></td>
                        <td><?php echo $data['strata_pendidikan'] ?></td>
                        <td><?php echo $data['program_studi'] ?></td>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <td>
                            <center>
                                <a href="#edit_sdm" data-toggle="modal" data-id="<?php echo $data['id_sdm']; ?>" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                                <a href="function/delete.php?aksi=del_sdm&id_sdm=<?php echo $data['id_sdm'] ?>" onClick="return confirm('ingin menghapus ID SDM <?php echo $data['id_sdm'] ?>?')" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
                            </center>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- modal edit anggota-->

    <div class="modal fade" id="edit_sdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit SDM</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal  -->
    <script src="js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#edit_sdm').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'get',
                url : 'form/edit_sdm.php',
                data :  'rowid='+ rowid,
                success : function(data){
                    $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });
    </script>

    <!-- end modal -->

    <!-- grafik -->

    <script type="text/javascript">
        var chart1; // globally available
        $(document).ready(function() {
            chart1 = new Highcharts.Chart({
                data: {
                    table: 'datatable'
                },
                chart: {
                    renderTo: 'grafik',
                    type: 'column'
                },
                title: {
                    text: 'Grafik Puskesmas Dan Rumah Sakit Berdasarkan Provinsi'
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}</td>' + '<td> : </td>' +
                        '<td style="padding:0"><b>{point.y:.f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',
                    align: 'center',
                    format: '{point.y:.f}', // one decimal
                    y: 3, // 10 pixels down from the top
                    style: {
                        fontSize: '15px',
                        fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                {
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',
                    align: 'center',
                    format: '{point.y:.f}', // one decimal
                    y: 3, // 10 pixels down from the top
                    style: {
                        fontSize: '15px',
                        fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
    </script>

    <!-- end grafik -->

    <!-- modal -->
    <div class="modal fade" id="create_sdm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="function/create.php?aksi=add_sdm" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="form-group">
    						<label class="col-sm-3 control-label">ID SDM</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="id_sdm" placeholder="input.." required="required">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="nama" placeholder="input.." required="required">
    						</div>
    					</div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kelamin</label>
    						<div class="col-md-8">
    							<select class="form-control select" name="jenis_kelamin">
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
    						</div>
    					</div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status Kepegawaian</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="status_kepegawaian" placeholder="input..">
    						</div>
    					</div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Nama Provinsi</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="nama_prov" data-live-search="true" data-size="5">
                                    <?php
                                        $query_prov  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY nama_prov ASC"));
                                        foreach ($query_prov as $data_prov) {
                                    ?>
                                    <option value="<?php echo $data_prov['nama_prov'] ?>"><?php echo $data_prov['nama_prov'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Nama Kabupaten</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="nama_kab" data-live-search="true" data-size="5">
                                    <?php
                                        $query_kab  = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota ORDER BY nama_kab ASC"));
                                        foreach ($query_kab as $data_kab) {
                                    ?>
                                    <option value="<?php echo $data_kab['nama_kab'] ?>"><?php echo $data_kab['nama_kab'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Nama Unit</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="nama_unit" data-live-search="true" data-size="5">
                                    <?php
                                        $query_fas  = mysqli_query($koneksi,("SELECT * FROM tb_fasyankes"));
                                        foreach ($query_fas as $data_fas) {
                                    ?>
                                    <option value="<?php echo $data_fas['nama_fasyankes'] ?>"><?php echo $data_fas['nama_fasyankes'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Rumpun SDMK</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="rumpun_sdmk" data-live-search="true" data-size="5">
                                    <?php
                                        $query_sdmk  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk GROUP BY rumpun ASC"));
                                        foreach ($query_sdmk as $data_sdmk) {
                                    ?>
                                    <option value="<?php echo $data_sdmk['rumpun'] ?>"><?php echo $data_sdmk['rumpun'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Jenis SDMK</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="jenis_sdmk" data-live-search="true" data-size="5">
                                    <?php
                                        $query_sdmk2  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk ORDER BY nomenklatur ASC"));
                                        foreach ($query_sdmk2 as $data_sdmk2) {
                                    ?>
                                    <option value="<?php echo $data_sdmk2['nomenklatur'] ?>"><?php echo $data_sdmk2['nomenklatur'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Strata Pendidikan</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="strata_pendidikan" data-live-search="true" data-size="5">
                                    <?php
                                        $query_strata  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY kode_strata ASC"));
                                        foreach ($query_strata as $data_strata) {
                                    ?>
                                    <option value="<?php echo $data_strata['kode_strata'] ?>"><?php echo $data_strata['kode_strata'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Program Studi</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="program_studi" data-live-search="true" data-size="5">
                                    <?php
                                        $query_studi  = mysqli_query($koneksi,("SELECT * FROM tb_kodedik GROUP BY nama_dik ASC"));
                                        foreach ($query_studi as $data_studi) {
                                    ?>
                                    <option value="<?php echo $data_studi['nama_dik'] ?>"><?php echo $data_studi['nama_dik'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer" style="text-align:left">
                    <button type="submit" class="btn btn-default btn-sm" style="margin-right:5px;">Submit</button>
                    <button type="reset" class="btn btn-default btn-sm">Reset</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>
