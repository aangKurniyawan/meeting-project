<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <?php $this->load->view('admin/header_admin');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Add Member
      </h1> -->
      <ol class="breadcrumb">
        <li><a href="<?php  echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <div class="col-md-6">
        <?php 
            if ($this->session->flashdata('cekRoom')){
                echo "<div class='alert alert-danger alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('cekRoom');
                echo "</div>";
            }else if($this->session->flashdata('addRoomSuccess')){
                echo "<div class='alert alert-success alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('addRoomSuccess');
                echo "</div>";
            }else if($this->session->flashdata('addRoomFailed')){
                echo "<div class='alert alert-danger alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('addRoomFailed');
                echo "</div>";
            }else if($this->session->flashdata('editRoomSuccess')){
                echo "<div class='alert alert-success alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('editRoomSuccess');
                echo "</div>";
            }else if($this->session->flashdata('editRoomFailed')){
                echo "<div class='alert alert-danger alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('editRoomFailed');
                echo "</div>";
            }else if($this->session->flashdata('deleteRoomSuccess')){
                echo "<div class='alert alert-success alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('deleteRoomSuccess');
                echo "</div>";
            }else if($this->session->flashdata('deleteRoomFailed')){
                echo "<div class='alert alert-danger alert-dismissible'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                echo $this->session->flashdata('deleteRoomFailed');
                echo "</div>";
            }
         ?>
       </div>
     <section class="content">
   
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Add Room
        </button><br><br>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Room Name</th>
                  <th  width="15%">Edit</th>
                  <th  width="15%">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no = 1;
                  foreach($room as $data){
                ?>
                <tr>
                  <td><?php echo $no++?></td>
                  <td><?php echo $data['nama_ruangan'];?></td>
                  <td>
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-edit<?php echo $data['id_room'];?>">
                      Edit
                    </button>
                  </td>
                  <td>
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $data['id_room'];?>">
                      Delete
                    </button>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th width="5%">No</th>
                  <th>Room Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
  </div>
  <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
    </footer>
  </div>
  <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Room</h4>
          </div>
          <div class="modal-body">
          <form action="<?php echo base_url('add_room');?>" method="post">
            <div class="form-group">
              <label>Room Name</label>
            <div class="input-group">
              <div class="input-group-addon">
              <i class="fa fa-user"></i>
              </div>
                 <input type="text" name="nama_ruangan" required class="form-control" >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php 
    foreach($room as $data){
  ?>
  <div class="modal fade" id="modal-edit<?php echo $data['id_room'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Room</h4>
          </div>
          <div class="modal-body">
          <form action="<?php echo base_url('edit_room');?>" method="post">
            <div class="form-group">
              <label>Room Name</label>
            <div class="input-group">
              <div class="input-group-addon">
              <i class="fa fa-user"></i>
              </div>
                 <input type="hidden" name="id_room" value="<?php echo $data['id_room'];?>" required class="form-control" >
                 <input type="text" name="nama_ruangan" value="<?php echo $data['nama_ruangan'];?>" required class="form-control" >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php 
    foreach($room as $data){
  ?>
  <div class="modal modal-danger fade" id="modal-delete<?php echo $data['id_room'];?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Peringatan !!</h4>
          </div>
          <div class="modal-body">
            <p>Data Yang Sudah Dihapus Tidak Bisa Dilihat Kembali</p>
            <form action="<?php echo base_url('delete_room');?>" method="post">
              <div class="form-group">
                </div>
                   <input type="hidden" name="id_room" value="<?php echo $data['id_room'];?>" required class="form-control" >
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete Data</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2()
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

  })
</script>
</body>
</html>
