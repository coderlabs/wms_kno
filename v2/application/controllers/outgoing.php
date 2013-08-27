<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outgoing extends CI_Controller {

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
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('outgoing/menu');
		$this->load->view('outgoing/dashboard');
		$this->load->view('template/footer');
	}
	
	public function form_buildup()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('outgoing/menu');
		$this->load->view('outgoing/form_buildup');
		$this->load->view('template/footer');	
	}
	
	public function buildup_checklist()
	{
			$flt_no = $this->input->post('flt_no');
			if($flt_no==NULL){redirect('incoming/form_breakdown');};
			$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
			$this->load->model('outgoing_model');
			$data['result'] = $this->outgoing_model->create_buildup($flt_no,$date);
			
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('outgoing/menu');
			$this->load->view('outgoing/buildup_checklist', $data);
			$this->load->view('template/footer');	
	}
	
	public function buildup_checklist_pdf()
	{
			$flt_no = $this->uri->segment(3,0);
			$date = mdate("%Y-%m-%d", strtotime($this->uri->segment(4,0)));
			$this->load->model('outgoing_model');
			$data['result'] = $this->outgoing_model->create_buildup($flt_no,$date);
			
			$this->load->helper('sigap_pdf');
			$stream = TRUE; 
			$papersize = 'legal'; 
			$orientation = 'potrait';
			$filename = 'buldup-checklist-' . $flt_no . '-' . $date;
			$stn = $this->input->post('hs_service_site');
			$html = $this->load->view('outgoing/buildup_checklist_pdf', $data, true);
			pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
			$full_filename = $filename . '.pdf';
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */