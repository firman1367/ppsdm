<?php
    $query1 = mysqli_query($koneksi,("SELECT SUM(jml_puskesmas) as jml_puskesmas from tb_kab_kota"));
    $data1  = mysqli_fetch_array($query1);

    $query2 = mysqli_query($koneksi,("SELECT SUM(jml_rs) as jml_rs from tb_kab_kota"));
    $data2  = mysqli_fetch_array($query2);
?>
<div class="alert alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <span style="font-size:20px;"><strong>INFORMASI</strong><br/>
        Jumlah Puskesmas keseleruhan adalah <strong><?php echo $data1['jml_puskesmas'] ?></strong><br/>
        Jumlah Rumah Sakit keseleruhan adalah <strong><?php echo $data2['jml_rs'] ?></strong>
    </span>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">GRAFIK</h3>
    </div>
    <div class="panel-body">
        <div id="grafik"></div>
        <table id="datatable" class="table table-bordered table-hover" style="display: none;">
            <thead>
                <tr class="active">
                    <th></th>
                    <th>PUSKESMAS</th>
                    <th>RUMAH SAKIT</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $query  = mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, SUM(b.jml_puskesmas) AS jml_puskesmas, 
                                                      SUM(b.jml_rs) AS jml_rs FROM tb_kab_kota AS b 
                                                      INNER JOIN tb_prov AS a USING(kode_prov)
                                                      GROUP BY a.kode_prov"));
                    foreach($query as $data){
                ?>
                    <tr>
                        <td><?php echo $data['nama_prov'] ?></td>
                        <td><?php echo $data['jml_puskesmas'] ?></td>
                        <td><?php echo $data['jml_rs'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL KODIFIKASI KABUPATEN</h3>
        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
        <div class="pull-right">
            <a href="export/kabupaten.php" class="btn btn-info btn-sm"><span class="fa fa-th-large"></span> Export Excel</a>
            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_kabupaten"><span class="fa fa-pencil"></span> Input Data</a>
        </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data_kabupaten" class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th width="5%" class="text-center">No</th>
                        <th width="10%" class="text-center">Kode Kabupaten</th>
                        <th width="15%" class="text-center">Nama Kabupaten</th>
                        <th width="10%" class="text-center">Nama Provinsi</th>
                        <th width="10%" class="text-center">Jumlah Puskesmas</th>
                        <th width="10%" class="text-center">Jumlah RS</th>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <th class="text-center" width="10%" style="font-size:11px">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- server side -->
    <script src="js/plugins/jquery/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        var dataTable = $('#data_kabupaten').DataTable( {
            "iDisplayLength": 25,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"form/data_kabupaten.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".lookup-error").html("");
                    $("#data_kabupaten").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
                    $("#data_kabupaten_processing").css("display","none");
                }
            }
        } );
    } );
    </script>
    <!-- end server side -->

    <!-- modal edit anggota-->

    <div class="modal fade" id="edit_kabupaten" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit KODIFIKASI KABUPATEN</h4>
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
    <script type="text/javascript">
    $(document).ready(function(){
        $('#edit_kabupaten').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'get',
                url : 'form/edit_kabupaten.php',
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
                        fontSize: '10px',
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
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
            });
        });
    </script>

    <!-- end grafik -->

    <!-- modal -->
    <div class="modal fade" id="create_kabupaten" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="function/create.php?aksi=add_kabupaten" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Kode Kabupaten</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="kode_kab" placeholder="input.." required="required">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Kabupaten</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="nama_kab" placeholder="input.." required="required">
    						</div>
    					</div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Nama Provinsi</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="kode_prov" data-live-search="true" data-size="5">
                                    <?php
                                        $query_prov  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY nama_prov ASC"));
                                        foreach ($query_prov as $data_prov) {
                                    ?>
                                    <option value="<?php echo $data_prov['kode_prov'] ?>"><?php echo $data_prov['nama_prov'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jumlah Puskesmas</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="jml_puskesmas" placeholder="input..">
    						</div>
    					</div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jumlah RS</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="jml_rs" placeholder="input..">
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