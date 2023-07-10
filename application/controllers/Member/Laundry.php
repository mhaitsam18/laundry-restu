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
        $data['member'] = $this->db->get_where('member', ['user_id' => $data['user']['id']])->row();
        $data['daerahs'] = $this->db->get('daerah')->result();
        $data['pakets'] = $this->db->get('paket')->result();

        $this->db->select('laundry.*, jenis_laundry.jenis_laundry');
        $this->db->join('jenis_laundry', 'laundry.jenis_laundry_id = jenis_laundry.id', 'left');
        $data['laundrys'] = $this->db->get('laundry')->result();
        
        
        if ($this->input->post('form') == "member") {
            $this->form_validation->set_rules('daerah_id', 'Daerah', 'trim|required');
            $this->form_validation->set_rules('nama_kost', 'Nama Kost', 'trim|required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        }
        
        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('member/laundry', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('form') == "member") {
                if ($this->input->post('aksi') == "add") {
                    $this->db->insert('member', [
                        'user_id' => $data['user']['id'],
                        'daerah_id' => $this->input->post('daerah_id'),
                        'nama_kost' => $this->input->post('nama_kost'),
                        'alamat' => $this->input->post('alamat'),
                        'paket_id' => 1,
                    ]);
    
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Data Member telah dilengkapi!
                        </div>');
                    $this->session->set_flashdata('flash', 'Data Member telah dilengkapi!');
                } elseif ($this->input->post('aksi') == "update") {
                    $this->db->where('member_id', $this->input->post('member_id'));
                    $this->db->update('member', [
                        'daerah_id' => $this->input->post('daerah_id'),
                        'nama_kost' => $this->input->post('nama_kost'),
                        'alamat' => $this->input->post('alamat')
                    ]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Data Member telah diperbarui!
                        </div>');
                    $this->session->set_flashdata('flash', 'Data Member telah diperbarui!');
                }
            } elseif ($this->input->post('form') == "laundry") {
                if ($this->input->post('aksi') == "add") {
                    $this->db->insert('laundry', [
                        'member_id' => $this->input->post('member_id'),
                    ]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Kurir Anda akan segera datang dan menghubungi Anda :)
                        </div>');
                    $this->session->set_flashdata('flash', 'Kurir Anda akan segera datang dan menghubungi Anda :)');
                } elseif($this->input->post('aksi') == "update"){
                    $this->db->where('id', $this->input->post('id'));
                    $this->db->update('laundry', [
                        'testimoni' => $this->input->post('testimoni'),
                    ]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Testimoni terkirim
                        </div>');
                    $this->session->set_flashdata('flash', 'Testimoni terkirim');
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
