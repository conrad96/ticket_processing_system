<?php
class User extends CI_Controller{
    function index(){
        $data['tickets'] = $this->_tickets->user_get_all_tickets();
        $this->load->view("user/index", $data);
    }
    function view(){       
        if(!empty($_POST)){
            $view['user_id'] = $this->input->post("user_id");
            $view['ticket_id'] = $this->input->post("ticket_id");
            $add_view = $this->_tickets->add_view($view);
            print_r($view);
        }
    }
    function closed_tickets(){        
        $data['tickets'] = $this->_tickets->user_get_all_tickets('closed');
        $this->load->view("user/closed", $data);
    }    
    function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
    }
}