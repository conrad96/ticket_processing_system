<?php 
class Login extends CI_Controller{
    
    function index(){
        
        $this->load->view("guest/index");
    }
    function login_form(){
        
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
                        'names'=>$user->full_names,
                        'role'=>$user->role
                    );
                    $this->session->set_userdata($user_data);

                    //redirect to respective role
                    redirect("$user->role/index");
                }
            }else{
                $data['msg'] = 'Incorrect email or password';
                $this->load->view("guest/index", $data);
            }
        }
    }
}