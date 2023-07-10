<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laundry extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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

        $this->db->select('laundry.*, jenis_laundry.jenis_laundry, user_member.name AS nama_member, user_kurir.name AS nama_kurir');
        $this->db->join('jenis_laundry', 'laundry.jenis_laundry_id = jenis_laundry.id', 'left');
        $this->db->join('member', 'laundry.member_id = member.id', 'left');
        $this->db->join('user AS user_member', 'member.user_id = user_member.id', 'left');
        $this->db->join('kurir', 'laundry.kurir_id = kurir.id', 'left');
        $this->db->join('user AS user_kurir', 'kurir.user_id = user_kurir.id', 'left');
        $data['laundrys'] = $this->db->get('laundry')->result_array();

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
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Kurir Anda akan segera datang dan menghubungi Anda :)
                    </div>');
                $this->session->set_flashdata('flash', 'Kurir Anda akan segera datang dan menghubungi Anda :)');
            } elseif ($this->input->post('aksi') == "update") {
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('laundry', [
                    'testimoni' => $this->input->post('testimoni'),
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Testimoni terkirim
                    </div>');
                $this->session->set_flashdata('flash', 'Testimoni terkirim');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
