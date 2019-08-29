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
          print '<p />';
          if(!empty($tickets)){
            $this->load->view("shared/tickets", $tickets);
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
                </div>
              <div class="modal-body">
              <span id="msg-detail" style="width: 100%;"></span>
                <p>
                    <form id="ticket-form">
                    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ticket
                <small>Log ticket here... </small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">              
                <textarea class="textarea" id="ticket-area" name="ticket_area" placeholder="Type complaint here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>              
            </div>
            <hr />
            <div class="box-body pad">              
                <textarea class="textarea" name="description_ticket_area" placeholder="Add description (optional)"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>              
            </div>

          </div>                         
                    </form>
                </p>
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
