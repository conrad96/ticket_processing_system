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
        Reports
        <small>export</small>       
      </h1>
     
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">     
    <!-- datatable open/closed -->       
    <div class="row">
        <div class="col-md-6">
            <h2><a href="<?php echo base_url(); ?>index.php/Admin/download_excel" target="_blank"><i class="fa fa-file-excel-o"></i>Download excel</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="<?php echo base_url(); ?>index.php/Admin/download_pdf" target="_blank"><i class="fa fa-file-pdf-o"></i>Download pdf</a></h2>
        </div>
    </div>         
    <div class="row">
        <div class="col-md-12">
        <div class="box">
        <div class="box-header">
        <h3 class="box-title">Open tickets</h3>
        </div>    
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                <th>#</th>
                <th>Ticket</th>
                <th>Description</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Author</th>
                <th>Date posted</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $open_tickets = $this->_tickets->get_all_tickets('open');
                    if(!empty($open_tickets)){
                        foreach($open_tickets as $open){
                            print '<tr>'. 
                                    '<td>'.$open->id.'</td>'.
                                    '<td>'.$open->ticket.'</td>'. 
                                    '<td>'.$open->description.'</td>'.
                                    '<td>'.$open->comments.'</td>'.
                                    '<td>'.$open->views.'</td>'.
                                    '<td>'.$open->author.'</td>'.
                                    '<td>'.$open->dateadded.'</td>'.
                            print '</tr>';        
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Ticket</th>
                <th>Description</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Author</th>
                <th>Date posted</th>
                </tr>
                </tfoot>
            </table>
        </div>    
    </div>    
    <div class="row">
        <div class="col-md-12">
        <div class="box">
        <div class="box-header">
        <h3 class="box-title">Closed tickets</h3>
        </div>    
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                <th>#</th>
                <th>Ticket</th>
                <th>Description</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Author</th>
                <th>Date posted</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    $closed_tickets = $this->_tickets->get_all_tickets('closed');
                    if(!empty($closed_tickets)){
                        foreach($closed_tickets as $close){
                            print '<tr>'. 
                                    '<td>'.$close->id.'</td>'.
                                    '<td>'.$close->ticket.'</td>'. 
                                    '<td>'.$close->description.'</td>'.
                                    '<td>'.$close->comments.'</td>'.
                                    '<td>'.$close->views.'</td>'.
                                    '<td>'.$close->author.'</td>'.
                                    '<td>'.$close->dateadded.'</td>'.
                            print '</tr>';        
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                <th>#</th>
                <th>Ticket</th>
                <th>Description</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Author</th>
                <th>Date posted</th>
                </tr>
                </tfoot>
            </table>
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
