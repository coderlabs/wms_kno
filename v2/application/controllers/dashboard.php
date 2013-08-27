<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 */
	
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('template/dashboard');
		$this->load->view('template/footer');
	}
	

	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */