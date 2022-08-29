<?php if(!defined('BASEPATH')) exit('Keluar dari sistem');

class m_user extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getUser($where){
    	$this->db->select('*');
    	$this->db->where($where);
		$this->db->join('role','user.role_id=role.role_id');
    	$query = $this->db->get('user');
    	return $query->row();
    }

	public function getAllUser($where,$orwhere){
    	$this->db->select('*');
    	$this->db->where($where);
		$this->db->or_where($orwhere);
		$this->db->join('role','user.role_id=role.role_id');
    	$query = $this->db->get('user');
		// echo $this->db->last_query(); die();
    	return $query->result();
    }

	public function insertUser($insert){
		$this->db->set($insert);
		$this->db->insert('user');
		return $this->db->insert_id();
	}

	public function updateUser($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('user');
		return $result;
	}

	public function deleteUser($id){
        $this->db->where('user_id', $id);
        return $this->db->delete('user');
    }

}
?>