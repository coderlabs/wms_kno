<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoming extends CI_Controller {

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
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/dashboard');
		#$this->load->view('template/footer');
	}
	
	# <<<< customer service >>>>
	
	public function get_smu()
	{
		# GET SMU to create BTB
		
		# get no smu from view
		$smu = $this->input->post('smu');
		if($smu == NULL)
		{
			# smu NULL find latest 5 smu
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_lastest_data_breakdown();
		}
		else
		{
			# smu search
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_data_breakdown($smu);
		}
		
		# call view		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/get_smu',$data);
		#$this->load->view('template/footer');
	}
	
	public function form_create_btb()
	{
		# Display form to create BTB
		
		# load model
		$this->load->model('incoming_model');
		
		# get breakdown id form url
		$id_breakdown = $this->uri->segment(3, 0);
		
		# get type barang data from db
		$data['typebarang'] = $this->incoming_model->get_all_type_barang();
		
		# get agent data from dn
		$data['agent'] = $this->incoming_model->get_all_agent();
		
		if($id_breakdown == 0)
		{
			# error, breakdown id not found, redirect to search smu
			redirect('incoming/get_smu', 'refresh');
		}
		else
		{
			# breakdown id found, display form
			$data['result'] = $this->incoming_model->get_data_in_breakdown_by_id($id_breakdown);
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('incoming/form_create_btb',$data);
			#$this->load->view('template/footer');	
		}
	}
	
	
	public function create_btb()
	{
		# Save data and create Inbound BTB
		
		# do form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('agent', 'agent', 'required');
		$this->form_validation->set_rules('airline', 'airline', 'required');		
		$this->form_validation->set_rules('typebarang', 'typebarang', 'required');		
		if ($this->form_validation->run() == FALSE)
		{
			# validation false
			$id_breakdown = $this->input->post('id_breakdown');
			redirect('incoming/get_smu/' . $id_breakdown, 'refresh');
		}
		else
		{
			# validation true
			$inb_id = $this->input->post('id_breakdown');
			$agent = $this->input->post('agent');
			$name = $this->input->post('name');
			$airline = $this->input->post('airline');
			$asal = $this->input->post('asal');
			$tujuan = $this->input->post('tujuan');
			$smu = $this->input->post('smu');
			$typebarang = $this->input->post('typebarang');
			$noflight = $this->input->post('noflight');
			$koli = $this->input->post('koli');
			$berataktual = $this->input->post('berataktual');
			$beratvolume = $this->input->post('beratvolume');
			
			# berat bayar
			if($berataktual > $beratvolume)
			{
				# berat aktual
				if($berataktual <= 10){$beratbayar = 10;}else{$beratbayar = $berataktual;}
			}
			else
			{
				# berat volume
				if($beratvolume <= 10){$beratbayar = 10;}else{$beratbayar = $beratvolume;}
			}
			
			$tglmanifest = date('Y-m-d');
			
			$this->load->model('incoming_model');
			
			#generate_btb_no
			$btb_no = $this->incoming_model->generate_btb_no();
			
			# get user data
			$user = $this->session->userdata('logged_in');
			$user = $user['id_user'];
			
			#insert btb
			$data_btb = array(
				'in_inb_id' => $inb_id,
				'in_btb' => $btb_no,
				'in_agent' => $agent,
				'in_name' => $name,
				'in_airline' => $airline,
				'in_asal' => $asal,
				'in_tujuan' => $tujuan,
				'in_smu' => $smu,
				'in_jenisbarang' => $typebarang,
				'in_noflight' => $noflight,
				'in_tgl_manifest' => $tglmanifest,
				'in_koli' => $koli,
				'in_berat_datang' => $berataktual,
				'in_berat_bayar' => $beratbayar,
				'in_status_cetak' => 1,
				'in_update_by' => $user,
				
			);
			
			# call model to save btb
			$this->incoming_model->insert_data_btb($data_btb);
			
			$data['btb_no'] = $btb_no;
			
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('incoming/print_btb',$data);
			#$this->load->view('template/footer');
		}
	}
	
	# <<<< customer service >>>>
	
	# <<<< report >>>>
	
	public function stock_opname()
	{
		# display stock opname form
		
		# load model
		$this->load->model('incoming_model');
		
		# get all available airline
		$data['airline'] = $this->incoming_model->get_all_airline();
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/stock_opname',$data);
	}
	
	public function stock_opname_result()
	{
		$airline = $this->input->post('airline');
		$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
		
		
		# load model
		$this->load->model('incoming_model');
		
		# get all available airline
		$data['result'] = $this->incoming_model->daily_stock_opname($date, $airline);
		
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/daily_stock_opname',$data);
		
	}
	
	public function stock_opname_pick_up()
	{
		$inb_id = $this->uri->segment(3, 0);
		$this->load->model('incoming_model');
		
		# get user data
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
			
		# update pick up status and time
		$this->incoming_model->pick_up_btb($inb_id, $user);
		redirect('incoming/get_btb', 'refresh');
	}
	
	# <<<< report >>>>
	
	# <<<< pick up cargo >>>>
	
	public function get_btb_pickup()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/get_btb_pickup');
	}
	
	public function get_btb_pickup_result()
	{
		$btb_no = $this->input->post('btb_no');
		
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_btb($btb_no);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/get_btb_pickup_result', $data);
	}
	
	public function keluarkan_barang()
	{
		$inb_id = $this->uri->segment(3, 0);
		$this->load->model('incoming_model');
		
		# get user data
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		
		# update pick up status and time
		$this->incoming_model->pick_up_btb($inb_id, $user);
		redirect('incoming/get_btb', 'refresh');
	}
	
	# <<< pick up cargo >>>
	
	
	
	# <<<< checker >>>>>
	
	public function add_manifest_instore()
	{
		# insert breakdown form
		
		$this->load->model('incoming_model');
		$smu = $this->uri->segment(3);
		
		$data['result'] = $this->incoming_model->get_data_inbreakdown($smu);	
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/add_manifestin_instore',$data);
		#$this->load->view('template/footer');	
	}
	
	public function insert_manifest_instore()
	{
		# do inster breakdown
		
		if(substr_count($this->input->post('incoming') , '/') !== 3 )
		{	
			# fail format input, redirect to form add
			redirect('incoming/add_manifest_instore/error');
		}
		else
		{
			#format input true, check type data input
			$incoming = explode('/',$this->input->post('incoming'));
			
			// pemberian nilai variabel
			$airlines = trim($incoming[0]);
			$smu = trim($incoming[1]);
			$koli = trim($incoming[2]);
			$berat = trim($incoming[3]);
			$status = 'instore';
			$user = $this->session->userdata('logged_in');
			$user = $user['id_user'];
			
			$this->load->model('airline_model');
			$cek_airline = $this->airline_model->cek_airline($airlines);
			if($cek_airline > 0)
			{
				# airline match
				$this->load->model('incoming_model');
				
				if ( ($this->incoming_model->is_alphanumeric($airlines) == FALSE) OR (!is_numeric($koli)) OR (!is_numeric($berat))  )
				{
					# fail redirect to form add
					redirect('incoming/add_manifest_instore/'.$smu.'/error');
				} 
				else 
				{
					# success
					$this->load->model('incoming_model');
					$this->incoming_model->insert_data_in_breakdown($airlines,$smu,$koli,$berat,$status,$user);
					# call model to update breakdown outstore
					#$this->incoming_model->update_breakdown($inb_id);
					redirect('incoming/add_manifest_instore/'.$smu.'/success');
				}
			}
			else
			{
					# airline not match
					redirect('incoming/add_manifest_instore/'.$smu.'/error');
			}
			
			
		}
	}
	
	# <<<< checker >>>>>
	
	
	
	
	
	
	############ Instore #############
	
	
	
	############ Outstore ##############
	public function add_manifest_outstore()
	{
		$this->load->model('incoming_model');
		$smu = $this->uri->segment(3);
		$data['result'] = $this->incoming_model->get_data_inbreakdown($smu);	
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		
		$this->load->view('incoming/add_manifestin_outstore',$data);
		$this->load->view('template/footer');	
	}
	
	
	public function insert_manifest_outstore()
	{
		if(substr_count($this->input->post('incoming') , '/') !== 4 )
		{	
			# fail format input, redirect to form add
			redirect('incoming/add_manifest_outstore/error');
		}
		else
		{
			#format input true, check type data input
			$incoming = explode('/',$this->input->post('incoming'));
			
			// pemberian nilai variabel
			$airlines = $incoming[0];
			$flt = $incoming[1];
			$smu = $incoming[2];
			$koli = $incoming[3];
			$berat = $incoming[4];
			$status = 'outstore';
			$date = mdate("%Y-%m-%d", time());
			# call model
			$this->load->model('incoming_model');
			
			if ( ($this->incoming_model->is_alphanumeric($airlines) == FALSE) OR (!is_numeric($koli)) OR (!is_numeric($berat))  )
			{
				# fail redirect to form add
				redirect('incoming/add_manifest_outstore/'.$smu.'/error');
			} 
			else 
			{
				# success
				$this->load->model('incoming_model');
				$this->incoming_model->insert_data_in_breakdown_outstore($airlines,$flt,$smu,$koli,$berat,$status, $date);
				
				redirect('incoming/add_manifest_outstore/'.$smu.'/success');
			}
		}
	}
	
	############ BTB #############
	
	
	
	
	
	
	
	public function get_btb()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/get_btb');
	}
	
	public function get_btb_result()
	{
		$btb_no = $this->input->post('btb_no');
		
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_btb($btb_no);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/get_btb_result', $data);
	}
	
	
	
	
	
	public function form_search_btb()
	{
		$smu = $this->uri->segment(3, 0);
		if($smu == 0)
		{
			# no smu NULL find latest 5 smu
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_lastest_data_breakdown();
		}
		else
		{
			
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_data_breakdown($smu);
		}
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/form_search_btb',$data);
		$this->load->view('template/footer');	
	}
	
	public function search_form_create_btb()
	{
		$smu = $this->input->post('smu');
		$this->load->model('incoming_model');
		
		$id_breakdown = $this->incoming_model->get_id_breakdown($smu);
		redirect('incoming/form_create_btb/'.$id_breakdown);
	}
	
	
	
	
	

	
	public function print_incoming_btb($btb_no)
	{
		$this->load->model('incoming_model');
		$data['detail'] = $this->incoming_model->get_detail_btb_by_btb_no($btb_no);
		$data['detail_berat'] = $this->incoming_model->get_detail_berat_btb_by_btb_no($btb_no);
		
		#View Call
		$this->load->helper('sigap_pdf');
		$this->load->view('incoming/print_btb_incoming',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'inbound-btb-' . $btb_no;
		$stn = $this->input->post('hs_service_site');
		$html = $this->load->view('incoming/print_btb_incoming', $data, true);
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
	public function reprint_incoming_btb()
	{
		$btb_no = $this->uri->segment(3, 0);
		$this->load->model('incoming_model');
		$data['detail'] = $this->incoming_model->get_detail_btb_by_btb_no($btb_no);
		$data['detail_berat'] = $this->incoming_model->get_detail_berat_btb_by_btb_no($btb_no);
		
		#View Call
		$this->load->helper('sigap_pdf');
		#$this->load->view('incoming/print_btb_incoming',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'inbound-btb-' . $btb_no;
		$stn = $this->input->post('hs_service_site');
		$html = $this->load->view('incoming/reprint_btb_incoming', $data, true);
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
	
	
	public function search_btb()
	{
		$smu = $this->input->post('smu');
		redirect('incoming/form_search_btb/'.$smu);
	}
	
	public function void_breakdown()
	{
		$inb_id = $this->uri->segment(3,0);
		$this->load->model('incoming_model');
		$this->incoming_model->update_status_void_breakdown($inb_id);
		redirect('incoming/my_breakdown');
	}
	
	public function void_breakdown_btb()
	{
		$inb_id = $this->uri->segment(3,0);
		$this->load->model('incoming_model');
		$this->incoming_model->update_status_void_breakdown($inb_id);
		redirect('incoming');
	}
	
	public function search_smu_breakdown()
	{
		$this->load->model('incoming_model');
		$smu = $this->uri->segment(3,0);
		if($smu == 0){
			$data['result'] = $this->incoming_model->get_data_inbreakdown_btb($smu);	
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_btb_breakdown',$data);
			$this->load->view('template/footer');	
		} else {
			$date = date('Y-m-d');
			$data['result'] = $this->incoming_model->get_data_inbreakdown_btb_by_date($date);	
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_btb_breakdown',$data);
			$this->load->view('template/footer');	
		}
	}
	
	public function form_instore()
	{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('incoming/form_instore');
			$this->load->view('template/footer');	
	}
	
	public function form_outstore()
	{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/form_outstore');
			$this->load->view('template/footer');	
	}
	
	public function instore()
	{
			$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_list_smu_instore_by_date($date);
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_instore',$data);
			$this->load->view('template/footer');	
	}
	
	public function outstore()
	{
			$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_list_smu_outstore_by_date($date);
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_outstore',$data);
			$this->load->view('template/footer');	
	}
	
	public function instore_incomplete_data()
	{
			
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->get_list_smu_instore_incomplete_data();
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_instore',$data);
			$this->load->view('template/footer');	
	}
	
	public function duplicate_smu()
	{
			
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->duplicate_smu();
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/list_instore',$data);
			$this->load->view('template/footer');	
	}
	
	public function form_breakdown()
	{
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('incoming/form_breakdown');
			$this->load->view('template/footer');	
	}
	
	public function breakdown_checklist()
	{
			$flt_no = $this->input->post('flt_no');
			if($flt_no==NULL){redirect('incoming/form_breakdown');};
			$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->create_breakdown($flt_no,$date);
			
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			
			$this->load->view('incoming/breakdown_checklist', $data);
			$this->load->view('template/footer');	
	}
	
	public function breakdown_checklist_pdf()
	{
			$flt_no = $this->uri->segment(3,0);
			$date = mdate("%Y-%m-%d", strtotime($this->uri->segment(4,0)));
			$this->load->model('incoming_model');
			$data['result'] = $this->incoming_model->create_breakdown($flt_no,$date);
			
			$this->load->helper('sigap_pdf');
			$stream = TRUE; 
			$papersize = 'legal'; 
			$orientation = 'potrait';
			$filename = 'breakdown-checklist-' . $flt_no . '-' . $date;
			$stn = $this->input->post('hs_service_site');
			$html = $this->load->view('incoming/breakdown_checklist_pdf', $data, true);
			pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
			$full_filename = $filename . '.pdf';
	}
	
	public function my_breakdown()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/my_breakdown');
	}
	
	public function my_breakdown_result()
	{
		$session_data = $this->session->userdata('logged_in');
		$user = $session_data['id_user'];
		
		if($user == NULL)
		{
			redirect('dashboard');
		}
		
		$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
		
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->my_breakdown($date, $user);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/my_breakdown_result',$data);
		$this->load->view('template/footer');	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */