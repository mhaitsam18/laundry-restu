<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Habitat extends CI_Controller
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
        $data['title'] = "Data Master Habitat";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['habitats'] = $this->db->get('habitats')->result_array();

        $this->form_validation->set_rules('habitat', 'Habitat', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/habitat', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('habitats', ['habitat' => $this->input->post('habitat')]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Habitat Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $data = array('habitat' => $this->input->post('habitat'));

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('habitats', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Habitat Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('habitats');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Habitat Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
