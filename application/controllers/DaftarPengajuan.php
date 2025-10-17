<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarPengajuan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelDaftarPengajuan');
		$this->load->model('ModelPengajuan');
		
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Pengguna';
		$data['isi']='isi/dukanwil';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		$list = $this->ModelDaftarPengajuan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			if($abg->status_surat=='Disetujui'){$persetujuan='btn btn-sm btn-success';}else{$persetujuan='btn btn-sm btn-warning';};
			if($abg->status_surat=='Belum Disetujui'){$cetaknya='<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Cetak Draft"><i class="glyphicon glyphicon-print"></i></a>';}else{$cetaknya='<a class="btn btn-sm btn-success" target="_blank" href="'.base_url().'daftarPengajuan/cetak_surat/'.$abg->id_surat.'" title="Cetak Draft"><i class="glyphicon glyphicon-print"></i></a>';};
			if($abg->file_tte==''){$cetaktte='<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Cetak TTE"><i class="glyphicon glyphicon-print"></i></a>';}else{$cetaktte='<a class="btn btn-sm btn-primary" target="_blank" href="'.base_url().'assets/img/tte/'.$abg->file_tte.'" title="Cetak TTE"><i class="glyphicon glyphicon-print"></i></a>';};
			$row = array();
			$row[] = $no;
			$row[] = $abg->nomor_surat;
			$row[] = date('d-m-Y',(strtotime($abg->tgl_surat_pengajuan)));
			$row[] = $abg->perihal_surat;
			$row[] = $abg->tempat_kegiatan;
			$row[] = $abg->presensi;
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-success" target="_blank" href="'.base_url().'daftarPengajuan/lihatDetail/'.$abg->id_surat.'" title="Lihat Detail" ><i class="glyphicon glyphicon-search"></i></a> '.$cetaknya.' '.$cetaktte.'
				  <!--<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->id_surat."'".')"><i class="glyphicon glyphicon-trash"></i></a>-->
				  <a class="'.$persetujuan.'" href="javascript:void(0)" title="Status Pengajuan"> <i class="glyphicon glyphicon-ok"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelDaftarPengajuan->count_all(),
						"recordsFiltered" => $this->ModelDaftarPengajuan->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function lihatDetail($id_surat)
	{
		$data['judul']='Detail Surat';
		$data['id_suratnya']=$id_surat;
		$data['surat']=$this->ModelDaftarPengajuan->lihatDetailSurat($id_surat);
		$data['datapersonil']=$this->ModelPengajuan->daftar_personil();
		$data['isi']='isi/detail_daftar_pengajuan';
		$this->load->view('layout/layout_isi',$data);
		
	}
	
	public function update_surat()
	{
		$this->_validate();
		$data = array(
				'nomor_surat' => $this->input->post('nomor_surat'),
				'tgl_surat_udangan' => $this->input->post('tgl_surat_udangan'),
				'perihal_surat' => $this->input->post('perihal_surat'),
				'penyelenggara' => $this->input->post('penyelenggara'),
				'nama_kegiatan' => $this->input->post('nama_kegiatan'),
				'mulai_tanggal' => $this->input->post('mulai_tanggal'),
				'akhir_tanggal' => $this->input->post('akhir_tanggal'),
				'tempat_kegiatan' => $this->input->post('tempat_kegiatan'),
				'ketugasan' => $this->input->post('ketugasan'),
				'presensi' => $this->input->post('presensi')
			);
		$this->ModelPengajuan->update(array('id_surat' => $this->input->post('id_surat')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function validasi_surat()
	{
		$this->_validasi_surat();
		date_default_timezone_set('Asia/Jakarta');
		$bulan=date('m');
		$tahun=date('Y');
		$data = array(
				'tipe_surat' => $this->input->post('tipe_surat'),
				'pejabat_disurat' => $this->input->post('pejabat_disurat'),
				'nomor_surat_admin' => $this->input->post('nomor_surat_admin').'/Kw.12.1/3/KP.01.1/'.$bulan.'/'.$tahun,
				'tgl_surat_pengesahan' => $this->input->post('tgl_surat_pengesahan'),
				'tertanda_pejabat' => $this->input->post('tertanda_pejabat'),
				'status_surat' => 'Disetujui'
			);
		$this->ModelPengajuan->update(array('id_surat' => $this->input->post('id_surat')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	private function _validasi_surat()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('tipe_surat') == '')
		{
			$data['inputerror'][] = 'tipe_surat';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('pejabat_disurat') == '')
		{
			$data['inputerror'][] = 'pejabat_disurat';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nomor_surat_admin') == '')
		{
			$data['inputerror'][] = 'nomor_surat_admin';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tgl_surat_pengesahan') == '')
		{
			$data['inputerror'][] = 'tgl_surat_pengesahan';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('tertanda_pejabat') == '')
		{
			$data['inputerror'][] = 'tertanda_pejabat';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('tgl_surat_udangan') == '')
		{
			$data['inputerror'][] = 'tgl_surat_udangan';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('perihal_surat') == '')
		{
			$data['inputerror'][] = 'perihal_surat';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('penyelenggara') == '')
		{
			$data['inputerror'][] = 'penyelenggara';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('nama_kegiatan') == '')
		{
			$data['inputerror'][] = 'nama_kegiatan';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('mulai_tanggal') == '')
		{
			$data['inputerror'][] = 'mulai_tanggal';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('akhir_tanggal') == '')
		{
			$data['inputerror'][] = 'akhir_tanggal';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('tempat_kegiatan') == '')
		{
			$data['inputerror'][] = 'tempat_kegiatan';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('ketugasan') == '')
		{
			$data['inputerror'][] = 'ketugasan';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('presensi') == '')
		{
			$data['inputerror'][] = 'presensi';
			$data['error_string'][] = 'Tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	public function simpan_anggota()
	{
		$this->_validate2();
		$data = array(
				'kode_pegawai' => $this->input->post('kode_pegawai'),
				'kode_surat_nya' => $this->input->post('kode_surat_nya'),
			);
		$this->db->insert('anggota_permanen',$data);
		echo json_encode(array("status" => TRUE));
	}
	
	
	public function tampil_anggota($id_suratnya)
	{
		$data['personelnya']=$this->ModelDaftarPengajuan->personel($id_suratnya);
		$this->load->view('isi/ajax_tampil_personel_permanen',$data);
	}
	
	public function hapus_personilnya($id_anggota_permanen)
	{
		$this->db->where('id_anggota_permanen',$id_anggota_permanen);
		$this->db->delete('anggota_permanen');
		echo json_encode(array("status" => TRUE));
	}
	
	public function tampil_tembusan($id_suratnya)
	{
		$data['tembusannya']=$this->ModelDaftarPengajuan->tembusan_permanen($id_suratnya);
		$this->load->view('isi/ajax_tampil_tembusan_permanen',$data);
	}
	
	public function tampil_cetak($id_suratnya)
	{
		$data['tampilCetak']=$this->ModelDaftarPengajuan->detailSurat($id_suratnya);
		$this->load->view('isi/ajax_tampil_cetak',$data);
	}
	
	public function update_dokumen_tte()
	{
		$this->load->library('upload');
		$config['upload_path'] = './assets/img/tte/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true; 

		$this->upload->initialize($config);
        if(!empty($_FILES['userfile'])){
 
            if ($this->upload->do_upload('userfile')){
                $gbr = $this->upload->data();
                $config['image_library']='gd2';
                $config['source_image']='./assets/img/tte/'.$gbr['file_name'];
				$config['max_size']= 50000;
                $config['new_image']= './assets/img/tte/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
				
				$ss = array(
					'file_tte' => $gbr['file_name']
					);
				$this->db->where('id_surat',$this->input->post('id_surat'));	
				$this->db->update('surat',$ss);
            }
		}
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id_surat)
	{
		$data = $this->ModelDaftarPengajuan->get_by_id($id_surat);
		echo json_encode($data);
	}
	
	public function tampil_tte($id_suratnya)
	{
		$data['tampilCetak']=$this->ModelDaftarPengajuan->detailSurat($id_suratnya);
		$this->load->view('isi/ajax_tampil_ket_tte',$data);
	}
	
	public function tampil_cetak_tte($id_suratnya)
	{
		$data['tampilCetak']=$this->ModelDaftarPengajuan->detailSurat($id_suratnya);
		$this->load->view('isi/ajax_tampil_cetak_tte',$data);
	}
	
	function hapus_tte($file_tte)
	{
		$data=array(
			'file_tte'	=> ''
		);
		$this->db->where('file_tte',$file_tte);
		$this->db->update('surat',$data);
		unlink('./assets/img/tte/'.$file_tte);
	}
	
	public function hapus_tembusannya($id_tembusan)
	{
		$this->db->where('id_tembusan',$id_tembusan);
		$this->db->delete('tembusan_permanen');
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	public function simpan_tembusan()
	{
		$this->_validate3();
		$data = array(
				'nama_tembusan' => $this->input->post('nama_tembusan'),
				'kode_suratnya' => $this->input->post('kode_suratnya')
			);
		$this->db->insert('tembusan_permanen',$data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function cetak_surat($id_surat)
	{
		$jumlahAnggota=count($this->ModelDaftarPengajuan->jumlah_pegawai_ikut($id_surat));
		if($jumlahAnggota<=3){
			$suratnya='surat_tugas_1_halaman';
		}else{
			$suratnya='surat_tugas_1_halaman';
		}
		
		$data['judul']='Cetak Surat';
		$data['personelnya']=$this->ModelDaftarPengajuan->jumlah_pegawai_ikut($id_surat);
		$data['tembusan']=$this->ModelDaftarPengajuan->data_tembusan($id_surat);
		$data['surat']=$this->ModelDaftarPengajuan->lihatDetailSurat($id_surat);
		$this->load->view('isi/'.$suratnya,$data);
	}
	
	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('kode_pegawai') == '')
		{
			$data['inputerror'][] = 'kode_pegawai';
			$data['error_string'][] = 'Personil tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	private function _validate3()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('nama_tembusan') == '')
		{
			$data['inputerror'][] = 'nama_tembusan';
			$data['error_string'][] = 'Tembusan belum diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
}