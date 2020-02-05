<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-MEETING</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs"><?php echo $this->session->userdata("nama_user"); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               <!--  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                <p>
                  <?php echo $this->session->userdata("nama_user"); ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php  echo base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active  menu-open">
          <a href="<?php  echo base_url('dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>  <span>Add</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php  echo base_url('add_user');?>"><i class="fa fa-circle-o"></i> Add User </a></li>
            <li><a href="<?php  echo base_url('add_schedule');?>"><i class="fa fa-circle-o"></i>Add Schedule </a></li>
            <li><a href="<?php  echo base_url('menu_jabatan');?>"><i class="fa fa-circle-o"></i> Add Position </a></li>
            <li><a href="<?php  echo base_url('menu_room');?>"><i class="fa fa-circle-o"></i> Add Room </a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>View</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php  echo base_url('data_member');?>"><i class="fa fa-circle-o"></i> Member </a></li>
            <li><a href="<?php  echo base_url('status');?>"><i class="fa fa-circle-o"></i> Status </a></li>
            <li><a href="<?php  echo base_url('data_schedule');?>"><i class="fa fa-circle-o"></i> Schedule </a></li>
          </ul>
        </li> -->
        <li>
          <a href="<?php  echo base_url('absent');?>">
            <i class="fa fa-share"></i> <span>Absent</span>
          </a>
        </li>
        <li>
          <a href="<?php  echo base_url('meeting_list');?>">
           <i class="fa fa-circle-o"></i> <span>Meeting Result</span>
          </a>
        </li>
        <li>
          <a href="<?php  echo base_url('meeting_report');?>">
           <i class="fa fa-book"></i> <span>Report</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>