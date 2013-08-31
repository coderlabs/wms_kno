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
		redirect('piutang/piutang_agent');
	}
	
	function piutang_agent()
	{
		$this->load->model('piutang_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/piutang/piutang_agent/'; 
		$config['total_rows'] = $this->piutang_model->count_all_piutang(); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 3; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['result']=$this->piutang_model->get_all_piutang($config['per_page'],$page);
		$data['offset'] = $page;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang',$data);
		$this->load->view('template/footer');
	}
	
	
	function do_search_piutang()
	{
		$agent = $this->input->post('agent');
		$this->load->model('piutang_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/piutang/do_search_piutang/'; 
		$config['total_rows'] = $this->piutang_model->count_piutang_by_agent($agent); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 3; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['result']=$this->piutang_model->get_piutang_by_agent($agent,$config['per_page'],$page);
		$data['offset'] = $page;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang',$data);
		$this->load->view('template/footer');
	
	}
	
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */