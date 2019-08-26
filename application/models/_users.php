<?php 
class _users extends CI_Model{
    function users(){
        return $this->db->query("SELECT * FROM users u WHERE u.id NOT IN (".$this->session->userid.") ")->result();
    }
}