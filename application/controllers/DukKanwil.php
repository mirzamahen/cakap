<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DukKanwil extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelDukanwil');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Duk Kanwil';
		$data['isi']='isi/dukanwil';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		$list = $this->ModelDukanwil->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $abg->nip_pegawai;
			$row[] = $abg->nama_pegawai;
			$row[] = $abg->jabatan.'<br>'.$abg->gol_pegawai;
			$row[] = $abg->jabatan_pegawai;
			$row[] = '<div class="text-center">'.$abg->status_pegawai.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->kode_pegawai."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->kode_pegawai."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelDukanwil->count_all(),
						"recordsFiltered" => $this->ModelDukanwil->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit($kode_pegawai)
	{
		$data = $this->ModelDukanwil->get_by_id($kode_pegawai);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'gol_pegawai' => $this->input->post('gol_pegawai'),
				'jabatan'	=>	$this->input->post('jabatan'),
				'jabatan_pegawai' => $this->input->post('jabatan_pegawai'),
				'status_pegawai' => $this->input->post('status_pegawai'),
			);
		$insert = $this->ModelDukanwil->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'gol_pegawai' => $this->input->post('gol_pegawai'),
				'jabatan'	=>	$this->input->post('jabatan'),
				'jabatan_pegawai' => $this->input->post('jabatan_pegawai'),
				'status_pegawai' => $this->input->post('status_pegawai'),
			);
		$this->ModelDukanwil->update(array('kode_pegawai' => $this->input->post('kode_pegawai')), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete($kode_pegawai)
	{
		$this->ModelDukanwil->delete_by_id($kode_pegawai);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('nip_pegawai') == '')
		{
			$data['inputerror'][] = 'nip_pegawai';
			$data['error_string'][] = 'NIP pegawai tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_pegawai') == '')
		{
			$data['inputerror'][] = 'nama_pegawai';
			$data['error_string'][] = 'Nama tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('gol_pegawai') == '')
		{
			$data['inputerror'][] = 'gol_pegawai';
			$data['error_string'][] = 'Golongan tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('jabatan') == '')
		{
			$data['inputerror'][] = 'jabatan';
			$data['error_string'][] = 'Jabatan tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('jabatan_pegawai') == '')
		{
			$data['inputerror'][] = 'jabatan_pegawai';
			$data['error_string'][] = 'Jabatan tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('status_pegawai') == '')
		{
			$data['inputerror'][] = 'status_pegawai';
			$data['error_string'][] = 'Status tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	
	
	
}