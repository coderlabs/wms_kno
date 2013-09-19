<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * user controller
	 *
	 * url : http://dom.wms.kno.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
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
		/*
		$session_data_user = $this->session->userdata('logged_in');
		
		if(($session_data_user['level'] != 'admin') AND ($session_data_user['level'] != 'supervisor'))
		{
			redirect('dashboard');
		}
		*/
	} 

	public function index()
	{
		$this->load->model('user_model');
		
		$session_data_user = $this->session->userdata('logged_in');
		$id_user = $session_data_user['id_user'];
		
		if(($session_data_user['level'] != 'admin') AND ($session_data_user['level'] != 'supervisor'))
		{
			$data['result'] =  $this->user_model->get_user_by_id($id_user);
		} else {
			$data['result'] = $this->user_model->get_all_user();
		}
		$data['level_user'] = $session_data_user['level'];//level user yang sedang login
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('user/daftar_user',$data);
		#$this->load->view('template/footer');
	}
	
	public function edit()
	{
		$id_user = str_replace('%20',' ',$this->uri->segment(3));
		$this->load->model('user_model');
		$data['result'] = $this->user_model->get_user_by_id($id_user);
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('user/edit_user',$data);
	}
	
	public function update_data_user()
	{
		$this->load->model('user_model');
		
		$id_user = $this->input->post('id_user');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$email = $this->input->post('email');
		$nipp = $this->input->post('nipp');
		$level = $this->input->post('level');
		$jabatan = $this->input->post('jabatan');
		$telpon = $this->input->post('telpon');
		
		$this->user_model->update_user($id_user , $nama_lengkap, $email, $nipp, $level, $jabatan, $telpon);
		redirect('user');
	}
	
	public function ganti_password()
	{
		$id_user = str_replace('%20',' ',$this->uri->segment(3));
		$this->load->model('user_model');
		$data['result'] = $this->user_model->get_user_by_id($id_user);
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('user/change_password',$data);
	}
	
	public function update_password()
	{
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		$id_user = $this->input->post('id_user');
		$password = $this->input->post('password');
		
		$this->user_model->update_password($id_user , $password);
		redirect('user');
	}
	
	
	public function delete_user()
	{
		$id_user = str_replace('%20',' ',$this->uri->segment(3));
		$this->load->model('user_model');
		$this->user_model->delete_user($id_user);
		redirect('user');
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */