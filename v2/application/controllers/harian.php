<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harian extends CI_Controller {

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
		redirect('harian/outgoing');
	}
	
	public function outgoing()
	{
		$this->load->model('airline_model');
		$data['airline'] = $this->airline_model->get_all_airline();
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('harian/outgoing', $data);
		$this->load->view('template/footer');	
	}
	
	
	
	public function outgoing_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->input->post('date')));
		$data['date'] = $date;
		$airline = $this->input->post('airline');
		$data['airline'] = $airline;
		
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_outgoing($date, $airline);
		#$data['total'] = $this->harian_model->get_total_outgoing($date, $airline);
		#print_r($data);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('harian/details_outgoing', $data);
		$this->load->view('template/footer');
	}
	

	public function outgoing_pdf()
	{
		$date = $this->uri->segment(4, mdate("%Y-%m-%d", time()));
		$data['date'] = $date;
		$airline = $this->uri->segment(3, 'ga');
		$data['airline'] = $airline;
		
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_outgoing($date, $airline);
		#$data['total'] = $this->harian_model->get_total_outgoing($date, $airline);
		
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lpkh-outgoing-'.$airline.'-'.$date;
		$stn = $this->input->post('hs_service_site');
		$html = $this->load->view('harian/details_pdf_outgoing',$data, true); 
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}

	public function incoming()
	{
		$this->load->model('airline_model');
		$data['airline'] = $this->airline_model->get_all_airline();
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('harian/incoming', $data);
		$this->load->view('template/footer');	
	}
	
	public function incoming_result()
	{
		$startdate = mdate('%Y-%m-%d', strtotime($this->input->post('startdate')));
		$enddate = mdate('%Y-%m-%d', strtotime($this->input->post('enddate')));
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		$airline = $this->input->post('airline');
		$data['airline'] = $airline;
		
		# redirect model due database change on 01-08-2013
		if($startdate < '2013-08-02')
		{
			$data_type = 'v2';
		}
		else
		{
			$data_type = 'v3';
		}
		
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_incoming($startdate, $enddate, $airline, $data_type);
		#$data['total'] = $this->harian_model->get_total_incoming($date, $airline);
		
		if($data_type == 'v2')
		{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('harian/details_incoming', $data);
			$this->load->view('template/footer');
		}
		else
		{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('harian/v3_details_incoming', $data);
			$this->load->view('template/footer');
		}

	}
	
	public function incoming_pdf()
	{
		$airline = $this->uri->segment(3, 'ga');
		$data['airline'] = $airline;
		
		$startdate = $this->uri->segment(4, mdate("%Y-%m-%d", time()));
		$enddate = $this->uri->segment(5, mdate("%Y-%m-%d", time()));
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
    
		# redirect model due database change on 01-08-2013
		if($startdate < '2013-08-02')
		{
			$data_type = 'v2';
		}
		else
		{
			$data_type = 'v3';
		}
	
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_incoming($startdate, $enddate, $airline, $data_type);
		$data['total'] = $this->harian_model->get_total_incoming($startdate,$enddate, $airline);
		
		# call helper    
    	$this->load->helper('sigap_pdf');
    
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lpkh-incoming-'.$airline.'-'.$startdate.'sd'.$enddate;
		$stn = $this->input->post('hs_service_site');
    
			if($data_type == 'v2')
			{
				$html = $this->load->view('harian/details_pdf_incoming',$data, true); 
			}
			else
			{
				$html = $this->load->view('harian/v3_details_pdf_incoming',$data, true); 
			}
		
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';		
	}
	/*
	public function incoming_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->input->post('date')));
		$data['date'] = $date;
		$airline = $this->input->post('airline');
		$data['airline'] = $airline;
		
		# redirect model due database change on 01-08-2013
		if($date < '2013-08-02')
		{
			$data_type = 'v2';
		}
		else
		{
			$data_type = 'v3';
		}
		
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_incoming($date, $airline, $data_type);
		#$data['total'] = $this->harian_model->get_total_incoming($date, $airline);
		
		#print_r($data);
		
		if($data_type == 'v2')
		{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('harian/details_incoming', $data);
			$this->load->view('template/footer');
		}
		else
		{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('harian/v3_details_incoming', $data);
			$this->load->view('template/footer');
		}

	}
	
	public function incoming_pdf()
	{
		$date = $this->uri->segment(4, mdate("%Y-%m-%d", time()));
		$data['date'] = $date;
		$airline = $this->uri->segment(3, 'ga');
		$data['airline'] = $airline;
    
	# redirect model due database change on 01-08-2013
		if($date < '2013-08-02')
		{
			$data_type = 'v2';
		}
		else
		{
			$data_type = 'v3';
		}
	
		$this->load->model('harian_model');
		$data['details'] = $this->harian_model->details_incoming($date, $airline, $data_type);
		$data['total'] = $this->harian_model->get_total_incoming($date, $airline);
		
		# call helper    
    	$this->load->helper('sigap_pdf');
    
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lpkh-incoming-'.$airline.'-'.$date;
		$stn = $this->input->post('hs_service_site');
    
			if($data_type == 'v2')
			{
				$html = $this->load->view('harian/details_pdf_incoming',$data, true); 
			}
			else
			{
				$html = $this->load->view('harian/v3_details_pdf_incoming',$data, true); 
			}
		
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';		
	}
	*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */