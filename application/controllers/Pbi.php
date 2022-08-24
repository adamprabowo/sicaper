<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pbi extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->view('pbi/style');
	}
	
	public function aktif()
	{
		$this->load->view('templates/header');
		$this->load->view('pbi/v_pbi_aktif');
		$this->load->view('templates/footer');
	}

	public function nonaktif()
	{
		$this->load->view('templates/header');
		$this->load->view('pbi/v_pbi_nonaktif');
		$this->load->view('templates/footer');
	}


	
}
