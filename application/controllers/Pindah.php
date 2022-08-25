<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindah extends CI_Controller {
	private $getSession = null;

	public function __construct(){
		parent::__construct();
		$sess = $this->getSession = $this->session->all_userdata();
		if(empty($sess['user_id'])){
            redirect('home/login');
        }
		$this->load->view('pindah/style');
		$this->load->model('m_pindah');
	}
	
	public function index()
	{
		$data['desa'] = $this->m_pindah->getAllDesa();
		$this->load->view('templates/header');
		$this->load->view('pindah/v_pindah',$data);
		$this->load->view('templates/footer');
	}

	public function inputPerpindahan(){
		$data = $this->input->post();
		$data['id_operator'] = $this->getSession['user_id'];
        if ($this->m_pindah->createPindah($data)) {
        	$this->session->set_flashdata('success', 'Input perpindahan berhasil dibuat');
			redirect('pindah');
        }
	}


}
