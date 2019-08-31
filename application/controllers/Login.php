<?php 
class Login extends CI_Controller{
    
    function index(){
        
        $this->load->view("guest/index");
    }
    function login_form(){
        
        if(!empty($_POST)){
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $sql = "SELECT u.id,u.full_names,r.role,
            (SELECT 
                GROUP_CONCAT(DISTINCT p1.permission
                    ORDER BY p1.id ASC
                    SEPARATOR ',')
                FROM permissions p1 
                    INNER JOIN permissions_mapping pm ON pm.permission_id = p1.id 
                WHERE pm.user_id = u.id
            ) AS permissions
            FROM users u 
                INNER JOIN roles r ON u.role = r.id
            WHERE u.email LIKE '".$email."' AND u.password LIKE '".$password."' ";
            $query = $this->db->query($sql)->result();
            if(!empty($query)){
                //set session
                foreach($query as $user){
                    $user_data = array(
                        'userid'=>$user->id,
                        'names'=>$user->full_names,
                        'role'=>$user->role,
                        'permissions'=>$user->permissions
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