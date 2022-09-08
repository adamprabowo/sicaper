<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pbi extends CI_Controller {
	private $getSession = null;

	public function __construct(){
		parent::__construct();
		$this->load->library(array('excel','session'));
		$this->load->model('m_pbi');
		$this->load->view('pbi/style');
		$sess = $this->getSession = $this->session->all_userdata();
		if(empty($sess['user_id'])){
            redirect('login');
        }
	}
	
	public function aktif()
	{
		$sess['session'] = $this->getSession;
		$data['pbi_aktif'] = $this->m_pbi->getPbiAktif();
		$this->load->view('templates/header',$sess);
		$this->load->view('pbi/v_pbi_aktif',$data,$sess);
		$this->load->view('templates/footer');
	}

	public function nonaktif()
	{
		$data = [];
		$q_pbi_nonaktif = $this->m_pbi->getPbiNonaktif();
		$i=0;
		foreach ($q_pbi_nonaktif as $param) {
			$data['pbi_nonaktif'][$i] = $this->returnData($param);
			$i++;
		}
		$sess['session'] = $this->getSession;
		$this->load->view('templates/header',$sess);
		$this->load->view('pbi/v_pbi_nonaktif',$data);
		$this->load->view('templates/footer');
	}

	private function returnData($param){
		$keterangan = '';
		switch ($param->keterangan) {
			case 'kematian':
				$keterangan='Kematian';
				break;
			case 'pindah_kab':
				$keterangan='Pindah Kabupaten';
				break;
			case 'pindah_prov':
				$keterangan='Pindah Provinsi';
				break;
		}

		$model = [];
        if(!empty($param)){
            $model = [
				'no' => $param->id_pbi,
                'nik' => $param->nik,
				'keterangan' => $keterangan
            ];
        }
		$return = (object) $model;

		return $return;
	}

	public function importExcel(){
		if (isset($_FILES["fileExcel"]["name"])) {
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$id_pbi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nik = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$temp_data[] = array(
						'id_pbi'	=> $id_pbi,
						'nik'		=> $nik,
						'status'	=> 1,
						'created_date' => date('Y-m-d')
					); 	
				}
			}
			$emptyPbi = $this->m_pbi->delete();
			if ($emptyPbi) {
				$insert = $this->m_pbi->insert($temp_data);
				if($insert){
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
					redirect('pbi/aktif');
				}
				else{
					$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
					redirect('pbi/aktif');
				}
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}


	
}
