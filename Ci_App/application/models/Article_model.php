<?php
class Article_model extends CI_Model
{
    public function get_articles($param = array())
    {
        if (isset($param['offset']) && isset($param['limit'])) {
            $this->db->limit($param['offset'], $param['limit']);
        }
        if (isset($param['q'])) {
            $this->db->or_like('title', trim($param['q']));
            $this->db->or_like('author',  trim($param['q']));
        }
        return $this->db->get('articles')->result_array();
    }
    public function get_article($id)
    {
        $this->db->where('articles.id', $id);
        $this->db->select('articles.*,categories.name as category_name');
        $this->db->join('categories', 'categories.id = articles.Category', 'left');
        return $this->db->get('articles')->row_array();
    }
    public function getArticleCount($param = array())
    {
        if (isset($param['id'])) {
            $this->db->where('category', $param['id']);
        }
        $result = $this->db->count_all_results('articles');
        return $result;


        return $this->db->get('articles')->row_array();
    }
    public function Add_article($formArray)
    {
        $this->db->insert('articles', $formArray);
    }
    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('articles', $formArray);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('articles');
    }



    // ********************front method**************

    public function get_articlesFront($param = array())
    {
        if (isset($param['offset']) && isset($param['limit'])) {
            $this->db->limit($param['offset'], $param['limit']);
        }
        if (isset($param['q'])) {
            $this->db->or_like('title', trim($param['q']));
            $this->db->or_like('auhor',  trim($param['q']));
        }
        if (isset($param['id'])) {
            $this->db->where('category', $param['id']);
        }
        $this->db->select('articles.*,categories.name as category_name');
        $this->db->order_by('articles.created_at', 'DESC');
        $this->db->join('categories', 'categories.id = articles.Category', 'left');
        return $this->db->get('articles')->result_array();
    }
}