<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Province extends CI_Controller
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
        $data['title'] = "Data Master Provinsi";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['provinces'] = $this->DataMaster_model->getProvinsi();

        $data['countrys'] = $this->db->get('country')->result_array();

        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('province', 'Province', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/provinsi', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $data = [
                    'country_id' => $this->input->post('country'),
                    'province' => $this->input->post('province'),
                ];

                $this->db->insert('province', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Province Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {
                $data = [
                    'country_id' => $this->input->post('country'),
                    'province' => $this->input->post('province'),
                ];

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('province', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Province Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('province');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Province Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
