<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelLaporan');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Laporan';
		$data['isi']='isi/laporan';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function bulanan()
	{
		$tahun=$this->input->post('tahun');
		$bulan=$this->input->post('bulan');
		$data['judul']='Laporan';
		$data['tahunnya']=$this->input->post('tahun');
		$data['bulannya']=$this->input->post('bulan');
		$data['data_surat']=$this->ModelLaporan->daftar_suratnya($tahun,$bulan);
		//$this->ModelLaporan->daftar_anggota($id_surat);
		$this->load->view('isi/laporan_bulanan',$data);

	}

	
}