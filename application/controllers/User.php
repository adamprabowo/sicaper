<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $getSession = null;

	public function __construct(){
		parent::__construct();
		$this->load->model('m_role');
		$this->load->model('m_user');
		$this->load->view('user/style');
		$sess = $this->getSession = $this->session->all_userdata();
		if(empty($sess['user_id'])){
            redirect('login');
        }
	}
	
	public function index()
	{
		$param['user.role_id'] = 3;
		$param['is_active'] = 1;
		$data['users'] = $this->m_user->getAllUser($param);
		$role['role_id'] = 3;
		$data['roles'] = $this->m_role->getRole($role);
		$this->load->view('templates/header');
		$this->load->view('user/v_user',$data);
		$this->load->view('templates/footer');
	}

	public function tambahPengguna(){
		$insert['username'] = $this->input->post('username');
		$insert['password'] = md5($this->input->post('password'));
		$insert['role_id'] = $this->input->post('role');
		$insert['is_active'] = $this->input->post('status');
		if ($this->m_user->insertUser($insert)) {
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Pengguna baru berhasil dibuat');
			redirect('user');
		}
	}

	public function editPengguna(){
		$where['user_id'] = $this->input->post('user_id');
		$update['username'] = $this->input->post('username');
		$update['password'] = md5($this->input->post('password'));
		$update['role_id'] = $this->input->post('role_id');
		$update['is_active'] = $this->input->post('is_active');
		if ($this->m_user->updateUser($update,$where)) {
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Perpindahan berhasil diubah');
			redirect('user');
        }
	}

	public function deletePengguna($id){    
	    if ($this->m_user->deleteUser($id)) {
	    	$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Pengguna berhasil dihapus');
			redirect('user');
	    } 
    }

	public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('is_active');
        $this->session->sess_destroy();
        redirect(site_url().'login');
    }


}
