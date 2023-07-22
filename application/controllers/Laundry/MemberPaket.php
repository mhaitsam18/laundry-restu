<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MemberPaket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Paket Member";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('user.name, member_paket.*, paket.paket, member.id AS member_id, paket.id AS paket_id');
        $this->db->join('paket', 'member_paket.paket_id = paket.id');
        $this->db->join('member', 'member_paket.member_id = member.id');
        $this->db->join('user', 'member.user_id = user.id');
        $data['member_pakets'] = $this->db->get('member_paket')->result_array();
        
        $this->db->select('user.name, member.*');
        $this->db->join('user', 'member.user_id = user.id');
        $data['members'] = $this->db->get('member')->result();
        
        $data['pakets'] = $this->db->get('paket')->result();

        $this->form_validation->set_rules('member_id', 'Member', 'required|trim');
        $this->form_validation->set_rules('paket_id', 'Paket', 'required|trim');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('laundry/member-paket', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {

                $data = [
                    'member_id' => htmlspecialchars($this->input->post('member_id', true)),
                    'paket_id' => htmlspecialchars($this->input->post('paket_id', true)),
                    'harga_bayar' => htmlspecialchars($this->input->post('harga_bayar', true)),
                    'kadaluarsa_paket' => date('Y-m-d', strtotime('+1 month')),
                ];
                $this->db->insert('member_paket', $data);

                $this->db->where('id', $this->input->post('member_id'));
                $this->db->update('member', [
                    'paket_id' => htmlspecialchars($this->input->post('paket_id', true)),
                    'kadaluarsa_paket' => date('Y-m-d', strtotime('+1 month')),
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Paket Member berhasil disimpan!
                    </div>');
                $this->session->set_flashdata('flash', 'Data Paket Member berhasil ditambahkan!');
            } elseif ($this->input->post('aksi') == "update") {
                $data = [
                    'member_id' => htmlspecialchars($this->input->post('member_id', true)),
                    'paket_id' => htmlspecialchars($this->input->post('paket_id', true)),
                    'harga_bayar' => htmlspecialchars($this->input->post('harga_bayar', true)),
                    'kadaluarsa_paket' => htmlspecialchars($this->input->post('kadaluarsa_paket', true)),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('member_paket', $data);

                $this->db->where('id', $this->input->post('member_id'));
                $this->db->update('member', [
                    'paket_id' => htmlspecialchars($this->input->post('paket_id', true)),
                    'kadaluarsa_paket' => htmlspecialchars($this->input->post('kadaluarsa_paket', true)),
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Paket Member berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('flash', 'Data Paket Member berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member_paket');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        paket member berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'Data paket member berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
