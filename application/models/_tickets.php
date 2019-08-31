<?php 
class _tickets extends CI_Model{
    function get_all_tickets(){
        return $this->db->query("
        SELECT  t.id,
                t.ticket,
                t.description,
                t.dateadded,
                u.full_names as author,
                d.department 
            FROM tickets t 
        INNER JOIN users u ON u.id = t.user_id 
            LEFT JOIN departments d ON d.id = u.department_id ")->result();
    }
    function add($data = array()){
        $this->db->insert("tickets", $data);
        return $this->db->insert_id();
    }
    function count_tickets($state = null){
        $state = (empty($state))? $state = ' 1 = 1 ' : " t.status LIKE '".$state."' ";
        #exit($state);
        return $this->db->query("
        SELECT *
            FROM tickets t 
        WHERE ".$state."
        ")->num_rows();
    }
}