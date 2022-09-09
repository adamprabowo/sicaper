<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pbi extends CI_Model {

	 //set nama tabel yang akan kita tampilkan datanya
	 var $table = 'pbi';
	 //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
	 var $column_order = array(null, 'id_pbi', 'nik');
 
	 var $column_search = array('id_pbi', 'Alanikmat');
	 // default order 
	 var $order = array('id_pbi' => 'asc');
 
	 public function __construct()
	 {
		 parent::__construct();
		 $this->load->database();
	 }

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

	public function getPbi($where){
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get('pbi');
		return $query->row();
	}

	public function updatePbi($update,$where){
		$this->db->set($update);
		$this->db->where($where);
		$result = $this->db->update('pbi');
		return $result;
	}

	public function getPbiAktif(){
		$this->db->select('id_pbi,nik');
		$this->db->where('status',1);
		return $this->db->get('pbi')->result();
	}

	public function getPbiNonaktif(){
		$this->db->select('*');
		$this->db->where('status',0);
		return $this->db->get('pbi')->result();
	}

	public function getJumlahPbiAktif(){
		$this->db->select('count(*) as jumlah');
		$this->db->where('status',1);
		return $this->db->get('pbi')->result();
	}

	public function getJumlahPbiNonaktif(){
		$this->db->select('count(*) as jumlah');
		$this->db->where('status',0);
		return $this->db->get('pbi')->result();
	}



	function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

	private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db->group_start();
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db->group_end();
            }
            $i++;
        }

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

	function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

	public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}