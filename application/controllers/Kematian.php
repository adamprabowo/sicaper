<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kematian extends CI_Controller {
	private $getSession = null;

	public function __construct(){
		parent::__construct();
		$this->load->model('m_desa');
		$this->load->model('m_pbi');
		$this->load->model('m_kematian');
		$this->load->model('m_user');
		$this->load->view('kematian/style');
		$sess = $this->getSession = $this->session->all_userdata();
		if(empty($sess['user_id'])){
            redirect('login');
        }
	}
	
	public function index(){
		$data = [];
		$q_data = $this->m_kematian->getData();
		
		$i=0;
		foreach ($q_data as $param) {
			$data['kematian'][$i] = $this->returnData($param);
			$i++;
		} 	


		$data['desa'] = $this->m_desa->getAllDesa();
		$sess['session'] = $this->getSession;
		$this->load->view('templates/header',$sess);
		$this->load->view('kematian/v_kematian',$data);
		$this->load->view('templates/footer');
	}

	public function inputData(){
		$insert['nik'] = $this->input->post('nik');
		$insert['no_akta'] = $this->input->post('no_akta');
		$insert['nama'] = $this->input->post('nama');
		$insert['keterangan'] = "meninggal";
		$insert['created_date'] = date('Y-m-d');
		$insert['id_operator'] = $this->getSession['user_id'];

        if ($id_kematian = $this->m_kematian->create($insert)) {
			//cek data PBI
			$where['nik'] = $insert['nik'];
			$pbi = $this->m_pbi->getPbi($where);
			if (!empty($pbi->nik)) {
				$update['nik'] = $pbi->nik;
				$update['status'] = 0;
				$update['keterangan'] = $insert['keterangan'];
				$update['id_kematian'] = $id_kematian;
				$update['modified_date'] = date('Y-m-d');
				$this->m_pbi->updatePbi($update,$where);
			} 
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Input data berhasil dibuat');
			redirect('kematian');
        }
	}

	public function editData(){
		$where['id_kematian'] = $this->input->post('id_kematian');
		$update['nik'] = $this->input->post('nik');
		$update['nama'] = $this->input->post('nama');
		$update['no_akta'] = $this->input->post('no_akta');
		$update['modified_date'] = date('Y-m-d');
        if ($this->m_kematian->update($update,$where)) {
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Kematian berhasil diubah');
			redirect('kematian');
        }
	}

	public function deleteData($id){    
	    if ($this->m_kematian->delete($id)) {
	    	$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Kematian berhasil dihapus');
			redirect('kematian');
	    } 
    }

	private function returnData($param){
		$where_desa['id'] = $param->id_desa;
		$desa = $this->m_desa->getDetailDesa($where_desa);
		$where_user['user_id'] = $param->id_operator;
		$user = $this->m_user->getUser($where_user);

		$model = [];
        if(!empty($param)){
            $model = [
                'id_kematian' => $param->id_kematian,
                'nik' => $param->nik,
                'nama' => $param->nama,
                'no_akta' => $param->no_akta,
			//	'nama_desa' => $desa->desa,
             //   'tgl_aktakematian' => date("d-m-Y", strtotime($param->tgl_aktakematian)),
			//	'tgl_aktakematian' => $param->tgl_aktakematian,
                'created_date' => $param->created_date,
                'nama_operator' => $user->username
            ];
        }
		$return = (object) $model;

		return $return;
	}


}
