<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Controller {

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
		$this->load->view('cashier/dashboard');
		#$this->load->view('template/footer');
	}
	
	public function new_receipt()
	{		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/add_payment_receipt_form');
		#$this->load->view('template/footer');
	}
	
	public function do_search_receipt()
	{
		#load model
		$this->load->model('cashier_model');
		
		#form validation
		//$this->form_validation->set_rules('btb_no', 'btb_no', 'required');
		
		#preparing search
		//if ($this->form_validation->run() == FALSE)
		{ 
			#redirect if form btb empty
			//redirect('cashier/payment/new_receipt'); 
		} //else
		{
			$search = $this->input->post('btb_no');
			
			# search outgoing dtbarang
			$outgoing = $this->cashier_model->payment_receipt_outgoing($search);
			
			if($outgoing == TRUE)
			{
				# redirect to outgoing
				redirect('cashier/payment_receipt_outgoing/' . $search, 'refresh');
			}
			else
			{
				# search on incoming
				$incoming = $this->cashier_model->payment_receipt_incoming($search);
				
				if($incoming == TRUE)
				{
					# redirect to incoming
					redirect('cashier/payment_receipt_incoming/' . $search, 'refresh');
				}
				else
				{
					# redirect to search again
					redirect('cashier/new_receipt/', 'refresh');
				}
			}
		}
	}
	
	public function payment_receipt_outgoing()
	{		
		#get data from url
		$search = $this->uri->segment(3,0);
		
		if($search == 0){redirect('cashier/new_receipt');}
		
		#load model
		$this->load->model('cashier_model');
		
		# cek payment status
		$paid = $this->cashier_model->get_payment_status_outgoing($search);
		
			if($paid == TRUE)
			{
				$data['search'] = $search;
				$void = $this->cashier_model->get_void_status($search);
				if($void == TRUE)
				{
					$data['void'] = 'yes';
				}
				else
				{
					$data['void'] = 'no';
				}
				echo $void;
				# btb paid and offering re print
				$this->load->view('template/header');
				$this->load->view('template/breadcumb');
				$this->load->view('cashier/paid_option_outgoing',$data);
				#$this->load->view('template/footer');
			}
			else
			{
				# btb unpaid and process new payment
				
				#prepare var
				$data['payment_type'] = $this->cashier_model->get_all_payment_type();
				$today = date('Y-m-d');
				
				# get outgoing dtbarang
				$data['outgoing'] = $this->cashier_model->get_dtbarang_outgoing($search);
				
				foreach ($data['outgoing'] as $item) :
					$no_btb = $item->btb_nobtb;
					$agent = $item->btb_agent;
					$no_smu = $item->btb_smu ;
					$airline = $item->airline;
					$tujuan = $item->btb_tujuan;
					$koli = $item->btb_totalkoli;
					$berat_aktual = $item->btb_totalberat;
					$berat_bayar = $item->btb_totalberatbayar;
					$tanggal_masuk = $item->btb_date;
				endforeach; 
				
				# prepare harga sewa by agent
				$harga_non_agent = $this->cashier_model->get_harga_sewa_non_agent('outgoing');
				foreach($harga_non_agent as $hs):
					$whc = $hs->sewaperhari;
					$csc = $hs->cgocharge;
					$ppn= $hs->ppn;
					$adm = $hs->dokumen;
					$kade = $hs->kade;
					$mincharge = $hs->mincharge;
					$data['mincharge'] = $mincharge;
					$minweight = $hs->minweight;
					$minhari = $hs->minhari;
				endforeach;
				
				# get durasi
				$durasi_aktual = round((time() - strtotime($tanggal_masuk))/(3600*24));
				
				if($durasi_aktual <= $minhari )
				{
					$durasi_bayar = 1;
				}
				else
				{
					$durasi_bayar = $durasi_aktual - 2;
				}
				$data['jumhari'] = $durasi_bayar;
				$data['minhari'] = $durasi_bayar;
				
				
				# get weight
				if($berat_bayar <= $minweight )
				{
					$berat_bayar = $minweight;
					
					# set data min wgt
					$data['minweight'] = 'y';
				}
				else
				{
					$berat_bayar = $berat_bayar;
					# set data min wgt
					$data['minweight'] = 'n';
				}
				
				
				# payment calculation
				$data['no_btb'] = $no_btb;
				$data['agent'] = $agent;
				$data['no_smu'] = $no_smu;
				$data['airline'] = $airline;
				$data['tujuan'] = $tujuan;
				$data['berat_aktual'] = $berat_aktual;
				$data['berat_bayar'] = $berat_bayar;
				$data['durasi_aktual'] = $durasi_aktual;
				$data['durasi_bayar'] = $durasi_bayar;
				$data['whc'] = $whc * $berat_bayar * $durasi_bayar;
				$data['csc'] = $csc * $berat_bayar * $durasi_bayar;
				$data['total'] = $data['csc'] + $data['whc'];
				$data['overtime'] = $data['total'] - ($berat_bayar*800);
				$data['sph'] = $whc + $csc;
				$data['admin'] = $adm;
				$data['ppn'] = $ppn;
				$data['tanggal_masuk'] = $tanggal_masuk;
				
				#View Call
				$this->load->view('template/spk_header');
				$this->load->view('template/breadcumb');
				$this->load->view('cashier/payment_receipt_outgoing_form',$data);
				#$this->load->view('template/footer');
				#$this->load->view('template/footer');
			}
		
		
	}
	
	public function payment_receipt_incoming()
	{
		# get data from url
		$search = $this->uri->segment(3,0);
		
		# if null
		if($search == 0){redirect('cashier/new_receipt');}
		
		#load model
		$this->load->model('cashier_model');
		
		# cek payment status
		$paid = $this->cashier_model->get_payment_status_incoming($search);
		
			if($paid == TRUE)
			{
				# btb paid
				
				# call model
				$void = $this->cashier_model->get_void_status($search);
				if($void == TRUE)
				{
					$data['void'] = 'yes';
				}
				else
				{
					$data['void'] = 'no';
				}
				
				# send data search to view
				$data['search'] = $search;
				
				# btb paid and offering re print
				$this->load->view('template/header');
				$this->load->view('template/breadcumb');
				$this->load->view('cashier/paid_option_incoming',$data);
				#$this->load->view('template/footer');
			}
			else
			{
				# btb unpaid and process new payment
				
				#prepare var
				$data['payment_type'] = $this->cashier_model->get_all_payment_type();
				$today = date('Y-m-d');
				
				# get incoming dtbarang
				$incoming = $this->cashier_model->get_dtbarang_incoming($search);
				
				foreach ($incoming as $item) :
					$no_btb = $item->in_btb;
					$agent = $item->in_agent;
					$no_smu = $item->in_smu ;
					$airline = $item->in_airline;
					$tujuan = $item->in_tujuan;
					$koli = $item->in_koli;
					$berat_aktual = $item->in_berat_datang;
					$berat_bayar = $item->in_berat_bayar;
					$tanggal_masuk = $item->in_update_on;
				endforeach; 
				
				# prepare harga sewa by agent
				$harga_non_agent = $this->cashier_model->get_harga_sewa_non_agent('outgoing');
				
				foreach($harga_non_agent as $hs):
					$whc = $hs->sewaperhari;
					$csc = $hs->cgocharge;
					$ppn= $hs->ppn;
					$adm = $hs->dokumen;
					$kade = $hs->kade;
					$mincharge = $hs->mincharge;
					$data['mincharge'] = $mincharge;
					$minweight = $hs->minweight;
					$minhari = $hs->minhari;
				endforeach;
				
				# get durasi
				$durasi_aktual = round((time() - strtotime($tanggal_masuk))/(3600*24));
				
				if($durasi_aktual <= $minhari )
				{
					$durasi_bayar = 1;
				}
				else
				{
					$durasi_bayar = $durasi_aktual - 2;
				}
				$data['durasi_aktual'] = $durasi_aktual;
				$data['durasi_bayar'] = $durasi_bayar;
				$data['jumhari'] = $durasi_bayar;
				$data['minhari'] = $durasi_bayar;
				
				
				# get weight
				if($berat_aktual <= 10 )
				{
					$berat_bayar = $minweight;
					
					# set data min wgt
					$data['minweight'] = 'y';
				}
				else
				{
					$berat_bayar = $berat_aktual;
					# set data min wgt
					$data['minweight'] = 'n';
				}
				$data['totalberat'] = $berat_bayar;
				
				# payment calculation
				$data['no_btb'] = $no_btb;
				$data['agent'] = $agent;
				$data['no_smu'] = $no_smu;
				$data['airline'] = $airline;
				$data['tujuan'] = $tujuan;
				$data['berat_aktual'] = $berat_aktual;
				$data['berat_bayar'] = $berat_bayar;
				$data['durasi_aktual'] = $durasi_aktual;
				$data['durasi_bayar'] = $durasi_bayar;
				$data['whc'] = $whc * $berat_bayar * $durasi_bayar;
				$data['csc'] = $csc * $berat_bayar * $durasi_bayar;
				$data['total'] = $data['csc'] + $data['whc'];
				$data['overtime'] = $data['total'] - ($berat_bayar*800);
				$data['sph'] = $whc + $csc;
				$data['admin'] = $adm;
				$data['ppn'] = $ppn;
				$data['tanggal_masuk'] = $tanggal_masuk;
				
				#view call
				$this->load->view('template/header');
				$this->load->view('template/breadcumb');
				$this->load->view('cashier/payment_receipt_incoming_form',$data);
				#$this->load->view('template/footer');
			}
	}
	
	public function save_payment()
	{
		$this->load->model('cashier_model');
		
		# get user data
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		
		$no_db = $this->cashier_model->get_last_db();
		
		$no_faktur = $this->cashier_model->get_last_faktur();
		
		$data = array(
				'no_smubtb' => $this->input->post('btb_no'),
				'document' => $this->input->post('administrasi'),
				'storage' => $this->input->post('total'),
				'id_carabayar' => $this->input->post('payment_type'),
				'lain' => $this->input->post('ppn_rp'),
				'ppn' => $this->input->post('ppn_rp'),
				'tglbayar' => mdate('%Y-%m-%d %h:%i:%s', time()),
				'user' => $user,
				'hari' => $this->input->post('min_hari'),
				'status' => $this->input->post('type'),
				'posted' => 0,
				'keterangan' => $this->input->post('ket'),
				'nosmu' => $this->input->post('awb_no'),
				'overtime' => $this->input->post('overtime'),
				'nodb' => $no_db,
				'nofaktur' => $no_faktur,
				'actual_days' => $this->input->post('jum_hari'),
				'sewagudang' => $this->input->post('whc'),
				'sewagudang_after_discount' => $this->input->post('total'),
				'cargo_charge' => $this->input->post('csc'),
				'administrasi' => $this->input->post('administrasi'),
				'total_biaya' => $this->input->post('total_bayar'),
				'minimum_charge' => $this->input->post('minc'),
				'minimum_weight' => $this->input->post('minw'),
			);
		
		$this->cashier_model->save_db($data);
		
		# data preparing
		$print['print'] = $this->input->post('btb_no');
		$print['nodb'] = $no_db;
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		
		if($this->input->post('type') == 0)
		{
			$this->load->view('cashier/print_bti', $print);
			$this->cashier_model->update_in_dtbarang($this->input->post('btb_no'));
			$this->cashier_model->update_in_dtbarang_berat($this->input->post('btb_no'), $this->input->post('berat_bayar'));
		} 
		elseif($this->input->post('type') == 1)
		{
			$this->load->view('cashier/print_bto',$print);
			$this->cashier_model->update_out_dtbarang_h($this->input->post('btb_no'));
			$this->cashier_model->update_out_dtbarang_h_berat($this->input->post('btb_no'), $this->input->post('berat_bayar'));
		}
		#$this->load->view('template/footer');
	}
	
	public function print_db()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		$devbil = $this->uri->segment(3);
	
		$devbill_out = $this->cashier_model->get_dev_bill_out_detail($devbil);
		$devbill_in = $this->cashier_model->get_dev_bill_in_detail($devbil);
		if ( $devbill_out != NULL) {
			$data['dev_bill'] = $this->cashier_model->get_dev_bill_out_detail($devbil);
			$set = $data['dev_bill'];
		} else if ($devbill_in != NULL) {
			$data['dev_bill'] = $this->cashier_model->get_dev_bill_in_detail($devbil);
			$set = $data['dev_bill'];
		}
		
		foreach ($set as $row)
		{
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$devbill = $row->nodb;
			$no_btb = $row->no_smubtb;
		}
		
		$this->cashier_model->update_status_print($devbill);
		$this->cashier_model->update_status_dbo($no_btb);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$this->load->view('cashier/pdf/print_dbi',$data);
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'delivery-bill-'.$devbil;
		$data['filename'] = $filename . '.pdf';
		$stn = $this->input->post('hs_service_site');
		if ($type == 0)
		{ $html = $this->load->view('cashier/pdf/print_dbi', $data, true); }
		else if ($type == 1)
		{ $html = $this->load->view('cashier/pdf/print_dbo',$data, true); }
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		
		
		redirect('cashier/payment/');
	}
	public function reprint_db()
	{
		$data['no_btb'] = $this->uri->segment(3);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/reprint_db', $data);
		#$this->load->view('template/footer');
	
	}
	public function do_reprint_db()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		# get no BTB in or out
		$no_btb = $this->uri->segment(3);
		
		$no_db = $this->cashier_model->get_nodb($no_btb);
		
		foreach ($no_db as $row)
		{
			$no_db = $row->nodb;
		}
		
		$devbill_out = $this->cashier_model->get_dev_bill_out_detail($no_db);
		
		$devbill_in = $this->cashier_model->get_dev_bill_in_detail($no_db);
		if ( $devbill_out != NULL) 
		{
			$data['dev_bill'] = $this->cashier_model->get_dev_bill_out_detail($no_db);
			$set = $data['dev_bill'];
		} 
		elseif($devbill_in != NULL) 
		{
			$data['dev_bill'] = $this->cashier_model->get_dev_bill_in_detail($no_db);
			$set = $data['dev_bill'];
		}
		
		foreach ($set as $row)
		{
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$devbill = $row->nodb;
			$no_btb = $row->no_smubtb;
		}
		
		$this->cashier_model->update_status_print($devbill);
		$this->cashier_model->update_status_dbo($no_btb);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$this->load->view('cashier/pdf/print_dbi',$data);
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'delivery-bill-'.$no_db;
		$stn = $this->input->post('hs_service_site');
		$html = '';
		if ($type == 0)
		{ $html = $this->load->view('cashier/pdf/print_dbi', $data, true); }
		else if ($type == 1)
		{ $html = $this->load->view('cashier/pdf/print_dbo',$data, true); }
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
		
		
		//redirect('cashier/payment/');
	}
	
	public function void_dbi()
	{
		#model call
		$this->load->model('cashier_model');
		
		$data['no_btb'] = $this->uri->segment(3);
		$data['cek_barang'] = $this->cashier_model->cek_barang_instore($data['no_btb']);
		echo $data['no_btb'] ;
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/void_reason_dbi', $data);
		#$this->load->view('template/footer');
	}
	
	function do_void_dbi()
	{
		#model call
		$this->load->model('cashier_model');
		
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		$no_btb = $this->uri->segment(3);
		
		$this->cashier_model->do_void_dbi($no_btb, $user);
		
		redirect('cashier');
	}
	
	public function void_dbo()
	{
		$data['no_btb'] = $this->uri->segment(3);
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/void_reason_dbo', $data);
		#$this->load->view('template/footer');
	}
	
	function do_void_dbo()
	{
		#model call
		$this->load->model('cashier_model');
		
		$user = $this->session->userdata('logged_in');
		$user = $user['id_user'];
		$no_btb = $this->uri->segment(3);
		
		$this->cashier_model->do_void_dbo($no_btb, $user);
		
		redirect('cashier');
	}
	
	function my_balance()
	{
		$this->load->model('cashier_model');
		$data['query'] = $this->cashier_model->get_cashier();
		
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/my_balance', $data);
		#$this->load->view('template/footer');
	}
	
	function my_balance_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = $this->input->post('kasir');
		$data['user'] = $user;
		
		$date = mdate("%Y-%m-%d", strtotime($this->input->post('date')));
		$data['date'] = $date;
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->my_balance_incoming($user, $date);
		$data['outgoing'] = $this->cashier_model->my_balance_outgoing($user, $date);
		$data['void'] = $this->cashier_model->my_void($user, $date);
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/my_balance_incoming', $data);
		#$this->load->view('template/footer');
	}
	
	function my_balance_pdf_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = $this->uri->segment(3);
		$data['user'] = $user;
		
		$date = mdate("%Y-%m-%d", strtotime($this->uri->segment(4)));
		$data['date'] = $date;
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->my_balance_incoming($user, $date);
		$data['outgoing'] = $this->cashier_model->my_balance_outgoing($user, $date);
		#$data['void'] = $this->cashier_model->my_void($user, $date);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lap-kasir-'.$user. '-'.$date;
		$stn = 'kno';
		
		$html = $this->load->view('cashier/pdf/my_balance_pdf', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		/*$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/my_balance_pdf', $data);
		$this->load->view('template/footer');*/
	}
	
	function summary()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/summary');
		#$this->load->view('template/footer');
	}
	
	
	function summary_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->input->post('date')));
		$data['date']=$date;
		
		# select type
		if($date <= '2013-07-31')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($date, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($date);
		
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/summary_result', $data);
		#$this->load->view('template/footer');
	}
	
	
	function pdf_summary_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->uri->segment(3)));
		$data['date']=$date;
		
		# select type
		if($date <= '2013-07-31')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($date, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($date);
		
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'summary-'.$date;
		$stn = 'kno';
		$html = '';
		$html = $this->load->view('cashier/pdf/pdf_summary_result', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
	}
	
	function reconciliation()
	{
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/reconciliation');
		#$this->load->view('template/footer');
	}
	
	function reconciliation_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->input->post('date')));
		$data['date']=$date;
		
		# select type
		if($date <= '2013-07-31')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($date, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($date);
		
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/reconciliation_result', $data);
		#$this->load->view('template/footer');
	}
	
	function pdf_reconciliation_result()
	{
		$date = mdate('%Y-%m-%d', strtotime($this->uri->segment(3)));
		$data['date']=$date;
		
		# select type
		if($date <= '2013-07-31')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($date, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($date);
		
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'summary-'.$date;
		$stn = 'kno';
		$html = '';
		$html = $this->load->view('cashier/pdf/pdf_reconciliation_result', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
	}
	
	function piutang_agent()
	{
	}
	
	function fix_db()
	{
		$this->load->model('cashier_model');
		$old_db_id = $this->uri->segment(3);
		$no_db = $this->cashier_model->get_last_db();
		$this->cashier_model->renew_db($old_db_id, $no_db);
	}
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */