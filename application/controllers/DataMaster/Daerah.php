<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daerah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Daerah";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['daerahs'] = $this->db->get('daerah')->result_array();
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/daerah', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('daerah', [
                    'nama' => $this->input->post('nama')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    daerah berhasil ditambahkan!
                    </div>');
                $this->session->set_flashdata('flash', 'berhasil ditambahkan!');
            } elseif ($this->input->post('aksi') == "update") {

                $data = [
                    'nama' => $this->input->post('nama'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('daerah', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                daerah berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('flash', 'berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('daerah');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        daerah berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
