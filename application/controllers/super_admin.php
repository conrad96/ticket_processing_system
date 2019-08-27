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
    
    function session_checker(){
        if(empty($this->session->userid)) redirect('login/index');
    }
}