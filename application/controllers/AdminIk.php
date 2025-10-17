<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminIk extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelAdminIk');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Indikator Kinerja';
		$data['isi']='isi/ik';
		$data['sknya']=$this->ModelAdminIk->ambil_data_ska();
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		$list = $this->ModelAdminIk->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<div class="text-center">'.$abg->no_sk.'</div>';
			$row[] = '<div class="text-center">'.$abg->no_ik.'</div>';
			$row[] = $abg->nama_ik;
			$row[] = $abg->target_ik;
			$row[] = $abg->satuan_ik;
			$row[] = '<div class="text-center">'.$abg->status_ik.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->kode_ik."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$abg->kode_ik."'".')"><i class="glyphicon glyphicon-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelAdminIk->count_all(),
						"recordsFiltered" => $this->ModelAdminIk->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit($kode_ik)
	{
		$data = $this->ModelAdminIk->get_by_id($kode_ik);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'no_ik' => $this->input->post('no_ik'),
				'nama_ik' => $this->input->post('nama_ik'),
				'target_ik' => $this->input->post('target_ik'),
				'satuan_ik' => $this->input->post('satuan_ik'),
				'kode_sknya' => $this->input->post('kode_sknya'),
				'status_ik' => $this->input->post('status_ik'),
			);
		$insert = $this->ModelAdminIk->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'no_ik' => $this->input->post('no_ik'),
			'nama_ik' => $this->input->post('nama_ik'),
			'target_ik' => $this->input->post('target_ik'),
			'satuan_ik' => $this->input->post('satuan_ik'),
			'kode_sknya' => $this->input->post('kode_sknya'),
			'status_ik' => $this->input->post('status_ik'),
			);
		$this->db->where('kode_ik',$this->input->post('kode_ik'));
		$this->db->update('ik',$data);
	//	$this->ModelAdminIk->update('kode_ik' => $this->input->post('kode_ik'), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete($kode_ik)
	{
		$this->ModelAdminIk->delete_by_id($kode_ik);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('no_ik') == '')
		{
			$data['inputerror'][] = 'no_ik';
			$data['error_string'][] = 'Nomor IK tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('nama_ik') == '')
		{
			$data['inputerror'][] = 'nama_ik';
			$data['error_string'][] = 'Nama SK tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('target_ik') == '')
		{
			$data['inputerror'][] = 'target_ik';
			$data['error_string'][] = 'Target IK tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('satuan_ik') == '')
		{
			$data['inputerror'][] = 'satuan_ik';
			$data['error_string'][] = 'Satuan IK tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('kode_sknya') == '')
		{
			$data['inputerror'][] = 'kode_sknya';
			$data['error_string'][] = 'SK';
			$data['status'] = FALSE;
		}
		if($this->input->post('status_ik') == '')
		{
			$data['inputerror'][] = 'status_ik';
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