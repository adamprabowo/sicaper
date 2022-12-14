<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_pindah extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getPindah(){
    	$this->db->select('*');
		$this->db->order_by('id_pindah', 'DESC');
    	$query = $this->db->get('perpindahan');
    	return $query->result();
    }

	public function createPindah($insert){
		$this->db->set($insert);
		$this->db->insert('perpindahan');
		return $this->db->insert_id();
	}

	public function updatePindah($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('perpindahan');
		return $result;
	}

	public function deletePindah($id){
        $this->db->where('id_pindah', $id);
        return $this->db->delete('perpindahan');
    }

	public function getJumlahPindahTotal(){
		$this->db->select('count(*) as jumlah');
		return $this->db->get('perpindahan')->result();
	}

	public function getJumlahPindahHariIni(){
		$this->db->select('count(*) as jumlah');
		$this->db->where('created_date',date('Y-m-d'));
		return $this->db->get('perpindahan')->result();
	}


}
?>