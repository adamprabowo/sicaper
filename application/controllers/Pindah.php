<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindah extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->view('pindah/style');
		$this->load->model('m_pindah');
	}
	
	public function index()
	{
		$data['desa'] = $this->m_pindah->getAllDesa();
		// $data = $this->input->post();
		// $data['vin'] = $this->input->post('vin');
		// echo '<pre>';
		// print_r($data['desa']);
		// echo '</pre>';
		// die();
		// $this->m_pindah->createPindah($data);
		$this->load->view('templates/header');
		$this->load->view('pindah/v_pindah',$data);
		$this->load->view('templates/footer');
	}


}
