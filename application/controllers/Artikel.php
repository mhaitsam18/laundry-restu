<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('Menu_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Artikel";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('*, articles.id as article_id');
        $this->db->join('user', 'user.id = articles.author_id');
        $data['artikel'] = $this->db->get('articles')->result_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/topbar', $data);
        $this->load->view('article/index', $data);
        $this->load->view('layouts/footer');
    }
    
    public function show($article_id = null)
    {
        $this->db->join('user', 'user.id = articles.author_id');
        $data['article'] = $this->db->get_where('articles', ['id', $article_id])->row_array();
        $data['title'] = $data['article']['title'];
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/topbar', $data);
        $this->load->view('article/show', $data);
        $this->load->view('layouts/footer');
    }
    
    public function create()
    {
        $data['title'] = "Tambah Artikel";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_type'] = $this->db->get_where('article_type')->result();
    
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('excerpt', 'excerpt', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $this->form_validation->set_rules('slug', 'slug', 'trim|required|is_unique[articles.slug]');
        // $this->form_validation->set_rules('article_category_id', 'article_category_id', 'trim|required');
        // $this->form_validation->set_rules('article_type_id', 'article_type_id', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('article/create', $data);
            $this->load->view('layouts/footer');
        } else {
            if (isset($_FILES['thumbnail']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                $config['upload_path'] = './assets/img/artikel';
                $config['max_size']     = '180000';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('thumbnail')) {
                    $nama_thumbnail = 'artikel/'.$this->upload->data('file_name');
                }
            } else {
                $nama_thumbnail = 'artikel/'. $this->input->post('nama_thumbnail');
            }
            echo $this->input->post('nama_thumbnail');
            die;
            $published_at = null;
            if ($this->input->post('published_at')) {
                $published_at = date('Y-m-d H:i:s');
            }
            $this->db->insert('articles', [
                'title' => $this->input->post('title'),
                'excerpt' => $this->input->post('excerpt'),
                'content' => $this->input->post('content'),
                'slug' => $this->input->post('slug'),
                'thumbnail' => $nama_thumbnail,
                'author_id' => $data['user']['id'],
                'published_at' => $published_at,
                'article_category_id' => $this->input->post('article_category_id'),
                'article_type_id' => $this->input->post('article_type_id'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Data Artikel berhasil ditambahkan!
				</div>');
            redirect('Artikel/index');
        }
    }
    
}
