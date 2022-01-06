<?php
class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model('Article_model');
        $param['offset'] = 4;
        $param['limit'] = 0;
        $rows = $this->Article_model->get_articlesFront($param);
        $data['rows'] = $rows;
        $this->load->view('front/home', $data);
    }
}