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
        Users
        <small>Registered users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">users</li>
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
                    <li class="list-group-item"><b>Permissions:</b> &nbsp;&nbsp;&nbsp;&nbsp;'.$user->permissions.'
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
              </div>
              <div class="modal-body">
              <span id="msg-detail" style="width: 100%;"></span>
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


</div>
<!-- ./wrapper -->
<?php $this->load->view("shared/footer.php"); ?>

</body>
</html>
