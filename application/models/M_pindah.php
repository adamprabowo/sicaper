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


	

	public function update_lpk($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('tbl_lpk');
		return $result;
	}

	public function get_all_lpk($where=''){
		$this->db->select('*');
		if (!empty($where)) $this->db->where($where);
		$this->db->limit(8);
		$query = $this->db->get('tbl_lpk');
		return $query->result();
	}

	public function get_detail_lpk($where=''){
		$this->db->select('*');
		if (!empty($where)) $this->db->where($where);
		$query = $this->db->get('tbl_lpk');
		return $query->result();
	}

	public function get_lpk_count($where=''){
		$this->db->select('*');
		if (!empty($where)) $this->db->where($where);
		$query = $this->db->get('tbl_lpk');
		return $query->num_rows();
	}

	public function cari_all_lpk(){
		$this->db->select('*');
		$this->db->join('tbl_pelatihan','tbl_pelatihan.id_lpk=tbl_lpk.id_lpk');
		$query = $this->db->get('tbl_lpk');

		return $query->result();
	}

    public function lihat_semua_lpk(){
    	$this->db->select('*');
    	$this->db->where('status_lpk',1);
    	$query = $this->db->get('tbl_lpk');
    	return $query->result();
    }

	public function get_all_kecamatan(){
    	$this->db->select('*');
    	$this->db->order_by('nama_kecamatan', 'ASC');
    	$query = $this->db->get('tbl_kecamatan');
    	return $query->result();
    }

    public function get_user($where){
    	$this->db->select('*');
    	$this->db->where($where);
    	$query = $this->db->get('tbl_lpk');
    	return $query->result();
    }

    //admin lpk
    public function edit_foto_admin($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('tbl_lpk');
		return $result;
	}

	public function update_profile_lpk($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('tbl_lpk');
		return $result;
	}

	//Disnaker
	public function delete_lpk($id_lpk){
        $this->db->where('id_lpk', $id_lpk);
        return $this->db->delete('tbl_lpk');
    }

    public function delete_dokumen($id_dokumen){
        $this->db->where('id_pelatihan_meta', $id_dokumen);
        return $this->db->delete('tbl_pelatihan_meta');
    }

}
?>