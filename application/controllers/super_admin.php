<?php 
class Super_admin extends CI_Controller{
    function index(){
        //$this->session_checker();
        $this->load->view("super_admin/index");
    }
    function users(){
        $data['users'] = $this->_users->users();
        $data['permissions'] = $this->db->get("permissions")->result();
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
            //validate
            if(!empty($fullnames)
            && !empty($username)
            && !empty($email)
            && !empty($password)
            && !empty($cpassword)
            ){
                if($password != $cpassword){
                    $msg = '<span class="alert alert-warning">Passwords dont match</span>';
                }else{
                   //check if anny permissions were selected
                   $bool = false; 
                   foreach($_POST as $key=>$value){
                        if($value == 'On'){
                            $bool = true;
                        }
                    }
                    $msg = $bool? '' : '<span class="alert alert-warning">Please choose permission</span>';
                    if($msg){
                        //add user
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