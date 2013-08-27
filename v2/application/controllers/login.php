<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * login controller
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
		$session_data = $this->session->userdata('logged_in');
		if ($this->session->userdata('logged_in'))
		{
			 redirect('dashboard');
		}
		else
		{
			# call login form
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('user/login');
			#$this->load->view('template/footer');
		}
	}
	
	public function cek_login()
	{
		# execute login
		$this->load->model('user_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$data['login'] = $this->user_model->login($username, $password);
		
		
		if($data['login'] == TRUE)
		{
			# login success redirest to dashboard
			redirect('dashboard');
			
		}
		else
		{
			# login fail, show login form
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('user/login');
			#$this->load->view('template/footer');
		}
		
	}
	
	
	public function register()
	{
		$this->load->model('user_model');
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('user/register');
		#$this->load->view('template/footer');
	}
	
	
	public function save_user()
	{
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		$id_user = $this->input->post('id_user');
		$password = $this->input->post('password');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$email = $this->input->post('email');
		$nipp = $this->input->post('nipp');
		$level = $this->input->post('level');
		$jabatan = $this->input->post('jabatan');
		
		$hash = $this->encrypt->sha1($password, $this->config->item('encryption_key'));
		
		$this->user_model->save($id_user , $password, $nama_lengkap, $email, $nipp, $level, $jabatan);
		redirect('dashboard');
		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */