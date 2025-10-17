<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBagian extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model(array('ModelAdminBagian','ModelAdminSk'));
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Data Pegawai/User';
		$data['isi']='isi/admin_bagian';
		$data['unit']=$this->ModelAdminSk->unit_kerja_aktif();
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		
		$list = $this->ModelAdminBagian->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $abg->nama_user.'<br>'.$abg->username;
			$row[] = $abg->jabatan_user;
			$row[] = $abg->nama_unit_kerja;
			$row[] = $abg->level_user;
			$row[] = '<div class="text-center">'.$abg->status_user.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->kode_user."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Password" onclick="gantipassword('."'".$abg->kode_user."'".')"><i class="glyphicon glyphicon-lock"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->kode_user."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelAdminBagian->count_all(),
						"recordsFiltered" => $this->ModelAdminBagian->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit($kode_user)
	{
		$data = $this->ModelAdminBagian->get_by_id($kode_user);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		date_default_timezone_set('Asia/Jakarta');
		$kode_user=date('YmdHis');
		$data = array(			
				'username' => $this->input->post('username'),
				'nama_user' => $this->input->post('nama_user'),
				'jabatan_user' => $this->input->post('jabatan_user'),
				'id_unit_kerjanya' => $this->input->post('id_unit_kerjanya'),
				'password' => sha1($this->input->post('password')),
				'status_user' => $this->input->post('status_user'),
				'level_user' => 'Admin Bagian',
			);
		$insert = $this->ModelAdminBagian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate2();
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'username' => $this->input->post('username'),
			'jabatan_user' => $this->input->post('jabatan_user'),
			'id_unit_kerjanya' => $this->input->post('id_unit_kerjanya'),
			'status_user' => $this->input->post('status_user'),
			);
		$this->ModelAdminBagian->update(array('kode_user' => $this->input->post('kode_user')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function update_password()
	{
		$this->_validate3();
		$data = array(
				'password' => sha1($this->input->post('password'))
			);
		$this->ModelAdminBagian->update(array('kode_user' => $this->input->post('kode_user')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_delete($kode_user)
	{
		$this->ModelAdminBagian->delete_by_id($kode_user);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
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
		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_user') == '')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Nama user tidak boleh kosong';
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
		
		if($this->input->post('status_user') == '')
		{
			$data['inputerror'][] = 'status_user';
			$data['error_string'][] = 'Status tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'NIP tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_user') == '')
		{
			$data['inputerror'][] = 'nama_user';
			$data['error_string'][] = 'Nama tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('jabatan_user') == '')
		{
			$data['inputerror'][] = 'jabatan_user';
			$data['error_string'][] = 'Admin Bagian tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_unit_kerjanya') == '')
		{
			$data['inputerror'][] = 'id_unit_kerjanya';
			$data['error_string'][] = 'Unit kerja harus dipilih';
			$data['status'] = FALSE;
		}
		if($this->input->post('status_user') == '')
		{
			$data['inputerror'][] = 'status_user';
			$data['error_string'][] = 'Status tidak boleh kosong';
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


		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}