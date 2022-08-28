<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_desa extends CI_Model {


	public function __construct(){
		parent::__construct();
	}

	public function getAllDesa(){
    	$this->db->select('desa.id as id, kode_kecamatan, desa, kecamatan.kode, kecamatan');
    	$this->db->order_by('desa', 'ASC');
		$this->db->join('kecamatan','desa.kode_kecamatan=kecamatan.kode');
    	$query = $this->db->get('desa');
    	return $query->result();
    }

    public function getDetailDesa($where){
    	$this->db->select('*');
    	$this->db->where($where);
    	$query = $this->db->get('desa');
    	return $query->row();
    }


}
?>