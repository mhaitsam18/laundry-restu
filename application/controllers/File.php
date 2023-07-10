<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function artikel()
	{
		if (!empty($_FILES['thumbnail']['name'])) {
			$config['upload_path'] = './assets/img/artikel/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('thumbnail')) {
			$file_name = $this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	
	public function kingdom()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/kingdom/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'kingdom/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function phylum()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/phylum/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'phylum/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function classify()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/classify/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'classify/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function order()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/order/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'order/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function family()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/family/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'family/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function genus()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/genus/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'genus/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function species()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/species/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'species/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
	public function fish()
	{
		if (!empty($_FILES['file']['name'])) {
			$config['upload_path'] = './assets/img/fish/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = '4096';

			// Generate random file name
			$config['file_name'] = uniqid();

			$this->load->library('upload', $config);
		}
		if ($this->upload->do_upload('file')) {
			$file_name = 'fish/'.$this->upload->data('file_name');
			echo $file_name;
		} else {
			$error = $this->upload->display_errors();
			// Handle error
			return $error;
		}
	}
}
