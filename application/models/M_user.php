<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_user extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getUser($where){
    	$this->db->select('*');
    	$this->db->where($where);
    	$query = $this->db->get('user');
    	return $query->row();
    }

}
?>