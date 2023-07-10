<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Continent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('DataMaster_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Master Benua";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['continents'] = $this->db->get('continent')->result_array();
        $this->form_validation->set_rules('continent', 'Continent', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/continent', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('continent', ['continent' => $this->input->post('continent')]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Continent Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {
                $data = array('continent' => $this->input->post('continent'));
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('continent', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Continent Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('continent');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Continent Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
