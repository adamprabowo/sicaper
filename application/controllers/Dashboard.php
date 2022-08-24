<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->view('dashboard/style');
	}
	
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('dashboard/v_dashboard');
		$this->load->view('templates/footer');
	}


}
