<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laundry extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $members = $this->db->get('member')->result();
        foreach ($members as $member) {
            if ($member->kadaluarsa_paket < date('Y-m-d')) {
                $this->db->where('id', $member->id);
                $this->db->update('member', [
                    'kadaluarsa_paket' => null
                ]);
            }
        }
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Laundry";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        

        $this->db->select('user.*, member.*, user.id as user_id, member.id as member_id, daerah.nama as nama_daerah, paket.paket');
        $this->db->join('user', 'member.user_id = user.id');
        $this->db->join('daerah', 'member.daerah_id = daerah.id', 'left');
        $this->db->join('paket', 'member.paket_id = paket.id', 'left');
        $data['members'] = $this->db->get('member')->result();
        
        $this->db->select('kurir.*, user.name');
        $this->db->join('user', 'kurir.user_id = user.id');
        $data['kurirs'] = $this->db->get('kurir')->result();

        $data['daerahs'] = $this->db->get('daerah')->result();
        $data['pakets'] = $this->db->get('paket')->result();
        $data['jenis_laundrys'] = $this->db->get('jenis_laundry')->result();

        $this->db->select('laundry.*, jenis_laundry.jenis_laundry, jenis_laundry.tipe_laundry, user_member.name AS nama_member, user_kurir.name AS nama_kurir, paket.paket, member.paket_id');
        $this->db->join('jenis_laundry', 'laundry.jenis_laundry_id = jenis_laundry.id', 'left');
        $this->db->join('member', 'laundry.member_id = member.id', 'left');
        $this->db->join('paket', 'member.paket_id = paket.id', 'left');
        $this->db->join('user AS user_member', 'member.user_id = user_member.id', 'left');
        $this->db->join('kurir', 'laundry.kurir_id = kurir.id', 'left');
        $this->db->join('user AS user_kurir', 'kurir.user_id = user_kurir.id', 'left');
        $data['laundrys'] = $this->db->get('laundry')->result_array();

        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('laundry/laundry', $data);
            $this->load->view('layouts/footer');
        } else {
            if ($this->input->post('aksi') == "add") {
                $this->db->insert('laundry', [
                    'member_id' => $this->input->post('member_id'),
                    'pengantaran' => $this->input->post('pengantaran'),
                    'kurir_id' => $this->input->post('kurir_id'),
                    'jenis_laundry_id' => $this->input->post('jenis_laundry_id'),
                    'berat' => $this->input->post('berat'),
                    'harga' => $this->input->post('harga'),
                    'pembayaran' => $this->input->post('pembayaran'),
                    'status' => $this->input->post('status'),
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Laundry tersimpan
                    </div>');
                $this->session->set_flashdata('success', 'Data Laundry tersimpan');
            } elseif ($this->input->post('aksi') == "update") {
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('laundry', [
                    'member_id' => $this->input->post('member_id'),
                    'pengantaran' => $this->input->post('pengantaran'),
                    'kurir_id' => $this->input->post('kurir_id'),
                    'jenis_laundry_id' => $this->input->post('jenis_laundry_id'),
                    'berat' => $this->input->post('berat'),
                    'harga' => $this->input->post('harga'),
                    'pembayaran' => $this->input->post('pembayaran'),
                    'status' => $this->input->post('status'),
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Laundry tersimpan
                    </div>');
                $this->session->set_flashdata('success', 'Data Laundry tersimpan');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('laundry');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        laundry berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'Data laundry berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hitungHarga()
    {
        $berat = $this->input->post('berat');
        $this->db->select("(harga*$berat) AS total_harga");
        echo $this->db->get_where('jenis_laundry', ['id' => $this->input->post('jenis_laundry_id')])->row()->total_harga;
    }
    
    public function hitungHargaPaket()
    {
        echo $this->db->get_where('paket', ['id' => $this->input->post('paket_id')])->row()->harga;
    }
    public function ubahPaketId()
    {
        echo $this->db->get_where('member', ['id' => $this->input->post('member_id')])->row()->paket_id;
    }
}
