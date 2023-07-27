<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beban extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Beban pengeluaran";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $data['bebans'] = $this->db->get('beban')->result_array();
        		
        $this->form_validation->set_rules('beban', 'Beban', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal Transaksi', 'required|trim');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('laundry/beban', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {

                $data = [
                    'user_id' => $data['user']['id'],
                    'beban' => htmlspecialchars($this->input->post('beban', true)),
                    'harga' => htmlspecialchars($this->input->post('harga', true)),
                    'tanggal_transaksi' => htmlspecialchars($this->input->post('tanggal_transaksi', true)),
                ];
                $this->db->insert('beban', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Beban Pengeluaran berhasil disimpan!
                    </div>');
                $this->session->set_flashdata('success', 'Data Beban Pengeluaran berhasil ditambahkan!');
            } elseif ($this->input->post('aksi') == "update") {
                $data = [
                    'user_id' => $data['user']['id'],
                    'beban' => htmlspecialchars($this->input->post('beban', true)),
                    'harga' => htmlspecialchars($this->input->post('harga', true)),
                    'tanggal_transaksi' => htmlspecialchars($this->input->post('tanggal_transaksi', true)),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('beban', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Beban Pengeluaran berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('success', 'Data Beban Pengeluaran berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('beban');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Beban Pengeluaran berhasil dihapus!
			</div>');
        $this->session->set_flashdata('success', 'Data Beban Pengeluaran berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
