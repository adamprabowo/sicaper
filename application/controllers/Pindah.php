<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pindah extends CI_Controller {
	private $getSession = null;

	public function __construct(){
		parent::__construct();
		$this->load->model('m_desa');
		$this->load->model('m_pbi');
		$this->load->model('m_pindah');
		$this->load->model('m_user');
		$this->load->view('pindah/style');
		$sess = $this->getSession = $this->session->all_userdata();
		if(empty($sess['user_id'])){
            redirect('login');
        }
	}
	
	public function index(){
		$data = [];
		$q_pindah = $this->m_pindah->getPindah();
		$i=0;
		foreach ($q_pindah as $param) {
			$data['pindah'][$i] = $this->returnData($param);
			$i++;
		}
		$data['desa'] = $this->m_desa->getAllDesa();
		$this->load->view('templates/header');
		$this->load->view('pindah/v_pindah',$data);
		$this->load->view('templates/footer');
	}

	public function inputPerpindahan(){
		$insert['nik'] = $this->input->post('nik');
		$insert['no_kk'] = $this->input->post('no_kk');
		$insert['no_skpwni'] = $this->input->post('no_skpwni');
		$insert['nama'] = $this->input->post('nama');
		$insert['id_desa'] = $this->input->post('id_desa');
		$insert['tgl_pindah'] = date("Y-m-d", strtotime($this->input->post('tgl_pindah')));
		$insert['keterangan'] = $this->input->post('keterangan');
		$insert['created_date'] = date('Y-m-d');
		$insert['id_operator'] = $this->getSession['user_id'];
        if ($id_pindah = $this->m_pindah->createPindah($insert)) {
			//cek data PBI
			$where['nik'] = $insert['nik'];
			$pbi = $this->m_pbi->getPbi($where);
			if (!empty($pbi->nik)) {
				$update['nik'] = $pbi->nik;
				$update['status'] = 0;
				$update['keterangan'] = $insert['keterangan'];
				$update['id_pindah'] = $id_pindah;
				$update['modified_date'] = date('Y-m-d');
				$this->m_pbi->updatePbi($update,$where);
			} 
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Input perpindahan berhasil dibuat');
			redirect('pindah');
        }
	}

	public function editPerpindahan(){
		$where['id_pindah'] = $this->input->post('id_pindah');
		$update['nik'] = $this->input->post('nik');
		$update['no_kk'] = $this->input->post('no_kk');
		$update['no_skpwni'] = $this->input->post('no_skpwni');
		$update['nama'] = $this->input->post('nama');
		$update['id_desa'] = $this->input->post('id_desa');
		$update['tgl_pindah'] = date("Y-m-d", strtotime($this->input->post('tgl_pindah')));
		$update['updated_date'] = date('Y-m-d');
        if ($this->m_pindah->updatePindah($update,$where)) {
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Perpindahan berhasil diubah');
			redirect('pindah');
        }
	}

	public function deletePerpindahan($id){    
	    if ($this->m_pindah->deletePindah($id)) {
	    	$this->session->set_flashdata('success', 'Perpindahan berhasil dihapus.');
	    	redirect('pindah');
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
                'id_pindah' => $param->id_pindah,
                'nik' => $param->nik,
                'no_kk' => $param->no_kk,
                'no_skpwni' => $param->no_skpwni,
                'nama' => $param->nama,
				'nama_desa' => $desa->desa,
                'tgl_pindah' => date("d-m-Y", strtotime($param->tgl_pindah)),
                'created_date' => $param->created_date,
                'nama_operator' => $user->username
            ];
        }
		$return = (object) $model;

		return $return;
	}


}
