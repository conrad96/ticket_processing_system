<?php 
class _tickets extends CI_Model{
    function get_all_tickets(){
        return $this->db->query("
        SELECT t.* 
            FROM tickets t 
        INNER JOIN users u ON u.id = t.user_id 
        LEFT JOIN departments d ON d.id = u.department_id         
        ")->result();
    }
}