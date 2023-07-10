<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data kurir";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('user.*, kurir.*, user.id as user_id, kurir.id as kurir_id');
        $this->db->join('user', 'kurir.user_id = user.id');
        $data['kurirs'] = $this->db->get('kurir')->result_array();
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'this email has already registered!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'this Username has already registered!'
        ]);
        $this->form_validation->set_rules('gender', 'Gander', 'required|trim');
        $this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        
        // $this->form_validation->set_rules('foto_ktp', 'Foto KTP', 'trim|required');
        $this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'trim|required');
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
            $this->load->view('laundry/kurir', $data);
            $this->load->view('layouts/footer');
        } else {

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

                $this->db->insert('kurir', [
                    'user_id' => $user_id,
                    'no_ktp' => $this->input->post('no_ktp')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    kurir berhasil ditambahkan!
                    </div>');
                $this->session->set_flashdata('flash', 'berhasil ditambahkan!');
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
                    'user_id' => $this->input->post('user_id'),
                    'no_ktp' => $this->input->post('no_ktp'),
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('kurir', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                kurir berhasil diperbarui!
                    </div>');
                $this->session->set_flashdata('flash', 'berhasil diperbarui!');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kurir');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        kurir berhasil dihapus!
			</div>');
        $this->session->set_flashdata('flash', 'berhasil dihapus!');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
