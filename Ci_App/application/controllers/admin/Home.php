<?php
class Home extends CI_Controller
{
    public function index()
    {
        if (empty($this->session->userdata('user'))) {
            redirect(base_url('admin/login/index'));
        } else {
            $this->load->view('admin/dashboard');
        }
        // $this->load->view('admin/dashboard');
    }
}