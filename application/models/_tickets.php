<?php 
class _tickets extends CI_Model{
    function get_all_tickets(){
        return $this->db->query("
        SELECT  t.id,
                t.ticket,
                t.description,
                t.dateadded,
                u.full_names as author,
                d.department ,
                t.user_id,
                (
                    SELECT COUNT(*) 
                        FROM views v 
                ) as views
            FROM tickets t 
        INNER JOIN users u ON u.id = t.user_id 
            LEFT JOIN departments d ON d.id = u.department_id 
            ")->result();
    }
    function add($data = array()){
        $this->db->insert("tickets", $data);
        return $this->db->insert_id();
    }
    function edit($data = array()){

        $id = $data['ticket_id'];
        $this->db->where("id", $id);        
        $this->db->update("tickets", $data);
        #print_r($this->db->last_query());
        return $this->db->affected_rows();
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
    function post_comment($data = array()){
        $this->db->insert("comments", $data);
        return $this->db->insert_id();
    }
    function get_comments($ticket_id = null){
        return $this->db->query(
            "SELECT c.comment,
                    u.full_names as author,
                    c.dateadded,
                    r.role
                FROM tickets t 
                INNER JOIN comments c ON c.ticket_id = t.id 
                INNER JOIN users u ON u.id = c.user_id 
                INNER JOIN roles r ON r.id = u.role
            "
        )->result();
    }
    function count_comments(){
        return $this->db->get("comments")->num_rows();
    }   
    function add_view($data = array()) {
        return $this->db->insert("views", $data);
    }
    function user_get_all_tickets(){
        return $this->db->query("
        SELECT  t.id,
                t.ticket,
                t.description,
                t.dateadded,
                u.full_names as author,
                d.department ,
                (
                    SELECT COUNT(*) 
                        FROM views v 
                ) as views
            FROM tickets t 
        INNER JOIN users u ON u.id = t.user_id 
            LEFT JOIN departments d ON d.id = u.department_id 
        WHERE t.status LIKE 'open'
            ")->result();
    }
}