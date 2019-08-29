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
            foreach($tickets as $ticket){
                print '
                <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="'.base_url().'assets/dist/img/pic.png" alt="User Image">
                <span class="username"><a href="#">'.$this->session->names.'</a></span>
                <span class="description">Posted at '.$ticket->dateadded.'</span>
              </div>
              <div class="box-tools">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>              
            </div>
            <div class="box-body">
                <p>
                    '.$ticket->ticket.'
                </p>
              <div class="attachment-block clearfix">
                <img class="attachment-img" src="'.base_url().'assets/gifs/diamond.gif" alt="Attachment Image">

                <div class="attachment-pushed">
                  <h4 class="attachment-heading"><a href="#">Description:</a></h4>

                  <div class="attachment-text">
                    '.$ticket->description.'
                  </div>                  
                </div>
              </div>
              <!--
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
              <span class="pull-right text-muted">45 likes - 2 comments</span>
              -->
            </div>
            <div class="box-footer box-comments">
              <!-- commenter come here -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form id="post-comment-form">
                <img class="img-responsive img-circle img-sm" src="'.base_url().'assets/dist/img/pic.png" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>';
            }
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
