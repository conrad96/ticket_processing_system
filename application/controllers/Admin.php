<?php 
class Admin extends CI_Controller{
    function index(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $this->load->view("admin/index", $data);
    }
    function tickets(){
        $data['tickets'] = $this->_tickets->get_all_tickets();
        $data['counter'] = $this->_tickets->count_tickets();
        $this->load->view("admin/tickets", $data);
    }
    function add_ticket(){
        $msg = null;
        if(!empty($_POST)){
            if(!empty($this->input->post("ticket_area"))){
                $ticket['ticket'] = strip_tags($this->input->post("ticket_area"));
                $ticket['description'] = strip_tags($this->input->post("description_ticket_area"));
                $ticket['user_id'] = $this->session->userid;                
                $add_ticket = $this->_tickets->add($ticket);
                if($add_ticket > 0){
                    $msg = '<span class="alert alert-success">Ticket added successfully</span>';
                }else{
                    $msg = '<span class="alert alert-danger">Oh snap!. an error occured on creating ticket</span>';
                }
            }else{
                $msg = '<span class="alert alert-warning">Please log ticket</span>';
            }
        }
        print_r($msg);
    }
    function logout(){
        $this->session->sess_destroy();
        redirect("login/index");
    }
}