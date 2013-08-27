<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoming extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		redirect('incoming/add_manifest_instore');
	}
	
	public function add_manifest_instore()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add_manifestin_instore');
		$this->load->view('template/footer');	
	}
	
	public function add_manifest_outstore()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add_manifestin_outstore');
		$this->load->view('template/footer');	
	}
	
	public function add()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add');
		$this->load->view('template/footer');	
	}
	
	
	public function insert_in()
	{
		if(substr_count($this->input->post('incoming') , '/') !== 4 )
		{	
			# fail format input, redirect to form add
			redirect('incoming/add');
		}
		else
		{
			#format input true, check type data input
			$incoming = explode('/',$this->input->post('incoming'));
			
			// pemberian nilai variabel
			$noflight = $incoming[0];
			$tanggal = substr($incoming[1],0,2)."-".substr($incoming[1],2,2)."-".substr($incoming[1],4);
			
			$tgl_manifest = date('Y-m-d',strtotime($tanggal));
			
			$smu = $incoming[2];
			$koli = $incoming[3];
			$berat = $incoming[4];
			
			# call model
			$this->load->model('incoming_model');
			
			if ( ($this->incoming_model->is_alphanumeric($noflight) == FALSE) OR (!is_numeric($koli)) OR (!is_numeric($berat))  )
			{
				# fail redirect to form add
				redirect('incoming/add');
			} 
			else 
			{
				# success
				$this->load->model('incoming_model');
				$get_flight = $this->incoming_model->get_flight($noflight);
				
				if($get_flight > 0)
				{
					# flight found
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$get_smu = $this->incoming_model->get_smu($smu);
					
					if($get_smu > 0)
					{
						# smu found and create breakdown
						#$id_isimanifestin = $this->incoming_model->get_id_isimanifestin($id_manifestin,$smu);
						#$this->incoming_model->insert_breakdown($id_isimanifestin,$id_manifestin,$berat,$koli);
					}
					else
					{
						# smu not found then create  isi manifest
						$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
						
						# delete breakdown dari trigger
						$this->incoming_model->delete_last_breakdown();
					}
				} 
				else
				{
					# flight not found
					
					$btb = $this->incoming_model->generate_btb_no(); 
					//$this->incoming_model->insert_incoming_in_dtbarang($btb,$smu,$noflight,$tgl_manifest,$koli,$berat);	
					$this->incoming_model->insert_manifestin($noflight,$tgl_manifest);	
					
					//add_manifestin
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
					// delete breakdown dari trigger
					$this->incoming_model->delete_last_breakdown();
				}
				redirect('incoming/list_incoming');
			}
		}
	}
	
	
	public function insert_manifest_instore()
	{
		if(substr_count($this->input->post('incoming') , '/') !== 4 )
		{	
			# fail format input, redirect to form add
			redirect('incoming/add_manifest_instore');
		}
		else
		{
			#format input true, check type data input
			$incoming = explode('/',$this->input->post('incoming'));
			
			// pemberian nilai variabel
			$noflight = $incoming[0];
			$tanggal = substr($incoming[1],0,2)."-".substr($incoming[1],2,2)."-".substr($incoming[1],4);
			
			$tgl_manifest = date('Y-m-d',strtotime($tanggal));
			
			$smu = $incoming[2];
			$koli = $incoming[3];
			$berat = $incoming[4];
			
			# call model
			$this->load->model('incoming_model');
			
			if ( ($this->incoming_model->is_alphanumeric($noflight) == FALSE) OR (!is_numeric($koli)) OR (!is_numeric($berat))  )
			{
				# fail redirect to form add
				redirect('incoming/add_manifest_instore');
			} 
			else 
			{
				# success
				$this->load->model('incoming_model');
				$get_flight = $this->incoming_model->get_flight($noflight);
				
				if($get_flight > 0)
				{
					# flight found
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$get_smu = $this->incoming_model->get_smu($smu);
					
					if($get_smu > 0)
					{
						# smu found and create breakdown
						#$id_isimanifestin = $this->incoming_model->get_id_isimanifestin($id_manifestin,$smu);
						#$this->incoming_model->insert_breakdown($id_isimanifestin,$id_manifestin,$berat,$koli);
					}
					else
					{
						# smu not found then create  isi manifest
						$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
						
						# delete breakdown dari trigger
						$this->incoming_model->delete_last_breakdown();
					}
				} 
				else
				{
					# flight not found
					
					$btb = $this->incoming_model->generate_btb_no(); 
					//$this->incoming_model->insert_incoming_in_dtbarang($btb,$smu,$noflight,$tgl_manifest,$koli,$berat);	
					$this->incoming_model->insert_manifestin($noflight,$tgl_manifest);	
					
					//add_manifestin
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
					// delete breakdown dari trigger
					$this->incoming_model->delete_last_breakdown();
				}
				redirect('incoming/list_breakdown/'.$noflight);
			}
		}
	}
	
	
	public function insert_manifest_outstore()
	{
		if(substr_count($this->input->post('incoming') , '/') !== 4 )
		{	
			# fail format input, redirect to form add
			redirect('incoming/add_manifest_outsource');
		}
		else
		{
			#format input true, check type data input
			$incoming = explode('/',$this->input->post('incoming'));
			
			// pemberian nilai variabel
			$noflight = $incoming[0];
			$tanggal = substr($incoming[1],0,2)."-".substr($incoming[1],2,2)."-".substr($incoming[1],4);
			
			$tgl_manifest = date('Y-m-d',strtotime($tanggal));
			
			$smu = $incoming[2];
			$koli = $incoming[3];
			$berat = $incoming[4];
			
			# call model
			$this->load->model('incoming_model');
			
			if ( ($this->incoming_model->is_alphanumeric($noflight) == FALSE) OR (!is_numeric($koli)) OR (!is_numeric($berat))  )
			{
				# fail redirect to form add
				redirect('incoming/add_manifest_outsource');
			} 
			else 
			{
				# success
				$this->load->model('incoming_model');
				$get_flight = $this->incoming_model->get_flight($noflight);
				
				if($get_flight > 0)
				{
					# flight found
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$get_smu = $this->incoming_model->get_smu($smu);
					
					if($get_smu > 0)
					{
						# smu found and create breakdown
						#$id_isimanifestin = $this->incoming_model->get_id_isimanifestin($id_manifestin,$smu);
						#$this->incoming_model->insert_breakdown($id_isimanifestin,$id_manifestin,$berat,$koli);
					}
					else
					{
						# smu not found then create  isi manifest
						$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
					}
				} 
				else
				{
					# flight not found
					
					$btb = $this->incoming_model->generate_btb_no(); 
					//$this->incoming_model->insert_incoming_in_dtbarang($btb,$smu,$noflight,$tgl_manifest,$koli,$berat);	
					$this->incoming_model->insert_manifestin($noflight,$tgl_manifest);	
					
					//add_manifestin
					$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
					$this->incoming_model->insert_isimanifestin($id_manifestin,$smu,$berat,$koli);
				}
				redirect('incoming/list_breakdown/'.$noflight);
			}
		}
	}
	
	public function list_incoming()
	{
		$this->load->model('incoming_model');
		$data['incoming'] = $this->incoming_model->get_last_list_incoming();
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/list_incoming',$data);
		$this->load->view('template/footer');	
	}
	
	public function list_breakdown()
	{
		$no_flight = ($this->uri->segment(3));
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_breakdown($no_flight);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/list_breakdown',$data);
		$this->load->view('template/footer');	
	}
	
	# add breakdown
	public function form_breakdown()
	{
		$no_flight = ($this->uri->segment(3));
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_breakdown($no_flight);
		$data['no_flight'] = $no_flight;
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/form_breakdown',$data);
		$this->load->view('template/footer');	
	}
	
	
	public function search_breakdown()
	{
		$no_flight = $this->input->post('no_flight');	
		redirect('incoming/list_breakdown/'.$no_flight);
	}
	public function search_form_breakdown()
	{
		$no_flight = $this->input->post('no_flight');	
		redirect('incoming/form_breakdown/'.$no_flight);
	}
	
	public function save_breakdown()
	{
		$data	= array(
				'id_manifestin' =>	$this->input->post('id_manifestin'),
				'id_isimanifestin' =>	$this->input->post('id_isimanifestin'),
				'kolidatang' =>	$this->input->post('koli'),
				'beratdatang' =>	$this->input->post('berat'),
			);
		$smu = $this->input->post('smu');
		$flight_no = $this->input->post('no_flight');
		
		$this->load->model('incoming_model');
		$this->incoming_model->save_breakdown($data);
		
		//update status manifestin
		$this->incoming_model->update_status_manifestin($data['id_manifestin']);
		
		redirect('incoming/form_breakdown/'.$flight_no);
	}
	
	
	
	
	/*
	public function input_breakdown()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add_breakdown',$data);
		$this->load->view('template/footer');	
	}
	*/

	
	public function search_smu_incoming()
	{
		$date = $this->input->post('date');	
		redirect('incoming/list_breakdown');
	}
	
	/*
	public function search_smu_breakdown()
	{
		$smu = $this->input->post('search');
		redirect('incoming/breakdown/'.$smu);
	}
	*/
	public function breakdown()
	{
		$smu = $this->uri->segment(3);
		$this->load->model('incoming_model');
		$data['result']=$this->incoming_model->get_isimanifestin($smu);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add_breakdown',$data);
		$this->load->view('template/footer');	
	}
	
	public function insert_breakdown()
	{
		$breakdown = explode('/',$this->input->post('breakdown'));
		// pemberian nilai variabel
		$smu = $incoming[0];
		$koli = $incoming[1];
		$berat = $incoming[2];
		$id_manifestin = $this->incoming_model->get_id_manifestin($noflight,$tgl_manifest);
		$id_isimanifestin = $this->incoming_model->get_id_isimanifestin($id_manifestin,$smu);
		//sampai sini			
	}
	
	public function edit_manifestin()
	{
		$data['id_manifestin'] = $this->uri->segment(3);
		$this->load->model('incoming_model');
		$data['manifest'] = $this->incoming_model->get_manifestin_by_id($data['id_manifestin']);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/edit_manifestin',$data);
		$this->load->view('template/footer');	
	}
	
	public function edit_data_manifestin()
	{
		$data = array(
				'airline'	=> $this->input->post('airline'),
				'noflight'	=> $this->input->post('noflight'),
				'tglmanifest' 	=>	$this->input->post('tglmanifest'),
				'acregistration'	=>	$this->input->post('acregistration'),
			);
		$id_manifest = $this->input->post('id_manifest');
		$this->load->model('incoming_model');
		$this->incoming_model->update_manifestin($data,$id_manifestin);
	}
	
	public function edit_isimanifestin()
	{
		$data['id_isimanifestin'] = $this->uri->segment(3);
		$this->load->model('incoming_model');
		$data['isimanifestin'] = $this->incoming_model->get_isimanifestin_by_id( $data['id_isimanifestin'] );
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/edit_isimanifestin',$data);
		$this->load->view('template/footer');	
	}
	
	public function update_manifestin()
	{
		
	}
	
	public function list_incoming_flight_no()
	{
		$data['today'] = date('Y-m-d',strtotime($this->uri->segment(3)));
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->list_incoming_flight_no($data['today']);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/list_incoming_flight_no',$data);
		$this->load->view('template/footer');	
	}
	public function search_incoming_flight_no()
	{
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		redirect("list_incoming_flight_no/".$date );
	}
	public function list_incoming_smu()
	{
		$data['today'] = date('Y-m-d',strtotime($this->uri->segment(3)));
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->list_incoming_smu($data['today']);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/list_incoming_smu',$data);
		$this->load->view('template/footer');	
	}
	public function search_incoming_smu()
	{
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		redirect("list_incoming_smu/".$date );
	}
	
	
	public function incoming_btb()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/search_smu_breakdown');
		$this->load->view('template/footer');	
	}
	public function search_smu_breakdown()
	{
		if( $this->input->post('smu') > 0 ){
			$data['smu'] = $this->input->post('smu');
		} else {
			$data['smu'] = $this->uri->segment(3);
		}
		
		//$data['smu'] = $this->input->post('smu');
		$this->load->model('incoming_model');
		$data['result'] = $this->incoming_model->get_smu_breakdown($data['smu']);
		$data['agent'] = $this->incoming_model->get_all_agent();
		$data['airline'] = $this->incoming_model->get_all_airline();
		$data['typebarang'] = $this->incoming_model->get_all_type_barang();
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('incoming/menu');
		$this->load->view('incoming/add_btb_incoming',$data);
		$this->load->view('template/footer');	
	}
	public function submit_incoming_btb()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('agent', 'agent', 'required');
		$this->form_validation->set_rules('airline', 'airline', 'required');		
		$this->form_validation->set_rules('jenisbarang', 'jenisbarang', 'required');		
		$this->form_validation->set_rules('beratbayar', 'beratbayar', 'required');		
		if ($this->form_validation->run() == FALSE)
		{
			$data['link'] = 'incoming/search_smu_breakdown/'.$this->input->post('smu');
			$this->load->view('template/header');
			$this->load->view('template/breadcumb');
			$this->load->view('incoming/menu');
			$this->load->view('incoming/gagal_create_btb_incoming',$data);
			$this->load->view('template/footer');	
		}
		else
		{
			$this->load->model('incoming_model');
			$cek = $this->incoming_model->cek_data_in_dtb($this->input->post('smu'));
			if($cek == 0){
				$btb_no = $this->incoming_model->generate_btb_no();
				$data = array(
						'in_btb'	=> $btb_no,
						'in_agent'	=> $this->input->post('agent'),
						'in_airline'	=> $this->input->post('airline'),
						'in_asal'	=> $this->input->post('asal'),
						'in_tujuan'	=> $this->input->post('tujuan'),
						'in_smu'	=> $this->input->post('smu'),
						'in_jenisbarang'	=> $this->input->post('jenisbarang'),
						'in_noflight'	=> $this->input->post('noflight'),
						'in_tgl_manifest'	=> $this->input->post('tglmanifest'),
						'in_koli'	=> $this->input->post('koli'),
						'in_berat_datang'	=> $this->input->post('berat'),
						'in_berat_bayar'	=> $this->input->post('berat_bayar'),
						'in_status_cetak'	=> 0,
				);
				$this->incoming_model->insert_incoming_btb($data);
			
				$data_manifestin = array(
						'airline' 	=>	$this->input->post('airline'),
						'noflight' 	=>	$this->input->post('noflight'),
						'tglmanifest'	=> $this->input->post('tglmanifest'),
						'acregistration' => $this->input->post('acregistraion'),
				);
				$id_manifestin = $this->input->post('id_manifestin');
				$this->incoming_model->update_data_manifestin($data_manifestin,$id_manifestin);
				
				$data_isimanifestin = array(
						'jenisbarang'	=>	$this->input->post('jenisbarang'),
						'asal'	=>	$this->input->post('asal'),
						'tujuan'	=>	$this->input->post('tujuan'),
				);
				$id_isimanifestin = $this->input->post('id_isimanifestin');
				$this->incoming_model->update_data_isimanifestin($data_isimanifestin,$id_isimanifestin);
				
			} else {
				$btb_no = $cek;
			}
			
			redirect('incoming/print_incoming_btb/'.$btb_no);
		}
	}
	
	public function print_incoming_btb($btb_no)
	{
		$this->load->model('incoming_model');
		$data['detail']=$this->incoming_model->get_detail_btb($btb_no);
		$data['detail_berat']=$this->incoming_model->get_detail_berat_btb($btb_no);
		$this->incoming_model->update_status_print_incoming_dtb($btb_no);
		#View Call
		$this->load->helper('sigap_pdf');
		$this->load->view('incoming/print_btb_incoming',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'print-incoming-btb';
		$stn = $this->input->post('hs_service_site');
		$html = $this->load->view('incoming/print_btb_incoming', $data, true);
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */