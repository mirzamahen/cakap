<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSk extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelAdminSk');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Sasaran Kegiatan Kinerja';
		$data['isi']='isi/sk';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		$list = $this->ModelAdminSk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $abg->no_sk;
			$row[] = $abg->nama_sk;
			$row[] = '<div class="text-center">'.$abg->status_sk.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->kode_sk."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->kode_sk."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelAdminSk->count_all(),
						"recordsFiltered" => $this->ModelAdminSk->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit($kode_sk)
	{
		$data = $this->ModelAdminSk->get_by_id($kode_sk);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'no_sk' => $this->input->post('no_sk'),
				'nama_sk' => $this->input->post('nama_sk'),
				'status_sk' => $this->input->post('status_sk'),
			);
		$insert = $this->ModelAdminSk->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'no_sk' => $this->input->post('no_sk'),
				'nama_sk' => $this->input->post('nama_sk'),
				'status_sk' => $this->input->post('status_sk'),
			);
		$this->ModelAdminSk->update(array('kode_sk' => $this->input->post('kode_sk')), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete($kode_sk)
	{
		$this->ModelAdminSk->delete_by_id($kode_sk);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('no_sk') == '')
		{
			$data['inputerror'][] = 'no_sk';
			$data['error_string'][] = 'Nomor SK tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_sk') == '')
		{
			$data['inputerror'][] = 'nama_sk';
			$data['error_string'][] = 'Nama SK tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	public function sk_unit()
	{
		$data['judul']='Sasaran Kegiatan Unit Kerja';
		$data['isi']='isi/sk_unit';
		$data['sk']=$this->ModelAdminSk->sk_aktif();
		$data['unit']=$this->ModelAdminSk->unit_kerja_aktif();
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_sk_unit()
	{
		$list = $this->ModelAdminSk->get_datatables2();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $abg->no_sk.' - '.$abg->nama_sk;
			$row[] = $abg->kode_unit.' - '.$abg->nama_unit_kerja;
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->id_sk_unit."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->id_sk_unit."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelAdminSk->count_all2(),
						"recordsFiltered" => $this->ModelAdminSk->count_filtered2(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit_sk_unit($id_sk_unit)
	{
		$data = $this->ModelAdminSk->get_by_id2($id_sk_unit);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add_sk_unit()
	{
		$this->_validatesk_unit();
		$data = array(
				'id_sknya' => $this->input->post('id_sknya'),
				'id_unitnya' => $this->input->post('id_unitnya')
			);
		$insert = $this->ModelAdminSk->save2($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_sk_unit()
	{
		$this->_validatesk_unit();
		$data = array(
				'id_sknya' => $this->input->post('id_sknya'),
				'id_unitnya' => $this->input->post('id_unitnya')
			);
		$this->ModelAdminSk->update2(array('id_sk_unit' => $this->input->post('id_sk_unit')), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete_sk_unit($id_sk_unit)
	{
		$this->ModelAdminSk->delete_by_id2($id_sk_unit);
		echo json_encode(array("status" => TRUE));
	}


	private function _validatesk_unit()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('id_sknya') == '')
		{
			$data['inputerror'][] = 'id_sknya';
			$data['error_string'][] = 'Sasaran kegiatan belum dipilih';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_unitnya') == '')
		{
			$data['inputerror'][] = 'id_unitnya';
			$data['error_string'][] = 'Unit kerja belum dipilih';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	public function unit_kerja()
	{
		$data['judul']='Unit Kerja';
		$data['isi']='isi/unit_kerja';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_unit_kerja()
	{
		$list = $this->modelUnitKerja->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $abg->kode_unit;
			$row[] = $abg->nama_unit_kerja;
			$row[] = $abg->profil_unit;
			$row[] = $abg->status_unit;
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_unit('."'".$abg->id_unit."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->id_unit."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->modelUnitKerja->count_all(),
						"recordsFiltered" => $this->modelUnitKerja->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit_unit_kerja($id_unit)
	{
		$data = $this->modelUnitKerja->get_by_id($id_unit);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add_unit_kerja()
	{
		$this->_validateunit_kerja();
		$data = array(
				'kode_unit' => $this->input->post('kode_unit'),
				'nama_unit_kerja' => $this->input->post('nama_unit_kerja'),
				'profil_unit' => $this->input->post('profil_unit'),
				'status_unit' => $this->input->post('status_unit')
			);
		$insert = $this->modelUnitKerja->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_unit_kerja()
	{
		$this->_validateunit_kerja();
		$data = array(
				'kode_unit' => $this->input->post('kode_unit'),
				'nama_unit_kerja' => $this->input->post('nama_unit_kerja'),
				'profil_unit' => $this->input->post('profil_unit'),
				'status_unit' => $this->input->post('status_unit')
			);
		$this->modelUnitKerja->update(array('id_unit' => $this->input->post('id_unit')), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete_unit_kerja($id_unit)
	{
		$this->modelUnitKerja->delete_by_id($id_unit);
		echo json_encode(array("status" => TRUE));
	}


	private function _validateunit_kerja()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('kode_unit') == '')
		{
			$data['inputerror'][] = 'kode_unit';
			$data['error_string'][] = 'Kode unit tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_unit_kerja') == '')
		{
			$data['inputerror'][] = 'nama_unit_kerja';
			$data['error_string'][] = 'Nama unit tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('profil_unit') == '')
		{
			$data['inputerror'][] = 'profil_unit';
			$data['error_string'][] = 'Profil unit tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('status_unit') == '')
		{
			$data['inputerror'][] = 'status_unit';
			$data['error_string'][] = 'Status unit belum dipilih';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	
}