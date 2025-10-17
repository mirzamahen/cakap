<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$sessiAdmin = $this->session->userdata('adminLogin');
		if($sessiAdmin == TRUE)
    	{
      		redirect('adminBagian');
    	}else{
			redirect('bagian');
		}
    }
	
	public function index()
	{

	}
	
}
