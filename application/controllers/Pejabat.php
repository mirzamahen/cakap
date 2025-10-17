<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		$this->load->model('ModelPejabat');
		if($sessiAdmin == FALSE)
    	{
      		redirect('login');
    	}
    }
	
	
	public function index()
	{
		$data['judul']='Pejabat';
		$data['isi']='isi/pejabat';
		$this->load->view('layout/layout_isi',$data);
	}
	
	public function ajax_list()
	{
		
		$list = $this->ModelPejabat->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $abg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $abg->nama_pejabat;
			$row[] = $abg->jabatan_pejabat;
			$row[] = '<div class="text-center"><ahref="javascript:void(0)" title="Edit" onclick="edit_ttd('."'".$abg->kode_pejabat."'".')"><img src="'.base_url().'assets/ttd/'.$abg->ttd.'"></div></a>';
			$row[] = '<div class="text-center">'.$abg->status_pejabat.'</div>';
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$abg->kode_pejabat."'".')"><i class="glyphicon glyphicon-pencil"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->ModelPejabat->count_all(),
						"recordsFiltered" => $this->ModelPejabat->count_filtered(),
						"data" => $data,
				);
	
		echo json_encode($output);
	}

	public function ajax_edit($kode_pejabat)
	{
		$data = $this->ModelPejabat->get_by_id($kode_pejabat);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nama_pejabat' => $this->input->post('nama_pejabat'),
				'jabatan_pejabat' => $this->input->post('jabatan_pejabat'),
				'status_pejabat' => $this->input->post('status_pejabat')
			);
		$this->ModelPejabat->update(array('kode_pejabat' => $this->input->post('kode_pejabat')), $data);
		echo json_encode(array("status" => TRUE));
	}
	

	public function ajax_delete($kode_pejabat)
	{
		$this->ModelPejabat->delete_by_id($kode_pejabat);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('nama_pejabat') == '')
		{
			$data['inputerror'][] = 'nama_pejabat';
			$data['error_string'][] = 'Nama pejabat tidak boleh kosong';
			$data['status'] = FALSE;
		}
		if($this->input->post('jabatan_pejabat') == '')
		{
			$data['inputerror'][] = 'jabatan_pejabat';
			$data['error_string'][] = 'Jabatan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('status_pejabat') == '')
		{
			$data['inputerror'][] = 'status_pejabat';
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