<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Member | Dashboard</title>
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

 <?php $this->load->view('member/header_member');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Undangan Meeting
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <section class="content">
     
      <?php foreach($list as $data){?>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title"><?php  echo $data['tittle_meeting'];?></h3>
        </div>
        <div class="box-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-3 col-md-5">
                <table class="table">
                  <tr>
                    <td width="10%">Judul</td>
                    <td width="10%">:</td>
                    <td> <?php  echo $data['tittle_meeting'];?></td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td> <?php  echo $data['tanggal'];?></td>
                  </tr>
                  <tr>
                    <td>Pemohon</td>
                    <td>:</td>
                    <td> <?php  echo $data['requestor'];?></td>
                  </tr>
                  <tr>
                    <td>Ruangan</td>
                    <td>:</td>
                    <td> <?php  echo $data['nama_ruangan'];?></td>
                  </tr>
                   <tr>
                    <td>Mulai</td>
                    <td>:</td>
                    <td> <?php  echo $data['starting_hour'];?> WIB</td>
                  </tr>
                  <tr>
                    <td>Selesai</td>
                    <td>:</td>
                    <td> <?php  echo $data['ending_hour'];?> WIB</td>
                  </tr>
                  <tr>
                    <td>Konfirmasi</td>
                    <td>:</td>
                    <td> <?php  echo $data['status_konfirmasi'];?></td>
                  </tr>
                </table>
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="row">
                  <div class="col-sm-6">
                   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?php  echo $data['id_schedule'];?>">
                    Bisa Hadir
                  </button>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger<?php  echo $data['id_schedule'];?>">
                      Tidak Bisa Hadir
                    </button>
                  </div><br><br>
                  <div class="col-sm-12">
                    <?php
                        $status_konfirmasi =  $data['status_konfirmasi']; 
                        if($status_konfirmasi == "Bisa Hadir"){
                          echo "<input type='hidden' id='qr-data' value='$data[email]' onchange='generateQR()'>
                          <center><div id='qrcode'></div>
                          $data[email]</center>";
                        }else{
                          echo "<div hidden>
                            <input type='hidden' id='qr-data' value='$data[email]' onchange='generateQR()'>
                            <div id='qrcode' style='background:pink;'></div>
                            <center>$data[email]</center>
                          </div>";
                        }
                     ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
               
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

    </section>
  </div>

  <?php foreach($list as $data){?>
  <div class="modal fade" id="modal-default<?php  echo $data['id_schedule'];?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Konfirmasi Hadir</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('hadir_meeting');?>" method="post">
            <input type="hidden" name="id_user" value="<?php  echo $data['id_user'];?>">
            <input type="hidden" name="id_schedule" value="<?php  echo $data['id_schedule'];?>">
            <input type="hidden" name="status_konfirmasi" value="Bisa Hadir">
          <p>Terima kasih atas konfirmasi yang ada pilih 
            selanjutnya silahkan tekan tombol saya hadir
            dan anda akan mendapatkan akses untuk masuk ke ruangan meeting</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Saya Hadir</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php foreach($list as $data){?>
  <div class="modal modal-danger fade" id="modal-danger<?php  echo $data['id_schedule'];?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Konfirmasi Tidak Bisa Hadir</h4>
        </div>
        <div class="modal-body">
         <form action="<?php echo base_url('hadir_meeting');?>" method="post">
            <input type="hidden" name="id_user" value="<?php  echo $data['id_user'];?>">
            <input type="hidden" name="id_schedule" value="<?php  echo $data['id_schedule'];?>">
            <input type="hidden" name="status_konfirmasi" value="Tidak Bisa Hadir">
          <p>Terima kasih atas konfirmasi yang ada pilih 
            selanjutnya silahkan tekan tombol saya Tidak Hadir</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Tidak Hadir</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
  <?php $this->load->view("member/footer");?>
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

<script src="<?php echo base_url();?>assets/qrcode.min.js"></script>
<script>
  var qrcode = new QRCode("qrcode");
  function makeCode () {      
      var elText = document.getElementById("qr-data");
     
      qrcode.makeCode(elText.value);
  }
  makeCode();
  $("#text").
      on("blur", function () {
          makeCode();
      }).
      on("keydown", function (e) {
          if (e.keyCode == 13) {
              makeCode();
          }
  });
</script>

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
  })
</script>

</body>
</html>
