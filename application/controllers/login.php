<?php 
class Login extends CI_Controller{
    
    function index(){
        parent:: __construct();
        $this->load->view("guest/index");
    }
    function login(){
        if(!empty($_POST)){
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $sql = "SELECT * FROM users u WHERE u.email LIKE '".$email."' AND u.password LIKE '".$password."' ";
            $query = $this->db->query($sql)->result();
            if(!empty($query)){
                //set session
                foreach($query as $user){
                    $user_data = array(
                        'userid'=>$user->id,
                        'names'=>$user->full_names

                    );
                    $this->session->set_userdata($user_data);
                }
            }else{
                $data['msg'] = 'Incorrect email or password';
                $this->load->view("guest/login", $data);
            }
        }
    }
}