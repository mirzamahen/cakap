<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('bagianLogin');
		$this->load->model('ModelPengajuan');
		$this->load->model('ModelDaftarPengajuan');
		$this->load->model('ModelDukanwil');
		$this->load->model('ModelUnitKerja');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Profil Pegawai';
		$data['isi']='isi/profil_pegawai';
		$data['pegawai']=$this->ModelDukanwil->detail_pegawai();
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function profil_update()
	{
		$data['judul']='Update Profil Pegawai';
		$data['isi']='isi/update_profil_pegawai';
		$data['pegawai']=$this->ModelDukanwil->detail_pegawai();
		$data['unit_kerja']=$this->ModelUnitKerja->unit_kerjanya();
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function update_simpan_profil()
	{
		$this->validasi_update_profil();
		$data=array(
			'username'			=>	$this->input->post('username'),
			'nama_user'			=>	$this->input->post('nama_user'),
			'jabatan_user'		=>	$this->input->post('jabatan_user'),
			'id_unit_kerjanya'	=>	$this->input->post('id_unit_kerjanya'),
		);
		$this->db->where('kode_user',$this->input->post('kode_user'));
		$this->db->update('user',$data);
		echo json_encode(array("status" => TRUE));
	}
	
	private function validasi_update_profil()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('nama_user') == '')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Nama Pegawai tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('jabatan_user') == '')
		{
			$data['inputerror'][] = 'jabatan_user';
			$data['error_string'][] = 'Jabatan tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
			if($this->input->post('id_unit_kerjanya') == '')
		{
			$data['inputerror'][] = 'id_unit_kerjanya';
			$data['error_string'][] = 'Unit kerja harus dipilih';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	public function kinerja()
	{
		$kode_bagian=$this->ModelPengajuan->data_user();
		$data['judul']='Kinerja Pegawai';
		$data['isi']='isi/bagian_pengajuan';
		$data['sksya']=$this->ModelPengajuan->daftar_sasaran_kegiatan($kode_bagian->id_unit_kerjanya);
		$this->load->view('layout/layout_isi',$data);
	}
	
	
	public function ajaxindikator()
	{
		$keluar['indikator']=$this->ModelPengajuan->indikatorKinerja();
        $this->load->view('isi/ajax_indikator_kinerja',$keluar);
	}
	
	public function ajax_list()
	{
		$list = $this->ModelPengajuan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date('d-m-Y',(strtotime($abg->tanggal_kin)));
			$row[] = $abg->hadir_kin;
			$row[] = $abg->no_sk;
			$row[] = $abg->no_ik.' - '.$abg->nama_ik;
			$row[] = $abg->uraian_kin;
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-dark" href="javascript:void(0)" onclick="edit('."'".$abg->kode_kin."'".')" title="Edit"> <i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="hapus('."'".$abg->kode_kin."'".')"  title="Hapus"> <i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelPengajuan->count_all(),
						"recordsFiltered" => $this->ModelPengajuan->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}
	
	private function _validasiInput()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('tanggal_kin') == '')
		{
			$data['inputerror'][] = 'tanggal_kin';
			$data['error_string'][] = 'Tanggal tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('kode_ik') == '')
		{
			$data['inputerror'][] = 'kode_ik';
			$data['error_string'][] = 'Indikator harus dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('uraian_kin') == '')
		{
			$data['inputerror'][] = 'uraian_kin';
			$data['error_string'][] = 'Uraian Kinerja tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
			if($this->input->post('hadir_kin') == '')
		{
			$data['inputerror'][] = 'hadir_kin';
			$data['error_string'][] = 'Status kehadiran tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	private function _validasiUpdate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('tanggal_kin') == '')
		{
			$data['inputerror'][] = 'tanggal_kin';
			$data['error_string'][] = 'Tanggal tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('uraian_kin') == '')
		{
			$data['inputerror'][] = 'uraian_kin';
			$data['error_string'][] = 'Uraian Kinerja tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('hadir_kin') == '')
		{
			$data['inputerror'][] = 'hadir_kin';
			$data['error_string'][] = 'Status kehadiran tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function ajax_add()
	{
		$this->_validasiInput();
		date_default_timezone_set('Asia/Jakarta');
		
		
		$data = array(
				'kode_usernya' => $this->session->userdata('kode_user'),
				'tanggal_kin' => $this->input->post('tanggal_kin'),
				'kode_sknya' => $this->input->post('kode_sk'),
				'kode_iksknya' => $this->input->post('kode_ik'),
				'uraian_kin' => $this->input->post('uraian_kin'),
				'hadir_kin' => $this->input->post('hadir_kin'),
				'status_kin' => 'Pending',
			);
		$this->db->insert('kinerja', $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($kode_kin)
	{
		$data = $this->ModelPengajuan->get_by_id($kode_kin);
		echo json_encode($data);
	}
	
	public function update()
	{
		$this->_validasiUpdate();
		if($this->input->post('kode_sk2')=='' || $this->input->post('kode_ik2')==''){
			$data = array(
				'tanggal_kin' => $this->input->post('tanggal_kin'),
				'uraian_kin' => $this->input->post('uraian_kin'),
				'hadir_kin' => $this->input->post('hadir_kin'),
				
			);
		$this->ModelPengajuan->update(array('kode_kin' => $this->input->post('kode_kin')), $data);
		}else{
			$data = array(
				'tanggal_kin' => $this->input->post('tanggal_kin'),
				'kode_sknya' => $this->input->post('kode_sk2'),
				'kode_iksknya' => $this->input->post('kode_ik2'),
				'uraian_kin' => $this->input->post('uraian_kin'),
				'hadir_kin' => $this->input->post('hadir_kin'),
			);
		$this->ModelPengajuan->update(array('kode_kin' => $this->input->post('kode_kin')), $data);
		}
		echo json_encode(array("status" => TRUE));
	}
	
	public function hapus($kode_kin)
	{
		$this->ModelPengajuan->delete_by_id($kode_kin);
		echo json_encode(array("status" => TRUE));
	}
	
	
	public function laporan()
	{
		$data['judul']='Laporan Kinerja';
		$data['isi']='isi/bagian_pelaporan';
		$this->load->view('layout/layout_isi',$data);
	}
	
	private function _ValidasiLihatLaporan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('bulan') == '')
		{
			$data['inputerror'][] = 'bulan';
			$data['error_string'][] = 'Bulan Harus dipilih';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tahun') == '')
		{
			$data['inputerror'][] = 'tahun';
			$data['error_string'][] = 'Tahun Harus dipilih';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	public function ajax_pencarian_laporan()
	{	
	//	$this->_ValidasiLihatLaporan();
		$data['data_laporan']=$this->ModelPengajuan->pencarianLaporan();
		$data['pengguna']=$this->ModelPengajuan->dataPengguna();
		$data['bulan']=$this->input->post('bulan');
		$data['tahun']=$this->input->post('tahun');
		$this->load->view('isi/ajax_pencarian_pelaporan',$data);
	}
	
	public function exsport_ajax_pencarian_laporan()
	{	
		$data['data_laporan']=$this->ModelPengajuan->pencarianLaporan();
		$data['pengguna']=$this->ModelPengajuan->dataPengguna();
		$data['bulan']=$this->input->post('bulan');
		$data['tahun']=$this->input->post('tahun');
		$this->load->view('isi/ajax_export_pelaporan',$data);
	}

	
	
	
	
}