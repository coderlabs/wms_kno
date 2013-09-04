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
	
	# piutang incoming
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
		$data['agent']  = "";
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang',$data);
		$this->load->view('template/footer');
	}
		
	function do_search_piutang()
	{
		if ($this->input->post('agent') == NULL )
		{
			$agent = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$agent = $this->input->post('agent');
		}
		$agent = $this->myUrlEncode($agent);
		$agent = $this->myUrlDecode($agent);
	
		if($agent == "" ){	$agent_link = 'ALL' ; }
		else{$agent_link = $agent;}
		
		$this->load->model('piutang_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/piutang/do_search_piutang/'.$agent_link.'/'; 
		$config['total_rows'] = $this->piutang_model->count_piutang_by_agent($agent); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 4; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['result']=$this->piutang_model->get_piutang_by_agent($agent,$config['per_page'],$page);
		$data['offset'] = $page;
		$data['agent']  = $agent;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang',$data);
		$this->load->view('template/footer');
	
	}
	
	function pdf_piutang_incoming()
	{
		$agent = str_replace('%20',' ',$this->uri->segment(3));
		$agent = $this->myUrlEncode($agent);
		$agent = $this->myUrlDecode($agent);
	
		$this->load->model('piutang_model');
		
		#data preparing
		$data['result'] = $this->piutang_model->get_all_piutang_by_agent($agent);
		$data['agent']  = $agent;
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'piutang-inbound-'.$agent;
		$stn = 'kno';
		$html = '';
		$html = $this->load->view('piutang/pdf/pdf_piutang_in', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
		
	#piutang outgoing
	function piutang_out_agent()
	{
		$this->load->model('piutang_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/piutang/piutang_out_agent/'; 
		$config['total_rows'] = $this->piutang_model->count_all_piutang_out(); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 3; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['result']=$this->piutang_model->get_all_piutang_out($config['per_page'],$page);
		$data['offset'] = $page;
		$data['agent']  = "";
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang_out',$data);
		$this->load->view('template/footer');
	}
		
	function do_search_piutang_out()
	{
		if ($this->input->post('agent') == NULL )
		{
			$agent = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$agent = $this->input->post('agent');
		}
		$agent = $this->myUrlEncode($agent);
		$agent = $this->myUrlDecode($agent);
	
		if($agent == "" ){	$agent_link = 'ALL' ; }
		else{$agent_link = $agent;}
		
		
		$this->load->model('piutang_model');
		
		#pagination config
		$config['base_url'] = base_url().'index.php/piutang/do_search_piutang_out/'.$agent_link.'/'; 
		$config['total_rows'] = $this->piutang_model->count_piutang_out_by_agent($agent); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 4; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['result'] = $this->piutang_model->get_piutang_out_by_agent($agent,$config['per_page'],$page);
		$data['offset'] = $page;
		$data['agent']  = $agent;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('piutang/list_piutang_out',$data);
		$this->load->view('template/footer');
	}
	
	function pdf_piutang_outgoing()
	{
		$agent = str_replace('%20',' ',$this->uri->segment(3));
		$agent = $this->myUrlEncode($agent);
		$agent = $this->myUrlDecode($agent);
	
		$this->load->model('piutang_model');
		
		#data preparing
		$data['result'] = $this->piutang_model->get_all_piutang_out_by_agent($agent);
		$data['total']  = $this->piutang_model->count_piutang_out_by_agent($agent);
		$data['agent']  = $agent;
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'piutang-outbound-'.$agent;
		$stn = 'kno';
		$html = '';
		$html = $this->load->view('piutang/pdf/pdf_piutang_out', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
	
	
	#########################################
	function myUrlEncode($string) {
		$replacements = array('_', '_', "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_",  "_", "_", "_");
		$entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?",  "#", "[", "]");
		return str_replace($entities, $replacements, $string);
	}
	
	function myUrlDecode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D');
		$replacements = array('_', '_', "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_",  "_", "_", "_");
		return str_replace($entities, $replacements, $string);
	}
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */