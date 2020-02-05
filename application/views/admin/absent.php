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
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

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
      <h1>
        Add Schedule
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php  echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <div class="col-md-6">
        <?php 
            if ($this->session->flashdata('duplicatSchedule2')){
              echo "<div class='alert alert-danger alert-dismissible'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
              echo $this->session->flashdata('duplicatSchedule2');
              echo "</div>";
            }else if($this->session->flashdata('simpanSchdule')){
              echo "<div class='alert alert-success alert-dismissible'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
              echo $this->session->flashdata('simpanSchdule');
              echo "</div>";
            }else if($this->session->flashdata('gagalSchedule')){
              echo "<div class='alert alert-danger alert-dismissible'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
              echo $this->session->flashdata('gagalSchedule');
              echo "</div>";
            }else if($this->session->flashdata('berhasilDeleteSchedule')){
              echo "<div class='alert alert-success alert-dismissible'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
              echo $this->session->flashdata('berhasilDeleteSchedule');
              echo "</div>";
            }else if($this->session->flashdata('gagalDeleteSchedule')){
              echo "<div class='alert alert-danger alert-dismissible'>";
              echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
              echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
              echo $this->session->flashdata('gagalDeleteSchedule');
              echo "</div>";
            }
         ?>
       </div>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Schedule List</h3>
            </div>
             <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Requestor</th>
                  <th>Tittle Of Meeting</th>
                  <th>Room</th>
                  <th>Starting</th>
                  <th>Ending</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $no = 1;
                  foreach($schedule as $data){ 
                ?>
                <tr>
                  <td><?php echo $no++?></td>
                  <td><?php echo $data['tanggal'];?></td>
                  <td><?php echo $data['requestor'];?></td>
                  <td><?php echo $data['tittle_meeting'];?></td>
                  <td><?php echo $data['nama_ruangan'];?></td>
                  <td><?php echo $data['starting_hour'];?></td>
                  <td><?php echo $data['ending_hour'];?></td>
                  <th><?php echo $data['status'];?></th>
                  <td>
                    <a href="<?php echo base_url('absent_list/');?><?php echo $data['id_schedule'];?>">
                      <button type="submit" class="btn btn-primary" style="padding:1px 6px;">Detail
                      </button>
                    </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Requestor</th>
                  <th>Tittle Of Meeting</th>
                  <th>Room</th>
                  <th>Starting</th>
                  <th>Ending</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

       
 
        <?php 
          foreach($schedule as $data){
        ?>
        <div class="modal modal-danger fade" id="modal-delete<?php echo $data['id_schedule'];?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Peringatan !!</h4>
                </div>
                <div class="modal-body">
                  <p>Data Yang Sudah Dihapus Tidak Bisa Dilihat Kembali</p>
                  <form action="<?php echo base_url('delete_schdeule');?>" method="post">
                    <div class="form-group">
                      </div>
                         <input type="hidden" name="id_schedule" value="<?php echo $data['id_schedule'];?>" required class="form-control" >
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Hapus Data</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php }?>
          
        <?php
          foreach($schedule as $data){ 
        ?>
        <div class="modal fade" id="modal-edit<?php echo $data['id_schedule'];?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Schedule</h4>
              </div>
                <div class="modal-body">
                  <form action="<?php echo base_url('schedule_add');?>" method="post">
                     <div class="box-body">
                    <div class="form-group">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" placeholder="Date">
                    </div>
                  </div>
                    <div class="form-group">
                      <input type="text" name="requestor" class="form-control" id="exampleInputPassword1" placeholder="Meeting Requestor">
                    </div>
                    <div class="form-group">
                      <input type="text" name="tittle_meeting" class="form-control" id="exampleInputPassword1" placeholder="Tittle Of Meeting">
                    </div>
                    <div class="form-group">
                      <select name="room" class="form-control">
                        <option value="1">Room 1</option>
                        <option value="2">Room 2</option>
                        <option value="3">Room 3</option>
                        <option value="4">Room 4</option>
                        <option value="5">Room 5</option>
                      </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <label>Starting Hour</label>
                          <div class="form-group">
                          <input type="time" name="starting_hour" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                         <div class="col-md-6">
                          <label>Ending Hour</label>
                          <div class="form-group">
                          <input type="time" name="ending_hour" class="form-control" id="exampleInputPassword1">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Schedule</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>

       
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Schedule</h4>
          </div>
            <div class="modal-body">
              <form action="<?php echo base_url('schedule_add');?>" method="post">
                 <div class="box-body">
                <div class="form-group">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" placeholder="Date">
                </div>
              </div>
                <div class="form-group">
                  <input type="text" name="requestor" class="form-control" id="exampleInputPassword1" placeholder="Meeting Requestor">
                </div>
                <div class="form-group">
                  <input type="text" name="tittle_meeting" class="form-control" id="exampleInputPassword1" placeholder="Tittle Of Meeting">
                </div>
                <div class="form-group">
                  <select name="room" class="form-control">
                    <option value="1">Room 1</option>
                    <option value="2">Room 2</option>
                    <option value="3">Room 3</option>
                    <option value="4">Room 4</option>
                    <option value="5">Room 5</option>
                  </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <label>Starting Hour</label>
                      <div class="form-group">
                      <input type="time" name="starting_hour" class="form-control" id="exampleInputPassword1" >
                      </div>
                    </div>
                     <div class="col-md-6">
                      <label>Ending Hour</label>
                      <div class="form-group">
                      <input type="time" name="ending_hour" class="form-control" id="exampleInputPassword1">
                      </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Schedule</button>
              </div>
              </form>
            </div>
          </div>
        </div>
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
  </footer>
</div>
        
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
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>
</body>
</html>
