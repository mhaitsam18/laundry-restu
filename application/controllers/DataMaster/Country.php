<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Country extends CI_Controller
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
        $data['title'] = "Data Master Negara";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['countrys'] = $this->DataMaster_model->getNegara();
        $data['continents'] = $this->db->get('continent')->result_array();

        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('continent', 'Continent', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/negara', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $data = [
                    'continent_id' => $this->input->post('continent'),
                    'country' => $this->input->post('country'),
                ];

                $this->db->insert('country', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Country Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {
                $data = [
                    'continent_id' => $this->input->post('continent'),
                    'country' => $this->input->post('country'),
                ];

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('country', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Country Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('country');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Country Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
