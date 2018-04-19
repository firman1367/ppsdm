<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">GRAFIK SDMK</h3>
    </div>
    <div class="panel-body">
        <div id="grafik"></div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL KODIFIKASI SDMK</h3>
        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
        <div class="pull-right">
            <a href="export/sdmk.php" class="btn btn-info btn-sm"><span class="fa fa-th-large"></span> Export Excel</a>
            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_sdmk"><span class="fa fa-pencil"></span> Input Data</a>
        </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data" class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th width="2%" class="text-center">No</th>
                        <th width="5%" class="text-center">ID SDMK</th>
                        <th width="20%"class="text-center">Nomenklatur</th>
                        <th width="10%" class="text-center">Rumpun</th>
                        <th width="10%" class="text-center">Jenis Rumpun</th>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <th class="text-center" width="13%" style="font-size:11px">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $no     = 1;
                        $query  = mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk ORDER BY id_sdmk ASC"));
                        foreach($query as $data){

                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $data['id_sdmk'] ?></td>
                        <td><?php echo $data['nomenklatur'] ?></td>
                        <td><?php echo $data['rumpun'] ?></td>
                        <td><?php echo $data['rumpun_jenis'] ?></td>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <td>
                            <center>
                                <a href="#edit_sdmk" data-toggle="modal" data-id="<?php echo $data['id_sdmk']; ?>" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                                <a href="function/delete.php?aksi=del_sdmk&id_sdmk=<?php echo $data['id_sdmk'] ?>" onClick="return confirm('ingin menghapus ID SDMK <?php echo $data['id_sdmk'] ?>?')" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
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

    <div class="modal fade" id="edit_sdmk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Kodifikasi SDMK</h4>
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
        $('#edit_sdmk').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'get',
                url : 'form/edit_sdmk.php',
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
                chart: {
                    renderTo: 'grafik',
                    type: 'column',
                },
                title: {
                    text: 'Grafik Rumpun '
                },
                xAxis: {
                    categories: ['Rumpun']
                },
                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                series:
                [
                    <?php
                        $query   = mysqli_query($koneksi,("SELECT rumpun, COUNT(rumpun) AS total_rumpun FROM tb_kodesdmk GROUP BY rumpun"));
                        while( $data = mysqli_fetch_array( $query))
                        {
                            $total  = $data['total_rumpun'];
                            $rumpun = $data['rumpun'];
                    ?>
                        {
                            name: "<?php echo $rumpun; ?>",
                            data: [<?php echo $total; ?>]
                        },
                    <?php
                        }
                    ?>
                ],
                credits: {
                    enabled: false
                },
            });
        });
    </script>

    <!-- end grafik -->

    <!-- modal -->
    <div class="modal fade" id="create_sdmk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="function/create.php?aksi=add_sdmk" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="form-group">
    						<label class="col-sm-3 control-label">ID SDMK</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="id_sdmk" placeholder="input.." required="required">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nomenklatur</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="nomenklatur" placeholder="input.." required="required">
    						</div>
    					</div>
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Rumpun</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="rumpun" placeholder="input..">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jenis Rumpun</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="jenis_rumpun" placeholder="input..">
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
