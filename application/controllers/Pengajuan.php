<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('bagianLogin');
		$this->load->model('ModelPengajuan');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Pengajuan';
		$data['isi']='isi/pengajuan';
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
			$row[] = $abg->nama_pendek_bag;
			$row[] = $abg->username;
			$row[] = $abg->admin_bagian;
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
				'kode_user'	=>$kode_user,
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'nama_pendek_bag' => $this->input->post('nama_pendek_bag'),
				'admin_bagian' => $this->input->post('admin_bagian'),
				'level_user' => 'Admin Bagian',
				'status_user' => $this->input->post('status_user'),
			);
		$insert = $this->ModelAdminBagian->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate2();
		$data = array(
				'username' => $this->input->post('username'),
				'nama_pendek_bag' => $this->input->post('nama_pendek_bag'),
				'admin_bagian' => $this->input->post('admin_bagian'),
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

		if($this->input->post('nama_pendek_bag') == '')
		{
			$data['inputerror'][] = 'nama_pendek_bag';
			$data['error_string'][] = 'Nama Singkatan Bagian tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('admin_bagian') == '')
		{
			$data['inputerror'][] = 'admin_bagian';
			$data['error_string'][] = 'Admin Bagian tidak boleh kosong';
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
			$data['error_string'][] = 'Username tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_pendek_bag') == '')
		{
			$data['inputerror'][] = 'nama_pendek_bag';
			$data['error_string'][] = 'Nama Singkatan Bagian tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('admin_bagian') == '')
		{
			$data['inputerror'][] = 'admin_bagian';
			$data['error_string'][] = 'Admin Bagian tidak boleh kosong';
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