<?php
class Admin_model extends CI_Model{
    public function getByUserName( $username,$password){
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query =  $this->db->get('admins');
        return  $query->row_array();
    }
}