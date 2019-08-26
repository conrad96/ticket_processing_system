<?php 
class Login extends CI_Controller{
    
    function index(){
        parent::__construct();
        $this->load->view("guest/index");
    }
}