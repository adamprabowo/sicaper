<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_role extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getRole($where){
    	$this->db->select('*');
        $this->db->where($where);
    	$query = $this->db->get('role');
    	return $query->result();
    }

}
?>