<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_role extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getRole($where,$orwhere){
    	$this->db->select('*');
        $this->db->where($where);
		$this->db->or_where($orwhere);
    	$query = $this->db->get('role');
    	return $query->result();
    }

}
?>