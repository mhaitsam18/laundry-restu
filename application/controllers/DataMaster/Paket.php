<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Paket";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pakets'] = $this->db->get('paket')->result_array();
        $this->form_validation->set_rules('paket', 'Paket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('lama', 'Lama', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/paket', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('paket', [
                    'paket' => $this->input->post('paket'),
                    'harga' => $this->input->post('harga'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'lama' => $this->input->post('lama'),
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Paket berhasil ditambahkan!
                    </div>');
                $this->session->set_flashdata('flash', 'Data paket berhasil ditambahkan!');
            } elseif ($this->input->post('aksi') == "update") {


                // $upload_picture = $_FILES['picture']['name'];
                // if ($upload_picture) {
                //     $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                //     $config['upload_path'] = './assets/img/paket';
                //     $config['max_size']     = '4096';

                //     // Generate random file name
                //     $config['file_name'] = uniqid();
                //     $this->load->library('upload', $config);
                //     if ($this->upload->do_upload('picture')) {
                //         $new_picture = $this->upload->data('file_name');
                //         $this->db->set('picture', 'paket/' . $new_picture);
                //     } else {
                //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                //         redirect($_SERVER['HTTP_REFERER']);
                //     }
                // }

                $data = [
                    'paket' => $this->input->post('paket'),
                    'harga' => $this->input->post('harga'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'lama' => $this->input->post('lama'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('paket', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Paket berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('flash', 'Data paket berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('paket');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Paket berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'Data paket berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}