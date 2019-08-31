<?php $this->load->view("shared/header"); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->load->view("shared/top-header"); ?>
  
  <?php $this->load->view("shared/sidebar"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">   
      

        <?php $this->load->view("shared/widgets"); ?>
      </div>
      <div class="row">
        <!-- display tickets activity -->
        <?php 
          $this->load->view("shared/tickets", $tickets);
        ?>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->
<?php $this->load->view("shared/footer.php"); ?>

</body>
</html>
