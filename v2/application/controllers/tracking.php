<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * login tracking
	 *
	 * url : http://dom.wms.kno.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	
	public function index()
	{
		redirect('tracking/smu');
	}
	
	public function btb()
	{
		# call login form
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('tracking/btb');
		$this->load->view('template/footer');
	}
	
	public function btb_search()
	{
		$this->load->model('tracking_model');
		$no_btb = $this->input->post('no_btb');
		$type = $this->input->post('type');
		$data['type'] = $type;
		
		$data['query'] = $this->tracking_model->btb($no_btb, $type);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('tracking/btb_result', $data);
		$this->load->view('template/footer');
	}
	
	public function smu()
	{
		# call login form
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('tracking/smu');
		$this->load->view('template/footer');
	}
	
	public function smu_search()
	{
		$this->load->model('tracking_model');
		$no_smu = $this->input->post('no_smu');
		
		if($no_smu == NULL){$no_smu = '00000000';}
		
		$type = $this->input->post('type');
		$data['type'] = $type;
		
		$data['query'] = $this->tracking_model->smu($no_smu, $type);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('tracking/smu_result', $data);
		$this->load->view('template/footer');
	}
	
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */