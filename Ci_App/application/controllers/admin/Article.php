<?php

class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user'))) {
            redirect(base_url('admin/login/index'));
        }
    }
    public function index($page = 1)
    {
        $this->load->model('Article_model');
        // ***************pagination***************
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/Article/index';
        $config['total_rows'] = $this->Article_model->getArticleCount();
        $config['per_page'] = 5;
        $config['use_page_numbers'] = true;
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $pagination_links = $this->pagination->create_links();
        $data['pagination_links'] = $pagination_links;

        $param['offset'] = $config['per_page'];
        $param['limit'] = ($page * $config['per_page']) - $config['per_page'];
        // ****************************************
        $param['q'] = $this->input->get('q');
        $rows = $this->Article_model->get_articles($param);
        $data['rows'] = $rows;
        $data['q'] = $this->input->get('q');
        $data['mainModule'] = 'article';
        $data['subModule'] = 'viewArticle';

        $this->load->view('admin/article/list', $data);
    }
    public function create()
    {
        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $rows = $this->Category_model->getAll();
        $data['rows'] = $rows;
        $data['mainModule'] = 'article';

        $data['submenu'] = 'creatArticle';
        $config['upload_path']          = './public/upload/article/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('category_id', 'category', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('discription', 'Discription', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $data = $this->upload->data();
                    $formArray['image'] = $data['file_name'];
                    $formArray['title'] = $this->input->post('title');
                    $formArray['discription'] = $this->input->post('discription');
                    $formArray['category'] = $this->input->post('category_id');
                    $formArray['author'] = $this->input->post('author');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y;m;d:H:i:s');
                    $this->Article_model->Add_article($formArray);
                    $this->session->set_flashdata('message', 'Article Added Successsfully.');
                    redirect(base_url() . 'admin/Article/');
                } else {
                    $error =  $this->upload->display_errors();
                    $data['error'] = $error;
                    redirect(base_url() . 'admin/Article/create', $data);
                }
            } else {
                $formArray = array();
                $formArray['title'] = $this->input->post('title');
                $formArray['discription'] = $this->input->post('discription');
                $formArray['category'] = $this->input->post('category_id');
                $formArray['author'] = $this->input->post('author');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y;m;d:H:i:s');
                $this->Article_model->Add_article($formArray);
                $this->session->set_flashdata('message', 'Article Added Successsfully.');
                redirect(base_url() . 'admin/Article/');
            }
        } else {

            $this->load->view('admin/article/create', $data);
        }
    }
    public function edit($id)
    {
        $this->load->model('Article_model');
        $this->load->model('Category_model');
        $rows = $this->Category_model->getAll();
        $article =  $this->Article_model->get_article($id);
        // $data['rows'] = $rows;
        $data['rows'] = $rows;
        $data['article'] = $article;

        // ************************FILE UPLOAD STNG**********
        $config['upload_path']          = './public/upload/article/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('category_id', 'category', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('discription', 'Discription', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $data = $this->upload->data();
                    $formArray['image'] = $data['file_name'];
                    $formArray['title'] = $this->input->post('title');
                    $formArray['discription'] = $this->input->post('discription');
                    $formArray['category'] = $this->input->post('category_id');
                    $formArray['author'] = $this->input->post('author');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y;m;d:H:i:s');
                    $this->Article_model->update($id, $formArray);
                    $this->session->set_flashdata('message', 'Article Updated Successsfully.');
                    redirect(base_url() . 'admin/Article/');
                } else {
                    $error =  $this->upload->display_errors();
                    $data['error'] = $error;
                    $this->load->view('admin/article/edit', $data);
                }
            } else {
                $formArray = array();
                $formArray['title'] = $this->input->post('title');
                $formArray['discription'] = $this->input->post('discription');
                $formArray['category'] = $this->input->post('category_id');
                $formArray['author'] = $this->input->post('author');
                $formArray['status'] = $this->input->post('status');
                $formArray['updated_at'] = date('Y;m;d:H:i:s');
                $this->Article_model->update($id, $formArray);
                $this->session->set_flashdata('message', 'Article Updated Successsfully.');
                redirect(base_url() . 'admin/Article/');
            }
        } else {
            $this->load->view('admin/article/edit', $data);
        }
    }
    public function delete($id)
    {
        $this->load->model('Article_model');
        $this->Article_model->delete($id);
        $this->session->set_flashdata('message', 'data deleted sucessfully.');
        redirect(base_url('admin/Article/index/'));
    }
}