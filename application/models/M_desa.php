<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_desa extends CI_Model {


	public function __construct(){
		parent::__construct();
	}

	public function getAllDesa(){
    	$this->db->select('*');
    	$this->db->order_by('desa', 'ASC');
    	$query = $this->db->get('desa');
    	return $query->result();
    }

    public function getDetailDesa($where){
    	$this->db->select('*');
    	$this->db->where($where);
    	$query = $this->db->get('desa');
        // echo $this->db->last_query();
    	return $query->row();
    }


}
?>