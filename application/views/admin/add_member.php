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
      <h1>
        Data User
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php  echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

   <div class="col-md-6">
        <?php 
            if ($this->session->flashdata('duplicat')){
              echo "<div class='alert alert-danger' role='alert'>";
              echo $this->session->flashdata('duplicat');
              echo "</div>";
            }else if($this->session->flashdata('phone')){
              echo "<div class='alert alert-danger' role='alert'>";
              echo $this->session->flashdata('phone');
              echo "</div>";
            }else if($this->session->flashdata('email')){
              echo "<div class='alert alert-danger' role='alert'>";
              echo $this->session->flashdata('email');
              echo "</div>";
            }else if($this->session->flashdata('success')){
              echo " <div class='alert alert-success' role='alert'>";
              echo $this->session->flashdata('success');
              echo "</div>";
            }else if($this->session->flashdata('successedit')){
              echo " <div class='alert alert-success' role='alert'>";
              echo $this->session->flashdata('successedit');
              echo "</div>";
            }else if($this->session->flashdata('userSuksesDelete')){
              echo " <div class='alert alert-success' role='alert'>";
              echo $this->session->flashdata('userSuksesDelete');
              echo "</div>";
            }else if($this->session->flashdata('userGagalDelete')){
              echo "<div class='alert alert-danger' role='alert'>";
              echo $this->session->flashdata('userGagalDelete');
              echo "</div>";
            }
         ?>
       </div>
     <section class="content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Tambah User
        </button><br><br>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Name User</th>
                  <th>Position</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no = 1;
                  foreach($user as $data){
                ?>
                <tr>
                  <td><?php echo $no++?></td>
                  <td><?php echo $data['nama_user'];?></td>
                  <td><?php echo $data['nama_jabatan'];?></td>
                  <td><?php echo $data['no_telepon'];?></td>
                  <td><?php echo $data['email'];?></td>
                  <td>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-detail<?php echo $data['id_user'];?>">Detail</button> ||
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-edit<?php echo $data['id_user'];?>">Edit</button> || 
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete<?php echo $data['id_user'];?>">Delete</button>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                 <tr>
                  <th>No</th>
                  <th>Name User</th>
                  <th>Position</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Action</th>
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
              <h4 class="modal-title">Tambah User</h4>
            </div>
              <div class="modal-body">
               <form action="<?php echo base_url('user_add');?>" method="post">
                <div class="form-group">
                  <label>Name</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="text" name="nama_user" required class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label>Position</label>
                    <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                      <option>-Position Option-</option>
                      <?php foreach($jabatan as $row ){?>
                      <option value="<?php echo $row['id_jabatan'];?>"><?php echo $row['nama_jabatan'];?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" name="no_telepon" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="email" name="email" required class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                    <input type="password" name="password" required class="form-control">
                  </div>
                </div>
               <div class="form-group">
                  <label>Level User</label>
                    <select name="level" class="form-control" style="width: 100%;">
                      <option selected="selected">-Pilih Level-</option>
                      <option value="Admin">Admin</option>
                      <option value="Dosen">Dosen</option>
                      <option value="Notulen">Notulen</option>
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <?php 
          foreach($user as $data){
        ?>
        <div class="modal fade" id="modal-detail<?php echo $data['id_user'];?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Detail User</h4>
                </div>
                <div class="modal-body">
                <form action="#" method="post">
                  <div class="form-group">
                  <label>Position Name</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                    </div>
                       <input type="hidden" name="id_jabatan" value="<?php echo $data['id_user'];?>" required class="form-control" >
                       <input type="text" name="nama_jabatan" value="<?php echo $data['nama_user'];?>" required class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Position</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa   fa-users"></i>
                    </div>
                       <input type="text" name="nama_jabatan" value="<?php echo $data['nama_jabatan'];?>" required class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                  <label>No Telepon</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                    </div>
                       <input type="text" name="nama_jabatan" value="<?php echo $data['no_telepon'];?>" required class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-at"></i>
                    </div>
                       <input type="text" name="nama_jabatan" value="<?php echo $data['email'];?>" required class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                    </div>
                       <input type="password" name="nama_jabatan" value="<?php echo $data['password'];?>" required class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Level</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                    </div>
                       <input type="text" name="nama_jabatan" value="<?php echo $data['level'];?>" required class="form-control" >
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                 <!--  <button type="submit" class="btn btn-primary">Save changes</button> -->
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>


    <?php 
      foreach($user as $data){
    ?>
    <div class="modal fade" id="modal-edit<?php echo $data['id_user'];?>">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit User</h4>
            </div>
              <div class="modal-body">
               <form action="<?php echo base_url('user_edit');?>" method="post">
                <div class="form-group">
                  <label>Name</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                    <input type="hidden" name="id_user" value="<?php echo $data['id_user'];?>" required class="form-control" >
                    <input type="text" name="nama_user" value="<?php echo $data['nama_user'];?>" required class="form-control" >
                  </div>
                </div>
                <div class="form-group">
                  <label>Position</label>
                    <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                      <option value="<?php echo $data['id_jabatan'];?>"><?php echo $data['nama_jabatan'];?></option>
                      <?php foreach($jabatan as $row ){?>
                      <option value="<?php echo $row['id_jabatan'];?>"><?php echo $row['nama_jabatan'];?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" name="no_telepon" value="<?php echo $data['no_telepon'];?>" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-laptop"></i>
                  </div>
                    <input type="email" name="email" value="<?php echo $data['email'];?>" required class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </div>
                    <input type="password" name="password" value="<?php echo $data['password'];?>" required class="form-control">
                  </div>
                </div>
               <div class="form-group">
                  <label>Level User</label>
                    <select name="level" class="form-control" style="width: 100%;">
                      <option value="Admin"  <?php if ($data['level'] == 'Admin')  echo 'selected'; else echo '';?>>Admin</option>
                      <option value="Dosen"  <?php if ($data['level'] == 'Dosen')  echo 'selected'; else echo '';?>>Dosen</option>
                      <option value="Notulen" <?php if ($data['level'] == 'Notulen')  echo 'selected'; else echo '';?>>Notulen</option>
                    </select>
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
          foreach($user as $data){
        ?>
        <div class="modal modal-danger fade" id="modal-delete<?php echo $data['id_user'];?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Peringatan !!</h4>
                </div>
                <div class="modal-body">
                  <p>Data Yang Sudah Dihapus Tidak Bisa Dilihat Kembali</p>
                  <form action="<?php echo base_url('delete_user');?>" method="post">
                    <div class="form-group">
                      </div>
                         <input type="hidden" name="id_user" value="<?php echo $data['id_user'];?>" required class="form-control" >
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
