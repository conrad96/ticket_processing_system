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
      
      <div class="row" style="padding-bottom: 25px;">
      <br><button class="btn btn-success pull-right" data-toggle="modal" data-target="#addUser" data-backdrop="static"><i class="fa fa-plus"></i>Add user</button></br>
      <?php 
          if(!empty($users)){
            foreach($users as $user){
                print 
                '
                <div class="col-md-4">
                <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="'.base_url().'assets/dist/img/pic.png" alt="User profile picture">
    
                  <h3 class="profile-username text-center">'.$user->full_names.'</h3>
    
                  <p class="text-muted text-center">'.$user->role.'</p>
    
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Username</b> <a class="pull-right">'.$user->username.'</a>
                    </li>
                    <li class="list-group-item">
                      <b>Email</b> <a class="pull-right">'.$user->email.'</a>
                    </li>
                    <li class="list-group-item">
                      <b>Department:</b> <a class="pull-right">'.$user->department.'</a>
                    </li>
                    <li class="list-group-item"><b>Permissions:</b>
                      <span class="text-muted text-center pull-right">
                      '.$user->permissions.'
                      </span>
                    </li>
                    <li class="list-group-item"><b>Role:</b>
                      <span class="text-muted text-center pull-right">
                      '.$user->role.'
                      </span>
                    </li>
                  </ul>
    
                  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.box-body -->
              </div>
                </div>
                ';
            }
          }else{
              print '
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Oops!</h4>
                No user registered
              </div>
              ';
          }
          ?>

          <!-- modal-->
          <div class="modal fade" id="addUser">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add user</h4>
                <div class="pull-right"><span id="msg-detail"></span></div>
              </div>
              <div class="modal-body">
                <p>
                    <form id="add-user" role="form">
                        <div class="box-body">
                          <div class="form-group">  
                              <label for="fullnames">Full names</label>                         
                              <input type="text" name="fullnames" class="form-control col-md-4" placeholder="Full names" id="fullnames">
                          </div>
                          <div class="form-group">      
                              <label for="username">Username</label>                      
                              <input type="text" name="username" class="form-control col-md-4" placeholder="username" id="username">
                          </div>
                          <div class="form-group">      
                              <label for="email">Email</label>                      
                              <input type="email" id="email" name="email" class="form-control col-md-4" placeholder="Email address" id="fullnames">
                          </div>
                          <div class="form-group">      
                              <label for="role">Role</label>                      
                              <select id="role" name="role" class="form-control col-md-4">
                              <?php 
                                if(!empty($roles)){
                                  foreach($roles as $role){
                                    print '<option value="'.$role->id.'">'.$role->role.'</option>';
                                  }
                                }
                              ?>
                              </select>
                          </div>
                          <div class="form-group">      
                              <label for="dept">Department</label>                      
                              <select id="dept" name="department" class="form-control col-md-4">
                              <?php 
                                if(!empty($departments)){
                                  foreach($departments as $department){
                                    print '<option value="'.$department->ID.'">'.$department->department.'</option>';
                                  }
                                }
                              ?>
                              </select>
                          </div>
                          <div class="form-group"> 
                             <label for="pass">Password</label>                         
                              <input type="password" class="form-control col-md-4" name="password" placeholder="Password" id="pass">
                          </div>
                          <div class="form-group">   
                              <label for="cpass">Confirm password</label>                        
                              <input type="password" class="form-control col-md-4" name="cpassword" placeholder="Confirm password" id="cpass">
                          </div>
                          <hr />
                          <span id="permission-display">
                            <h4>Permissions</h4>
                            <div class="row">
                              <?php 
                                if(!empty($permissions)){
                                  foreach($permissions as $permission){
                                    print '
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" name="permissions[]" value="'.$permission->id.'_'.strtolower(str_replace(' ', '_', $permission->permission)).'" >'.$permission->permission.'
                                      </label>
                                    </div>
                                  ';
                                  }
                                }else{
                                  print '<span class="alert alert-danger">No permissions created</span>';
                                }
                              ?>
                          </span>                         
                        </div>
                    </form>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <span id="loader"></span>
                <button type="button" id="add-user-save" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

          <!-- end modal -->
          
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("shared/footer.php"); ?>

</body>
</html>
