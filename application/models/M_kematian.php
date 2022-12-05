<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_kematian extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getData(){
    	$this->db->select('*');
    	$query = $this->db->get('kematian');
    	return $query->result();
    }

	public function create($insert){
		$this->db->set($insert);
		$this->db->insert('kematian');
		return $this->db->insert_id();
	}

	public function update($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('kematian');
		return $result;
	}

	public function delete($id){
        $this->db->where('id_kematian', $id);
        return $this->db->delete('kematian');
    }

	public function getJumlahKematianTotal(){
		$this->db->select('count(*) as jumlah');
		return $this->db->get('kematian')->result();
	}

	public function getJumlahKematianHariIni(){
		$this->db->select('count(*) as jumlah');
		$this->db->where('created_date',date('Y-m-d'));
		return $this->db->get('kematian')->result();
	}

}
?>