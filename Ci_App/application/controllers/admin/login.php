<?php
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admin_model');
    }
    public function index()
    {
        if (!empty($this->session->userdata('user'))) {
            redirect(base_url('admin/Home/index'));
        }
        $this->load->view('admin/Login');
    }
    public function authentication()
    {

        $this->form_validation->set_rules('username', 'username', 'required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->Admin_model->getByUserName($username, $password);
            if (!empty($user)) {
                $this->session->set_userdata('user', $user);
                redirect(base_url() . 'admin/Home/');
            } else {
                $this->session->set_flashdata('message', 'Email or password is incorrect.');
                $this->load->view('admin/login');
            }
        } else {
            $this->load->view('admin/login');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect(base_url('admin/Login/index'));
        // $this->load->view('admin/login');
    }
}