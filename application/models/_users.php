<?php 
class _users extends CI_Model{
    function users(){
        return $this->db->query(
            "SELECT * 
                FROM users u 
            INNER JOIN permissions p ON p.user_id = u.id 
            ")->result();
    }
}