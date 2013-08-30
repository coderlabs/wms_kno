<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Piutang extends CI_Controller {

	/**
	 *
	 */
	function __construct()
	{
        parent::__construct();
		
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('login');
			}
   		 }
		 
	} 
	
	public function index()
	{
		redirect('cashier/piutang/piutang_agent');
	}
	
	function piutang_agent()
	{
		$this->load->model('piutang_model');
		$data['result']=$this->piutang_model->get_all_piutang();
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/list_piutang',$data);
		$this->load->view('template/footer');
	}
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */