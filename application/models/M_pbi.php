<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pbi extends CI_Model {

	public function insert($data){
		$insert = $this->db->insert_batch('pbi', $data);
		if($insert){
			return true;
		}
	}

	public function delete(){
        $delete = $this->db->empty_table('pbi');
		if($delete){
			return true;
		}
    }

	public function getPbiAktif(){
		$this->db->select('*');
		$this->db->where('status',1);
		return $this->db->get('pbi')->result();
	}

	public function getPbiNonaktif(){
		$this->db->select('*');
		$this->db->where('status',0);
		return $this->db->get('pbi')->result();
	}

}