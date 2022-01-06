<?php
class Category_model extends CI_Model
{
    public function create($formArray)
    {
        $this->db->insert('categories', $formArray);
    }
    public function getAll($params = [])
    {
        if (!empty($params['querysting'])) {
            $this->db->like('name', $params['querysting']);
        }
        return $this->db->get('categories')->result_array();
    }
    public function getCategory($id)
    {

        $this->db->where('id', $id);
        return $this->db->get('categories')->row_array();
    }
    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $formArray);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }
}