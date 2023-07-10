<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Phylum extends CI_Controller
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
        $data['title'] = "Data Master phylum";
        $data['dataMaster'] = $this->db->get_where('user_sub_menu', ['menu_id' => 14])->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('phylums.*, kingdoms.kingdom');
        $this->db->join('kingdoms','phylums.kingdom_id = kingdoms.id', 'left');
        $data['phylums'] = $this->db->get('phylums')->result_array();
        
        $data['kingdoms'] = $this->db->get('kingdoms')->result_array();

        $this->form_validation->set_rules('phylum', 'phylum', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/phylum', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('phylums', [
                    'phylum' => $this->input->post('phylum'),
                    'kingdom_id' => $this->input->post('kingdom_id'),
                    'description' => $this->input->post('description'),
                    'picture' => $this->input->post('picture')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New phylum Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $upload_picture = $_FILES['picture']['name'];
                if ($upload_picture) {
                    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                    $config['upload_path'] = './assets/img/phylum';
                    $config['max_size']     = '4096';

                    // Generate random file name
                    $config['file_name'] = uniqid();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('picture')) {
                        $new_picture = $this->upload->data('file_name');
                        $this->db->set('picture', 'phylum/' . $new_picture);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $data = array(
                    'phylum' => $this->input->post('phylum'),
                    'kingdom_id' => $this->input->post('kingdom_id'),
                    'description' => $this->input->post('description')
                );

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('phylums', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                phylum Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('phylums');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        phylum Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
