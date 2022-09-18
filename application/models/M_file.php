<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_file extends CI_Model {

	public function getFile(){
		$this->db->select('*');
		$query = $this->db->get('file');
		return $query->result();
	}

    public function insertFile($insert){
		$this->db->set($insert);
		$this->db->insert('file');
		$id_file = $this->db->insert_id();
		return $id_file;
	}

}