<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Archipelago extends CI_Controller
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
        $data['title'] = "Data Master Kepulauuan";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['archipelago'] = $this->DataMaster_model->getKepulauan();

        $data['provinces'] = $this->db->get('provinsi')->result_array();
        $data['distributions'] = $this->db->get('distribution')->result_array();

        $this->form_validation->set_rules('distribution', 'Distribution', 'trim|required');
        $this->form_validation->set_rules('province', 'Province', 'trim|required');
        $this->form_validation->set_rules('archipelago', 'Archipelago', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/archipelago', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $data = [
                    'distribution_id' => $this->input->post('distribution'),
                    'province_id' => $this->input->post('province'),
                    'archipelago' => $this->input->post('archipelago'),
                ];

                $this->db->insert('archipelago', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Archipelago Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {
                $data = [
                    'distribution_id' => $this->input->post('distribution'),
                    'province_id' => $this->input->post('province'),
                    'archipelago' => $this->input->post('archipelago'),
                ];

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('archipelago', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Archipelago Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('archipelago');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Archipelago Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
