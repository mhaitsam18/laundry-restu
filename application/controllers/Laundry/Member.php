<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Member";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('user.*, member.*, user.id as user_id, member.id as member_id, daerah.nama as nama_daerah, paket.paket');
        $this->db->join('user', 'member.user_id = user.id');
        $this->db->join('daerah', 'member.daerah_id = daerah.id', 'left');
        $this->db->join('paket', 'member.paket_id = paket.id', 'left');
        $data['members'] = $this->db->get('member')->result_array();
        $data['daerahs'] = $this->db->get('daerah')->result();
        $data['pakets'] = $this->db->get('paket')->result();
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        if ($this->input->post('aksi') == 'update') {
            $this->db->join('user', 'member.user_id = user.id');
            $member = $this->db->get_where('member', ['member.id' => $this->input->post('id')])->row();
            if ($member->email != $this->input->post('email')) {
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
            } else{
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

            }
            if ($member->username != $this->input->post('username')) {
                $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
                    'is_unique' => 'this Username has already registered!'
                ]);
            } else{
                $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                    'is_unique' => 'this Username has already registered!'
                ]);
            }
        } else{
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
                'is_unique' => 'this email has already registered!'
            ]);
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
                'is_unique' => 'this Username has already registered!'
            ]);
        }
        $this->form_validation->set_rules('gender', 'Gander', 'required|trim');
        $this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        // $this->form_validation->set_rules('foto_ktp', 'Foto KTP', 'trim|required');
        $this->form_validation->set_rules('daerah_id', 'Daerah', 'trim|required');
        $this->form_validation->set_rules('nama_kost', 'Nama Kost', 'trim|required');
        // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('paket_id', 'Paket', 'trim|required');

        if ($this->input->post('aksi') == "add") {
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]', [
                'matches' => 'password dont match!',
                'min_length' => 'password too short!'
            ]);
            $this->form_validation->set_rules('password2', 'Confrim Password', 'required|trim|matches[password1]');
        }

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('laundry/member', $data);
            $this->load->view('layouts/footer');
        } else {
            $member = $this->db->get_where('member', [
                'id' => $this->input->post('id')
            ])->row_array();
            if ($this->input->post('paket_id') != 1) {
                if(!$member['kadaluarsa_paket']){
                    $kadaluarsa_paket = date('Y-m-d', strtotime('+30 days'));
                } else {
                    $kadaluarsa_paket = $this->input->post('kadaluarsa_paket');
                }
            } else {
                $kadaluarsa_paket = null;
            }
            
            if ($this->input->post('aksi') == "add") {

                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'gender' => htmlspecialchars($this->input->post('gender', true)),
                    'birthday' => htmlspecialchars($this->input->post('birthday', true)),
                    'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
                    'address' => htmlspecialchars($this->input->post('address', true)),
                    'image' => htmlspecialchars($this->input->post('image', true)),
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => 3,
                    'is_active' => 1,
                    'date_created' => time(),
                ];
                $this->db->insert('user', $data);

                $user_id = $this->db->insert_id();
                $this->db->insert('member', [
                    'user_id' => $user_id,
                    'daerah_id' => $this->input->post('daerah_id'),
                    'nama_kost' => $this->input->post('nama_kost'),
                    'alamat' => $this->input->post('address'),
                    'paket_id' => $this->input->post('paket_id'),
                    'kadaluarsa_paket' => $kadaluarsa_paket,
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    member berhasil ditambahkan!
                    </div>');
                $this->session->set_flashdata('flash', 'Data Member berhasil ditambahkan!');
            } elseif ($this->input->post('aksi') == "update") {


                $upload_image = $_FILES['image']['name'];
                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                    $config['upload_path'] = './assets/img/profile';
                    $config['max_size']     = '4096';

                    // Generate random file name
                    $config['file_name'] = uniqid();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('image', 'profile/' . $new_image);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $data = [
                    'name' => htmlspecialchars($this->input->post('name', true)),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'gender' => htmlspecialchars($this->input->post('gender', true)),
                    'birthday' => htmlspecialchars($this->input->post('birthday', true)),
                    'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
                    'address' => htmlspecialchars($this->input->post('address', true)),
                ];
                $this->db->where('id', $this->input->post('user_id'));
                $this->db->update('user', $data);

                $data = [
                    'daerah_id' => $this->input->post('daerah_id'),
                    'nama_kost' => $this->input->post('nama_kost'),
                    'alamat' => $this->input->post('address'),
                    'paket_id' => $this->input->post('paket_id'),
                    'kadaluarsa_paket' => $kadaluarsa_paket,
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('member', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                member berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('flash', 'Data Member berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        member berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'Data Member berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
