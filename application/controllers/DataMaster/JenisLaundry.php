<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisLaundry extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Jenis Laundry";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jenis_laundrys'] = $this->db->get('jenis_laundry')->result_array();
        $this->form_validation->set_rules('jenis_laundry', 'Jenis Laundry', 'trim|required');
        $this->form_validation->set_rules('tipe_laundry', 'Tipe Laundry', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required');
        $this->form_validation->set_rules('lama', 'Lama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/jenis-laundry', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('jenis_laundry', [
                    'jenis_laundry' => $this->input->post('jenis_laundry'),
                    'tipe_laundry' => $this->input->post('tipe_laundry'),
                    'harga' => $this->input->post('harga'),
                    'lama' => $this->input->post('lama'),
                    'deskripsi' => $this->input->post('deskripsi'),
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Jenis Laundry berhasil ditambahkan!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {


                // $upload_picture = $_FILES['picture']['name'];
                // if ($upload_picture) {
                //     $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                //     $config['upload_path'] = './assets/img/jenis_laundry';
                //     $config['max_size']     = '4096';

                //     // Generate random file name
                //     $config['file_name'] = uniqid();
                //     $this->load->library('upload', $config);
                //     if ($this->upload->do_upload('picture')) {
                //         $new_picture = $this->upload->data('file_name');
                //         $this->db->set('picture', 'jenis_laundry/' . $new_picture);
                //     } else {
                //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                //         redirect($_SERVER['HTTP_REFERER']);
                //     }
                // }

                $data = [
                    'jenis_laundry' => $this->input->post('jenis_laundry'),
                    'tipe_laundry' => $this->input->post('tipe_laundry'),
                    'harga' => $this->input->post('harga'),
                    'lama' => $this->input->post('lama'),
                    'deskripsi' => $this->input->post('deskripsi'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('jenis_laundry', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Jenis Laundry berhasil diperbarui!
                    </div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_laundry');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        jenis laundry berhasil dihapus!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
