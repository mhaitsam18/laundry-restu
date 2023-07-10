<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Food extends CI_Controller
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
        $data['title'] = "Data Master Makanan";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['foods'] = $this->db->order_by('id', 'DESC')->get('food')->result_array();

        $this->form_validation->set_rules('food', 'Food', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/food', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('food', ['food' => $this->input->post('food')]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Food Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $data = array('food' => $this->input->post('food'));

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('food', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Food Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('food');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Food Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
