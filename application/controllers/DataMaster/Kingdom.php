<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kingdom extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('DataMaster_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Data Master kingdom";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kingdoms'] = $this->db->get('kingdoms')->result_array();

        $this->form_validation->set_rules('kingdom', 'kingdom', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/kingdom', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('kingdoms', [
                    'kingdom' => $this->input->post('kingdom'),
                    'description' => $this->input->post('description'),
                    'picture' => $this->input->post('picture')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New kingdom Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $upload_picture = $_FILES['picture']['name'];
                if ($upload_picture) {
                    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                    $config['upload_path'] = './assets/img/kingdom';
                    $config['max_size']     = '4096';

                    // Generate random file name
                    $config['file_name'] = uniqid();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('picture')) {
                        $new_picture = $this->upload->data('file_name');
                        $this->db->set('picture', 'kingdom/' . $new_picture);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $data = array(
                    'kingdom' => $this->input->post('kingdom'),
                    'description' => $this->input->post('description')
                );

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('kingdoms', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                kingdom Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kingdoms');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        kingdom Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
