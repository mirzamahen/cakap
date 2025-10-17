<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPengajuan extends CI_Model {

	var $table = 'kinerja';
	var $column_order = array(NULL,'tanggal_kin','no_sk','no_ik','uraian_kin','status_kin'); 
	var $column_search = array('tanggal_kin','no_sk','no_ik','uraian_kin','status_kin'); 
	var $order = array('tanggal_kin' => 'desc');

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
		$this->db->join('sk','kinerja.kode_sknya=sk.kode_sk');
		$this->db->join('ik','kinerja.kode_iksknya=ik.kode_ik');
		$this->db->where('kode_usernya',$this->session->userdata('kode_user'));
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$this->db->join('sk','kinerja.kode_sknya=sk.kode_sk');
		$this->db->join('ik','kinerja.kode_iksknya=ik.kode_ik');
		$this->db->where('kode_usernya',$this->session->userdata('kode_user'));
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->join('sk','kinerja.kode_sknya=sk.kode_sk');
		$this->db->join('ik','kinerja.kode_iksknya=ik.kode_ik');
		$this->db->where('kode_usernya',$this->session->userdata('kode_user'));
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($kode_kin)
	{
		$this->db->from($this->table);
		$this->db->where('kode_kin',$kode_kin);
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

	public function delete_by_id($kode_kin)
	{
		$this->db->where('kode_kin', $kode_kin);
		$this->db->delete($this->table);
	}
	
	public function data_user()
	{
		$this->db->from('user');
		$this->db->where('kode_user',$this->session->userdata('kode_user'));
		$query = $this->db->get();
		return $query->row();
	}
	
	public function daftar_sasaran_kegiatan($kode_bagian)
	{
		$this->db->from('sk_unit');
		$this->db->join('sk','sk_unit.id_sknya=sk.kode_sk');
		$this->db->where('id_unitnya',$kode_bagian);
		$this->db->order_by('sk.kode_sk','ASC');
	//	$this->db->group_by('id_sknya');
		$query = $this->db->get();
		return $query->result();
	}

	
	public function indikatorKinerja()
	{
		$kode_sk=$this->input->post('kode_sk');
		$data=array();
		$this->db->select('*');
		$this->db->where('kode_sknya',$kode_sk);
		$this->db->where('status_ik','Aktif');
		$this->db->order_by('no_ik','ASC');
		$Q=$this->db->get('ik');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function pencarianLaporan()
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('sk','kinerja.kode_sknya=sk.kode_sk');
		$this->db->join('ik','kinerja.kode_iksknya=ik.kode_ik');
		$this->db->where('MONTH(tanggal_kin)',$this->input->post('bulan'));
		$this->db->where('YEAR(tanggal_kin)',$this->input->post('tahun'));
		$this->db->where('kode_usernya',$this->session->userdata('kode_user'));
		$this->db->order_by('tanggal_kin','ASC');
		$this->db->order_by('kinerja.kode_sknya','ASC');
		$this->db->order_by('kode_iksknya','ASC');
		$Q=$this->db->get('kinerja');
		if($Q->num_rows()>0){
		/*if(count($Q->num_rows()>0))*/
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function dataPengguna()
	{
		$this->db->from('user');
		$this->db->join('unit_kerja','user.id_unit_kerjanya=unit_kerja.kode_unit');
		$this->db->where('kode_user',$this->session->userdata('kode_user'));
		$query = $this->db->get();
		return $query->row();
	}
	
	


}
