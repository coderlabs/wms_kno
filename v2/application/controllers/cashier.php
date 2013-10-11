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
		$search = $this->input->post('btb_no');
		

		if(substr($search,0,2) < 13)
		{
			#incoming
			$incoming = $this->cashier_model->payment_receipt_incoming($search);
			if($incoming == TRUE)
			{
				# redirect to incoming
				$this->session->set_flashdata('no_btb', $search);
				redirect('cashier/payment_receipt_incoming/', 'refresh');
			} 
			else 
			{
				# redirect to search again
				redirect('cashier/new_receipt/', 'refresh');
			}
		}
		elseif(substr($search,0,2) == 20) 
		{
			#outgoing
			$outgoing = $this->cashier_model->payment_receipt_outgoing($search);
			if($outgoing == TRUE)
			{
				# redirect to outgoing
				$this->session->set_flashdata('no_btb', $search);
				redirect('cashier/payment_receipt_outgoing/', 'refresh');
			}
			else 
			{
				# redirect to search again
				redirect('cashier/new_receipt/', 'refresh');
			}
		}
		else
		{
			# redirect to search again
			redirect('cashier/new_receipt/', 'refresh');
		}

	}
	
	public function payment_receipt_outgoing()
	{		
		$nobtb = $this->session->flashdata('no_btb');
		
		#get data from url
		#$search = $this->uri->segment(3,0);
		$search = $this->session->flashdata('no_btb');
		
		if($search == 0){redirect('cashier/new_receipt');}
		
		#load model
		$this->load->model('cashier_model');
		
		# cek payment status
		$paid = $this->cashier_model->get_void_status($search);
		
			if($paid == TRUE)
			{
				$data['search'] = $search;
				
				# call model
				$void = $this->cashier_model->get_void_status($search);
				
				foreach($void as $void_item):
					$void = $void_item->isvoid;
					$no_db = $void_item->nodb;
				endforeach;
				
				if($void == 1)
				{
					$data['void'] = 'yes';
				}
				else
				{
					$data['void'] = 'no';
				}
				
				$data['db'] = $no_db;
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
					$berat_aktual_btb = $item->btb_totalberat;
					$berat_bayar_btb = $item->btb_totalberatbayar;
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
					$durasi_aktual = 1;
					$durasi_bayar = 1;
				}
				else
				{
					$durasi_bayar = $durasi_aktual - 2;
				}
				$data['jumhari'] = $durasi_bayar;
				$data['minhari'] = $durasi_bayar;
				
				
				# get weight
				# get weight
				if($berat_aktual_btb > $berat_bayar_btb)
				{
					if($berat_aktual_btb <= $minweight)
					{
						$berat_bayar = $minweight;
						$data['minweight'] = 'y';
					}
					else
					{
						$berat_bayar = $berat_aktual_btb;
						$data['minweight'] = 'n';
					}
				}
				else
				{
					if($berat_bayar_btb <= $minweight)
					{
						$berat_bayar = $minweight;
						$data['minweight'] = 'y';
					}
					else
					{
						$berat_bayar = $berat_bayar_btb;
						$data['minweight'] = 'n';
					}
				}
				
				$data['totalberat'] = $berat_bayar;
				
				# payment calculation
				$data['no_btb'] = $no_btb;
				$data['agent'] = $agent;
				$data['no_smu'] = $no_smu;
				$data['airline'] = $airline;
				$data['tujuan'] = $tujuan;
				$data['berat_aktual'] = $berat_aktual_btb;
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
				$this->load->view('template/header');
				$this->load->view('template/breadcumb');
				$this->load->view('cashier/payment_receipt_outgoing_form',$data);
				#$this->load->view('template/footer');
				#$this->load->view('template/footer');
			}
	}
	
	public function payment_receipt_incoming()
	{
		$nobtb = $this->session->flashdata('no_btb');
		
		# get data from url
		#$search = $this->uri->segment(3,0);
		$search = $this->session->flashdata('no_btb');
		
		# if null
		if($search == 0){redirect('cashier/new_receipt');}
		
		#load model
		$this->load->model('cashier_model');
		
		# cek payment status
		$paid = $this->cashier_model->get_void_status($search);
		
			if($paid == TRUE)
			{
				# btb paid
				
				# call model
				$void = $this->cashier_model->get_void_status($search);
				
				foreach($void as $void_item):
					$void = $void_item->isvoid;
					$no_db = $void_item->nodb;
				endforeach;
				
				if($void == 1)
				{
					$data['void'] = 'yes';
				}
				else
				{
					$data['void'] = 'no';
				}
				
				# send data search to view
				$data['search'] = $search;
				$data['db'] = $no_db;
				
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
					$berat_aktual_btb = $item->in_berat_datang;
					$berat_volume_btb = $item->in_berat_volume;
					$berat_bayar_btb = $item->in_berat_bayar;
					$tanggal_masuk = $item->in_tgl_manifest;
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
					if ($durasi_aktual == 0)
					{
						$durasi_aktual = 1;
					}
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
				if($berat_aktual_btb > $berat_bayar_btb)
				{
					if($berat_aktual_btb <= $minweight)
					{
						$berat_bayar = $minweight;
						$data['minweight'] = 'y';
					}
					else
					{
						$berat_bayar = $berat_aktual_btb;
						$data['minweight'] = 'n';
					}
				}
				else
				{
					if($berat_bayar_btb <= $minweight)
					{
						$berat_bayar = $minweight;
						$data['minweight'] = 'y';
					}
					else
					{
						$berat_bayar = $berat_bayar_btb;
						$data['minweight'] = 'n';
					}
				}
				
				$data['totalberat'] = $berat_bayar;
				
				# payment calculation
				$data['no_btb'] = $no_btb;
				$data['agent'] = $agent;
				$data['no_smu'] = $no_smu;
				$data['airline'] = $airline;
				$data['tujuan'] = $tujuan;
				$data['berat_aktual'] = $berat_aktual_btb;
				$data['berat_volume'] = $berat_volume_btb;
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
		$this->load->model('supervisor_model');
		
		# get agent balance
		$balance = $this->supervisor_model->get_balance_by_name($this->input->post('agent'));
		foreach ($balance as $row)
		{
			$last_balance = $row->balance;
			$id_agent = $row->id_agent;
		}
		$payment = $this->input->post('payment_type');
		if ( $payment == 'credit')
		{
			if ($balance == NULL)
			{
				redirect('cashier/new_receipt/balance_not_enough');
			} else
			if ($this->input->post('total_bayar') > $last_balance)
			{
				redirect('cashier/new_receipt/balance_not_enough');
			} else {
				$ket = 'kredit pembayaran '.$this->input->post('btb_no');
				$this->supervisor_model->kredit_balance($id_agent, $last_balance, $ket);
			}
		} 
		
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
		
		$this->session->set_flashdata('no_db', $no_db);
		
		if($this->input->post('type') == 0)
		{
			$this->cashier_model->update_in_dtbarang($this->input->post('btb_no'));
			$this->cashier_model->update_in_dtbarang_berat($this->input->post('btb_no'), $this->input->post('berat_bayar'));
			redirect('cashier/print_dbi/', 'refresh');
		} 
		elseif($this->input->post('type') == 1)
		{
			$this->cashier_model->update_out_dtbarang_h($this->input->post('btb_no'));
			$this->cashier_model->update_out_dtbarang_h_berat($this->input->post('btb_no'), $this->input->post('berat_bayar'));
			redirect('cashier/print_dbo/', 'refresh');
		}
	}
	
	public function print_dbi()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		$data['nodb'] = $this->session->flashdata('no_db');
		
		# Call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/print_npjg_incoming', $data);
	}
	
	public function print_dbo()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		$data['nodb'] = $this->session->flashdata('no_db');
		
		# Call view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/print_npjg_outgoing', $data);
	}
	
	public function print_pdf_dbi()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		$no_db = $this->uri->segment(3);
		
		$data['query'] = $this->cashier_model->get_delivery_bill_in($no_db);
		
		foreach($data['query'] as $row):
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$no_db = $row->nodb;
			$no_btb = $row->no_smubtb;
		endforeach;
		
		$this->cashier_model->update_status_print($no_db);
		$this->cashier_model->update_in_dtbarang($no_btb);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'npjg-'.$no_db;
		$data['filename'] = $filename . '.pdf';
		$stn = 'kno';
		$html = $this->load->view('cashier/pdf/print_dbi', $data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		
	}
	
	public function print_pdf_dbo()
	{
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		$no_db = $this->uri->segment(3);
		$no_btb = '';
		$data['query'] = $this->cashier_model->get_delivery_bill_out($no_db);
		
		foreach($data['query'] as $row):
			$data['terbilang'] = number_to_words($row->total_biaya);
			$type = $row->status;
			$no_db = $row->nodb;
			$no_btb = $row->no_smubtb;
		endforeach;
		$this->cashier_model->update_status_print($no_db);
		$this->cashier_model->update_out_dtbarang_h($no_btb);
		
		$this->load->view('cashier/pdf/print_dbo', $data); 
		# Helper Load
		$this->load->helper('sigap_pdf');
		
		//PDF Maker
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'npjg-'.$no_db;
		$data['filename'] = $filename . '.pdf';
		$stn = 'kno';
		$html = $this->load->view('cashier/pdf/print_dbo', $data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		
	}
	
	
	public function reprint_db()
	{
		$data['no_btb'] = $this->uri->segment(3);
		
		#model call
		$this->load->model('cashier_model');
		$this->load->helper('terbilang');
		
		#View Call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
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
		
		/*$no_db = $this->cashier_model->get_nodb($no_btb);
		
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
		$full_filename = $filename . '.pdf';*/
		
		
		
		//redirect('cashier/payment/');
	}
	
	public function void_dbi()
	{
		#model call
		$this->load->model('cashier_model');
		
		$data['no_btb'] = $this->uri->segment(3);
		$data['no_db'] = $this->uri->segment(4);
		$data['cek_barang'] = $this->cashier_model->cek_barang_instore($data['no_btb']);
		
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
		$no_db = $this->uri->segment(4);
		
		if($this->input->post('status_kembali') == 1){
			$data = $this->cashier_model->get_agent_in($no_btb);
			$credit = $this->cashier_model->get_payment_type($no_db);
			if ($credit->id_carabayar == 'CREDIT')
			{
				if ($data != NULL)
				{
					$balance = $this->cashier_model->get_balance_agent($data->id_agent);
					$this->cashier_model->do_void_balance_dbi($no_btb, $data->id_agent,$data->kredit, $balance->balance);
				}
			}
		}
		$this->cashier_model->do_void_dbi($no_btb, $no_db, $user);
		redirect('cashier/new_receipt');
	}
	
	public function void_dbo()
	{
		$data['no_btb'] = $this->uri->segment(3);
		$data['no_db'] = $this->uri->segment(4);
		
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
		$no_db = $this->uri->segment(4);
		
		if($this->input->post('status_kembali') == 1){
			$data = $this->cashier_model->get_agent_out($no_btb);
			$credit = $this->cashier_model->get_payment_type($no_db);
			if ($credit->id_carabayar == 'CREDIT')
			{
				if ($data != NULL)
				{
					$balance = $this->cashier_model->get_balance_agent($data->id_agent);
					$this->cashier_model->do_void_balance_dbo($no_btb, $data->id_agent,$data->kredit, $balance->balance);
				}
			}
		}
		$this->cashier_model->do_void_dbo($no_btb, $no_db, $user);
		
		redirect('cashier/new_receipt');
	}
	
	function my_balance()
	{
		$this->load->model('cashier_model');
		$data['query'] = $this->cashier_model->get_cashier();
		
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/my_balance', $data);
		#$this->load->view('template/footer');
	}
	
	function my_balance_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = $this->input->post('kasir');
		$data['user'] = $user;
		
		$startdate = mdate("%Y-%m-%d", strtotime($this->input->post('startdate')));
		$enddate = mdate("%Y-%m-%d", strtotime($this->input->post('enddate')));
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		$data['type'] = $this->input->post('type'); 
		
		#model call
		$this->load->model('cashier_model');
		if($data['type'] == "incoming"){			
			$data['incoming'] = $this->cashier_model->my_balance_incoming($user, $startdate, $enddate);
		} 
		else if($data['type'] == "outgoing"){
			$data['outgoing'] = $this->cashier_model->my_balance_outgoing($user, $startdate, $enddate);
		} 
		else if($data['type'] == "void"){
			$data['void'] = $this->cashier_model->my_void($user, $startdate, $enddate);
		}
		else if($data['type'] == "total"){
			# penentuan version incoming
			if($startdate < '2013-08-02')
			{
				$typeincoming = 'v2';
			}
			else
			{
				$typeincoming = 'v3';
			}
			$data['incoming'] = $this->cashier_model->my_summary_incoming_result($user, $startdate, $enddate, $typeincoming);
			$data['outgoing'] = $this->cashier_model->my_summary_outgoing_result($user, $startdate, $enddate);
			$data['void'] = $this->cashier_model->my_summary_void_result($user, $startdate, $enddate);
		}
		
		# load view
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		
		if($data['type'] == 'incoming'){
			$this->load->view('cashier/my_balance_incoming_result', $data);
		} 
		else if($data['type'] == 'outgoing'){
			$this->load->view('cashier/my_balance_outgoing_result', $data);
		}
		else if($data['type'] == 'void'){
			$this->load->view('cashier/my_balance_void_result', $data);
		}
		else if($data['type'] == 'total'){
			$this->load->view('cashier/my_summary_result', $data);
		}
		
		#$this->load->view('template/footer');
	}
	
	
	
	# transaksiku pdf
	function my_balance_detail_pdf_result()
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
		$data['void'] = $this->cashier_model->my_void($user, $date);
		
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
	}
	function my_incoming_balance_detail_pdf_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = str_replace('%20',' ',$this->uri->segment(3));
		$data['user'] = $user;
		
		$startdate = mdate("%Y-%m-%d", strtotime($this->uri->segment(4)));
		$enddate = mdate("%Y-%m-%d", strtotime($this->uri->segment(5)));
		$data['startdate'] = $startdate;
		$data['enddate'] = $startdate;
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->my_balance_incoming($user, $startdate, $enddate);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lap-incoming-kasir-'.$user. '-'.$startdate. ' sd '.$enddate;
		$stn = 'kno';
		$html = $this->load->view('cashier/pdf/my_incoming_balance_pdf', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
	}
	function my_outgoing_balance_detail_pdf_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = str_replace('%20',' ',$this->uri->segment(3));
		$data['user'] = $user;
		
		$startdate = mdate("%Y-%m-%d", strtotime($this->uri->segment(4)));
		$enddate = mdate("%Y-%m-%d", strtotime($this->uri->segment(5)));
		$data['startdate'] = $startdate;
		$data['enddate'] = $startdate;
		
		#model call
		$this->load->model('cashier_model');
		$data['outgoing'] = $this->cashier_model->my_balance_outgoing($user, $startdate, $enddate);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lap-outgoing-kasir-'.$user. '-'.$startdate.' sd '.$enddate;
		$stn = 'kno';
		
		$html = $this->load->view('cashier/pdf/my_outgoing_balance_pdf', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	
	function my_void_balance_detail_pdf_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = str_replace('%20',' ',$this->uri->segment(3));
		$data['user'] = $user;
		
		$startdate = mdate("%Y-%m-%d", strtotime($this->uri->segment(4)));
		$enddate = mdate("%Y-%m-%d", strtotime($this->uri->segment(5)));
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		
		#model call
		$this->load->model('cashier_model');
		$data['void'] = $this->cashier_model->my_void($user, $startdate, $enddate);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lap-void-kasir-'.$user. '-'.$startdate.' sd '.$enddate;
		$stn = 'kno';
		
		$html = $this->load->view('cashier/pdf/my_void_balance_pdf', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
		
	}
	function my_balance_summary_pdf_result()
	{
		# incoming
		/*$user = $this->session->userdata('logged_in');*/
		$user = str_replace('%20',' ',$this->uri->segment(3));
		$data['user'] = $user;
		
		$startdate = mdate("%Y-%m-%d", strtotime($this->uri->segment(4)));
		$enddate = mdate("%Y-%m-%d", strtotime($this->uri->segment(5)));
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		# penentuan version incoming
		if($startdate < '2013-08-02')
		{
			$typeincoming = 'v2';
		}
		else
		{
			$typeincoming = 'v3';
		}
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->my_summary_incoming_result($user, $startdate, $enddate, $typeincoming);
		$data['outgoing'] = $this->cashier_model->my_summary_outgoing_result($user, $startdate, $enddate);
		$data['void'] = $this->cashier_model->my_summary_void_result($user, $startdate, $enddate);
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'lap-kasir-'.$user. '-'.$startdate.' sd '.$enddate;
		$stn = 'kno';
		
		$html = $this->load->view('cashier/pdf/my_pdf_summary_result', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
	}
	# akhir transaksiku
	
	
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
		$startdate = mdate('%Y-%m-%d', strtotime($this->input->post('startdate')));
		$data['startdate']=$startdate;
		$enddate = mdate('%Y-%m-%d', strtotime($this->input->post('enddate')));
		$data['enddate']=$enddate;
		
		# select type
		if($startdate < '2013-08-02')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($startdate, $enddate, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($startdate, $enddate);
		
		#print_r($data);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/summary_result', $data);
		#$this->load->view('template/footer');
	}
	
	
	function pdf_summary_result()
	{
		$startdate = mdate('%Y-%m-%d', strtotime($this->uri->segment(3)));
		$data['startdate']=$startdate;
		$enddate = mdate('%Y-%m-%d', strtotime($this->uri->segment(4)));
		$data['enddate']=$enddate;
		
		# select type
		if($startdate < '2013-08-02')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($startdate,$enddate, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($startdate,$enddate);
		
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'landscape';
		$filename = 'summary-'.$startdate.'-sd-'.$enddate;
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
		$startdate = mdate('%Y-%m-%d', strtotime($this->input->post('startdate')));
		$data['startdate']=$startdate;
		$enddate = mdate('%Y-%m-%d', strtotime($this->input->post('enddate')));
		$data['enddate']=$enddate;
				
		# select type
		if($startdate < '2013-08-02')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($startdate, $enddate, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($startdate, $enddate);
		
		
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		#$this->load->view('cashier/menu');
		$this->load->view('cashier/reconciliation_result', $data);
		#$this->load->view('template/footer');
	}
	
	function pdf_reconciliation_result()
	{
		$startdate = mdate('%Y-%m-%d', strtotime($this->uri->segment(3)));
		$data['startdate']=$startdate;
		$enddate = mdate('%Y-%m-%d', strtotime($this->uri->segment(4)));
		$data['enddate']=$enddate;
		
		# select type
		if($startdate < '2013-08-02')
		{
			$type = 'v2';
		}
		else
		{
			$type = 'v3';
		}
		
		#model call
		$this->load->model('cashier_model');
		$data['incoming'] = $this->cashier_model->incoming_summary_income($startdate, $enddate, $type);
		$data['outgoing'] = $this->cashier_model->outgoing_summary_income($startdate, $enddate);
		
		
		# Helper Load
		$this->load->helper('sigap_pdf');
		$stream = TRUE; 
		$papersize = 'legal'; 
		$orientation = 'potrait';
		$filename = 'summary-'.$startdate.'-sd-'.$enddate;
		$stn = 'kno';
		$html = '';
		$html = $this->load->view('cashier/pdf/pdf_reconciliation_result', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
		$full_filename = $filename . '.pdf';
		
	}
	
	function fix_db()
	{
		$this->load->model('cashier_model');
		$old_db_id = $this->uri->segment(3);
		$no_db = $this->cashier_model->get_last_db();
		$this->cashier_model->renew_db($old_db_id, $no_db);
	}
	
	function all_inbound()
	{
		#$date = mdate('%Y-%m-%d', strtotime($this->input->post('date')));
		
		# weighing list pagination
		$this->load->library('pagination');
		
		
		$config 				= array();
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['base_url'] 	= site_url() . '/cashier/all_inbound_result/';
		$config['per_page'] 	= 10; 
		$config["uri_segment"] 	= 4;
		$page 					= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$limit 					= $config["per_page"];
		$offset 				= $page;
		
		$this->load->model('cashier_model');
		$total = $this->cashier_model->count_all_inbound();
		$config['total_rows'] = $total;
		
		# select type
		
		
		$this->pagination->initialize($config);
		$data['details'] = $this->cashier_model->all_inbound($limit, $offset);
		#$data['query'] = $this->pagination->create_links();
		#$data['query'] = $this->cashier_model->all_inbound($date);
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/details_incoming', $data);
		
	}

	# awal list delivery bill
	public function list_db()
	{
		$this->load->model('cashier_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/cashier/list_db/'; 
		$config['total_rows'] = $this->cashier_model->count_all_db(); 
		$config['per_page'] = 30; 
		$config['uri_segment'] = 3; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['result']=$this->cashier_model->get_all_db($config['per_page'],$page);
		$data['offset'] = $page;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/list_db',$data);
		$this->load->view('template/footer');
	}
	
	function do_search_db()
	{
		if ($this->input->post('db') == NULL )
		{
			$db = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$db = $this->input->post('db');
		}
		$db = $this->myUrlEncode($db);
		
		if($db == "" ){	$db_link = 'ALL' ; }
		else{$db_link = $db;}
		
		
		$this->load->model('cashier_model');
		#pagination config
		$config['base_url'] = base_url().'index.php/cashier/do_search_db/'.$db_link.'/'; 
		$config['total_rows'] = $this->cashier_model->count_db_by_nodb($db); 
		$config['per_page'] = 30; 
		$config['uri_segment'] = 4; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['result']=$this->cashier_model->get_db_by_nodb($db,$config['per_page'],$page);
		$data['offset'] = $page;
		
		#view call
		$this->load->view('template/header');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/list_db',$data);
		$this->load->view('template/footer');
	
	}
	
	function myUrlEncode($string) {
		$replacements = array('_', '_', "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_",  "_", "_", "_");
		$entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?",  "#", "[", "]");
		return str_replace($entities, $replacements, $string);
	}
	
	# akhir list delivery bill
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */