<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAdminSk extends CI_Model {

	var $table = 'sk';
	var $column_order = array('kode_sk','no_sk','nama_sk','status_sk',null); 
	var $column_search = array('no_sk','nama_sk','status_sk'); 
	var $order = array('kode_sk' => 'desc','kode_sk' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) 
		{
			if($_POST['search']['value']) 
			{
				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
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

	public function get_by_id($kode_sk)
	{
		$this->db->from($this->table);
		$this->db->where('kode_sk',$kode_sk);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($kode_sk)
	{
		$this->db->where('kode_sk', $kode_sk);
		$this->db->delete($this->table);
	}
	
	// SK Unit
	var $table2 = 'sk_unit';
	var $column_order2 = array(null,'nama_sk','nama_unit_kerja',null); 
	var $column_search2 = array('nama_sk','nama_unit_kerja'); 
	var $order2 = array('id_sknya' => 'asc','kode_unit' => 'asc');

	private function _get_datatables_query2()
	{
		
		$this->db->from($this->table2);

		$i = 0;
	
		foreach ($this->column_search2 as $item) 
		{
			if($_POST['search']['value']) 
			{
				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search2) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order2))
		{
			$order = $this->order2;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2()
	{
		$this->_get_datatables_query2();
		$this->db->join('sk','sk_unit.id_sknya=sk.kode_sk');
		$this->db->join('unit_kerja','sk_unit.id_unitnya=unit_kerja.id_unit');
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered2()
	{
		$this->_get_datatables_query2();
		$this->db->join('sk','sk_unit.id_sknya=sk.kode_sk');
		$this->db->join('unit_kerja','sk_unit.id_unitnya=unit_kerja.id_unit');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all2()
	{
		$this->db->from($this->table2);
		$this->db->join('sk','sk_unit.id_sknya=sk.kode_sk');
		$this->db->join('unit_kerja','sk_unit.id_unitnya=unit_kerja.id_unit');
		return $this->db->count_all_results();
	}

	public function get_by_id2($id_sk_unit)
	{
		$this->db->from($this->table2);
		$this->db->join('sk','sk_unit.id_sknya=sk.kode_sk');
		$this->db->join('unit_kerja','sk_unit.id_unitnya=unit_kerja.id_unit');
		$this->db->where('id_sk_unit',$id_sk_unit);
		$query = $this->db->get();

		return $query->row();
	}

	public function save2($data)
	{
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}

	public function update2($where, $data)
	{
		$this->db->update($this->table2, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id2($id_sk_unit)
	{
		$this->db->where('id_sk_unit', $id_sk_unit);
		$this->db->delete($this->table2);
	}
	
	public function sk_aktif()
	{
		$this->db->from('sk');
		$this->db->where('status_sk','Aktif');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function unit_kerja_aktif()
	{
		$this->db->from('unit_kerja');
		$this->db->where('status_unit','Aktif');
		$query = $this->db->get();
		return $query->result();
	}
	


}
