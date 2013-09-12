<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek_report extends CI_Controller {

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
		redirect('cek_report/form_generate');
	}
	
	public function form_cek()
	{
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cek_report/form_cek_report');
	}
	
	public function form_generate()
	{
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cek_report/form_generate_report');
	}
	
	
	public function perbandingan_report()
	{
		$date = mdate('%Y-%m-%d',strtotime($this->input->post('date')));
		$this->load->model('cek_report_model');
		$data['deliverybill'] = $this->cek_report_model->get_all_db_by_date($date);
		$data['date']=$date;
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cek_report/hasil_cek_report',$data);
	}
	
	# perbandingan report by query
	public function generate_report()
	{
		$date = mdate('%Y-%m-%d',strtotime($this->input->post('date')));
		$this->load->model('cek_report_model');
		$data['deliverybill'] = $this->cek_report_model->get_diff_db_by_date($date);
		$data['date']=$date;
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cek_report/hasil_generate_report',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */