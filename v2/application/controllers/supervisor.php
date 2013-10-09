<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supervisor extends CI_Controller {

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
		redirect('supervisor/agent');
	}
	
	public function agent()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('supervisor/add_agent');
	}
	
	public function add_agent()
	{
		$this->load->model('supervisor_model');
		
		$data = array(
			'btb_agent' => $this->input->post('agent'),
			'agentfullname' => $this->input->post('full'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'fax' => $this->input->post('fax'),
			'contactpeson' => $this->input->post('cp'),
			'npwp' => $this->input->post('npwp'),
			);
		$this->supervisor_model->insert_data_agent($data);
		
		redirect('supervisor/list_agent');
	}
	
	public function list_agent()
	{
		$this->load->model('supervisor_model');
		
		#pagination config
		$config['base_url'] = base_url().'index.php/supervisor/list_agent/'; 
		$config['total_rows'] = $this->supervisor_model->count_all_agent(); 
		$config['per_page'] = 20; 
		$config['uri_segment'] = 3; 
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['result'] = $this->supervisor_model->get_all_agent($config['per_page'],$page);
		$data['offset'] = $page;
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('supervisor/list_agent', $data);
	}
	
	public function balance_agent()
	{
		$this->load->model('supervisor_model');
		$id_agent = $this->uri->segment(3);
		
		#pagination config
		$config['base_url'] = base_url().'index.php/supervisor/balance_agent/'.$id_agent.'/'; 
		$config['total_rows'] = $this->supervisor_model->count_all_balance($id_agent); 
		$config['per_page'] = 10; 
		$config['uri_segment'] = 4; 
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['result'] = $this->supervisor_model->get_agent_balance($id_agent, $config['per_page'],$page);
		$data['agent'] = $this->supervisor_model->get_agent_by_id($id_agent);
		$data['offset'] = $page;
		
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('supervisor/balance_agent',$data);
		$this->load->view('template/footer');	
		
	}
	
	public function add_balance()
	{
		$this->load->model('supervisor_model');
		$id_agent = $this->input->post('id_agent');
		
		# Validation Form
		$this->load->library('form_validation');
		$this->form_validation->set_rules('balance', 'balance', 'required|numeric');
		if ($this->form_validation->run() == FALSE)
		{
			# validation false
			redirect('supervisor/balance_agent/'.$id_agent.'/not_complete', 'refresh');
		}
		else
		{
		# Page Data
		$pagedata['view_supervisor_agent'] = 'class="active"';
		$pagedata['sidebar'] = 'supervisor';
		
		# data preparing
		$balance = $this->supervisor_model->get_last_balance($id_agent);
		foreach($balance as $row_balance)
		{
			$last_balance = $row_balance->balance;
		}
		if ($balance == NULL)
		{
			$last_balance = 0;
		}
			$this->supervisor_model->debet_balance($id_agent, $last_balance);
		
		# call view
		redirect('supervisor/balance_agent/'. $id_agent);
		}
	}
	
	public function edit_agent()
	{
		$this->load->model('supervisor_model');
		$id_agent = $this->uri->segment(3);
		
		$data['agent'] = $this->supervisor_model->get_agent_by_id($id_agent);
		
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('supervisor/edit_agent',$data);
		$this->load->view('template/footer');	
		
	}
	
	public function update_data_agent()
	{
		$id_agent = $this->input->post('id_agent');
		$data = array(
			'btb_agent' => $this->input->post('agent'),
			'agentfullname' => $this->input->post('full'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'fax' => $this->input->post('fax'),
			'contactpeson' => $this->input->post('cp'),
			'npwp' => $this->input->post('npwp'),
			);
		$this->load->model('supervisor_model');
		$this->supervisor_model->update_data_agent($id_agent,$data);
		redirect('supervisor/list_agent');
	}
	
	public function delete_agent()
	{
		$id_agent = $this->uri->segment(3);
		$this->load->model('supervisor_model');
		$this->supervisor_model->delete_agent($id_agent);
		redirect('supervisor/list_agent');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */