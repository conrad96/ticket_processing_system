<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/pic.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->names; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php 
      if(!empty($this->session->role)){
        print '<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview" id="dash-link">
          <a href="'.base_url().'index.php/'.$this->session->role.'/index"><i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>
        </li>';
        switch($this->session->role){
          case 'super_admin':
            print '
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">
                <li><a href="'.base_url().'index.php/super_admin/users"><i class="fa fa-user-plus"></i>Add new user</li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Tickets</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">
                <li><a href="'.base_url().'index.php/super_admin/tickets"><i class="fa fa-book"></i>view tickets</li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Departments</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
               <ul class="treeview-menu">
                <li><a href="'.base_url().'index.php/super_admin/departments"><i class="fa fa-book"></i>view departments</li>
              </ul>
            </li>';
          break;
          case 'admin':
          print '
          <li class="treeview">
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Tickets</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
             <ul class="treeview-menu">
              <li><a href="'.base_url().'index.php/admin/tickets"><i class="fa fa-file-text"></i>View tickets</li>
              <li><a href="'.base_url().'index.php/admin/export"><i class="fa fa-cloud-download"></i>Report</li>
            </ul>            
          </li>';
          break;
          case 'user':
            print '
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Tickets</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="'.base_url().'index.php/user/closed_tickets"><i class="fa fa-file-text"></i>Closed tickets</li>
              </ul>
            </li>';
          break;
        }
        print '</ul>';
      }
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>