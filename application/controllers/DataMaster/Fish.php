<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fish extends CI_Controller
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
        $data['title'] = "Data Ikan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('fish.*, abundance.abundance, fish_type.type, species.species, subspecies.subspecies, genera.genus, families.family, order.order, classifies.classify, phylums.phylum, kingdoms.kingdom');
        $this->db->join('species', 'fish.species_id = species.id', 'left');
        $this->db->join('subspecies', 'fish.subspecies_id = subspecies.id', 'left');
        $this->db->join('genera', 'species.genus_id = genera.id', 'left');
        $this->db->join('families', 'genera.family_id = families.id', 'left');
        $this->db->join('order', 'families.order_id = order.id', 'left');
        $this->db->join('classifies', 'order.classify_id = classifies.id', 'left');
        $this->db->join('phylums', 'classifies.phylum_id = phylums.id', 'left');
        $this->db->join('kingdoms', 'phylums.kingdom_id = kingdoms.id', 'left');
        $this->db->join('fish_type', 'fish.fish_type_id = fish_type.id', 'left');
        $this->db->join('abundance', 'fish.abundance_id = abundance.id', 'left');
        $data['fishs'] = $this->db->get('fish')->result_array();
        $data['subspeciess'] = $this->db->get('subspecies')->result_array();
        $data['speciess'] = $this->db->get('species')->result_array();
        $data['abundances'] = $this->db->get('abundance')->result_array();
        $data['fish_types'] = $this->db->get('fish_type')->result_array();

        $this->form_validation->set_rules('fish', 'fish', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->index();
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('layouts/topbar', $data);
            $this->load->view('data-master/fish', $data);
            $this->load->view('layouts/footer');
        } else {

            if ($this->input->post('aksi') == "add") {
                $this->db->insert('fish', [
                    'scientific_name' => $this->input->post('scientific_name'),
                    'general_name' => $this->input->post('general_name'),
                    'synonim' => $this->input->post('synonim'),
                    'species_id' => $this->input->post('species_id'),
                    'subspecies_id' => $this->input->post('subspecies_id'),
                    'fish_type_id' => $this->input->post('fish_type_id'),
                    'abundance_id' => $this->input->post('abundance_id'),
                    'length' => $this->input->post('length'),
                    'weight' => $this->input->post('weight'),
                    'information' => $this->input->post('information'),
                    'image' => $this->input->post('image'),
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New fish Added!
                    </div>');
            } elseif ($this->input->post('aksi') == "update") {

                $upload_image = $_FILES['image']['name'];
                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                    $config['upload_path'] = './assets/img/fish';
                    $config['max_size']     = '4096';

                    // Generate random file name
                    $config['file_name'] = uniqid();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')) {
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('image', 'fish/' . $new_image);
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }

                $data = array(
                    'scientific_name' => $this->input->post('scientific_name'),
                    'general_name' => $this->input->post('general_name'),
                    'synonim' => $this->input->post('synonim'),
                    'species_id' => $this->input->post('species_id'),
                    'subspecies_id' => $this->input->post('subspecies_id'),
                    'fish_type_id' => $this->input->post('fish_type_id'),
                    'abundance_id' => $this->input->post('abundance_id'),
                    'length' => $this->input->post('length'),
                    'weight' => $this->input->post('weight'),
                    'information' => $this->input->post('information'),
                );

                $this->db->where('id', $this->input->post('id'));
                $this->db->update('fish', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                fish Updated!
                    </div>');
            }


            // redirect('admin/role');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('fish');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        fish Deleted!
			</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}
