<div class="panel panel-primary">
<div class="panel-heading">
    <h3 class="panel-title">Tabel Administrator</h3>
    <?php if ($_SESSION['level'] == 'superadmin') { ?>
    <div class="pull-right">
        <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#create_admin"><span class="fa fa-pencil"></span> Input Data</a>
    </div>
    <?php } ?>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="active">
                    <th class="text-center">No.</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Fullname</th>
                    <th class="text-center">Authority</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Registered</th>
                    <?php if ($_SESSION['level'] == 'superadmin') { ?>
                    <th class="text-center">Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php

                    $no     = 1;
                    $query  = mysqli_query($koneksi,("SELECT * FROM tb_admin ORDER BY fullname ASC"));
                    foreach($query as $data){

                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td><?php echo $data['username'] ?></td>
                    <td><?php echo $data['fullname'] ?></td>
                    <td><?php echo $data['level'] ?></td>
                    <td><?php echo $data['status'] ?></td>
                    <td class="text-center"><?php echo $data['registered'] ?></td>
                    <?php if ($_SESSION['level'] == 'superadmin') { ?>
                    <td>
                        <center>
                            <a href="#edit_admin" data-toggle="modal" data-id="<?php echo $data['id_admin']; ?>" style="font-size:15px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                            <a href="function/delete.php?aksi=del_admin&id_admin=<?php echo $data['id_admin'] ?>" onClick="return confirm('are you sure for delete it?')" style="font-size:15px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
                        </center>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal edit employes -->

<div class="modal fade" id="edit_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Data Administrator</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal employes -->
<script src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#edit_admin').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'get',
            url : 'form/edit_admin.php',
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
<div class="modal fade" id="create_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus"></i> Input Data</h3>
            </div>
            <div class="modal-body">
                <form role="form" action="function/create.php?aksi=add_admin" class="form-horizontal" enctype="multipart/form-data" method="post">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Fullname</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="fullname" placeholder="input.." required="required">
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Username</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="username" placeholder="input.." required="required">
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Password</label>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" placeholder="input.." required="required">
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Authority</label>
						<div class="col-md-8">
							<select class="form-control select" name="level" data-live-search="true">
                                <option>superadmin</option>
                                <option>admin</option>
                            </select>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Status</label>
						<div class="col-md-8">
                            <select class="form-control select" name="status" data-live-search="true">
                                <option>active</option>
                                <option>block</option>
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
