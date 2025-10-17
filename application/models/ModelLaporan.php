<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaporan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	

	
	public function daftar_suratnya($tahun,$bulan)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('YEAR(tgl_surat_pengesahan)',$tahun);
		$this->db->where('MONTH(tgl_surat_pengesahan)',$bulan);
		$this->db->order_by('id_surat','desc');
		$Q=$this->db->get('surat');
		if(count($Q->num_rows()>0)){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		$Q -> free_result();
		return $data;
	}
	
	public function daftar_anggota($id_surat)
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
	
	//Tiak terpakai
	
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
