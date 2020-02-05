<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Detail Schedule</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php $this->load->view('admin/header_admin');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Schedule
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php  echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Detail Schedule</li>
      </ol>
    </section>

    <?php 
      foreach($detailScedule as $data){
    ?>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $data['tittle_meeting'];?>
            <small class="pull-right">Date: <?php echo $data['tanggal'];?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
         
          <address>
            Requestor : <?php echo $data['requestor'];?> <br>
            Room : <?php echo $data['nama_ruangan'];?><br>
            Starting Hour : <?php echo $data['starting_hour'];?> WIB<br>
            Ending Hour  :  <?php echo $data['ending_hour'];?> WIB
          </address>
        </div>
        <!-- /.col -->
        <?php foreach($persentase as $rows){
          
        ?>
        <div class="col-sm-6 invoice-col">
          Total Member : <?php echo $rows['Total'];?><br>
          Status Terdaftar : <?php echo $rows['Terdaftar'];?><br>
          Status Konfirmasi Hadir : <?php echo $rows['Konfirmasi_Hadir'];?><br>
          Status Konfirmasi Tidak Hadir : <?php echo $rows['Tidak_Hadir'];?><br>
          Status Hadir : <?php echo $rows['Hadir'];?><br>
          Persentase : <?php 
            $total = $rows['Total'];
            if($total == 0){
              $total = 1;
            }else{
              $total = $rows['Total'];
            }
            $persen = round($rows['Hadir']/$total * 100);
            echo $persen ;?> %
          <br>
        </div>
        <?php } ?>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
          <b>Status : <?php echo $data['status'];?></b><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
       <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <!--   <li class="active"><a href="#adddMember" data-toggle="tab">Add Member</a></li> -->
              <li class="active"><a href="#memberList" data-toggle="tab">Member Registered</a></li>
              <li><a href="#Confirmation" data-toggle="tab">Confirmation Present</a></li>
              <li><a href="#notpresent" data-toggle="tab">Member Not Present</a></li>
              <li><a href="#memberPresence" data-toggle="tab">Member Present</a></li>
              <li><a href="#meetingResult" data-toggle="tab">Meeting Result</a></li>
            </ul>
            <div class="tab-content">
              <div class="col-md-6">
                <?php 
                    if ($this->session->flashdata('gagalAddAbsen')){
                      echo "<div class='alert alert-danger alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('gagalAddAbsen');
                      echo "</div>";
                    }else if($this->session->flashdata('berhasilAddAbsen')){
                      echo "<div class='alert alert-success alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('berhasilAddAbsen');
                      echo "</div>";
                    }else if($this->session->flashdata('notifBerhasil')){
                      echo "<div class='alert alert-success alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('notifBerhasil');
                      echo "</div>";
                    }else if($this->session->flashdata('notifGagal')){
                      echo "<div class='alert alert-danger alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('notifGagal');
                      echo "</div>";
                    }else if($this->session->flashdata('gagalHadir')){
                      echo "<div class='alert alert-danger alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('gagalHadir');
                      echo "</div>";
                    }else if($this->session->flashdata('berhasilHadir')){
                      echo "<div class='alert alert-success alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('berhasilHadir');
                      echo "</div>";
                    }
                 ?>
                 <?php 
                    if ($this->session->flashdata('notifBerhasil')){
                      echo "<div class='alert alert-success alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('notifBerhasil');
                      echo "</div>";
                    }else if($this->session->flashdata('notifGagal')){
                      echo "<div class='alert alert-danger alert-dismissible'>";
                      echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                      echo "<h4><i class='icon fa fa-ban'></i> Alert!</h4>";
                      echo $this->session->flashdata('notifGagal');
                      echo "</div>";
                    }
                 ?>
               </div>
              <!-- <div class="active tab-pane" id="adddMember">
                 <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                             <tr>
                              <th>No</th>
                              <th>Nama User</th>
                              <th>Jabatan</th>
                              <th>No Telepon</th>
                              <th>Email</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($member as $row){ 
                          ?>
                           <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $row['nama_user'];?></td>
                              <td><?php echo $row['nama_jabatan'];?></td>
                              <td><?php echo $row['no_telepon'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td>
                                <form action="<?php echo base_url('add_absen');?>" method="post">
                                  <input type="hidden" id="email" name="email" value="<?php echo $row['email'];?>">
                                  <input type="hidden" id="tittle_meeting" name="tittle_meeting" value="<?php echo $data['tittle_meeting'];?>">
                                  <input type="hidden" id="id_schdule" name="id_schedule" value="<?php echo $data['id_schedule'];?>">
                                  <input type="hidden" id="id_user" name="id_user" value="<?php echo $row['id_user'];?>">
                                  <button type="submit" id="btn_simpan" class="btn btn-primary">
                                    Daftar Kan
                                  </button>
                                </form>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Jabatan</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
              </div> -->

              <div class="active tab-pane" id="memberList">
                 <div class="row">
                    <div class="col-md-12">
                        <table id="example3" class="table table-bordered table-striped">
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
                            foreach($memberList as $row){ 
                          ?>
                           <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $row['nama_user'];?></td>
                              <td><?php echo $row['nama_jabatan'];?></td>
                              <td><?php echo $row['no_telepon'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td><?php echo $row['status_konfirmasi'];?></td>
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
                  </div>
              </div>

               <div class="tab-pane" id="Confirmation">
                 <div class="row">
                    <div class="col-md-12">
                        <table id="example3" class="table table-bordered table-striped">
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
                            foreach($confirmation as $row){ 
                          ?>
                           <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $row['nama_user'];?></td>
                              <td><?php echo $row['nama_jabatan'];?></td>
                              <td><?php echo $row['no_telepon'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td><?php echo $row['status_konfirmasi'];?></td>
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
                  </div>
              </div>

              <div class="tab-pane" id="notpresent">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example4" class="table table-bordered table-striped">
                          <thead>
                             <tr>
                              <th>No</th>
                              <th>Name User</th>
                              <th>Position</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Information</th>
                            </tr>
                          </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($notpresent as $row){ 
                          ?>
                           <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $row['nama_user'];?></td>
                              <td><?php echo $row['nama_jabatan'];?></td>
                              <td><?php echo $row['no_telepon'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td><?php echo $row['status_konfirmasi'];?></td>
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
                            <th>Information</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
              </div>

              <div class="tab-pane" id="memberPresence">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example4" class="table table-bordered table-striped">
                          <thead>
                             <tr>
                              <th>No</th>
                              <th>Name User</th>
                              <th>Position</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                              <th>Information</th>
                            </tr>
                          </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($present as $row){ 
                          ?>
                           <tr>
                              <td><?php echo $no++?></td>
                              <td><?php echo $row['nama_user'];?></td>
                              <td><?php echo $row['nama_jabatan'];?></td>
                              <td><?php echo $row['no_telepon'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <td><?php echo $row['status_konfirmasi'];?></td>
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
                            <th>Information</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
              </div>

               <?php 
                foreach($result as $data){
              ?>
            <div class="tab-pane" id="meetingResult">
                <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-6">
                    <div class="form-group">
                      <label>Date</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo $data['tanggal'];?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Tittle</label>
                      <input type="text" class="form-control pull-right" value="<?php echo $data['tittle_meeting'];?>" readonly>
                    </div>
                    <br><br>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Budget Set</label>
                      <input type="text" class="form-control" value="<?php echo $data['budget_set'];?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Budget Used</label>
                      <input type="text" class="form-control" value="<?php echo $data['budget_used'];?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <textarea id="editor1" name="editor1" rows="10" cols="80" readonly>
                       <?php echo $data['meeting_notes'];?>
                    </textarea><br>
                  </div>
                  <div class="col-md-10">
                    <div class="input-group date">
                      <!-- <button type="button" class="btn btn-block btn-primary">Submit Meeting Result</button> -->
                    </div>
                  </div>

                  
                </div>
              </div>
              </div>
            </div>
            <?php } ?>
               </div>
            </div>
          </div>
        
    </section>
    <?php } ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    &copy;Universitas Raharja-2020
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
  </footer>
</div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  //Save product
        $('#btn_save').on('click',function(){
            var id_schdule = $('#id_schdule').val();
            var id_user = $('#id_user').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('konfirmasi_hadir');?>",
                dataType : "JSON",
                data : {id_schdule:id_schdule , id_user:id_user},
                success: function(data){
                    $('[name="id_schdule"]').val("");
                    $('[name="id_user"]').val("");
                    //show_product();
                }
            });
            return false;
        });
</script>

<script>
  $(function () {
   
    $('#example1').DataTable()
    $('#example3').DataTable()
    $('#example4').DataTable()
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

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
