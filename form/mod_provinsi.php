<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">TABEL KODIFIKASI PROVINSI</h3>
        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
        <div class="pull-right">
            <a href="export/provinsi.php" class="btn btn-info btn-sm"><span class="fa fa-th-large"></span> Export Excel</a>
            <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_kodeprov"><span class="fa fa-pencil"></span> Input Data</a>
        </div>
        <?php } ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data" class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th width="2%" class="text-center">No</th>
                        <th width="5%" class="text-center">Kode Provinsi</th>
                        <th width="15%" class="text-center">Nama Provinsi</th>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <th class="text-center" width="13%">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $no     = 1;
                        $query  = mysqli_query($koneksi,("SELECT * FROM tb_prov ORDER BY kode_prov ASC"));
                        foreach($query as $data){

                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td class="text-center"><?php echo $data['kode_prov'] ?></td>
                        <td><?php echo $data['nama_prov'] ?></td>
                        <?php if ($_SESSION['level'] == 'superadmin' OR 'admin') { ?>
                        <td>
                            <center>
                                <a href="#edit_kodeprov" data-toggle="modal" data-id="<?php echo $data['kode_prov']; ?>" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                                <a href="function/delete.php?aksi=del_provinsi&kode_prov=<?php echo $data['kode_prov'] ?>" onClick="return confirm('ingin menghapus Kode Provinsi <?php echo $data['kode_prov'] ?>?')" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
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

    <div class="modal fade" id="edit_kodeprov" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Kodifkasi Provinsi</h4>
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
        $('#edit_kodeprov').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'get',
                url : 'form/edit_provinsi.php',
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
    <div class="modal fade" id="create_kodeprov" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="function/create.php?aksi=add_kodeprovinsi" class="form-horizontal" enctype="multipart/form-data" method="post">
                        <div class="form-group">
    						<label class="col-sm-3 control-label">Kode Provinsi</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="kode_prov" placeholder="input.." required="required">
    						</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Provinsi</label>
    						<div class="col-md-8">
    							<input type="text" class="form-control" name="nama_prov" placeholder="input..">
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
