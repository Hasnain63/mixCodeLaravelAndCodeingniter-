<?php
class Blog extends CI_Controller
{
    public function index($page = 1)
    {
        $this->load->library('pagination');
        $this->load->model('Article_model');
        $this->load->helper('text');
        $per_page = 5;
        $param['offset'] = $per_page;
        $param['limit'] = ($page * $per_page) - $per_page;
        $config['base_url'] = base_url() . 'Blog/index';
        $config['total_rows'] = $this->Article_model->getArticleCount();
        $config['per_page'] =  $per_page;
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

        $rows = $this->Article_model->get_articlesFront($param);
        $data['rows'] = $rows;
        $this->load->view('front/blog', $data);
    }
    public function categories()
    {
        $this->load->model('Category_model');
        $rows = $this->Category_model->getAll();
        $data['rows'] = $rows;
        $this->load->view('front/categories', $data);
    }
    public function detail($id)
    {
        $this->load->model('Comment_model');
        $this->load->model('Article_model');

        $rows = $this->Article_model->get_article($id);
        $comment = $this->Comment_model->getComment($id, true);
        $data['comment'] = $comment;
        $data['rows'] = $rows;
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['comment'] = $this->input->post('comment');
            $formArray['article_id'] = $id;
            $formArray['created_at'] = date('Y;m;d:H:i:s');
            $this->Comment_model->create($formArray);
            $this->session->set_flashdata('message', 'Comment submitted sucessfully.');
            redirect(base_url('Blog/detail/' . $id));
        } else {

            $this->load->view('front/detailBlog', $data);
        }
    }
    public function category($id, $page = 1)
    {

        $this->load->library('pagination');
        $this->load->model('Category_model');

        $this->load->model('Article_model');
        $this->load->helper('text');
        $per_page = 5;
        $param['offset'] = $per_page;
        $param['id'] = $id;
        $param['limit'] = ($page * $per_page) - $per_page;
        $config['base_url'] = base_url() . 'Blog/index';
        $config['total_rows'] = $this->Article_model->getArticleCount($param);
        $config['per_page'] =  $per_page;
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

        $category = $this->Category_model->getCategory($id);
        $rows = $this->Article_model->get_articlesFront($param);
        $data['category'] = $category;
        $data['rows'] = $rows;
        $this->load->view('front/category_article', $data);
    }
}