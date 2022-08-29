<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('m_user');
	}
	
	public function index()
	{
		$this->load->view('v_login');
	}

	public function action(){
		$where['username'] = $this->input->post('username');
		$where['password'] = md5($this->input->post('password'));
		$users = $this->m_user->getUser($where);
		if (!empty($users) && $users->password == $where['password'] && $users->is_active==1) {
			$data = $users;
				$this->session->set_userdata('user_id',$data->user_id);
				$this->session->set_userdata('username',$data->username);
				$this->session->set_userdata('is_active',$data->is_active);
				$this->session->set_userdata('role_name',$data->role_name);
				redirect('dashboard');
		}
		else{
			$data = array(
            	'error_message' => 'Username / Kata Sandi yang anda masukkan salah.'
            );
           $this->load->view('v_login',$data);
		}
	}


}
