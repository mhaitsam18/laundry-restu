<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Abundance extends CI_Controller
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
        $data['title'] = "Data Master Kelimpahan";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['abundance'] = $this->db->order_by('id', 'desc')->get('abundance')->result_array();

        $this->form_validation->set_rules('abundance', 'Abundance', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/abundance', $data);
            $this->load->view('layouts/footer');
        } else {
            // test
            if ($this->input->post('aksi') == "add") {

                $data = [
                    'abundance' => $this->input->post('abundance'),
                    'description' => $this->input->post('description'),
                ];

                $this->db->insert('abundance', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Abundance Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $data = [
                    'abundance' => $this->input->post('abundance'),
                    'description' => $this->input->post('description'),
                ];


                $this->db->where('id', $this->input->post('id'));
                $this->db->update('abundance', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Abundance Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('abundance');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Fish Type Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
