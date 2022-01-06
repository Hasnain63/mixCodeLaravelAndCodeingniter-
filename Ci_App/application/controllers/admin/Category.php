<?php

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user'))) {
            redirect(base_url('admin/login/index'));
        }
    }
    public function index()
    {
        $this->load->model('Category_model');
        // seach method
        $querysting = $this->input->get('q');
        $params['querysting'] = $querysting;
        $rows = $this->Category_model->getAll($params);
        $data['rows'] = $rows;
        $data['mainModule'] = 'category';
        $data['subModule'] = 'viewcategory';

        $data['querysting'] = $querysting;
        $this->load->view('admin/category/list', $data);
    }
    public function create()
    {
        $this->load->model('Category_model');
        $config['upload_path']          = './public/upload/categories/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;
        $data['mainModule'] = 'category';

        $data['submenu'] = 'createcategory';
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    // success
                    $data = $this->upload->data();
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y;m;d:H:i:s');
                    $this->Category_model->create($formArray);
                    $this->session->set_flashdata('message', 'Category Added Successsfully.');
                    redirect(base_url() . 'admin/Category/');
                } else {

                    $error =  $this->upload->display_errors();
                    $data['error'] = $error;
                    redirect(base_url() . 'admin/Category/create', $data);
                }
            } else {
                // upload with out file
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y;m;d:H:i:s');
                $this->Category_model->create($formArray);
                $this->session->set_flashdata('message', 'Category Added Successsfully.');
                redirect(base_url() . 'admin/Category/');
            }
        } else {
            // $this->session->set_flashdata('message', 'some error occer please try again.');
            $this->load->view('admin/Category/create', $data);
        }
    }
    public function edit($id)
    {
        $this->load->model('Category_model');
        $rows =  $this->Category_model->getCategory($id);
        $config['upload_path']          = './public/upload/categories/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    // success
                    $data = $this->upload->data();
                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['updated_at'] = date('Y;m;d:H:i:s');
                    $this->Category_model->update($id, $formArray);
                    $this->session->set_flashdata('message', 'Category UpDated Successsfully.');
                    redirect(base_url() . 'admin/Category/');
                } else {

                    $error =  $this->upload->display_errors();
                    $data['error'] = $error;
                    redirect(base_url() . 'admin/Category/edit', $data);
                }
            } else {
                // upload with out file
                $formArray = array();
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y;m;d:H:i:s');
                $this->Category_model->update($id, $formArray);
                $this->session->set_flashdata('message', 'Category UpDated Successsfully.');
                redirect(base_url() . 'admin/Category/');
            }
        } else {
            $data['rows'] = $rows;
            $this->load->view('admin/Category/edit', $data);
        }
    }
    public function delete($id)
    {
        $this->load->model('Category_model');
        $this->Category_model->delete($id);
        $this->session->set_flashdata('message', 'data deleted sucessfully.');
        redirect(base_url('admin/Category/'));
    }
}