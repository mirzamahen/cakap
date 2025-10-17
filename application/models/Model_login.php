<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	
	
	public function cek_usernamepassword($username,$password)
	{
		$data=array();
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('user');
		return $query->result();
	}
	
	//tidak dipakai
	public function produk_pilihan($id_produk)
	{
		$data=array();
		$this->db->select('*');
		$this->db->join('user','produk.id_ukm=user.id_user');
		$this->db->where('id_produk',$id_produk);
		$Q=$this->db->get('produk');
		if($Q ->num_rows()>0){
			$data = $Q->row_array();
		}
		$Q->free_result();  
		return $data;
	}


}
