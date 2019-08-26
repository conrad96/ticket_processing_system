<?php 
class Super_admin extends CI_Controller{
    function index(){
        parent::__construct();
        $this->session_checker();
        $this->load->view("super_admin/index");
    }
    
    function session_checker(){
        if(empty($this->session->userid)) redirect('login/index');
    }
}