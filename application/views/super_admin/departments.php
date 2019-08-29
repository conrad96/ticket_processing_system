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
        Departments
        <small>Registered departments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Departments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Hover Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Employees</th>
                        <th>Author</th>
                        <th>Dateadded</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(!empty($departments)){
                                foreach($departments as $department){
                                    print '<tr>'. 
                                            '<td>'.$department->ID.'</td>'.
                                            '<td>'.$department->department.'</td>'.
                                            '<td>'.$department->employees.'</td>'.
                                            '<td>'.$department->author.'</td>'.
                                            '<td>'.$department->dateadded.'</td>';
                                    print '</tr>';        
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                        <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Employees</th>
                        <th>Author</th>
                        <th>Dateadded</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
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
