<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL KODIFIKASI FASYANKES</h3>
        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
        <div class="pull-right">
            <a href="export/fasyankes.php" class="btn btn-info btn-sm"><span class="fa fa-th-large"></span> Export Excel</a>
            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_fasyankes"><span class="fa fa-pencil"></span> Input Data</a>
        </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data_fasyankes" class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th style="font-size:10px;" width="5%" class="text-center">No</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Kode Fasyankes</th>
                        <th style="font-size:10px;" width="15%" class="text-center">Nama Fasyankes</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Tipe</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Nama Provinsi</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Nama Kabupaten</th>
                        <th style="font-size:10px;" width="10%" class="text-center">Kode Fas OLD</th>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <th class="text-center" width="10%" style="font-size:11px">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody style="font-size:10px;"></tbody>
            </table>
        </div>
    </div>

    <!-- server side -->
    <script src="js/plugins/jquery/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        var dataTable = $('#data_fasyankes').DataTable( {
            "iDisplayLength": 25,
            "info": true,
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"form/data_fasyankes.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".lookup-error").html("");
                    $("#data_fasyankes").append('<tbody class="employee-grid-error"><tr><th colspan="13">No data found in the server</th></tr></tbody>');
                    $("#data_fasyankes_processing").css("display","none");
                }
            }
        } );
    } );
    </script>
    <!-- end server side -->

    <!-- modal edit anggota-->

    <div class="modal fade" id="edit_fasyankes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit KODIFIKASI FASYANKES</h4>
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
        $('#edit_fasyankes').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'get',
                url : 'form/edit_fasyankes.php',
                data :  'rowid='+ rowid,
                success : function(data){
                    $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    });
    </script>

    <!-- end modal -->

    <!-- modal -->
    <div class="modal fade" id="create_fasyankes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="function/create.php?aksi=add_fasyankes" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Kode Fasyankes</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="kode_fasyankes" placeholder="input.." required="required">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Fasyankes</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="nama_fasyankes" placeholder="input.." required="required">
    						</div>
    					</div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tipe</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="tipe" placeholder="input..">
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
    						<label class="col-sm-3 control-label">Nama Kabupaten</label>
                            <div class="col-md-8">
                                <select class="form-control select" name="kode_kab" data-live-search="true" data-size="5">
                                    <?php
                                        $query_kab  = mysqli_query($koneksi,("SELECT * FROM tb_kab_kota ORDER BY nama_kab ASC"));
                                        foreach ($query_kab as $data_kab) {
                                    ?>
                                    <option value="<?php echo $data_kab['kode_kab'] ?>"><?php echo $data_kab['nama_kab'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Fas Old</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="kode_fas_old" placeholder="input..">
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
