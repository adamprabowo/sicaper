<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_pindah extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function createPindah($insert){
		$this->db->set($insert);
		$this->db->insert('perpindahan');
		return $this->db->insert_id();
	}

	public function getAllDesa(){
    	$this->db->select('*');
    	$this->db->order_by('desa', 'ASC');
    	$query = $this->db->get('desa');
    	return $query->result();
    }


}
?>