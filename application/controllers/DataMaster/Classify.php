<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classify extends CI_Controller
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
        $data['title'] = "Data Master classify";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('classifies.*, phylums.phylum, subphylum.subphylum, infraphylum.infraphylum, superclass.superclass, kingdoms.kingdom');
        $this->db->join('subphylum', 'classifies.subphylum_id = subphylum.id', 'left');
        $this->db->join('infraphylum', 'classifies.infraphylum_id = infraphylum.id', 'left');
        $this->db->join('superclass', 'classifies.superclass_id = superclass.id', 'left');
        
        $this->db->join('phylums', 'classifies.phylum_id = phylums.id', 'left');
        $this->db->join('kingdoms', 'phylums.kingdom_id = kingdoms.id', 'left');
        $data['classifies'] = $this->db->get('classifies')->result_array();
        
        $data['phylums'] = $this->db->get('phylums')->result_array();
        $data['subphylums'] = $this->db->get('subphylum')->result_array();
        $data['infraphylums'] = $this->db->get('infraphylum')->result_array();
        $data['superclassifies'] = $this->db->get('superclass')->result_array();

        $this->form_validation->set_rules('classify', 'classify', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/classify', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('classifies', [
                    'classify' => $this->input->post('classify'),
                    'general_name' => $this->input->post('general_name'),
                    'phylum_id' => $this->input->post('phylum_id'),
                    'subphylyum_id' => $this->input->post('subphylyum_id'),
                    'infraphylum_id' => $this->input->post('infraphylum_id'),
                    'superclass_id' => $this->input->post('superclass_id'),
                    'description' => $this->input->post('description'),
                    'picture' => $this->input->post('picture'),
                    'species' => $this->input->post('species')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New classify Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {


                $upload_picture = $_FILES['picture']['name'];
                if ($upload_picture) {
                    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                    $config['upload_path'] = './assets/img/classify';
                    $config['max_size']     = '4096';

                    // Generate random file name
                    $config['file_name'] = uniqid();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('picture')) {
                        $new_picture = $this->upload->data('file_name');
                        $this->db->set('picture', 'classify/'.$new_picture);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $data = [
                    'classify' => $this->input->post('classify'),
                    'general_name' => $this->input->post('general_name'),
                    'phylum_id' => $this->input->post('phylum_id'),
                    'subphylum_id' => $this->input->post('subphylum_id'),
                    'infraphylum_id' => $this->input->post('infraphylum_id'),
                    'superclass_id' => $this->input->post('superclass_id'),
                    'description' => $this->input->post('description'),
                    'species' => $this->input->post('species')
                ];
                $this->db->where('id', $this->input->post('id'));
                $this->db->update('classifies', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                classify Updated!
                    </div>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('classifies');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        classify Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
