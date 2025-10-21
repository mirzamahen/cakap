<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDaftarPengajuan extends CI_Model {

	var $table = 'surat';
	var $column_order = array(NULL,'nomor_surat','tgl_surat_pengajuan','perihal_surat',null,'tempat_kegiatan',null); 
	var $column_search = array('nomor_surat','perihal_surat','tempat_kegiatan','ketugasan','tipe_surat'); 
	var $order = array('id_surat' => 'desc');

	public function __construct()
	{
		// parent::__construct();
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
	
	public function get_by_id($id_surat)
	{
		$this->db->from($this->table);
		$this->db->where('id_surat',$id_surat);
		$query = $this->db->get();

		return $query->row();
	}

	public function lihatDetailSurat($id_surat)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('user','surat.id_pemohon=user.kode_user');
		$this->db->where('id_surat',$id_surat);
		$Q=$this->db->get('surat');
		if($Q ->num_rows()>0){
			$data = $Q->row_array();
		}
		$Q->free_result();  
		return $data;
	}
	public function detailSurat($id_suratnya)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('user','surat.id_pemohon=user.kode_user');
		$this->db->where('id_surat',$id_suratnya);
		$Q=$this->db->get('surat');
		if($Q ->num_rows()>0){
			$data = $Q->row_array();
		}
		$Q->free_result();  
		return $data;
	}
	
	public function daftar_personil()
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('status_pegawai','Aktif');
		$Q=$this->db->get('duk_kanwil');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	
	public function personel($id_suratnya)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('duk_kanwil','anggota_permanen.kode_pegawai=duk_kanwil.kode_pegawai');
		$this->db->where('kode_surat_nya',$id_suratnya);
		$this->db->order_by('id_anggota_permanen','asc');
		$Q=$this->db->get('anggota_permanen');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function jumlah_pegawai_ikut($id_surat)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('duk_kanwil','anggota_permanen.kode_pegawai=duk_kanwil.kode_pegawai');
		$this->db->where('kode_surat_nya',$id_surat);
		$this->db->order_by('id_anggota_permanen','asc');
		$Q=$this->db->get('anggota_permanen');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function tembusan_permanen($id_suratnya)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('kode_suratnya',$id_suratnya);
		$this->db->order_by('id_tembusan','asc');
		$Q=$this->db->get('tembusan_permanen');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function data_tembusan($id_surat)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('kode_suratnya',$id_surat);
		$this->db->order_by('id_tembusan','asc');
		$Q=$this->db->get('tembusan_permanen');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function gambar_sementara()
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('id_usernya',$this->session->userdata('kode_user'));
		$Q=$this->db->get('gambar_sementara');
		if($Q ->num_rows()>0){
			$data = $Q->row_array();
		}
		$Q->free_result();  
		return $data;
	}
	
	public function cari_gambar_sementara()
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('id_usernya',$this->session->userdata('kode_user'));
		$Q=$this->db->get('gambar_sementara');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function pejabat_pilihan($jabatan)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('jabatan_pejabat',$jabatan);
		$Q=$this->db->get('pejabat');
		if($Q ->num_rows()>0){
			$data = $Q->row_array();
		}
		$Q->free_result();  
		return $data;
	}
	


}
