<?php

class Auth_model extends CI_Model{

    function login($username, $password,$table) {

        $pass = base64_encode($password);     

        $this->db->from($table);
        $this->db->group_start();
        $this->db->where('email',$username)->or_where('mobile',$username);
        $this->db->group_end();
        $this->db->where('password', $pass);
        $this->db->like('email',$username);
        $result = $this->db->get();
        
        if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    function loginAdmin($username, $password,$table) {

        $pass = base64_encode($password);     

        $this->db->from($table);
        $this->db->group_start();
        $this->db->where('email', $username)->or_where('contact', $username);
        $this->db->group_end();
        $this->db->where('password', $pass);
        $this->db->where('user_type ',1);
        $result = $this->db->get();
        
        if ($result->num_rows() == 1) {
            return $result->result();
        } else {
            return false;
        }
    }
    function insert_dataIntoTable($table,$record) {
        $this->db->insert($table, $record);
        return $this->db->insert_id();
    }
}

?>