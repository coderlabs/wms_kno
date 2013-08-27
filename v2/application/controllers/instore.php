<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instore extends CI_Controller {

	/**
	 *
	 */
	 
	function __construct()
	{
        parent::__construct();
		
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('index');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('login');
			}
   		 }
		 
	} 
	
	public function index()
	{
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_list_smu_instore();
		$this->load->view('incoming/list_smu_instore_marquee_vertical',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */