<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		// is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('Member_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data['title'] = "Beranda";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dashboard'] = $this->db->get('dashboard')->row_array();
		$this->load->view('layouts/header-member', $data);
		$this->load->view('layouts/topbar-member', $data);
		$this->load->view('member/index', $data);
		$this->load->view('layouts/footer-member');
	}

	
}