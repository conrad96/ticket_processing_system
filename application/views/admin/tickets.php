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
        Tickets
        <small>view tickets</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>index.php/admin/index"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">          
          <?php 
          //check permission
          if(!empty($this->session->permissions)){
            $permissions = explode(',', str_replace(' ', '_', strtolower($this->session->permissions)));
            if(!empty($permissions)){
                foreach($permissions as $permission){
                    if($permission == 'write_ticket'){
                        print '<br>'. 
                                  '<button class="btn btn-success pull-right" data-toggle="modal" data-target="#addTicket" data-backdrop="static"><i class="fa fa-pencil"></i>Write ticket</button>'. 
                        '</br><p style="paddin-bottom: 10px;" />';
                    }
                }
            }
          }

          if(!empty($tickets)){

          }else{
              print '
              <div class="alert alert-warning">
                <span>Oh snap!. no tickets created</span>
              </div>
              ';
          }
          ?>
          <!-- Start modal -->
          <div class="modal fade" id="addTicket">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Write ticket</h4>
                <div class="pull-right"><span id="msg-detail"></span></div>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="loader"></span>
                <button type="button" id="write-ticket" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
          <!-- End modal-->
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
