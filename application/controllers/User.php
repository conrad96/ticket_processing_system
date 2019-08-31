<?php
class User extends CI_Controller{
    function index(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $this->load->view("user/index", $data);
    }
    function view(){
       
        if(!empty($_POST)){
            $view['user_id'] = $this->input->post("user_id");
            $view['ticket_id'] = $this->input->post("ticket_id");
            $add_view = $this->_tickets->add_view($view);
            //print_r($view);
        }
    }
}