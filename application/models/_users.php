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
}