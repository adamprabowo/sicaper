<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->view('user/style');
	}
	
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('user/v_user');
		$this->load->view('templates/footer');
	}


}
