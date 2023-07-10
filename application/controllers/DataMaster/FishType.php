<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FishType extends CI_Controller
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
        $data['title'] = "Data Master Jenis Ikan";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['fish_type'] = $this->db->order_by('id', 'desc')->get('fish_type')->result_array();

        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/jenis_ikan', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {

                $data = [
                    'type' => $this->input->post('type'),
                    'description' => $this->input->post('description'),
                ];

                $this->db->insert('fish_type', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Fish Type Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $data = [
                    'type' => $this->input->post('type'),
                    'description' => $this->input->post('description'),
                ];


                $this->db->where('id', $this->input->post('id'));
                $this->db->update('fish_type', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Fish Type Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('fish_type');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Fish Type Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
