<?php 
class Super_admin extends CI_Controller{
    function index(){
        //$this->session_checker();
        $this->load->view("super_admin/index");
    }
    function users(){
        $data['users'] = $this->_users->users();
        $data['permissions'] = $this->db->get("permissions")->result();
        $data['roles'] = $this->db->get("roles")->result();
        $this->load->view("super_admin/users", $data);
    }
    function add_user(){
        $msg = null;
        if(!empty($_POST)){           
            $fullnames = $this->input->post("fullnames");
            $username = $this->input->post("username");
            $email =$this->input->post("email");
            $password =$this->input->post("password");
            $cpassword =$this->input->post("cpassword");
            $role = $this->input->post("role");
            //validate
            if(!empty($fullnames)
            && !empty($username)
            && !empty($email)
            && !empty($password)
            && !empty($cpassword)
            && !empty($role)
            ){
                if($password != $cpassword){
                    $msg = '<span class="alert alert-warning">Passwords dont match</span>';
                }else{
                   //check if anny permissions were selected
                   $bool = false; 
                  if(!empty($_POST['permissions'])){
                      $mapping = array();
                    //add user
                    $user['fullnames'] = $fullnames;
                    $user['email'] = $email;
                    $user['username'] = $username;
                    $user['password'] = $password;
                    $user['role'] = $role;
                    $result = $this->_users->add($user);
                    
                    if($result > 0){
                        //add permission mapping
                        $perm_ids = array();
                        foreach($_POST['permissions'] as $permission){
                            $str = explode('_', $permission);
                            array_push($perm_ids, $str[0]);                      
                        }                        
                        if(!empty($perm_ids)){
                            foreach($perm_ids as $id){
                                $mapping['permission_id'] = $id;
                                $mapping['user_id'] = $result;
                            }
                            $val = $add_mapping = $this->_users->add_permission_mapping($mapping);
                            if($val > 0){
                                $msg = '<span class="alert alert-success">Account created successfully</span>';
                            }
                        }
                    }

                  }else{
                    $msg = '<span class="alert alert-warning">Please choose permission</span>';
                  }
                }
            }else{
                $msg = '<span class="alert alert-danger">*Please fill in all fields</span>';
            }
        }
        print_r($msg);
    }
    
    function session_checker(){
        if(empty($this->session->userid)) redirect('login/index');
    }
}