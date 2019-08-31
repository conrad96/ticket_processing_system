<?php 
class _users extends CI_Model{
    function users(){
        return $this->db->query(
            "SELECT u.full_names,
                    u.username,
                    u.email,
                    r.role, 
                    d.department,
                    (SELECT 
                        GROUP_CONCAT(DISTINCT p1.permission
                            ORDER BY p1.id ASC
                            SEPARATOR ',')
                        FROM permissions p1 
                            INNER JOIN permissions_mapping pm ON pm.permission_id = p1.id 
                        WHERE pm.user_id = u.id
                    ) AS permissions
                FROM users u 
                LEFT JOIN roles r ON r.id = u.role
                LEFT JOIN departments d ON d.id = u.department_id
            WHERE u.id NOT IN (".$this->session->userid.")
            ")->result();
    }
    function add($data = array()){
        $user = $this->db->insert("users", $data);
        return $this->db->insert_id();
    }
    function departments(){
        return $this->db->query("
        SELECT u.full_names as author,
            d.dateadded,
            d.department,
            d.id as ID,
            (
                SELECT 
                    COUNT(*)
                    FROM users u1 WHERE u1.department_id = d.id
            ) as employees 
            FROM departments d
                INNER JOIN users u ON u.id = d.author
        ")->result();
    }
    function add_permission_mapping($data = array()){
        $permission = $this->db->insert("permission_mapping", $data);
        return $this->db->insert_id();
    }
    function get_users($role = null){
        $role = (empty($role))? ' 1 = 1' : " u.role = '".$role."' ";
        return $this->db->query("SELECT * FROM users u WHERE $role ")->num_rows();
    }
}