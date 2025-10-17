<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('model_login');
    }
	
	
	public function index()
	{
		$data['judul']='Login';
		$this->load->view('layout/login',$data);
	}
	
	public function login_user()
    {
        $this->_validate();
		date_default_timezone_set('Asia/Jakarta');
		$waktu_login=date('Y-m-d H:i:s');
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$cek_username_password = count($this->model_login->cek_usernamepassword($username,$password)); 
		$tampilkan = $this->model_login->cek_usernamepassword($username,$password);

        if($cek_username_password == 1){
	
			foreach ($tampilkan as $cemp) {
                $kode_user = $cemp->kode_user;
				$username = $cemp->username;
				$nama_user = $cemp->nama_user;
				$level_user = $cemp->level_user;
				$status_user = $cemp->status_user;
            }
			if($level_user=='Admin Utama'){
				$this->session->set_userdata(array(
                'adminLogin'			=> TRUE, 
				'kode_user' 			=> $kode_user,
				'username' 				=> $username,
				'nama_user' 			=> $nama_user,
				'level_user' 			=> $level_user,
				'status_user' 			=> $status_user
				));
			}else{
				$this->session->set_userdata(array(
                'bagianLogin'			=> TRUE, 
				'kode_user' 			=> $kode_user,
				'username' 				=> $username,
				'nama_user' 			=> $nama_user,
				'level_user' 			=> $level_user,
				'status_user' 			=> $status_user
				));
				
			}
		}
		echo json_encode(array("status" => TRUE));
	}
	
	public function keluar_admin()
	{
		$this->session->unset_userdata('adminLogin');
		$this->session->unset_userdata('kode_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('nama_pendek_bag');
		$this->session->unset_userdata('admin_bagian');
		$this->session->unset_userdata('level_user');
		$this->session->unset_userdata('status_user');
		redirect('login');
	}
	
	public function keluar_bagian()
	{
		$this->session->unset_userdata('bagianLogin');
		$this->session->unset_userdata('kode_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('nama_pendek_bag');
		$this->session->unset_userdata('admin_bagian');
		$this->session->unset_userdata('level_user');
		$this->session->unset_userdata('status_user');
		redirect('login');
	}
	
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$cek_username_password = $this->model_login->cek_usernamepassword($username,$password); 
		
		if(count($cek_username_password)==0)
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username atau password tidak sesuai';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Field tidak boleh kosong';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Field tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}