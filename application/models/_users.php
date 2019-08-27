<?php 
class _users extends CI_Model{
    function users(){
        return $this->db->query(
            "SELECT u.* 
                FROM users u 
            INNER JOIN permissions_mapping pm ON pm.user_id = u.id 
            INNER JOIN permissions p ON p.id = pm.permission_id
            WHERE u.id NOT IN (".$this->session->userid.")
            ")->result();
    }
    function add($data = array()){
        $user = $this->db->insert("users", $data);
        return $this->db->insert_id();
    }
    function add_permission_mapping($data = array()){
        $permission = $this->db->insert("permission_mapping", $data);
        return $this->db->insert_id();
    }
}