<?php 
class Admin extends CI_Controller{
    function index(){
        $this->load->view("admin/index");
    }
    function tickets(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $this->load->view("admin/tickets", $data);
    }
    function add_ticket(){
        print_r($_POST);
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
    }
}