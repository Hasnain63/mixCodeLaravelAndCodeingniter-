<?php
class Comment_model extends CI_Model
{
    public function create($formArray)
    {
        $this->db->insert('comments', $formArray);
    }
    public function getComment($id, $status = null)
    {
        if ($status == true) {
            $this->db->where('status', 1);
        }
        $this->db->where('id', $id);
        return $this->db->get('comments')->result_array();
    }
}