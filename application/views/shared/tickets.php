<?php 
    if(!empty($tickets)){
        foreach($tickets as $ticket){
?>
<!-- view log modal -->
<div class="modal fade" id="view-log-<?php echo $ticket->id; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">View ticket activity</h4>
                </div>
              <div class="modal-body">              
                <p>
                <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Comments</a></li>
              <li><a href="#tab_2" data-toggle="tab">Viewers</a></li>                                          
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <b>Comments activity:</b>
                 <!-- user posted comment at "" -->
                  <?php 
                  $logs = $this->_tickets->log($ticket->id);
                  if(!empty($logs)){
                    foreach($logs as $log){
                      print '<p />'. $log->author.' ['.$log->role.'] '.$log->status.' this ticket at '.$log->dateadded.'<br />';
                    }
                  }
                  ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <?php 
                  $views = $this->_tickets->viewers($ticket->id);
                  if(!empty($views)){
                    foreach($views as $view){
                      print '<p />'.$view->author.' : '.$view->dateadded.'<br />';
                    }
                  }else{
                    print '<span class="alert alert-danger">No views yet.</span>';
                  }
                ?>
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="loader"></span>
                <button type="button" id="edit-ticket-btn" data-ticket_id="<?php echo $ticket->id; ?>" class="btn btn-primary editBtn">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!-- end log modal -->
<!-- ticket edit modal -->
<div class="modal fade" id="edit-ticket-<?php echo $ticket->id; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit ticket</h4>
                </div>
              <div class="modal-body">
              <span id="msg-detail" style="width: 100%;"></span>
                <p>
                    <form id="edit-ticket-form-<?php echo $ticket->id; ?>">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>" />
                    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ticket
                <small>edit ticket here... </small>
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
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          <?php echo $ticket->ticket; ?>
                          </textarea>              
            </div>
            <hr />
            <div class="box-body pad">              
                <textarea class="textarea" name="description_ticket_area" placeholder="Add description (optional)"
                     style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                     <?php echo $ticket->description; ?>
                     </textarea>              
            </div>

          </div>                         
                    </form>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="loader"></span>
                <button type="button" id="edit-ticket-btn" data-ticket_id="<?php echo $ticket->id; ?>" class="btn btn-primary editBtn">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!-- end ticket edit modal -->
<div class="box box-widget ticket-window-display" >
  <input type="hidden" id="ticket-id" value="<?php echo $ticket->id; ?>" />
            <div class="box-header with-border">              
              <div class="user-block">
                <img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/pic.png" alt="User Image">
                <span class="username"><a href="#"><?php echo $ticket->author; ?></a></span>
                <span class="description">Posted at <?php echo $ticket->dateadded; ?></span>                
                <div id="msg-field" class="pull-right" style="height: 8px;"></div>
                <!-- permission to close ticket -->
                <?php 
            if(!empty($this->session->permissions)){
              $permissions = explode(',', str_replace(' ', '_', strtolower($this->session->permissions)));
              
              if(!empty($permissions) && $this->session->role != 'user'){

                print '<div class="col-md-4">
                        <form>
                          <div class="form-group">
                            <select class="form-control" id="action-'.$ticket->id.'">
                              <option disabled selected>-select-</option>'.
                              '<option value="closed">Close ticket</option>'. 
                              '<option value="open">Open ticket</option>'. 
                            '</select>
                          </div>
                          <div class="form-group">
                              <button id="update-status" data-ticket_id="'.$ticket->id.'" class="btn btn-sm update-status"><i class="fa fa-cog"></i>Update</button>
                          </div>
                        </form></div>';
                      print '<div class="rows">';

                      foreach($permissions as $permission){
                        if($permission == 'edit_ticket'){
                          print '<div class="col-md-2">
                            <a data-toggle="modal" data-static="static" data-target="#edit-ticket-'.$ticket->id.'"><i class="fa fa-pencil"></i>Edit ticket</a>
                          </div>';
                        }
                        if($permission == 'view_log'){
                          print '<div class="col-md-2">
                            <a data-toggle="modal" data-static="static" data-target="#view-log-'.$ticket->id.'"><i class="fa fa-file-text-o"></i>View log</a>
                          </div>';
                        }
                      }
                      print '<div class="col-md-2">
                      <span>Views: <i class="fa fa-eye"></i>'.$ticket->views.'</span>
                      </div>';

                      print '</div>';
                  }
                }            
            ?>                   
              </div>
              
              <div class="box-tools">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>              
            </div>
            <div class="box-body">
                <p>
                    <?php echo $ticket->ticket; ?>
                </p>
              <div class="attachment-block clearfix">
                <img class="attachment-img" src="<?php echo base_url(); ?>assets/gifs/diamond.gif" alt="Attachment Image">

                <div class="attachment-pushed">
                  <h4 class="attachment-heading"><a href="#">Description:</a></h4>

                  <div class="attachment-text">
                    <?php echo $ticket->description; ?>
                  </div>                   

                </div>
              </div>
              <!--
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
              <span class="pull-right text-muted">45 likes - 2 comments</span>
              -->
            </div>
            <?php 
            $comments = $this->_tickets->get_comments($ticket->id);
            if(!empty($comments)){
              ?>
              <div class="box-footer box-comments" id="comments-activity">
               
                    <!-- User image -->
                    <?php                     
                    foreach($comments as $comment){
                        print ' <div class="box-comment">
                        <img class="img-circle img-sm" src="'.base_url().'assets/dist/img/pic.png" alt="'.$comment->author.'">

                        <div class="comment-text">
                              <span class="username">
                                '.$comment->author.' <b style="color: blue;">['.$comment->role.']</b>
                                <span class="text-muted pull-right">'.$comment->dateadded.'</span>
                              </span>
                         '.$comment->comment.'
                        </div>                      
                    </div> ';
                    
                    }                      
                  ?>
            </div>

              <?php 
            }
            ?>
            <?php 
            if(!empty($this->session->permissions)){
              $permissions = explode(',', str_replace(' ', '_', strtolower($this->session->permissions)));
              if(!empty($permissions)){
                  foreach($permissions as $permission){
                      if($permission == 'post_comment'){
                        print '
                        <div class="box-footer">
                            <form id="post-comment-form">                              
                              <img class="img-responsive img-circle img-sm" src="'.base_url().'assets/dist/img/pic.png" alt="'.$this->session->names.'">                                                            
                              <div class="img-push">
                              <input type="hidden" name="ticket_id" value="'.$ticket->id.'" />
                                <input type="text" id="comment-text" name="comment" class="form-control input-sm" placeholder="Press enter to post comment">
                                <span id="avatar-pic"></span>
                                </div>
                            </form>
                        </div>    
                        ';
                      }
                    }
                  }
                }            
            ?>        
</div>
    <?php   
        } 
    }
?>