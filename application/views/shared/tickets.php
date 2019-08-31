<?php 
    if(!empty($tickets)){
        foreach($tickets as $ticket){
?>
<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/pic.png" alt="User Image">
                <span class="username"><a href="#"><?php echo $this->session->names; ?></a></span>
                <span class="description">Posted at <?php echo $ticket->dateadded; ?></span>
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
            <div class="box-footer box-comments">
                <div class="box-comment">
                    <!-- User image -->
                    <img class="img-circle img-sm" src="<?php echo base_url(); ?>assets/dist/img/pic.png" alt="User Image">

                        <div class="comment-text">
                              <span class="username">
                                Nora Havisham
                                <span class="text-muted pull-right">8:03 PM Today</span>
                              </span><!-- /.username -->
                          The point of using Lorem Ipsum is that it has a more-or-less
                          normal distribution of letters, as opposed to using
                          'Content here, content here', making it look like readable English.
                        </div>
                      
                </div> 
                <span style="padding-bottom: 15px;"></span>  
            </div>
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